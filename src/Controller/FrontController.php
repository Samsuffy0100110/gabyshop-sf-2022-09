<?php

namespace App\Controller;

use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use App\Repository\LogoRepository;
use App\Repository\ParentCategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ThemeRepository;
use App\Repository\UserRepository;
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
}
