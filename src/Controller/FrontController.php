<?php

namespace App\Controller;

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
}
