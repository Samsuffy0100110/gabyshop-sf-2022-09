<?php

namespace App\Controller\Admin;

use App\Entity\Product\FeaturedProducts;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FeaturedProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FeaturedProducts::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Produits mis en avant')
            ->setEntityLabelInSingular('Produit mis en avant')
            ->setPageTitle('index', 'Administration des produits mis en avant');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('product')
                ->setLabel('Produit'),
            ChoiceField::new('position')
                ->setLabel('Position')
                ->setChoices([
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ]),
        ];
    }
}
