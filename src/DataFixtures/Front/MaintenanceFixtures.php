<?php

namespace App\DataFixtures\Front;

use App\Entity\Maintenance;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MaintenanceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $maintenance = new Maintenance();
        $maintenance->setIsActive(false);
        $manager->persist($maintenance);

        $manager->flush();
    }
}
