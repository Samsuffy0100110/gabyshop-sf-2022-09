<?php

namespace App\DataFixtures\Communication;

use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Communication\NewsLetter;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NewsLetterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $newsLetter = new NewsLetter();
        $newsLetter->setName('Spécial Halloween');
        $newsLetter->setTitle('Peur sur les prix !!');
        $newsLetter->setDescription('Profitez de nos offres spéciales pour Halloween');
        $newsLetter->setCreatedAt(new DateTimeImmutable());
        $newsLetter->setSummary('Profitez de nos offres spéciales pour Halloween');
        $newsLetter->setImage('newsletter.jpg');
        $manager->persist($newsLetter);

        $newsLetter = new NewsLetter();
        $newsLetter->setName('Spécial Noël');
        $newsLetter->setTitle('Noël approche !!');
        $newsLetter->setDescription('Profitez de nos offres spéciales pour Noël');
        $newsLetter->setCreatedAt(new DateTimeImmutable());
        $newsLetter->setSummary('Profitez de nos offres spéciales pour Noël');
        $newsLetter->setImage('newsletter.jpg');
        $manager->persist($newsLetter);

        $manager->flush();
    }
}
