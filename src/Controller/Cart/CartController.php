<?php

namespace App\Controller\Cart;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CartService $cart): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull()
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(CartService $cart, $id): Response
    {
        $cart->add($id);
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
