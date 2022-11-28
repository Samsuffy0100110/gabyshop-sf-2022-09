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
        $attribut->setPrice(10);
        $attribut->setQuantity(10);
        $attribut->setProduct($this->getReference("Rabbit"));
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName("Rouge");
        $attribut->setPrice(10);
        $attribut->setQuantity(10);
        $attribut->setProduct($this->getReference("Chibre de dieu"));
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
