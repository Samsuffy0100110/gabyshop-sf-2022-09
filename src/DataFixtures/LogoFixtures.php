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
        $logo->setImage("https://loremflickr.com/300/300?random=1");
        $logo->setPosition(1);
        $manager->persist($logo);

        $manager->flush();
    }
}
