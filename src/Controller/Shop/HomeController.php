<?php

namespace App\Controller\Shop;

use App\Repository\Front\LogoRepository;
use App\Repository\Front\ShopRepository;
use App\Repository\Front\SocialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(SocialRepository $socialRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'socials' => $socialRepository->findAll(),
        ]);
    }

    public function metaDescription(ShopRepository $shopRepository, LogoRepository $logoRepository): Response
    {
        return $this->render('home/seo.html.twig', [
            'shop' => $shopRepository->findOneBy(['isActive' => true]),
            'logo' => $logoRepository->findOneBy(['isActive' => true]),
        ]);
    }
}
