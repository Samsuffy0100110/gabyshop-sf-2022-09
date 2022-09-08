<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            PercentField::new('percent')
                ->setLabel('Pourcentage')
                ->setNumDecimals(2),
            MoneyField::new('reduce')
                ->setLabel('Réduction')
                ->setCurrency('EUR')
                ->setNumDecimals(2)
                ->setFormType(MoneyType::class)
                ->setFormTypeOptions([
                    'divisor' => 100,
                ]),
            BooleanField::new('isActive')
                ->setLabel('Actif'),
            AssociationField::new('product', 'Produit')
                ->setLabel('Produit'),
        ];
    }
}
