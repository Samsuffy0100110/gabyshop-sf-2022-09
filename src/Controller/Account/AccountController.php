<?php

namespace App\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account/', name: 'account_')]
class AccountController extends AbstractController
{
    #[Route('dashboard', name: 'dashboard')]
    public function dashboard(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('account/profile.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('change-password', name: 'change-password')]
    public function changePassword(): Response
    {
        return $this->render('account/change-password.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('addresses', name: 'addresses')]
    public function addresses(): Response
    {
        return $this->render('account/addresses.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('orders', name: 'orders')]
    public function orders(): Response
    {
        return $this->render('account/orders.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('wishlist', name: 'wishlist')]
    public function wishlist(): Response
    {
        return $this->render('account/wishlist.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
