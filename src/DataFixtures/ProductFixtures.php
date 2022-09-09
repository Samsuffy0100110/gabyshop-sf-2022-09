<?php

namespace App\DataFixtures;

use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 40; $i++) {
            $product = new Product();
            $product->setName($faker->words(1, true));
            $product->setImage0("https://picsum.photos/200/300?random=$i");
            $product->setImage1("https://picsum.photos/200/300?random=1$i");
            $product->setImage2("https://picsum.photos/200/300?random=2$i");
            $product->setImage3("https://picsum.photos/200/300?random=3$i");
            $product->setImage4("https://picsum.photos/200/300?random=4$i");
            $product->setPrice($faker->randomFloat(2, 0, 100));
            $product->setQuantity($faker->numberBetween(0, 100));
            $product->setDescription($faker->realText(100));
            $product->setCreatedAt(new DateTimeImmutable());
            $product->setUpdatedAt($faker->dateTimeBetween('-6 months'));
            $product->setReleaseAt($faker->dateTimeBetween('-6 months'));
            $product->setSummary($faker->realText(50));
            $product->setWeight("100");
            $product->setCategory($this->getReference("category_" . $faker->numberBetween(0, 4)));
            $product->setTaxe($this->getReference("taxe_" . $faker->numberBetween(0, 1)));
            $this->addReference("product_$i", $product);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            TaxeFixtures::class,
        ];
    }
}
