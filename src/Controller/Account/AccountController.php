<?php

namespace App\Controller\Account;

use App\Repository\UserRepository;
use App\Form\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function profile(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre profil a bien été mis à jour.');
            return $this->redirectToRoute('account_profile', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('account/profile.html.twig', [
            'user' => $userRepository->findOneBy(['id' => $this->getUser()]),
            'form' => $form->createView(),
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
