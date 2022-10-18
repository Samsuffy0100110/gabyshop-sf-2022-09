<?php

namespace App\Controller\Product;

use App\Entity\Product\Product;
use App\Entity\Product\Wishlist;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\Product\WishlistRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/wishlist')]
class WishlistController extends AbstractController
{
    #[Route('/new/{product}', name: 'wishlist_new', methods: ['GET', 'POST'])]
    #[ParamConverter('product', options: ['mapping' => ['product' => 'slug']])]
    public function new(Product $product, WishlistRepository $wishlistRepository): Response
    {
        $wishlist = new Wishlist();
        $wishlist->setUser($this->getUser());
        $wishlist->setProduct($product);
        $wishlistRepository->save($wishlist, true);

        return $this->redirectToRoute('account_wishlist');
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
