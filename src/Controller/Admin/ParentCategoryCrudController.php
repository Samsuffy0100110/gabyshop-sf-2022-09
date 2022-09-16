<?php

namespace App\Controller\Admin;

use App\Entity\Product\ParentCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ParentCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ParentCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
            ->setPageTitle('index', 'Administration des Catégories')
            ->setSearchFields(['id', 'name', 'slug', 'description', 'image', 'createdAt', 'updatedAt'])
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            ImageField::new('image')
                ->setBasePath('/images/parentCategories/')
                ->setUploadDir('public/images/parentCategories/')
                ->setUploadedFileNamePattern('[name].[extension]')
                ->setLabel('Image')
                ->setHelp('L\'image doit être au format jpg, jpeg, png ou gif et doit faire moins de 2Mo'),
        ];
    }
}
