<?php

namespace App\Form\Communication;

use Symfony\Component\Form\AbstractType;
use App\Entity\Communication\NewsLetterUser;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewsLetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer une adresse email',
                    ]),
                    new Email([
                        'message' => 'Entrer une adresse email valide',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
                        'message' => 'Entrer une adresse email valide',
                    ]),
                ],
                ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsLetterUser::class,
        ]);
    }
}
