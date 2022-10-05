<?php

namespace App\Controller\Order;

use DateTime;
use App\Form\OrderType;
use App\Entity\Order\Order;
use App\Entity\OrderDetails;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(CartService $cart)
    {

        // if(!$this->getUser()->getAddresses()->getValues()){
        //     return $this->redirectToRoute('account_address_add');
        // }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);


        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }

    #[Route('/commande/recapitulatif', name: 'order_recap', methods: ['POST'])]
    public function add(CartService $cart, Request $request)
    {
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shipping = $form->get('shipping')->getData();
            $delivery = $form->get('addresses')->getData();
            $deliveryAddress = sprintf(
                '%s %s <br> %s <br> %s %s',
                $delivery->getUser()->getFirstname(),
                $delivery->getUser()->getLastname(),
                $delivery->getAdresse(),
                $delivery->getZipcode(),
                $delivery->getCity()
            );
            $dayDate = new DateTime();
            $order = new Order();
            $order->setReference(sprintf('%s-%s', $dayDate->format('dmY'), uniqid()))
                ->setUser($this->getUser())
                ->setCreatedAt($dayDate)
                // ->setShipping($shipping->getPrice())
                // ->setShipping($shipping->getName())
                // ->setDelivery($delivery_address)
                ->setState(0);

            $this->entityManager->persist($order);

            // foreach ($cart->getFull() as $product) {
            //     $orderDetails = new OrderDetails();
            //     $orderDetails->setMyOrder($order)
            //         ->setProduct($product['product']->getName())
            //         ->setQuantity($product['quantity'])
            //         ->setPrice($product['product']->getPrice())
            //         ->setTotal($product['product']->getPrice() * $product['quantity']);

            //     $this->entityManager->persist($orderDetails);
            // }

            $this->entityManager->flush();

            return $this->render('order/add.html.twig', [
                'cart' => $cart->getFull(),
                'shipping' => $shipping,
                'delivery_address' => $deliveryAddress,
                'reference' => $order->getReference()
            ]);
        }
        return $this->redirectToRoute('cart');
    }
}
