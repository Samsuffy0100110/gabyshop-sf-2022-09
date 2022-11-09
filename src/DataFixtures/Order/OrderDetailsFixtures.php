<?php

namespace App\DataFixtures\Order;

use App\Entity\Order\OrderDetails;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Order\OrderFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderDetailsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $orderDetails = new OrderDetails();
        $orderDetails->setMyOrder($this->getReference(1));
        $orderDetails->setProduct('Product 1');
        $orderDetails->setQuantity(1);
        $orderDetails->setPrice(10);
        $orderDetails->setTotal(10);
        $orderDetails->setTaxe('20%');
        $manager->persist($orderDetails);

        $orderDetails = new OrderDetails();
        $orderDetails->setMyOrder($this->getReference(1));
        $orderDetails->setProduct('Product 2');
        $orderDetails->setQuantity(2);
        $orderDetails->setPrice(20);
        $orderDetails->setTotal(40);
        $orderDetails->setTaxe('20%');
        $manager->persist($orderDetails);

        $orderDetails = new OrderDetails();
        $orderDetails->setMyOrder($this->getReference(2));
        $orderDetails->setProduct('Product 3');
        $orderDetails->setQuantity(3);
        $orderDetails->setPrice(30);
        $orderDetails->setTotal(90);
        $orderDetails->setTaxe('20%');
        $manager->persist($orderDetails);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class,
        ];
    }
}
