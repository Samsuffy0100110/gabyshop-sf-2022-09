<?php

namespace App\DataFixtures\Front;

use App\Entity\Front\Social;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SocialFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $social = new Social();
        $social->setName('Facebook');
        $social->setLink('https://www.facebook.com/');
        $manager->persist($social);

        $social = new Social();
        $social->setName('Twitter');
        $social->setLink('https://twitter.com/');
        $manager->persist($social);

        $social = new Social();
        $social->setName('Instagram');
        $social->setLink('https://www.instagram.com/');
        $manager->persist($social);

        $manager->flush();
    }
}
