<?php

namespace App\DataFixtures;

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

        for ($i = 0; $i < 3; $i++) {
            $parentCategory = new ParentCategory();
            $parentCategory->setName("ParentCategory $i");
            $parentCategory->setImage("https://loremflickr.com/300/300?random=$i");
            $parentCategory->setSlug($this->slug->generate($parentCategory->getName()));
            $this->addReference("parentCategory_$i", $parentCategory);
            $manager->persist($parentCategory);
        }

        $manager->flush();
    }
}
