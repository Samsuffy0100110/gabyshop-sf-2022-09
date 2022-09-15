<?php

namespace App\Controller\Admin;

use App\Entity\Logo;
use App\Entity\Shop;
use App\Entity\Taxe;
use App\Entity\Offer;
use App\Entity\Theme;
use App\Entity\Banner;
use App\Entity\Social;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\NewsLetter;
use App\Entity\ParentCategory;
use App\Entity\FeaturedProducts;
use App\Repository\SocialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('gabyShop - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('');
        yield MenuItem::section('Gestion Produits');
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-folder', ParentCategory::class);
        yield MenuItem::linkToCrud('Sous Catégorie', 'fas fa-folder-tree', Category::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-box', Product::class);
        yield MenuItem::linkToCrud('Mise en avant', 'fas fa-star', FeaturedProducts::class);
        yield MenuItem::section('');
        yield MenuItem::section('Taxes');
        yield MenuItem::linkToCrud('TVA', 'fas fa-percent', Taxe::class);
        yield MenuItem::section('');
        yield MenuItem::section('');
        yield MenuItem::section('Promotions');
        yield MenuItem::linkToCrud('Offres', 'fas fa-ad', Offer::class);
        yield MenuItem::section('');
        yield MenuItem::section('Newsletter');
        yield MenuItem::linkToCrud('Gestion des newsletters', 'fas fa-envelope', NewsLetter::class);
        yield MenuItem::section('');
        yield MenuItem::section('Personnalisation');
        yield MenuItem::linkToCrud('Boutique', 'fas fa-store', Shop::class);
        yield MenuItem::linkToCrud('Logo', 'fas fa-font-awesome', Logo::class);
        yield MenuItem::linkToCrud('Réseaux sociaux', 'fas fa-share-alt', Social::class);
        yield MenuItem::linkToCrud('Banniére', 'fas fa-image', Banner::class);
        yield MenuItem::linkToCrud('Thémes', 'fas fa-droplet', Theme::class);
        yield MenuItem::section('');
        yield MenuItem::linkToRoute('Retour sur le site', 'fas fa-home', 'home');
    }
}
