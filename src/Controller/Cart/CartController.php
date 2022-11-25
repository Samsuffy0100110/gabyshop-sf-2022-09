<?php

namespace App\Controller\Cart;

use App\Service\CartService;
use App\Entity\Product\Custom;
use App\Entity\Product\Attribut;
use App\Repository\Product\CustomRepository;
use App\Repository\Product\AttributRepository;
use App\Repository\Product\WishlistRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/panier', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CartService $cart, WishlistRepository $wishlistRepository): Response
    {
        $wishlist = $wishlistRepository->findBy(['user' => $this->getUser()]);
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull(),
            'wishlist' => $wishlist
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(CartService $cart, $id): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/add-to-cart/{id}/{quantity}/{attribut}/{description}', name: 'add-to-cart')]
    public function addQuantity(
        CartService $cart,
        int $id,
        int $quantity,
        Attribut $attribut,
        string $description,
        AttributRepository $attributRepository,
        CustomRepository $customRepository
    ): Response {
        $custom = new Custom();
        $custom->setAttribut($attribut);
        $custom->setDescription($description);
        $custom->setQuantity($quantity);
        $custom->setPrice($attribut->getPrice());
        $customRepository->save($custom, true);
        $cart->addIdAndQuantity($id, $quantity);
        $attribut->setQuantity($attribut->getQuantity() - $quantity);
        $attributRepository->add($attribut, true);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove', name: 'remove')]
    public function remove(CartService $cart): Response
    {
        $cart->remove();
        $this->addFlash('success', 'Votre panier a bien été vidé');
        return $this->redirectToRoute('home');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(CartService $cart, $id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/decrease/{id}', name: 'decrease')]
    public function decrease(CartService $cart, $id): Response
    {
        $cart->decrease($id);
        return $this->redirectToRoute('cart_index');
    }
}
