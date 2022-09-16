<?php

namespace App\DataFixtures\Front;

use App\Entity\Front\Logo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

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
