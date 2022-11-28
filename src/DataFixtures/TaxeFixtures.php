<?php

namespace App\DataFixtures;

use App\Entity\Product\Taxe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TaxeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $taxe = new Taxe();
        $taxe->setName("Tax Free");
        $taxe->setPercent(0);
        $this->addReference("Tax Free", $taxe);
        $manager->persist($taxe);

        $manager->flush();
    }
}
