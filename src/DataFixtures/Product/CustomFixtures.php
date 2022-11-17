<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\Custom;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Order\OrderFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Product\AttributFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CustomFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $custom = new Custom();
        $custom->setDescription('Wild forever !');
        $custom->setQuantity(3);
        $custom->setPrice(1.5);
        $custom->setAttribut($this->getReference('attribut 1'));
        $custom->setCustomOrder($this->getReference(1));
        $manager->persist($custom);

        $custom = new Custom();
        $custom->setDescription('Just fuck it !');
        $custom->setQuantity(2);
        $custom->setPrice(2.5);
        $custom->setAttribut($this->getReference('attribut 1'));
        $custom->setCustomOrder($this->getReference(1));
        $manager->persist($custom);

        $custom = new Custom();
        $custom->setDescription('I love you !');
        $custom->setQuantity(8);
        $custom->setPrice(3);
        $custom->setAttribut($this->getReference('attribut 2'));
        $custom->setCustomOrder($this->getReference(1));
        $manager->persist($custom);

        $custom = new Custom();
        $custom->setDescription('Hello world');
        $custom->setQuantity(5);
        $custom->setPrice(3.5);
        $custom->setAttribut($this->getReference('attribut 3'));
        $custom->setCustomOrder($this->getReference(2));
        $manager->persist($custom);

        $custom = new Custom();
        $custom->setDescription('Pour Julie et Pierre');
        $custom->setQuantity(6);
        $custom->setPrice(4);
        $custom->setAttribut($this->getReference('attribut 4'));
        $custom->setCustomOrder($this->getReference(2));
        $manager->persist($custom);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AttributFixtures::class,
            OrderFixtures::class,
        ];
    }
}
