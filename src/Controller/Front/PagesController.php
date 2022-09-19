<?php

namespace App\Controller\Front;

use App\Repository\Front\PagesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/{slug}', name: 'pages')]
    public function page(PagesRepository $pagesRepository, string $slug): Response
    {
        return $this->render('includes/pages/page.html.twig', [
            'page' => $pagesRepository->findOneBy(['slug' => $slug]),
        ]);
    }
}
