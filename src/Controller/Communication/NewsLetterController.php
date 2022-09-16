<?php

namespace App\Controller\Communication;

use App\Form\NewsLetterType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mime\Address;
use App\Entity\Communication\NewsLetterUser;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Communication\NewsLetterUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsLetterController extends AbstractController
{
    #[Route('/subscribe-newsletter', name: 'newsletter')]
    public function new(
        Request $request,
        NewsLetterUserRepository $newsLetterRepository,
        MailerInterface $mailer
    ): Response {

        $newsLetter = new NewsLetterUser();
        $form = $this->createForm(NewsLetterType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uuid = Uuid::v4();
            $newsLetter->setUuid($uuid);
            $newsLetterRepository->add($newsLetter, true);

            $email = (new TemplatedEmail())
            ->from(new Address('gabyshop@noreply.com', 'GabyShop'))
            ->to($newsLetter->getEmail())
            ->subject('Insciption Newsletter Gaby Shop !')
            ->htmlTemplate('mailer/sub-email.html.twig')
            ->context(['uuid' => $uuid]);

            $mailer->send($email);

            $this->addFlash('success', 'Votre adresse e-mail a  bien été enregistrée, merci !');
            return $this->redirectToRoute('home');
        } else {
            $this->addFlash('error', 'Une erreur est survenue, merci de réessayer !');
            return $this->redirectToRoute('home');
        }
    }

    #[Route('/unsubscribe/{uuid}', name: 'unsubscribe')]
    public function unsubscribeNewsletter(NewsLetterUser $newsLetter, string $uuid): Response
    {
        return $this->render('mailer/unsubscribe-form.html.twig', [
            'newsLetter' => $newsLetter,
            'uuid' => $uuid
        ]);
    }

    #[Route('/validate-unsubscribe/{uuid}', name: 'validate-unsubscribe')]
    public function validateUnsubscribe(
        Request $request,
        NewsLetterUser $newsLetter,
        NewsLetterUserRepository $newsLetterRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $newsLetter->getId(), $request->request->get('_token'))) {
            $newsLetterRepository->remove($newsLetter, true);
            $this->addFlash('success', 'Votre adresse e-mail a bien été supprimée, merci !');
        }
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }

    public function subscribeForm(): Response
    {
        $newsLetter = new NewsLetterUser();
        $form = $this->createForm(NewsLetterType::class, $newsLetter, [
            'attr' => ['action' => $this->generateUrl('newsletter')]
        ]);
        return $this->renderForm('includes/newsLetter/index.html.twig', [
            'form' => $form,
        ]);
    }
}
