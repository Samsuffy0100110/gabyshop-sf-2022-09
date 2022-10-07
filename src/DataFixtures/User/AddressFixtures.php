<?php

namespace App\DataFixtures\User;

use App\Entity\Address;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $address = new Address();
        $address->setUser($this->getReference('User'));
        $address->setName('maison');
        $address->setAdresse('1 rue de la paix');
        $address->setComplementAdresse('appartement 1');
        $address->setZipcode('75000');
        $address->setCity('Paris');
        $address->setCountry('France');
        $address->setPhone('0606060606');
        $address->setIsActive(true);
        $manager->persist($address);

        $address = new Address();
        $address->setUser($this->getReference('User'));
        $address->setName('travail');
        $address->setAdresse('1 rue de la paix');
        $address->setComplementAdresse('appartement 2');
        $address->setZipcode('75000');
        $address->setCity('Paris');
        $address->setCountry('France');
        $address->setPhone('0606060606');
        $address->setIsActive(false);
        $manager->persist($address);

        $address = new Address();
        $address->setUser($this->getReference('Admin'));
        $address->setName('maison');
        $address->setAdresse('1 rue de la paix');
        $address->setComplementAdresse('appartement 1');
        $address->setZipcode('75000');
        $address->setCity('Paris');
        $address->setCountry('France');
        $address->setPhone('0606060606');
        $address->setIsActive(true);
        $manager->persist($address);

        $address = new Address();
        $address->setUser($this->getReference('Admin'));
        $address->setName('travail');
        $address->setAdresse('1 rue de la paix');
        $address->setComplementAdresse('appartement 2');
        $address->setZipcode('75000');
        $address->setCity('Paris');
        $address->setCountry('France');
        $address->setPhone('0606060606');
        $address->setIsActive(false);
        $manager->persist($address);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
