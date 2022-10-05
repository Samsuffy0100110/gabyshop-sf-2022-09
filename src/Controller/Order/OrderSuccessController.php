<?php

namespace App\Controller\Order;

use App\Entity\Order\Order;
use App\Service\CartService;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSuccessController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/commande/merci/{stripeSessionId}', name: 'order_success')]
    public function index($stripeSessionId, CartService $cart, MailerInterface $mailer)
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);
        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }
        if ($order->getState() === 0) {
            $order->setState(1);
            $this->entityManager->flush();
            $cart->remove();

            $email = (new Email())
            ->from(('sam@gmail.com'))
            ->to(('yo@gmail.com'))
            ->subject('Nouvelle commande')
            ->html('Vous avez reçu une nouvelle commande');
            $mailer->send($email);
        }

        return $this->render('order/_order-success.html.twig', [
            'order' => $order
        ]);
    }
}
