<?php

namespace App\Controller\Cart;

use App\Service\CartService;
use App\Entity\Product\Custom;
use App\Entity\Product\Attribut;
use App\Service\RemoveAllService;
use App\Repository\Order\OrderRepository;
use App\Repository\Order\ShippingRepository;
use App\Repository\Product\CustomRepository;
use App\Repository\Product\WishlistRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Order\OrderDetailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/panier', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        CartService $cart,
        WishlistRepository $wishlistRepository,
    ): Response {
        $wishlist = $wishlistRepository->findBy(['user' => $this->getUser()]);
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull(),
            'wishlist' => $wishlist,
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(
        int $id,
        CartService $cart,
        CustomRepository $customRepository
    ): Response {
        $cart->add($id);
        $cartQuantity = [];
        $cartId = null;
        $customs = $customRepository->findAll();
        foreach ($customs as $custom) {
            $cartId[] = $custom->getId();
        }
        $cartQ = $cart->getFull();
        foreach ($cartQ as $key => $value) {
            $cartQuantity[$key] = $value['quantity'];
            $customRepository->createQueryBuilder('c')
                ->update()
                ->set('c.quantity', $cartQuantity[$key])
                ->where('c.id = :id')
                ->setParameter('id', $cartId[$key])
                ->getQuery()
                ->execute();
        }
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/add-to-cart/{id}/{quantity}/{attribut}/{description}', name: 'add-to-cart')]
    public function addQuantity(
        CartService $cart,
        int $id,
        int $quantity,
        Attribut $attribut,
        string $description,
        CustomRepository $customRepository
    ): Response {
        $custom = new Custom();
        $custom->setAttribut($attribut);
        $custom->setDescription($description);
        $custom->setQuantity($quantity);
        $custom->setPrice($attribut->getPrice());
        $custom->setProduct($attribut->getProduct());
        $customRepository->save($custom, true);

        $cart->addIdAndQuantity($id, $quantity);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove', name: 'remove')]
    public function remove(
        CartService $cart,
        RemoveAllService $removeAllService,
        OrderRepository $orderRepository,
        CustomRepository $customRepository,
        ShippingRepository $shippingRepository,
        OrderDetailsRepository $orderDetailsRepo
    ): Response {
        $removeAllService->removeAll(
            $cart,
            $orderRepository,
            $customRepository,
            $shippingRepository,
            $orderDetailsRepo
        );
        $this->addFlash('success', 'Votre panier a bien été vidé');
        return $this->redirectToRoute('home');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(
        int $id,
        CartService $cart,
        CustomRepository $customRepository
    ): Response {

        $customs = $customRepository->findAll();
        $customId = null;
        $customOrder = null;

        for ($i = 0; $i < count($cart->getFull()); $i++) {
            $customOrder[] = $cart->getFull()[$i]['customOrder'];
        }
        for ($i = 0; $i < count($customs); $i++) {
            $customId[] = $customs[$i]->getId();
            if ($id == $customOrder[$i]) {
                $customRepository->createQueryBuilder('c')
                    ->delete()
                    ->where('c.id = :id')
                    ->setParameter('id', $customId[$i])
                    ->getQuery()
                    ->execute();
            }
        }
        $cart->delete($id);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/decrease/{id}', name: 'decrease')]
    public function decrease(
        int $id,
        CartService $cart,
        CustomRepository $customRepository
    ): Response {

        $cart->decrease($id);
        $cartQuantity = [];
        $cartId = null;
        $customs = $customRepository->findAll();
        foreach ($customs as $custom) {
            $cartId[] = $custom->getId();
        }
        $cartQ = $cart->getFull();
        foreach ($cartQ as $key => $value) {
            $cartQuantity[$key] = $value['quantity'];
            $customRepository->createQueryBuilder('c')
                ->update()
                ->set('c.quantity', $cartQuantity[$key])
                ->where('c.id = :id')
                ->setParameter('id', $cartId[$key])
                ->getQuery()
                ->execute();
        }
        return $this->redirectToRoute('cart_index');
    }
}
