<?php

namespace App\Form\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
                        'pattern' => '/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄ
                        ĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres',
                    ]),
                ],
            ])
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
                        'pattern' => '/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄ
                        ĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]+$/',
                        'message' => 'Le prénom ne doit contenir que des lettres',
                    ]),
                ],
            ])
            ->add(
                'email',
                EmailType::class,
                [
                'label' => 'Email',
                ]
            )
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                'type' => PasswordType::class,
                'first_options' => [
                'label' => 'Mot de passe',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(
                        [
                        'message' => 'Mot de passe requis',
                        ]
                    ),
                    new Assert\Length(
                        [
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit faire au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Le mot de passe doit faire au maximum {{ limit }} caractères',
                        ]
                    ),
                    new Assert\Regex(
                        [
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/',
                        'message' => 'Le mot de passe doit contenir au moins une minuscule, 
                            une majuscule, un chiffre et un caractère spécial',
                        ]
                    ),
                ],
                ],
                'second_options' => [
                'label' => 'Confirmez votre mot de passe',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(
                        [
                        'message' => 'Confirmation requise',
                        ]
                    ),
                ],
                ],
                ]
            )
            ->add('isNewsletterOk', CheckboxType::class, [
                'label' => 'Je souhaite recevoir la newsletter',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
            ])
            ->add('isPro', CheckboxType::class, [
                'label' => 'Je suis un professionnel',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
            ])
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
