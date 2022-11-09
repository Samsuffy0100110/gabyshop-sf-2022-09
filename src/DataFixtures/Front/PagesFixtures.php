<?php

namespace App\DataFixtures\Front;

use DateTime;
use App\Entity\Front\Pages;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Pages();
        $page->setName('Mentions légales');
        $page->setSlug('mentions-legales');
        $page->setContent('Bla bla bla');
        $page->setCreatedAt(new DateTime());
        $page->setUpdatedAt(new DateTime());
        $page->setTitle('Mentions légales');
        $manager->persist($page);

        $page = new Pages();
        $page->setName('CGV');
        $page->setSlug('cgv');
        $page->setContent('Bla bla bla');
        $page->setCreatedAt(new DateTime());
        $page->setUpdatedAt(new DateTime());
        $page->setTitle('CGV');
        $manager->persist($page);

        $page = new Pages();
        $page->setName('CGU');
        $page->setSlug('cgu');
        $page->setContent('Bla bla bla');
        $page->setCreatedAt(new DateTime());
        $page->setUpdatedAt(new DateTime());
        $page->setTitle('CGU');
        $manager->persist($page);

        $manager->flush();
    }
}
