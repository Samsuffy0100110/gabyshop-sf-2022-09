<?php

namespace App\Controller\Admin;

use App\Entity\Front\Logo;
use App\Entity\Front\Shop;
use App\Entity\Front\Pages;
use App\Entity\Front\Theme;
use App\Entity\Maintenance;
use App\Entity\Order\Order;
use App\Entity\Front\Banner;
use App\Entity\Front\Social;
use App\Entity\Product\Taxe;
use App\Entity\Product\Offer;
use App\Entity\Order\Shipping;
use App\Entity\Product\Product;
use App\Entity\Product\Attribut;
use App\Entity\Product\Category;
use App\Entity\Product\PromoCode;
use App\Repository\UserRepository;
use App\Repository\AddressRepository;
use App\Entity\Product\ParentCategory;
use App\Entity\Communication\Commentary;
use App\Entity\Communication\NewsLetter;
use App\Entity\Product\FeaturedProducts;
use App\Repository\Order\OrderDetailsRepository;
use App\Repository\Order\OrderRepository;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class DashboardController extends AbstractDashboardController
{
    private $orderRepository;
    private $userRepository;
    private $productRepository;
    private $addressRepository;
    private $orderDetailsRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderDetailsRepository $orderDetailsRepository,
        ProductRepository $productRepository,
        UserRepository $userRepository,
        AddressRepository $addressRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->orderDetailsRepository = $orderDetailsRepository;
    }

    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'orders' => $this->orderRepository->findAll(),
            'products' => $this->productRepository->findAll(),
            'users' => $this->userRepository->findAll(),
            'addresses' => $this->addressRepository->findAll(),
            'ordersDetails' => $this->orderDetailsRepository->findAll(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour sur le site', 'fas fa-home', 'home');
        yield MenuItem::section('');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-sliders');
        yield MenuItem::section('');
        yield MenuItem::section('Gestion Produits');
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-folder', ParentCategory::class);
        yield MenuItem::linkToCrud('Sous Catégorie', 'fas fa-folder-tree', Category::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-box', Product::class);
        yield MenuItem::linkToCrud('Mise en avant', 'fas fa-star', FeaturedProducts::class);
        yield MenuItem::linkToCrud('Gestion des stocks', 'fas fa-boxes', Attribut::class);
        yield MenuItem::section('');
        yield MenuItem::section('Taxes');
        yield MenuItem::linkToCrud('TVA', 'fas fa-percent', Taxe::class);
        yield MenuItem::section('');
        yield MenuItem::section('Promotions');
        yield MenuItem::linkToCrud('Offres', 'fas fa-ad', Offer::class);
        yield MenuItem::linkToCrud('Codes Promo', 'fas fa-gift', PromoCode::class);
        yield MenuItem::section('');
        yield MenuItem::section('Commandes');
        yield MenuItem::linkToCrud('Commandes', 'fas fa-shopping-cart', Order::class);
        yield MenuItem::linkToCrud('Transporteurs', 'fas fa-truck', Shipping::class);
        yield MenuItem::section('');
        yield MenuItem::section('Newsletter');
        yield MenuItem::linkToCrud('Gestion des newsletters', 'fas fa-envelope', NewsLetter::class);
        yield MenuItem::section('');
        yield MenuItem::section('Gestion des Pages');
        yield MenuItem::linkToCrud('Gestion des Pages', 'fas fa-pen', Pages::class);
        yield MenuItem::section('');
        yield MenuItem::section('Personnalisation');
        yield MenuItem::linkToCrud('Boutique', 'fas fa-store', Shop::class);
        yield MenuItem::linkToCrud('Logo', 'fas fa-font-awesome', Logo::class);
        yield MenuItem::linkToCrud('Réseaux sociaux', 'fas fa-share-alt', Social::class);
        yield MenuItem::linkToCrud('Banniére', 'fas fa-image', Banner::class);
        yield MenuItem::linkToCrud('Thémes', 'fas fa-droplet', Theme::class);
        yield MenuItem::linkToCrud('Maintenance', 'fas fa-tools', Maintenance::class);
        yield MenuItem::section('');
        yield MenuItem::section('Commentaires');
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', Commentary::class);
    }
}
