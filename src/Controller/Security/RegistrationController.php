<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\User\AddressType;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use App\Form\User\RegistrationFormType;
use App\Security\SecurityAuthenticator;
use App\Entity\Address as AddressEntity;
use App\Repository\Front\LogoRepository;
use App\Repository\Front\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\Front\ThemeRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        SecurityAuthenticator $authenticator,
        UserAuthenticatorInterface $userAuthenticator,
        ShopRepository $shopRepository,
        LogoRepository $logoRepository,
        ThemeRepository $themeRepository,
    ): Response {
        $shop = $shopRepository->findOneBy(['isActive' => true]);
        $logo = $logoRepository->findOneBy(['isActive' => true]);
        $theme = $themeRepository->findOneBy(['isActive' => true]);
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $address = new AddressEntity();
        $formAddress = $this->createForm(AddressType::class, $address);
        $formAddress->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $address->setUser($user);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->persist($address);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation(
                'verify_email',
                $user,
                (new TemplatedEmail())
                ->from(new Address($this->getParameter('mailer_address'), $shop->getName()))
                    ->to($user->getEmail())
                    ->subject('Merci de confirmer votre adresse email')
                    ->htmlTemplate('security/registration/confirmation_email.html.twig')
                    ->context([
                        'user' => $user,
                        'shop' => $shop,
                        'logo' => $logo,
                        'theme' => $theme,
                    ])
            );
            // do anything else you need here, like send an email
            $this->addFlash('success', 'Bienvenue ! Un email de confirmation vous a été envoyé.');

            return $userAuthenticator->authenticateUser($user, $authenticator, $request);
        }
        return $this->render('security/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'addressForm' => $formAddress->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'verify_email')]
    public function verifyUserEmail(
        Request $request,
        TranslatorInterface $translator
    ): Response {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Votre adresse email a bien été confirmée.');

        return $this->redirectToRoute('register');
    }
}
