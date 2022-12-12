<?php

namespace App\Controller\Admin\Shop;

use App\Entity\Front\Theme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
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
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Administration des Thémes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom'),
            ColorField::new('colorMenu')
                ->setLabel('Couleur du menu'),
            ColorField::new('backgroundColor')
                ->setLabel('Couleur de fond'),
            ColorField::new('footerColor')
                ->setLabel('Couleur du pied de page'),
            ColorField::new('fontColor')
                ->setLabel('Couleur de la police')
                ->setHelp('Attention au contraste des couleurs'),
            BooleanField::new('isActive')
                ->setLabel('Actif')
                ->hideOnForm()
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
                return $action->setIcon('fa fa-trash')->setLabel('supprimer');
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('supprimer')
                    ->setCssClass('btn btn-danger');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('modifier')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setIcon('fa fa-arrow-left')->setLabel('retour');
            });
    }
}
