<?php

namespace App\Controller\Admin;

use App\Entity\Order\Shipping;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShippingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shipping::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Livraison')
            ->setEntityLabelInPlural('Livraisons')
            ->showEntityActionsInlined()
            ->setSearchFields(['id', 'name', 'description', 'price']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextareaField::new('description', 'Description'),
            MoneyField::new('price', 'Prix')
                ->setCurrency('EUR'),
        ];
    }
}
