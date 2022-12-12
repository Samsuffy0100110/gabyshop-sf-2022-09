<?php

namespace App\Controller\Admin\Shop;

use App\Entity\Front\Shop;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
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
            CountryField::new('country')
                ->setLabel('Pays'),
            TelephoneField::new('phone')
                ->setLabel('Téléphone'),
            EmailField::new('mail')
                ->setLabel('Email'),
            TextareaField::new('description')
                ->setLabel('Description')
                ->hideOnIndex(),
            TextField::new('shopNumberPro')
                ->setLabel('Numéro de boutique PRO'),
            BooleanField::new('isActive')
                ->setLabel('Actif')
                ->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, 'detail')
            ->update(Crud::PAGE_INDEX, 'detail', function (Action $action) {
                return $action->setIcon('fa fa-eye')->setLabel('voir')->setCssClass('text-info');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('modifier')->addCssClass('text-warning');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('supprimer');
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('supprimer')
                    ->setCssClass('btn btn-danger');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('modifier')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setIcon('fa fa-arrow-left')->setLabel('retour');
            });
    }
}
