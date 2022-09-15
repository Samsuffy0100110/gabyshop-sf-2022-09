<?php

namespace App\Controller;

use App\Repository\LogoRepository;
use App\Repository\ShopRepository;
use App\Repository\ThemeRepository;
use App\Repository\BannerRepository;
use App\Repository\SocialRepository;
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

    public function footerMap(ShopRepository $shopRepository): Response
    {
        return $this->render('includes/footer/_localisation.html.twig', [
            'shops' => $shopRepository->findAll(),
        ]);
    }

    public function footerShop(ShopRepository $shopRepository): Response
    {
        return $this->render('includes/footer/_shop.html.twig', [
            'shops' => $shopRepository->findAll(),
        ]);
    }

    public function footerSocial(SocialRepository $socialRepository, ShopRepository $shopRepository): Response
    {
        return $this->render('includes/footer/_socials.html.twig', [
            'socials' => $socialRepository->findAll(),
            'shops' => $shopRepository->findAll(),
        ]);
    }

    public function aboutUs(ShopRepository $shopRepository): Response
    {
        return $this->render('includes/aboutus/index.html.twig', [
            'shops' => $shopRepository->findAll(),
        ]);
    }
}
