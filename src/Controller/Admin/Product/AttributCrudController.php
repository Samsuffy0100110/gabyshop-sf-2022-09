<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product\Attribut;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AttributCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribut::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Stock')
            ->setEntityLabelInSingular('Stocks')
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Gestion des Stocks');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom')
                ->setDefaultColumns('col-lg-8'),
            IntegerField::new('position')
                ->setLabel('Position')
                ->hideOnIndex()
                ->setDefaultColumns('col-lg-8'),
            IntegerField::new('quantity')
                ->setLabel('Quantité')
                ->setDefaultColumns('col-lg-8'),
            AssociationField::new('product')
                ->setLabel('Produit')
                ->hideOnForm()
                ->setDefaultColumns('col-lg-8'),
            IntegerField::new('price')
                ->setLabel('Prix')
                ->setHelp('Prix de la personnalisation')
                ->setDefaultColumns('col-lg-8')
                ->setRequired(true),
            TextField::new('perso')
                ->setLabel('Personnalisation')
                ->hideOnForm(),
            BooleanField::new('persoIsEnable')
                ->setLabel('Personnalisation activée'),
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
