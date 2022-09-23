<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    #[Route('account/change-password', name: 'change-password')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $hashPass,
        UserRepository $userRepository
    ): Response {
        $user = $userRepository->findOneBy(['id' => $this->getUser()]);
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($hashPass->hashPassword($user, $form->get('plainPassword')->getData()));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre mot de passe a bien été mis à jour.');
            return $this->redirectToRoute('account_dashboard', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('account/change-password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
