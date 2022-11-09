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
        $logo->setImage("https://zupimages.net/up/22/45/vv64.png");
        $logo->setPosition(1);
        $logo->setIsActive(true);
        $manager->persist($logo);

        $manager->flush();
    }
}
