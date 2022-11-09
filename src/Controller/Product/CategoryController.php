<?php

namespace App\Controller\Product;

use App\Entity\Product\Category;
use App\Entity\Product\ParentCategory;
use App\Form\Product\SearchProductType;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CategoryController extends AbstractController
{
    #[Route(
        'categorie/{parentCategory}/sous-categorie/{category}',
        name: 'sub-category_show',
        methods: ['GET', 'POST'],
    )]
    #[ParamConverter('category', options: ['mapping' => ['category' => 'slug']])]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory' => 'slug']])]
    public function showProductsByCategories(
        Request $request,
        Category $category,
        ParentCategory $parentCategory,
        ProductRepository $productRepository
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
