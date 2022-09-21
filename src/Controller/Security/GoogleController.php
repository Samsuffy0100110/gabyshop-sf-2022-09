<?php

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
