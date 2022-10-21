<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product\ParentCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
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
            ->showEntityActionsInlined()
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
            SlugField::new('slug')
                ->setTargetFieldName('name')
                ->setLabel('Slug')
                ->setHelp('Le slug est le nom qui apparaîtra dans la barre de navigation, 
                il est généré automatiquement à partir du nom')
                ->hideOnIndex()
                ->setCssClass('display-slug'),
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
                return $action->setIcon('fa fa-trash')->setLabel('supprimer')
                ->addCssClass('text-danger')
                ->displayIf(fn (ParentCategory $parentCategory) => $parentCategory->getCategories()->isEmpty());
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('supprimer')
                    ->setCssClass('btn btn-danger')
                    ->displayIf(fn (ParentCategory $parentCategory) => $parentCategory->getCategories()->isEmpty());
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('modifier')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setIcon('fa fa-arrow-left')->setLabel('retour');
            });
            ;
    }
}
