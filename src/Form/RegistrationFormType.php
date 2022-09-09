<?php

namespace App\Form;

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
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
            ])
            ->add(
                'email',
                EmailType::class,
                [
                'label' => 'mail',
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
                    new Regex(
                        [
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/',
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
                    new Assert\Length(
                        [
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Confirmation trop courte',
                        'maxMessage' => 'Confirmation trop longue',
                        ]
                    ),
                ],
                ],
                ]
            )
            ->add('adress', TextType::class, [
                'label' => 'Adresse',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code postal',
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
            ])
            ->add('isPro', CheckboxType::class, [
                'label' => 'Je suis un professionnel',
                'required' => false,
            ])
            ->add('companyName', TextType::class, [
                'label' => 'Nom de la société',
            ])
            ->add('idPro', TextType::class, [
                'label' => 'Numéro de SIRET',
            ])
            ->add('isNewsletterOk', CheckboxType::class, [
                'label' => 'Je souhaite recevoir la newsletter',
                'required' => false,
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
