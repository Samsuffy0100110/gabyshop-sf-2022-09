<?php

namespace App\DataFixtures;

use App\Entity\Product\Product;
use App\Entity\Product\Attribut;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AttributFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $attribut = new Attribut();
        $attribut->setName("Violet");
        $attribut->setPrice(1);
        $attribut->setQuantity(10);
        $attribut->setProduct($this->getReference("Rabbit"));
        $attribut->setPosition(1);
        $attribut->setPersoIsEnable(true);
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName("Bleu");
        $attribut->setPrice(1);
        $attribut->setQuantity(10);
        $attribut->setProduct($this->getReference("Rabbit"));
        $attribut->setPosition(2);
        $attribut->setPersoIsEnable(true);
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName("Rouge");
        $attribut->setPrice(2);
        $attribut->setQuantity(10);
        $attribut->setProduct($this->getReference("Chibre de dieu"));
        $attribut->setPosition(2);
        $attribut->setPersoIsEnable(true);
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName("Rose");
        $attribut->setPrice(2);
        $attribut->setQuantity(10);
        $attribut->setProduct($this->getReference("Chibre de dieu"));
        $attribut->setPosition(2);
        $attribut->setPersoIsEnable(true);
        $manager->persist($attribut);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
        ];
    }
}
