<?php

namespace App\Controller\Product;

use DateTime;
use App\Entity\Product\Product;
use App\Entity\Product\Category;
use App\Entity\Product\ParentCategory;
use App\Form\Communication\CommentType;
use App\Entity\Communication\Commentary;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\Product\AttributRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Communication\CommentaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProductController extends AbstractController
{
    #[Route(
        'categorie/{parentCategory}/sous-categorie/{category}/produit/{product}',
        name: 'product_show',
        methods: ['GET', 'POST'],
    )]
    #[ParamConverter('product', options: ['mapping' => ['product' => 'slug']])]
    #[ParamConverter('category', options: ['mapping' => ['category' => 'slug']])]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory' => 'slug']])]
    public function showProduct(
        Product $product,
        Request $request,
        Category $category,
        ParentCategory $parentCategory,
        ProductRepository $productRepository,
        AttributRepository $attributRepository,
        CommentaryRepository $commentaryRepository
    ): Response {
        $user = $this->getUser();
        $comment = new Commentary();
        $comment->setProduct($product);
        $comment->setUser($user);
        $comment->setCreatedAt(new DateTime());
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaryRepository->save($comment, true);
            $this->addFlash('success', 'Merci pour ton commentaire !');
            return $this->redirectToRoute(
                'product_show',
                [
                'product' => $product->getSlug(),
                'category' => $category->getSlug(),
                'parentCategory' => $parentCategory->getSlug(),
                ]
            );
        }
        $attributs = $attributRepository->createQueryBuilder('a')
            ->select('a')
            ->join('a.product', 'p')
            ->where('p.id = :id')
            ->setParameter('id', $product->getId())
            ->getQuery()
            ->getResult();
        $products = $productRepository->findByCategory($category);
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'category' => $category,
            'parentCategory' => $parentCategory,
            'products' => $products,
            'attributs' => $attributs,
            'attribut' => $attributRepository->findByProduct($product),
            'rates' => $commentaryRepository->findByProduct($product),
            'form' => $form->createView(),
            'comment' => $comment,
        ]);
    }
}
