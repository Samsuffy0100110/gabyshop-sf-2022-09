<?php

namespace App\Controller\Product;

use App\Entity\Product\ParentCategory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ParentCategoryController extends AbstractController
{
    #[Route('/parent_category', name: 'parent_category')]
    public function index(): Response
    {
        return $this->render('parent_category/index.html.twig', [
            'controller_name' => 'ParentCategoryController',
        ]);
    }

    #[Route(
        '/{parentCategory}',
        name: 'category_index',
        methods: ['GET'],
        priority: -1
    )]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory' => 'slug']])]
    public function showProductsByCategoriesAndParentCategories(ParentCategory $parentCategory): Response
    {
        return $this->render('parent_category/index.html.twig', [
            'parentCategory' => $parentCategory,
        ]);
    }
}
