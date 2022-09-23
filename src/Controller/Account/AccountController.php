<?php

namespace App\Controller\Account;

use App\Form\ProfileType;
use App\Repository\UserRepository;
use App\Form\ChangePasswordFormType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/account/', name: 'account_')]
class AccountController extends AbstractController
{
    #[Route('dashboard', name: 'dashboard')]
    public function dashboard(Request $request, UserRepository $userRepository): Response
    {
        return $this->render('account/index.html.twig', [
            'user' => $userRepository->findOneBy(['id' => $this->getUser()]),
        ]);
    }

    #[Route('profile', name: 'profile')]
    public function profile(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a bien été mis à jour.');
            return $this->redirectToRoute('account_profile', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('account/profile.html.twig', [
            'user' => $userRepository->findOneBy(['id' => $this->getUser()]),
            'form' => $form->createView(),
        ]);
    }

    #[Route('change-password', name: 'change-password')]
    public function changePassword(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre mot de passe à bien été pris en compte.');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('account/change-password.html.twig', [
            'user' => $userRepository->findOneBy(['id' => $this->getUser()]),
            'form' => $form->createView(),
        ]);
    }

    #[Route('address', name: 'address')]
    public function userAdresses(
        AddressRepository $addressRepository,
    ): Response {

        return $this->render('account/addresses.html.twig', [
            'addresses' => $addressRepository->findBy(['user' => $this->getUser()]),
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
