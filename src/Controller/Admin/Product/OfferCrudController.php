<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Offre')
            ->setEntityLabelInPlural('Offres')
            ->setPageTitle('index', 'Administration des Offres Promotionnelles')
            ->setSearchFields(['id', 'name'])
            ->setDefaultSort(['id' => 'DESC'])
            ->showEntityActionsInlined()
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            IntegerField::new('reduce')
                ->setLabel('Réduction'),
            ChoiceField::new('typeReduce')
                ->setLabel('Type')
                ->setChoices([
                    'Pourcentage' => 'percent',
                    'Euro' => 'euro',
                ]),
            BooleanField::new('isActive')
                ->setLabel('Actif'),
            DateTimeField::new('startedAt')
                ->setLabel('Début de l\'offre'),
            DateTimeField::new('endedAt')
                ->setLabel('Fin de l\'offre'),
            AssociationField::new('product', 'Produit')
                ->setLabel('Produit'),
        ];
    }
}
