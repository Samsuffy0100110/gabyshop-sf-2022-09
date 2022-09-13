<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Service\Slugify;
use App\Entity\ParentCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ParentCategoryFixtures extends Fixture
{
    private Slugify $slug;

    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $parentCategory = new ParentCategory();
            $parentCategory->setName($faker->words(1, true));
            $parentCategory->setImage("https://picsum.photos/200/300?random=5$i");
            $parentCategory->setSlug($this->slug->generate($parentCategory->getName()));
            $this->addReference("parentCategory_$i", $parentCategory);
            $manager->persist($parentCategory);
        }

        $manager->flush();
    }
}
