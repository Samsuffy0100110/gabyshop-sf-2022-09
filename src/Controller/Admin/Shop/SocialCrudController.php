<?php

namespace App\Controller\Admin\Shop;

use App\Entity\Front\Social;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SocialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Social::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Réseau social')
            ->setEntityLabelInPlural('Réseaux sociaux')
            ->setSearchFields(['id', 'name', 'link'])
            ->setDefaultSort(['id' => 'DESC'])
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Administration des réseaux sociaux');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('name')
                ->setLabel('Nom')
                ->setChoices([
                    'Facebook' => 'facebook',
                    'Instagram' => 'instagram',
                    'Twitter' => 'twitter',
                    'Pinterest' => 'pinterest',
                    'Youtube' => 'youtube',
                    'Linkedin' => 'linkedin',
                    'TikTok' => 'tiktok',
                    'Snapchat' => 'snapchat',
                    'Twitch' => 'twitch',
                    'Discord' => 'discord',
                    'Autre' => 'earlybirds',
                ]),
            TextField::new('link')
                ->setLabel('Lien'),
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
