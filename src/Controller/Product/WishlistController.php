<?php

namespace App\Controller\Product;

use App\Entity\Product\Wishlist;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\Product\WishlistRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/wishlist')]
class WishlistController extends AbstractController
{
    #[Route('/new', name: 'wishlist_new', methods: ['GET', 'POST'])]
    public function new(WishlistRepository $wishlistRepository): Response
    {
        $wishlist = new Wishlist();
        $wishlist->setUser($this->getUser());
        // $wishlist->setProduct($wishlistRepository->find($request->get('product')));
        $wishlistRepository->save($wishlist, true);

        return $this->redirectToRoute('account_wishlist');

        return $this->renderForm('product/_wishlist.html.twig', [
            'wishlist' => $wishlist,
        ]);
    }

    #[Route('/{id}', name: 'wishlist_delete', methods: ['POST'])]
    public function delete(Request $request, Wishlist $wishlist, WishlistRepository $wishlistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $wishlist->getId(), $request->request->get('_token'))) {
            $wishlistRepository->remove($wishlist, true);
        }

        return $this->redirectToRoute('account_wishlist', [], Response::HTTP_SEE_OTHER);
    }
}
