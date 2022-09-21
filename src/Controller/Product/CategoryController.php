<?php

namespace App\Controller\Product;

use App\Entity\Product\Category;
use App\Form\SearchProductType;
use App\Entity\Product\ParentCategory;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
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
        methods: ['GET', 'POST'],
        priority: -1
    )]
    #[ParamConverter('category', options: ['mapping' => ['category' => 'slug']])]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory' => 'slug']])]
    public function showProductsByCategories(
        Category $category,
        ParentCategory $parentCategory,
        ProductRepository $productRepository,
        Request $request
    ): Response {

        $form = $this->createForm(SearchProductType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $products = $productRepository->findLikeName($search);
        } else {
            $products = $productRepository->findByCategory($category);
        }

        return $this->render('category/index.html.twig', [
            'category' => $category,
            'parentCategory' => $parentCategory,
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }
}
