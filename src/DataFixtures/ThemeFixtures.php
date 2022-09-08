<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $theme = new Theme();
        $theme->setName("Thème 1");
        $theme->setColorMenu("#000000");
        $theme->setBackgroundColor("#FFFFFF");
        $theme->setFooterColor("#FFFFAF");
        $theme->setIsActive(true);
        $manager->persist($theme);

        $theme = new Theme();
        $theme->setName("Thème 2");
        $theme->setColorMenu("#FFFFFF");
        $theme->setBackgroundColor("#000000");
        $theme->setFooterColor("#FFFFAF");
        $theme->setIsActive(false);
        $manager->persist($theme);

        $manager->flush();
    }
}
