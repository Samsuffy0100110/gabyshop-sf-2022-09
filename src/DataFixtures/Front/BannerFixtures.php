<?php

namespace App\DataFixtures\Front;

use DateTime;
use App\Entity\Front\Banner;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BannerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $banner = new Banner();
        $banner->setName("-15 % pour Noël");
        $banner->setImage("christmas.jpg");
        $banner->setPosition("1");
        $banner->setIsActive(true);
        $banner->setCreatedAt(new DateTime());
        $banner->setStartedAt(new DateTime());
        $banner->setEndedAt(new DateTime());
        $manager->persist($banner);

        $banner = new Banner();
        $banner->setName("Peur sur les prix !");
        $banner->setImage("halloween.jpg");
        $banner->setPosition("2");
        $banner->setIsActive(true);
        $banner->setCreatedAt(new DateTime());
        $banner->setStartedAt(new DateTime());
        $banner->setEndedAt(new DateTime());
        $manager->persist($banner);

        $banner = new Banner();
        $banner->setName("Chassez les promos !");
        $banner->setImage("easter.jpg");
        $banner->setPosition("3");
        $banner->setIsActive(true);
        $banner->setCreatedAt(new DateTime());
        $banner->setStartedAt(new DateTime());
        $banner->setEndedAt(new DateTime());
        $manager->persist($banner);

        $manager->flush();
    }
}
