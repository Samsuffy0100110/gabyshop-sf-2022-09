<?php

namespace App\Controller\Admin;

use App\Entity\Front\Theme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ThemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Theme::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Thémes')
            ->setEntityLabelInSingular('Théme')
            ->setPageTitle('index', 'Administration des Thémes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            ColorField::new('colorMenu')
                ->setLabel('Couleur'),
            ColorField::new('backgroundColor')
                ->setLabel('Couleur de fond'),
            ColorField::new('footerColor')
                ->setLabel('Couleur du pied de page'),
            BooleanField::new('isActive')
                ->setLabel('Actif')
                ->hideOnForm(),
        ];
    }
}
