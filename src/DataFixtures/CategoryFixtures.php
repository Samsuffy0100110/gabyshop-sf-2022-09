<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Service\Slugify;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    private Slugify $slug;

    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName("Category $i");
            $category->setDescription($faker->realText(100));
            $category->setImage("https://picsum.photos/200/300?random=$i");
            $category->setSlug($this->slug->generate($category->getName()));
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
