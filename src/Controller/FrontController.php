<?php

namespace App\Controller;

use App\Repository\BannerRepository;
use App\Repository\LogoRepository;
use App\Repository\ThemeRepository;
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
}
