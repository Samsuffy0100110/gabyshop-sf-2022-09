<?php

namespace App\DataFixtures;

use App\Entity\Order\Shipping;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ShippingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $shipping = new Shipping();
        $shipping->setPrice(0.00);
        $shipping->setName('Livraison gratuite');
        $shipping->setDescription('Courrier simple');
        $this->addReference('Livraison gratuite', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(4.40);
        $shipping->setName('Mondial Relay 0.5kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 0.5kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(4.90);
        $shipping->setName('Mondial Relay 1kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 1kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(6.40);
        $shipping->setName('Mondial Relay 2kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 2kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(6.60);
        $shipping->setName('Mondial Relay 3kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 3kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(7.00);
        $shipping->setName('Mondial Relay 4kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 4kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(9.90);
        $shipping->setName('Mondial Relay 5kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 5kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(12.10);
        $shipping->setName('Mondial Relay 7kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 7kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(13.80);
        $shipping->setName('Mondial Relay 10kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 10kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(18.30);
        $shipping->setName('Mondial Relay 15kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 15kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(21.50);
        $shipping->setName('Mondial Relay 20kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 20kg', $shipping);
        $manager->persist($shipping);

        $shipping = new Shipping();
        $shipping->setPrice(26.90);
        $shipping->setName('Mondial Relay 30kg');
        $shipping->setDescription('Livraison en point relais, 3 à 5 jours ouvrés');
        $this->addReference('Mondial Relay 30kg', $shipping);
        $manager->persist($shipping);

        $manager->flush();
    }
}
