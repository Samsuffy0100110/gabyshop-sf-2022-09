<?php

namespace App\Controller\Communication;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact', name: 'contact_')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function new(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $email = (new Email())
            ->from(('sam@gmail.com'))
            ->to(('yo@gmail.com'))
            ->subject('Nouveau Message de ' .
            $contactFormData['firstname'] . ' ' .
            $contactFormData['lastname'] . ' à propos de ' .
            $contactFormData['subject'])
            ->html($contactFormData['message']);

            $mailer->send($email);

            $this->addFlash('success', 'Merci votre message a bien été envoyé');
            return $this->redirectToRoute('home');
        }

        return $this->render(
            'contact/index.html.twig',
            [
            'form' => $form->createView(),
            ]
        );
    }
}
