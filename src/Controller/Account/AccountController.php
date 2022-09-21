<?php

namespace App\Controller\Account;

use App\Form\ProfileType;
use App\Form\UserAdressType;
use App\Form\EditPasswordType;
use App\Repository\UserRepository;
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
    public function changePassword(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher,
        UserRepository $userRepository
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(EditPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre mot de passe à bien été modifié.');
            return $this->redirectToRoute('account_change-password', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('account/change-password.html.twig', [
            'user' => $userRepository->findOneBy(['id' => $this->getUser()]),
            'form' => $form->createView(),
        ]);
    }

    #[Route('addresses', name: 'addresses')]
    public function addresses(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserAdressType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre profil a bien été mis à jour.');
            return $this->redirectToRoute('account_addresses', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('account/addresses.html.twig', [
            'user' => $userRepository->findOneBy(['id' => $this->getUser()]),
            'form' => $form->createView(),
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
