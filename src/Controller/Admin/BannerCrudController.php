<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Banner;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BannerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Banner::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Bannières')
            ->setEntityLabelInSingular('Bannière')
            ->setPageTitle('index', 'Administration des Banniéres');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            ImageField::new('image')
                ->setBasePath('/images/banners/')
                ->setUploadDir('public/images/banners/')
                ->setUploadedFileNamePattern('[name].[extension]')
                ->setLabel('Banniére')
                ->setHelp('La banniére doit être au format jpg, jpeg, png ou gif et doit faire moins de 2Mo'),
            IntegerField::new('position')
                ->setLabel('Position'),
            DateTimeField::new('createdAt')
                ->setFormTypeOptions([
                    'data' => new DateTime(),
                ])
                ->setLabel('Date de création')
                ->setFormat('long'),
            DateTimeField::new('startedAt')
                ->setLabel('Date de début d\'affichage')
                ->setFormat('long')
                ->setTimezone('Europe/Paris'),
            DateTimeField::new('endedAt')
                ->setLabel('Date de fin d\'affichage')
                ->setFormat('long')
                ->setTimezone('Europe/Paris'),
            BooleanField::new('isActive')
                ->setLabel('Actif'),
        ];
    }
}
