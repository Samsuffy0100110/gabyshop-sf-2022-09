<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Sous Catégorie')
            ->setEntityLabelInPlural('Sous Catégories')
            ->setPageTitle('index', 'Administration des Sous Catégories')
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
            TextareaField::new('description', 'Description')
                ->setLabel('Description'),
            ImageField::new('image', 'Image')
                ->setBasePath('/images/categories')
                ->setUploadDir('public/images/categories')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->setLabel('Image'),
            AssociationField::new('parent', 'Catégorie')
                ->setLabel('Catégorie'),
            SlugField::new('slug')
                ->setTargetFieldName('name')
                ->setLabel('Slug')
                ->setHelp('Le slug est le nom qui apparaîtra dans la barre de navigation, 
                il est généré automatiquement à partir du nom')
                ->hideOnIndex(),
        ];
    }
}
