<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->words(1, true));
            $category->setDescription($faker->realText(100));
            $category->setImage("https://picsum.photos/200/300?random=$i");
            $this->addReference("category_$i", $category);
            $category->setParent($this->getReference("parentCategory_" . $faker->numberBetween(0, 2)));
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ParentCategoryFixtures::class,
        ];
    }
}
