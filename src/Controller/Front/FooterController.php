<?php

namespace App\Controller\Front;

use App\Repository\Front\ShopRepository;
use App\Repository\Front\ThemeRepository;
use App\Repository\Front\SocialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends AbstractController
{
    public function footerColor(ThemeRepository $themeRepository): Response
    {
        return $this->render('includes/footer/index.html.twig', [
            'theme' => $themeRepository->findOneBy(['isActive' => true]),
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
}
