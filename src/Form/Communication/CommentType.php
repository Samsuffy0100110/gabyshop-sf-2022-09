<?php

namespace App\Form\Communication;

use App\Entity\Communication\Commentary;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-success',
                ],
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
