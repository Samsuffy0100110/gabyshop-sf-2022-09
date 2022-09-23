<?php

namespace App\Controller\Security;

use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class GoogleController extends AbstractController
{
    #[Route('/connect/google', name: 'connect_google')]
    public function connectAction(ClientRegistry $clientRegistry): Response
    {
        //Redirect to google
        return $clientRegistry->getClient('google')->redirect([], []);
    }

    /**
     * After going to Google, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route('/connect/google/check', name: 'connect_google_check')]
    public function connectCheckAction(Request $request): Response
    {
        if (!$this->getUser()) {
            return new JsonResponse(array('status' => false, 'message' => 'User not found'));
        } else {
            return $this->redirectToRoute('home');
        }
    }

    #[Route('/create-password', name: 'create_password')]
    public function createPassword(
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
            $user->setIsVerified(true);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre mot de passe a bien été mis à jour.');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('security/google/create-password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
