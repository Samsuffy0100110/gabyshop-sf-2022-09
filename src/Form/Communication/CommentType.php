<?php

namespace App\Form\Communication;

use App\Entity\Communication\Commentary;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', null, [
                'label' => false,
                'attr' => [
                    'class' => 'rating rating-loading',
                    'data-show-clear' => 'false',
                    'data-show-caption' => 'false',
                    'value' => '3',
                    'data-min' => '0',
                    'data-max' => '5',
                ],
            ])
            ->add(
                'comment',
                CKEditorType::class,
                [
                'attr' => ['data-editor' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Votre commentaire',
                ],
                'config_name' => 'light',
                'label' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
            'data_class' => Commentary::class,
            ]
        );
    }
}
