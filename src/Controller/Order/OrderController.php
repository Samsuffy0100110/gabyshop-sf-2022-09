<?php

namespace App\Controller\Order;

use Stripe;
use DateTime;
use App\Entity\Address;
use App\Entity\Order\Order;
use App\Service\CartService;
use App\Form\Order\OrderType;
use Symfony\Component\Mime\Email;
use App\Entity\Order\OrderDetails;
use App\Service\MondialRelayService;
use App\Repository\Front\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\Order\OrderRepository;
use App\Repository\Order\ShippingRepository;
use App\Repository\Product\CustomRepository;
use App\Repository\Product\PromoCodeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/commande', name: 'order')]
    public function index(
        CartService $cart,
        MondialRelayService $mondialRelayService,
        ShippingRepository $shippingRepository
    ) {
        if ($this->getUser() == null) {
            $this->addFlash('warning', 'Vous devez être connecté pour passer une commande.');
            return $this->redirectToRoute('login');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        return $this->render('order/index.html.twig', [
            'totalWeight' => $cart->getTotalWeight(),
            'shippingMethod' => $mondialRelayService->shipByTotWeight($cart),
            'form' => $form->createView(),
            'cart' => $cart->getFull(),
            'shipping' => $shippingRepository->findOneBy(['name' => $mondialRelayService->shipByTotWeight($cart)])
        ]);
    }

    #[Route('/commande/recapitulatif', name: 'order_recap', methods: ['POST'])]
    public function add(
        CartService $cart,
        Request $request,

        CustomRepository $customRepository,
        PromoCodeRepository $promoCodeRepository
        OrderRepository $orderRepository,
       
    ) {
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shipping = $form->get('shipping')->getData();
            $delivery = $form->get('addresses')->getData();
            $name = $form->get('name')->getData();
            $adresse = $form->get('adresse')->getData();
            $zipCode = $form->get('zipCode')->getData();
            $city = $form->get('city')->getData();
            $country = $form->get('country')->getData();
            $deliveryAddress = sprintf(
                '%s %s <br> %s <br> %s %s <br> %s',
                $delivery->getUser()->getFirstname(),
                $delivery->getUser()->getLastname(),
                $delivery->getAdresse(),
                $delivery->getZipcode(),
                $delivery->getCity(),
                $delivery->getCountry()
            );
            $adress = $form->get('addresses')->getData();
            $dayDate = new DateTime();
            $order = new Order();
            $order->setReference(sprintf('%s-%s', $dayDate->format('dmY'), uniqid()))
                ->setUser($this->getUser())
                ->setCreatedAt($dayDate)
                ->addShipping($shipping)
                ->setState(0);
            $this->entityManager->persist($order);

            $adress = new Address();
            $adress->setUser($this->getUser())
                ->setName($name)
                ->setAdresse($adresse)
                ->setZipcode($zipCode)
                ->setCity($city)
                ->setCountry($country);
            $this->entityManager->persist($adress);

            foreach ($cart->getFull() as $product) {
                $orderDetails = new OrderDetails();
                $orderDetails->setMyOrder($order)
                    ->setProduct($product['product']->getName())
                    ->setQuantity($product['quantity'])
                    ->setPrice($product['product']->getPrice())
                    ->setTaxe($product['product']->getTaxe())
                    ->setTotal($product['product']->getPrice() * $product['quantity']);

                $this->entityManager->persist($orderDetails);
            }

            $this->entityManager->flush();

            $customRepository->createQueryBuilder('c')
                ->update()
                ->set('c.customOrder', ':order')
                ->where('c.customOrder IS NULL')
                ->setParameter('order', $order)
                ->getQuery()
                ->execute();

            $orderRepository->createQueryBuilder('o')
                ->update()
                ->set('o.adress', ':adress')
                ->where('o.adress IS NULL')
                ->setParameter('adress', $adress)
                ->getQuery()
                ->execute();

            return $this->render('order/add.html.twig', [
                'cart' => $cart->getFull(),
                'shipping' => $shipping,
                'delivery_address' => $deliveryAddress,
                'reference' => $order->getReference(),
                'stripe_key' => $_ENV["STRIPE_KEY"],
                'total' => $cart->getTotal(),
                'order' => $order,
                'promo_codes' => $promoCodeRepository->findByIsValidated()
                'country' => $country,
                'adress' => $adresse
            ]);
        }
        return $this->redirectToRoute('cart');
    }

    #[Route('/stripe/create-charge/', name: 'stripe_charge', methods: ['POST'])]
    public function createCharge(
        Request $request,
        CartService $cart,
        MailerInterface $mailer,
        ShopRepository $shopRepository,
        OrderRepository $orderRepository
    ) {
        $cart->getTotal();
        Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
        Stripe\Charge::create([
            'amount' => $cart,
            "currency" => "eur",
            'description' => 'Commande sur gabyShop',
            "source" => $request->request->get('stripeToken'),
        ]);
        $shop = $shopRepository->findOneBy(['isActive' => true]);
        $order = $this->entityManager->getRepository(Order::class)
        ->findOneBy(['user' => $this->getUser()], ['createdAt' => 'DESC']);
        $getEmail = $this->entityManager->getRepository(Order::class)->findOneBy(['user' => $this->getUser()]);
        $email = (new Email())
            ->to($this->getParameter('mailer_address'))
            ->from('noreply@gmail.com')
            ->subject('Nouvelle commande')
            ->html($this->renderView('mailer/order.html.twig', [
                'cart' => $cart->getFull(),
                'total' => $cart->getTotal(),
                'shop' => $shop,
                'order' => $order,
                'address' => $order->getAdress(),
            ]));
            $mailer->send($email);

            $orderRepository->createQueryBuilder('o')
            ->update()
            ->set('o.state', ':state')
            ->where('o.state = 0')
            ->setParameter('state', 1)
            ->getQuery()
            ->execute();

            $emailClient = (new Email())
            ->to($getEmail->getUser()->getEmail())
            ->from($this->getParameter('mailer_address'))
            ->subject('Confirmation de commande')
            ->html($this->renderView('mailer/recap.html.twig', [
                'cart' => $cart->getFull(),
                'total' => $cart->getTotal(),
                'shop' => $shop,
                'order' => $order,
                'address' => $order->getAdress(),
            ]));
            $mailer->send($emailClient);

            $this->addFlash(
                'success',
                'Paiement Réussi!'
            );
        $cart->remove();
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
