<?php

namespace App\Controller\Admin;

use App\Entity\Front\Social;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
                    'Autre' => 'arobase',
                ]),
            TextField::new('link')
                ->setLabel('Lien'),
        ];
    }
}
