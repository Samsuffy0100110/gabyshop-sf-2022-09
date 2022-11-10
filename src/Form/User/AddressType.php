<?php

namespace App\Form\User;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'adresse',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un nom pour l\'adresse',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9._ -]+$/',
                        'message' => 'Entrer un nom valide',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer une adresse',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9._ -]+$/',
                        'message' => 'Entrer une adresse valide',
                    ]),
                ],
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => 'Complément d\'adresse',
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9._ -]+$/',
                        'message' => 'Entrer un complément d\'adresse valide',
                    ]),
                ],
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Code postal',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un code postal',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{5}$/',
                        'message' => 'Entrer un code postal valide',
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer une ville',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z._ -]+$/',
                        'message' => 'Entrer une ville valide',
                    ]),
                ],
            ])
            ->add('country', ChoiceType::class, [
                'label' => 'Pays',
                'choices' => [
                    'France' => 'France',
                    'Belgique' => 'Belgique',
                    'Suisse' => 'Suisse',
                ],
            ])
            ->add('isActive', HiddenType::class, [
                'data' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
