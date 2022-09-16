<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\Taxe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TaxeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $taxe = new Taxe();
        $taxe->setName("TVA 20%");
        $taxe->setPercent(20);
        $this->addReference("taxe_0", $taxe);
        $manager->persist($taxe);

        $taxe = new Taxe();
        $taxe->setName("TVA 10%");
        $taxe->setPercent(10);
        $this->addReference("taxe_1", $taxe);
        $manager->persist($taxe);

        $manager->flush();
    }
}
