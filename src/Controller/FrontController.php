<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Service\fullProducts;
use App\Entity\ParentCategory;
use App\Repository\LogoRepository;
use App\Repository\ThemeRepository;
use App\Repository\BannerRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use App\Repository\ParentCategoryRepository;
use App\Repository\FeaturedProductsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    public function footerColor(ThemeRepository $themeRepository): Response
    {
        return $this->render('includes/footer/index.html.twig', [
            'theme' => $themeRepository->findOneBy(['isActive' => true]),
        ]);
    }

    public function banner(BannerRepository $bannerRepository): Response
    {
        return $this->render('includes/banner/index.html.twig', [
            'banner' => $bannerRepository->findOneBy(['isActive' => true]),
        ]);
    }

    public function logo(LogoRepository $logoRepository): Response
    {
        return $this->render('includes/logo/index.html.twig', [
            'logo' => $logoRepository->findAll(),
        ]);
    }

    public function navbar(
        CategoryRepository $category,
        ParentCategoryRepository $parent,
        ProductRepository $product
    ): Response {
        return $this->render('includes/navbar/index.html.twig', [
            'categories' => $category->findAll(),
            'parentCategories' => $parent->findAll(),
            'products' => $product->findAll(),
        ]);
    }

    public function carousel(
        CategoryRepository $category,
        ParentCategoryRepository $parent,
        ProductRepository $product
    ): Response {
        return $this->render('includes/productcarousel/index.html.twig', [
            'categories' => $category->findAll(),
            'parentCategories' => $parent->findAll(),
            'products' => $product->findAll(),
        ]);
    }

    public function latestProducts(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        ParentCategoryRepository $parentCategory
    ): Response {

        return $this->render('includes/latestProducts/index.html.twig', [
            'products' => $productRepository->findBy([], ['createdAt' => 'DESC'], 3),
            'categories' => $categoryRepository->findAll(),
            'parentCategories' => $parentCategory->findAll(),
        ]);
    }


    public function randomProducts(FeaturedProductsRepository $featuredRepository): Response
    {
        return $this->render('includes/randomProducts/index.html.twig', [
            'starProducts' => $featuredRepository->findAll(),
        ]);
    }
}
