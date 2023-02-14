<?php

namespace App\Controller\Communication;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mime\Address;
use App\Repository\Front\LogoRepository;
use App\Repository\Front\ShopRepository;
use App\Repository\Front\ThemeRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Communication\NewsLetterRepository;
use App\Repository\Communication\NewsLetterUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/newsletter')]
class SendNewsController extends AbstractController
{
    #[Route('/preview', name: 'newsletter_preview', methods: ['GET', 'POST'])]
    public function sendViewNewsletter(
        NewsLetterRepository $newsLetterRepository,
        int $id
    ): Response {
        return $this->render('mailer/newsLetterPreview.html.twig', [
            'newsletter' => $newsLetterRepository->find($id),
        ]);
    }

    #[Route('/{id}/send', name: 'newsletter_send', methods: ['GET', 'POST'])]
    public function sendNewsletter(
        MailerInterface $mailer,
        NewsLetterUserRepository $user,
        NewsLetterRepository $newsLetter,
        ShopRepository $shopRepository,
        LogoRepository $logoRepository,
        ThemeRepository $themeRepository,
        int $id
    ): Response {
        $shop = $shopRepository->findOneBy(['isActive' => true]);
        $logo = $logoRepository->findOneBy(['isActive' => true]);
        $theme = $themeRepository->findOneBy(['isActive' => true]);
        $users = $user->findAll();
        foreach ($users as $user) {
            $email = (new TemplatedEmail())
            ->from(new Address($this->getParameter('mailer_address'), $shop->getName()))
            ->to(new Address($user->getEmail()))
            ->subject('Newsletter de ' . $shop->getName())
            ->htmlTemplate('mailer/newsLetter.html.twig')
            ->context([
                'newsletter' => $newsLetter->find($id),
                'uuid' => Uuid::v4(),
                'shop' => $shop,
                'logo' => $logo,
                'theme' => $theme,
            ]);
            $mailer->send($email);
        }
            $this->addFlash('success', 'Newsletter envoyée avec succès');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
