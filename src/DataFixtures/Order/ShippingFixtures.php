<?php

namespace App\DataFixtures\Order;

use App\Entity\Order\Shipping;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ShippingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $shipping = new Shipping();
        $shipping->setPrice(5.99);
        $shipping->setName('Chronopost');
        $shipping->setDescription('Livraison en 24h');
        $this->addReference('Chronopost', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(2.99);
        $shipping->setName('Colissimo');
        $shipping->setDescription('Livraison en 48h');
        $this->addReference('Colissimo', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(3.99);
        $shipping->setName('Mondial Relay');
        $shipping->setDescription('Livraison en 72h');
        $this->addReference('Mondial Relay', $shipping);
        $manager->persist($shipping);

        $manager->flush();
    }
}
