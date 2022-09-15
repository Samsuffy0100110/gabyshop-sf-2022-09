<?php

namespace App\DataFixtures;

use App\Entity\Logo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LogoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $logo = new Logo();
        $logo->setName("Logo 1");
        $logo->setImage("logo.png");
        $logo->setPosition(1);
        $manager->persist($logo);

        $manager->flush();
    }
}
