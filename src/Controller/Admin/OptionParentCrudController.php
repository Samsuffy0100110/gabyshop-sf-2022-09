<?php

namespace App\Controller\Admin;

use App\Entity\Product\OptionParent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OptionParentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OptionParent::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Catégorie d\'Option')
            ->setEntityLabelInPlural('Catégories d\'Options')
            ->setPageTitle('index', 'Administration des Catégories d\'Options')
            ->setSearchFields(['id', 'name'])
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
        ];
    }
}
