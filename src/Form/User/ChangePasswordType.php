<?php

namespace App\Form\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add(
            'plainPassword',
            RepeatedType::class,
            [
            'type' => PasswordType::class,
            'first_options' => [
                'constraints' => [
                    new NotBlank(
                        [
                        'message' => 'Entrer un mot de passe',
                        ]
                    ),
                    new Length(
                        [
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe ne peut etre inférieur à  {{ limit }} charactéres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                        ]
                    ),
                    new Regex(
                        [
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/',
                        'message' => 'Votre mot de passe doit contenir au moins une lettre minuscule,
                        une lettre majuscule, un chiffre et un caractère spécial',
                        ]
                    ),
                ],
                'label' => 'Mot de passe',
            ],
            'second_options' => [
                'attr' => ['autocomplete' => 'Mot de passe'],
                'label' => 'Répéter le mot de passe',
            ],
            'invalid_message' => 'Les mots de passe ne correspondent pas',
            // Instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            ]
        )
        ->add('submit', SubmitType::class, [
            'label' => 'S\'inscrire',
            'attr' => [
            'class' => 'btn btn-primary',
            ],
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
