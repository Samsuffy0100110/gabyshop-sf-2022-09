<?php

namespace App\Controller\Shop;

use App\Repository\Front\ShopRepository;
use App\Repository\Front\SocialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends AbstractController
{
    public function footerSocial(SocialRepository $socialRepository, ShopRepository $shopRepository): Response
    {
        return $this->render('includes/footer/_socials.html.twig', [
            'socials' => $socialRepository->findAll(),
            'shops' => $shopRepository->findAll(),
        ]);
    }
}
