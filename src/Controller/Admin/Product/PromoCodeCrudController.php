<?php

namespace App\Controller\Admin\Product;

use DateTime;
use App\Entity\Product\PromoCode;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PromoCodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PromoCode::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Code Promo')
            ->setEntityLabelInPlural('Codes Promo')
            ->setSearchFields(['name', 'reduce', 'code','dateStart', 'dateEnd', 'active'])
            ->setPaginatorPageSize(10)
            ->setDefaultSort(['name' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom du code promo'),
            TextField::new('code', 'Code du code promo'),
            NumberField::new('reduce', 'Réduction en %'),
            DateField::new('createdAt', 'Date de création')
                ->setFormat('long')
                ->setFormTypeOptions([
                'data' => new DateTime(),
                ]),
            DateField::new('startedAt', 'Date de début')
                ->setFormat('long'),
            DateField::new('endedAt', 'Date de fin')
                ->setFormat('long'),
            BooleanField::new('Isactive', 'Actif'),
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
