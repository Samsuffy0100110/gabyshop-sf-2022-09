<?php

namespace App\Controller\Front;

use App\Repository\Front\LogoRepository;
use App\Repository\Front\ShopRepository;
use App\Repository\Front\BannerRepository;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\Product\CategoryRepository;
use App\Repository\Product\ParentCategoryRepository;
use App\Repository\Product\FeaturedProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    public function banner(BannerRepository $bannerRepository): Response
    {
        return $this->render('includes/banner/index.html.twig', [
            'banners' => $bannerRepository->findBy(['isActive' => true]),
        ]);
    }

    public function logo(LogoRepository $logoRepository, ShopRepository $shopRepository): Response
    {

        return $this->render('includes/logo/index.html.twig', [
            'logos' => $logoRepository->findAll(),
            'shops' => $shopRepository->findAll(),
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
        return $this->render('includes/productCarousel/index.html.twig', [
            'categories' => $category->findAll(),
            'parentCategories' => $parent->findAll(),
            'products' => $product->findAll(),
        ]);
    }

    public function latestProducts(
        ProductRepository $productRepository,
    ): Response {

        return $this->render('includes/latestProducts/index.html.twig', [
            'products' => $productRepository->findBy([], ['createdAt' => 'DESC'], 3),
        ]);
    }

    public function randomProducts(FeaturedProductsRepository $featuredRepository): Response
    {
        return $this->render('includes/randomProducts/index.html.twig', [
            'starProducts' => $featuredRepository->findAll(),
        ]);
    }

    public function aboutUs(ShopRepository $shopRepository): Response
    {
        return $this->render('includes/aboutus/index.html.twig', [
            'shops' => $shopRepository->findAll(),
        ]);
    }
}
