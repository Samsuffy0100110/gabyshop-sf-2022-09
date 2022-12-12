<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $address = new Address();
        $address->setUser($this->getReference('Admin'));
        $address->setName('Maison');
        $address->setAdresse('3 rue du chat qui pète');
        $address->setComplementAdresse('Appartement 3');
        $address->setZipCode('99999');
        $address->setCity('Nulle part');
        $address->setCountry('France');
        $address->setIsActive(true);
        $manager->persist($address);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
