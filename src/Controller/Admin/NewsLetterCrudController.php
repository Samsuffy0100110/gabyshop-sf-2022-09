<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\NewsLetter;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewsLetterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NewsLetter::class;
    }

    public function configureToCrud(Crud $crud): Crud
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
            DateTimeField::new('createdAt')
                ->setFormTypeOptions([
                    'data' => new DateTime(),
                ])
                ->setLabel('Date de création')
                ->setFormat('dd-MM-Y HH:mm'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
