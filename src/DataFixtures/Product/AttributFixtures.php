<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\Attribut;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Product\ProductFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AttributFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $attribut = new Attribut();
        $attribut->setName('Attribut 1');
        $attribut->setPosition(1);
        $attribut->setQuantity(1);
        $attribut->setProduct($this->getReference('product_1'));
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName('Attribut 2');
        $attribut->setPosition(2);
        $attribut->setQuantity(2);
        $attribut->setProduct($this->getReference('product_1'));
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName('Attribut 3');
        $attribut->setPosition(1);
        $attribut->setQuantity(1);
        $attribut->setProduct($this->getReference('product_2'));
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName('Attribut 4');
        $attribut->setPosition(2);
        $attribut->setQuantity(2);
        $attribut->setProduct($this->getReference('product_2'));
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
