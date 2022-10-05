<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Front\Pages;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pages::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Pages')
            ->setEntityLabelInSingular('Page')
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Administration des Pages')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            TextField::new('title')
                ->setLabel('Titre'),
            DateTimeField::new('createdAt')
                ->setFormTypeOptions([
                    'data' => new DateTime(),
                ])
                ->setLabel('Date de création')
                ->setFormat('long'),
            DateTimeField::new('updatedAt')
                ->setFormTypeOptions([
                    'data' => new DateTime(),
                ])
                ->setLabel('Date de modification')
                ->setFormat('long'),
            SlugField::new('slug')
                ->setTargetFieldName('title')
                ->setLabel('Slug'),
            TextareaField::new('content')
                ->setLabel('Contenu')
                ->setFormType(CKEditorType::class)
                ->hideOnIndex(),
        ];
    }
}
