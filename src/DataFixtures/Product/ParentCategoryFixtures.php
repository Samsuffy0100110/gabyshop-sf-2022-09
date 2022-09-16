<?php

namespace App\DataFixtures\Product;

use App\Service\Slugify;
use App\Entity\Product\ParentCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ParentCategoryFixtures extends Fixture
{
    private Slugify $slug;

    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public const PARENTCATEGORIES = [
        0 => [
            'name' => 'Maison',
            'image' => 'maison.jpg',
        ],
        1 => [
            'name' => 'Beauté',
            'image' => 'beaute.jpg',
        ],
        2 => [
            'name' => 'Vêtements',
            'image' => 'vetement.jpg',
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::PARENTCATEGORIES as $key => $value) {
            $parentCategory = new ParentCategory();
            $parentCategory->setName($value['name']);
            $parentCategory->setImage($value['image']);
            $parentCategory->setSlug($this->slug->generate($value['name']));
            $manager->persist($parentCategory);
            $this->addReference('parentCategory_' . $key, $parentCategory);
        }

        $manager->flush();
    }
}
