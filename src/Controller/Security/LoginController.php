<?php

namespace App\Controller\Security;

use App\Service\CartService;
use App\Repository\Product\CustomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout(): void
    {
        // controller can be blank: it will never be called!
        // throw new Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/logoutAction', name: 'logoutAction', methods: ['GET'])]
    public function logoutAction(
        CustomRepository $customRepository
    ): Response {
        $customs = $customRepository->findBy(['customOrder' => null]);
        foreach ($customs as $custom) {
            $customRepository->createQueryBuilder('c')
                ->delete()
                ->where('c.id = :id')
                ->setParameter('id', $custom->getId())
                ->getQuery()
                ->execute();
        }
        return $this->redirectToRoute('home');
    }
}
