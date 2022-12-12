<?php

namespace App\DataFixtures;

use App\Entity\Product\Product;
use App\Entity\Product\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName("Rabbit");
        $product->setTaxe($this->getReference("Tax Free"));
        $product->setCategory($this->getReference('Vibromasseur'));
        $product->setDescription("Le rabbit est un sextoy qui permet de stimuler les zones érogénes");
        $product->setPrice(1000);
        $product->setWeight(100);
        $product->setSlug('rabbit');
        $this->addReference("Rabbit", $product);
        $manager->persist($product);

        $product = new Product();
        $product->setName("Chibre de dieu");
        $product->setTaxe($this->getReference("Tax Free"));
        $product->setCategory($this->getReference('Vibromasseur'));
        $product->setDescription("Le chibre de dieu est énorme");
        $product->setPrice(1000);
        $product->setWeight(1000);
        $product->setSlug('chibre');
        $this->addReference("Chibre de dieu", $product);
        $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
