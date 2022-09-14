<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\ParentCategory;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
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
        methods: ['GET']
    )]
    #[ParamConverter('parentCategory', options: ['mapping' => ['parentCategory' => 'slug']])]
    public function showProductsByCategoriesAndParentCategories(ParentCategory $parentCategory): Response
    {
        return $this->render('parent_category/index.html.twig', [
            'parentCategory' => $parentCategory,
        ]);
    }
}
