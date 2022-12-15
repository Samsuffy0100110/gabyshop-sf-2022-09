<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\Front\LogoRepository;
use App\Repository\Front\ShopRepository;
use App\Repository\Front\ThemeRepository;
use App\Repository\Front\PagesRepository;
use App\Repository\MaintenanceRepository;
use App\Repository\Product\OfferRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;

    private ThemeRepository $themeRepository;

    private ShopRepository $shopRepository;

    private PagesRepository $pagesRepository;

    private OfferRepository $offerRepository;

    private LogoRepository $logoRepository;

    private MaintenanceRepository $maintenance;

    public function __construct(
        Environment $twig,
        ThemeRepository $themeRepository,
        ShopRepository $shopRepository,
        PagesRepository $pagesRepository,
        OfferRepository $offerRepository,
        LogoRepository $logoRepository,
        MaintenanceRepository $maintenance,
    ) {
        $this->twig = $twig;
        $this->themeRepository = $themeRepository;
        $this->shopRepository = $shopRepository;
        $this->pagesRepository = $pagesRepository;
        $this->offerRepository = $offerRepository;
        $this->logoRepository = $logoRepository;
        $this->maintenance = $maintenance;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('theme', $this->themeRepository->findOneBy(['isActive' => true]));
        $this->twig->addGlobal('shops', $this->shopRepository->findAll());
        $this->twig->addGlobal('pages', $this->pagesRepository->findAll());
        $this->twig->addGlobal('offers', $this->offerRepository->findAll());
        $this->twig->addGlobal('logo', $this->logoRepository->findOneBy(['position' => 1]));
        $this->twig->addGlobal('maintenance', $this->maintenance->findAll());
        $this->twig->addGlobal('shop', $this->shopRepository->findOneBy(['isActive' => true]));
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }
}
