<?php

namespace App\Controller\Account;

use App\Form\User\ProfileType;
use App\Security\EmailVerifier;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/account/', name: 'account_')]
class AccountController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('dashboard', name: 'dashboard')]
    public function dashboard(UserRepository $userRepository): Response
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

    #[Route('verify-email', name: 'verify-email')]
    public function verifyEmail(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['id' => $this->getUser()]);
        $this->emailVerifier->sendEmailConfirmation(
            'verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('gabyshop@noreply.com', 'GabyShop'))
                ->to($user->getEmail())
                ->subject('Merci de confirmer votre adresse email')
                ->htmlTemplate('security/registration/confirmation_email.html.twig')
        );
        $this->addFlash('success', 'Un email de confirmation vous a été envoyé.');
        return $this->redirectToRoute('account_dashboard', [], Response::HTTP_SEE_OTHER);
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
