<?php

namespace App\Controller\Communication;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mime\Address;
use App\Repository\Front\LogoRepository;
use App\Repository\Front\ShopRepository;
use App\Repository\Front\ThemeRepository;
use App\Form\Communication\NewsLetterType;
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
        MailerInterface $mailer,
        LogoRepository $logoRepository,
        ThemeRepository $themeRepository,
        ShopRepository $shopRepository
    ): Response {
        $shop = $shopRepository->findOneBy(['isActive' => true]);
        $logo = $logoRepository->findOneBy(['isActive' => true]);
        $theme = $themeRepository->findOneBy(['isActive' => true]);
        $newsLetter = new NewsLetterUser();
        $form = $this->createForm(NewsLetterType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uuid = Uuid::v4();
            $newsLetter->setUuid($uuid);
            $newsLetterRepository->add($newsLetter, true);

            $email = (new TemplatedEmail())
            ->from(new Address($this->getParameter('mailer_address'), $shop->getName()))
            ->to($newsLetter->getEmail())
            ->subject('Insciption Newsletter Gaby Shop !')
            ->htmlTemplate('mailer/sub-email.html.twig')
            ->context([
                'uuid' => $uuid,
                'shop' => $shop,
                'logo' => $logo,
                'theme' => $theme,
            ]);
            $mailer->send($email);

            $this->addFlash('success', 'Votre adresse e-mail a  bien été enregistrée, merci !');
            return $this->redirectToRoute('home');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue, merci de réessayer ! 
            l\'adresse e-mail est peut-être déjà enregistrée où contient des caratéres interdits.');
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
