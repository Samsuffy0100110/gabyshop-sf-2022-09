<?php

namespace App\Controller\Admin;

use App\Entity\NewsLetter;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewsLetterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NewsLetter::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Newsletter')
            ->setEntityLabelInPlural('Newsletters')
            ->setPageTitle('index', 'Administration des Newsletters')
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(10)
            ->setSearchFields(['id', 'email'])
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            TextField::new('title')
                ->setLabel('Titre'),
            TextField::new('summary')
                ->setLabel('Résumé'),
            TextEditorField::new('description')
                ->hideOnIndex()
                ->setFormType(CKEditorType::class),
            DateField::new('createdAt')
                ->setFormat('dd-MM-Y')
                ->hideOnForm(),
        ];
    }
}
