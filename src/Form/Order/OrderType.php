<?php

namespace App\Form\Order;

use App\Entity\Address;
use App\Service\CartService;
use App\Entity\Order\Shipping;
use App\Service\MondialRelayService;
use Symfony\Component\Form\AbstractType;
use App\Repository\Order\ShippingRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderType extends AbstractType
{
    public function __construct(
        MondialRelayService $mondialRelayService,
        CartService $cartService,
        ShippingRepository $shipping
    ) {
        $this->mondialRelayService = $mondialRelayService;
        $this->cartService = $cartService;
        $this->shippingRepository = $shipping;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        if ($this->mondialRelayService->shipByTotWeight($this->cartService) == 'Livraison gratuite') {
            $builder
            ->add('addresses', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Address::class,
                'choices' => $user->getAddresses(),
                'multiple' => false,
                'expanded' => true
            ])
            ->add('shipping', EntityType::class, [
                'label' => 'Livraison gratuite',
                'required' => true,
                'class' => Shipping::class,
                'attr' => [
                    'class' => 'd-none',
                    'value' => 'Livraison gratuite'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider ma commande',
                'attr' => [
                    'class' => 'btn btn-success btn-block'
                ]
            ])
            ;
        } else {
            $builder
            ->add('addresses', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Address::class,
                'choices' => $user->getAddresses('isActive' == true),
                'attr' => [
                    'class' => 'd-none',
                ]
            ])
            ->add('shipping', EntityType::class, [
                'label' => $this->mondialRelayService->shipByTotWeight($this->cartService),
                'required' => true,
                'class' => Shipping::class,
                'choices' => $this->shippingRepository->
                findBy(['name' => $this->mondialRelayService->
                shipByTotWeight($this->cartService)]),
                'attr' => [
                    'class' => 'd-none',
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Valider ma commande',
                'attr' => [
                    'class' => 'btn btn-info btn-block'
                ]
            ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user' => [],
        ]);
    }
}
