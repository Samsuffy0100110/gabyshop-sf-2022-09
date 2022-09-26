<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\Option;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Product\ProductFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $option = new Option();
        $option->setName('S');
        $option->addProduct($this->getReference('product_1'));
        $option->setOptionParent($this->getReference('option_parent_2'));
        $manager->persist($option);

        $option = new Option();
        $option->setName('M');
        $option->addProduct($this->getReference('product_1'));
        $option->setOptionParent($this->getReference('option_parent_2'));
        $manager->persist($option);

        $option = new Option();
        $option->setName('L');
        $option->addProduct($this->getReference('product_1'));
        $option->setOptionParent($this->getReference('option_parent_2'));
        $manager->persist($option);

        $option = new Option();
        $option->setName('XL');
        $option->addProduct($this->getReference('product_1'));
        $option->setOptionParent($this->getReference('option_parent_2'));
        $manager->persist($option);

        $option = new Option();
        $option->setName('rouge');
        $option->addProduct($this->getReference('product_1'));
        $option->setOptionParent($this->getReference('option_parent_1'));
        $manager->persist($option);

        $option = new Option();
        $option->setName('bleu');
        $option->addProduct($this->getReference('product_1'));
        $option->setOptionParent($this->getReference('option_parent_1'));
        $manager->persist($option);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            OptionParentFixtures::class,
        ];
    }
}
