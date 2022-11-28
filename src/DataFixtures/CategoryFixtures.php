<?php

namespace App\DataFixtures;

use App\Entity\Product\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\ParentCategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName("Vibromasseur");
        $category->setDescription("Le vibromasseur est un sextoy qui permet de stimuler les zones érogénes");
        $category->setSlug("vibromasseur");
        $category->setParent($this->getReference("Sexe"));
        $this->addReference("Vibromasseur", $category);
        $manager->persist($category);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ParentCategoryFixtures::class,
        ];
    }
}
