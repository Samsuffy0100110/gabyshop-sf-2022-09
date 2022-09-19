<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\Front\ShopRepository;
use App\Repository\Front\ThemeRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;

    private ThemeRepository $themeRepository;

    private ShopRepository $shopRepository;

    public function __construct(Environment $twig, ThemeRepository $themeRepository, ShopRepository $shopRepository)
    {
        $this->twig = $twig;
        $this->themeRepository = $themeRepository;
        $this->shopRepository = $shopRepository;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('theme', $this->themeRepository->findOneBy(['isActive' => true]));
        $this->twig->addGlobal('shops', $this->shopRepository->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }
}
