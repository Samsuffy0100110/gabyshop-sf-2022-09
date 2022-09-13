<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\ParentCategory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'index')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route(
        '/{parentCategory_slug<[^0-9]+>}/{category_slug<[^0-9]+>}/{product_slug<[^0-9]+>}',
        name: 'product_show',
        methods: ['GET']
    )]
    #[ParamConverter('product', options: ['mapping' => ['product_slug' => 'slug']])]
    #[ParamConverter('category', options: ['mapping' => ['category_slug' => 'slug']])]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory_slug' => 'slug']])]
    public function show(Product $product, Category $category, ParentCategory $parentCategory): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'category' => $category,
            'parentCategory' => $parentCategory,
        ]);
    }
}
