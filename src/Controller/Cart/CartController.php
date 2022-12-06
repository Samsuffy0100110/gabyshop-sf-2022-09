<?php

namespace App\Controller\Cart;

use App\Service\CartService;
use App\Entity\Product\Custom;
use App\Entity\Product\Attribut;
use App\Repository\Product\CustomRepository;
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
    public function add(
        int $id,
        CartService $cart,
        CustomRepository $customRepository
        ): Response {

        $custom = $customRepository->findOneBy(['id' => 599]);
            $customRepository->createQueryBuilder('c')
            ->delete()
            ->where('c.id = :id')
            ->setParameter('id', 599)
            ->getQuery()
            ->execute();
            
        // $custom = new Custom();
        // $custom->setQuantity(1);
        // $custom->setPrice(0);
        // $custom->setProduct($id);
        // $customRepository->save($custom, true);



        $cart->add($id);

        // $custom->setQuantity($quantity);
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

        if ($cart->get()) {
            foreach ($cart->get() as $key => $value) {
                if ($value['product']->getId() == $id) {
                    $quantity = $value['quantity'] + $quantity;
                }
            }
        }

        $cart->addIdAndQuantity($id, $quantity);

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
