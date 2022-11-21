<?php

namespace App\DataFixtures\Order;

use App\Entity\Order\OrderDetails;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Order\OrderFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Product\ProductFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderDetailsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $orderDetails = new OrderDetails();
        $orderDetails->setMyOrder($this->getReference(1));
        $orderDetails->setProduct($this->getReference('product_1'));
        $orderDetails->setQuantity(1);
        $orderDetails->setPrice(10);
        $orderDetails->setTotal(10);
        $orderDetails->setTaxe('20%');
        $orderDetails->setPrimaryOfferName('Super Promo de Noël');
        $orderDetails->setPrimaryOfferReduce(10);
        $orderDetails->setPrimaryOfferTypeReduce('percent');
        $orderDetails->setSecondaryOfferName('Vente flash !');
        $orderDetails->setSecondaryOfferReduce(10);
        $orderDetails->setSecondaryOfferTypeReduce('percent');
        $orderDetails->setCustomPrice(3);
        $orderDetails->setCustomDescription('Cadeau de Noël');
        $manager->persist($orderDetails);

        $orderDetails = new OrderDetails();
        $orderDetails->setMyOrder($this->getReference(1));
        $orderDetails->setProduct($this->getReference('product_1'));
        $orderDetails->setQuantity(2);
        $orderDetails->setPrice(20);
        $orderDetails->setTotal(40);
        $orderDetails->setTaxe('20%');
        $orderDetails->setPrimaryOfferName('Super Promo de Halloween');
        $orderDetails->setPrimaryOfferReduce(10);
        $orderDetails->setPrimaryOfferTypeReduce('percent');
        $orderDetails->setSecondaryOfferName('Vente flash !');
        $orderDetails->setSecondaryOfferReduce(10);
        $orderDetails->setSecondaryOfferTypeReduce('percent');
        $orderDetails->setCustomPrice(3);
        $orderDetails->setCustomDescription('Cadeau de Halloween');
        $manager->persist($orderDetails);

        $orderDetails = new OrderDetails();
        $orderDetails->setMyOrder($this->getReference(2));
        $orderDetails->setProduct($this->getReference('product_2'));
        $orderDetails->setQuantity(3);
        $orderDetails->setPrice(30);
        $orderDetails->setTotal(90);
        $orderDetails->setTaxe('20%');
        $orderDetails->setPrimaryOfferName('Super Promo de Paques');
        $orderDetails->setPrimaryOfferReduce(20);
        $orderDetails->setPrimaryOfferTypeReduce('amount');
        $orderDetails->setSecondaryOfferName('Vente flash !');
        $orderDetails->setSecondaryOfferReduce(10);
        $orderDetails->setSecondaryOfferTypeReduce('percent');
        $orderDetails->setCustomPrice(3);
        $orderDetails->setCustomDescription('Cadeau de Paques');
        $manager->persist($orderDetails);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class,
            ProductFixtures::class,
        ];
    }
}
