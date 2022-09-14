<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\ParentCategory;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'index')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route(
        '/{parentCategory}/{category}',
        name: 'product_index',
        methods: ['GET']
    )]
    #[ParamConverter('category', options: ['mapping' => ['category' => 'slug']])]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory' => 'slug']])]
    public function showProductsByCategories(
        Category $category,
        ParentCategory $parentCategory,
        ProductRepository $productRepository
    ): Response {
        $products = $productRepository->findByCategory($category);
        return $this->render('category/index.html.twig', [
            'category' => $category,
            'parentCategory' => $parentCategory,
            'products' => $products,
        ]);
    }
}
