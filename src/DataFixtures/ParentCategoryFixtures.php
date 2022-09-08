<?php

namespace App\DataFixtures;

use App\Entity\ParentCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ParentCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $parentCategory = new ParentCategory();
            $parentCategory->setName($faker->words(1, true));
            $parentCategory->setImage("https://picsum.photos/200/300?random=5$i");
            $this->addReference("parentCategory_$i", $parentCategory);
            $manager->persist($parentCategory);
        }

        $manager->flush();
    }
}
