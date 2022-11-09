<?php

namespace App\DataFixtures\Product;

use Doctrine\Persistence\ObjectManager;
use App\Entity\Product\FeaturedProducts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Product\ProductFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FeaturedProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $featuredProduct = new FeaturedProducts();
        $featuredProduct->setProduct($this->getReference('product_1'));
        $featuredProduct->setPosition(1);
        $manager->persist($featuredProduct);

        $featuredProduct = new FeaturedProducts();
        $featuredProduct->setProduct($this->getReference('product_2'));
        $featuredProduct->setPosition(2);
        $manager->persist($featuredProduct);

        $featuredProduct = new FeaturedProducts();
        $featuredProduct->setProduct($this->getReference('product_3'));
        $featuredProduct->setPosition(3);
        $manager->persist($featuredProduct);

        $featuredProduct = new FeaturedProducts();
        $featuredProduct->setProduct($this->getReference('product_4'));
        $featuredProduct->setPosition(4);
        $manager->persist($featuredProduct);

        $featuredProduct = new FeaturedProducts();
        $featuredProduct->setProduct($this->getReference('product_5'));
        $featuredProduct->setPosition(5);
        $manager->persist($featuredProduct);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
        ];
    }
}
