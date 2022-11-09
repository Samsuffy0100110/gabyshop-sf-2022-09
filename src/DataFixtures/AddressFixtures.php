<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $address = new Address();
        $address->setUser($this->getReference('User'));
        $address->setName('Chez moi');
        $address->setAdresse('3 Rue du chat qui pète');
        $address->setComplementAdresse('clos des roses');
        $address->setZipcode('99999');
        $address->setCity('Nulle part');
        $address->setCountry('ici bas');
        $address->setPhone('0642963217');
        $this->addReference('Chez moi', $address);
        $address->setIsActive(true);
        $manager->persist($address);

        $address = new Address();
        $address->setUser($this->getReference('User'));
        $address->setName('Taf');
        $address->setAdresse('454 Rue du phacochère');
        $address->setComplementAdresse('bat 2');
        $address->setZipcode('99999');
        $address->setCity('Nulle part');
        $address->setCountry('pas loin');
        $address->setPhone('0642963217');
        $address->setIsActive(false);
        $this->addReference('Taf', $address);
        $manager->persist($address);

        $address = new Address();
        $address->setUser($this->getReference('Admin'));
        $address->setName('Domicile');
        $address->setAdresse('3 Rue du chat qui pète');
        $address->setComplementAdresse('clos des roses');
        $address->setZipcode('99999');
        $address->setCity('Nulle part');
        $address->setCountry('ici bas');
        $address->setPhone('0642963217');
        $address->setIsActive(true);
        $this->addReference('Domicile', $address);
        $manager->persist($address);

        $address = new Address();
        $address->setUser($this->getReference('Admin'));
        $address->setName('Boulot');
        $address->setAdresse('454 Rue du phacochère');
        $address->setComplementAdresse('bat 2');
        $address->setZipcode('99999');
        $address->setCity('Nulle part');
        $address->setCountry('pas loin');
        $address->setPhone('0642963217');
        $address->setIsActive(false);
        $this->addReference('Boulot', $address);
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
