<?php

namespace App\DataFixtures;

use App\Entity\Product\ParentCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ParentCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $parentCategory = new ParentCategory();
        $parentCategory->setName("Sexe");
        $parentCategory->setSlug("sexe");
        $this->addReference("Sexe", $parentCategory);
        $manager->persist($parentCategory);

        $manager->flush();
    }
}
