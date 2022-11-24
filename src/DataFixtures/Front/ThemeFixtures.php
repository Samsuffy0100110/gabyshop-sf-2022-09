<?php

namespace App\DataFixtures\Front;

use App\Entity\Front\Theme;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $theme = new Theme();
        $theme->setName("Thème 1");
        $theme->setColorMenu("#000000");
        $theme->setBackgroundColor("#FFFFFF");
        $theme->setFooterColor("#212529");
        $theme->setFontColor("#FFFFFF");
        $theme->setIsActive(true);
        $manager->persist($theme);
        $manager->flush();
    }
}
