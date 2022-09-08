<?php

namespace App\Controller\Admin;

use App\Entity\Logo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LogoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Logo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Logos')
            ->setEntityLabelInSingular('Logo')
            ->setPageTitle('index', 'Administration des Logos');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            ImageField::new('image')
                ->setBasePath('/images/logos/')
                ->setUploadDir('public/images/logos/')
                ->setUploadedFileNamePattern('[name].[extension]')
                ->setLabel('Logo')
                ->setHelp('Le logo doit être au format jpg, jpeg, png ou gif et doit faire moins de 2Mo'),
            IntegerField::new('position')
                ->setLabel('Position'),
        ];
    }
}
