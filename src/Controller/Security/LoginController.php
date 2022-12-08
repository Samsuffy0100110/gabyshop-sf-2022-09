<?php

namespace App\Controller\Security;

use App\Service\CartService;
use App\Service\RemoveAllService;
use App\Repository\Order\OrderRepository;
use App\Repository\Order\ShippingRepository;
use App\Repository\Product\CustomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Order\OrderDetailsRepository;
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
        CartService $cart,
        OrderRepository $orderRepository,
        RemoveAllService $removeAllService,
        CustomRepository $customRepository,
        ShippingRepository $shippingRepository,
        OrderDetailsRepository $orderDetailsRepo
    ): Response {
        $removeAllService->removeAll(
            $cart,
            $orderRepository,
            $customRepository,
            $shippingRepository,
            $orderDetailsRepo
        );
        return $this->redirectToRoute('home');
    }
}
