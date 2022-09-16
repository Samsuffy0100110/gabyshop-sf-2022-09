<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'firstname',
                TextType::class,
                [
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'Prénom'],
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Nom'],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Email'],
                ]
            )
            ->add(
                'subject',
                ChoiceType::class,
                [
                'label' => 'Sujet',
                'choices' => [
                    'Renseignement' => 'Renseignement',
                    'Problèmes de livraison' => 'Problèmes de livraison',
                    'Autres' => 'Autres',
                ],
                ]
            )
            ->add(
                'message',
                TextareaType::class,
                [
                'label' => 'Message',
                'attr' => ['placeholder' => 'Message', 'rows' => 5],
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn btn-outline-success mt-3'],
                ]
            )
        ;
    }
}
