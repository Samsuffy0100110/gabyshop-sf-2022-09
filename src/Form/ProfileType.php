<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
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
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
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
            ])
            ->add('birthday', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Votre date de naissance'
                ],
                'required' => false
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Genre',
                'choices' => [
                    '' => null,
                    'Mlle' => 'Mlle',
                    'Mme' => 'Mme',
                    'Mr' => 'Mr',
                    'Autre' => 'Autre'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer une adresse email',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
                        'message' => 'Entrer une adresse email valide',
                    ]),
                ],
            ])
            ->add('companyname', TextType::class, [
                'label' => 'Société',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer une société',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'La société doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'La société doit contenir au maximum {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9]+$/',
                        'message' => 'La société ne doit contenir que des lettres et des chiffres',
                    ]),
                ],
                'required' => false
            ])
            ->add('idPro', TextType::class, [
                'label' => 'Siret',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un siret',
                    ]),

                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'Le siret ne doit contenir que des chiffres',
                    ]),
                ],
                'required' => false
            ])
            ->add('isNewsletterOk', CheckboxType::class, [
                'label' => 'Je souhaite recevoir la newsletter',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour mon profil',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
