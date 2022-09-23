<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un prénom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Le prénom doit contenir au maximum {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le prénom ne doit contenir que des lettres',
                    ]),
                ],
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Nom'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un nom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Le nom doit contenir au maximum {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres',
                    ]),
                ],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Email'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un email',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'L\'email doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'L\'email doit contenir au maximum {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
                        'message' => 'Entrer une adresse email valide',
                    ]),
                ],
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un message',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le message doit contenir au moins {{ limit }} caractères',
                        'max' => 500,
                        'maxMessage' => 'Le message doit contenir au maximum {{ limit }} caractères',
                    ]),
                ],
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
