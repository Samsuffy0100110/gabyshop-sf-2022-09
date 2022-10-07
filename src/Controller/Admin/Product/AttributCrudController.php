<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product\Attribut;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AttributCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribut::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Stock')
            ->setEntityLabelInSingular('Stocks')
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Gestion des Stocks');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            IntegerField::new('position')
                ->setLabel('Position')
                ->hideOnIndex(),
            IntegerField::new('quantity')
                ->setLabel('Quantité'),
            AssociationField::new('product')
                ->setLabel('Produit')
                ->hideOnForm(),
        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
