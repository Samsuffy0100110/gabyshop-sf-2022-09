<?php

namespace App\Controller\Admin;

use App\Entity\Product\Option;
use App\Repository\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Option::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Option')
            ->setEntityLabelInPlural('Options')
            ->setPageTitle('index', 'Administration des Options')
            ->setSearchFields(['id', 'name'])
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            AssociationField::new('optionParent', 'Catégorie d\'Option')
                ->setLabel('Catégorie d\'Option'),
            AssociationField::new('quantity')
                ->setLabel('Quantité')
                ->hideOnForm(),
        ];
    }
}
