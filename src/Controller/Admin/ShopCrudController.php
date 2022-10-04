<?php

namespace App\Controller\Admin;

use App\Entity\Front\Shop;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shop::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Boutiques')
            ->setEntityLabelInSingular('Boutique')
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Administration des Boutiques');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            TextField::new('adress')
                ->setLabel('Adresse'),
            TextField::new('city')
                ->setLabel('Ville'),
            TextField::new('zipCode')
                ->setLabel('Code postal'),
            TextField::new('country')
                ->setLabel('Pays'),
            TextField::new('phone')
                ->setLabel('Téléphone'),
            TextField::new('mail')
                ->setLabel('Email'),
            TextField::new('description')
                ->setLabel('Description'),
            TextField::new('shopNumberPro')
                ->setLabel('Numéro de boutique PRO'),
        ];
    }
}
