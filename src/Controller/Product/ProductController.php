<?php

namespace App\Controller\Product;

use App\Entity\Product\Product;
use App\Entity\Product\Category;
use App\Entity\Product\ParentCategory;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProductController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route(
        '/{parentCategory}/{category}/{product}',
        name: 'product_show',
        methods: ['GET'],
        priority: -3
    )]
    #[ParamConverter('product', options: ['mapping' => ['product' => 'slug']])]
    #[ParamConverter('category', options: ['mapping' => ['category' => 'slug']])]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory' => 'slug']])]
    public function showProduct(
        Product $product,
        Category $category,
        ParentCategory $parentCategory,
        ProductRepository $productRepository
    ): Response {
        $products = $productRepository->findByCategory($category);
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'category' => $category,
            'parentCategory' => $parentCategory,
            'products' => $products,
        ]);
    }
}
