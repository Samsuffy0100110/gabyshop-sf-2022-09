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
        $attribut->setQuantity(15);
        $attribut->setPrice(2);
        $attribut->setPersoIsEnable(true);
        $attribut->setProduct($this->getReference('product_1'));
        $this->addReference('attribut 1', $attribut);
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName('Attribut 2');
        $attribut->setPosition(2);
        $attribut->setQuantity(24);
        $attribut->setPrice(3.5);
        $attribut->setPersoIsEnable(true);
        $attribut->setProduct($this->getReference('product_1'));
        $this->addReference('attribut 2', $attribut);
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName('Attribut 3');
        $attribut->setPosition(1);
        $attribut->setQuantity(18);
        $attribut->setPrice(1.5);
        $attribut->setPersoIsEnable(true);
        $attribut->setProduct($this->getReference('product_2'));
        $this->addReference('attribut 3', $attribut);
        $manager->persist($attribut);

        $attribut = new Attribut();
        $attribut->setName('Attribut 4');
        $attribut->setPosition(2);
        $attribut->setQuantity(6);
        $attribut->setPrice(1.2);
        $attribut->setPersoIsEnable(true);
        $attribut->setProduct($this->getReference('product_2'));
        $this->addReference('attribut 4', $attribut);
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
