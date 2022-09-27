<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\OptionParent;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OptionParentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $optionParent = new OptionParent();
        $optionParent->setName('Color');
        $this->addReference('option_parent_1', $optionParent);
        $manager->persist($optionParent);

        $optionParent = new OptionParent();
        $optionParent->setName('Size');
        $this->addReference('option_parent_2', $optionParent);
        $manager->persist($optionParent);

        $manager->flush();
    }
}
