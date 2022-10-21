<?php

namespace App\DataFixtures\Communication;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Communication\NewsLetterUser;

class NewsLetterUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $newsLetterUser = new NewsLetterUser();
        $newsLetterUser->setEmail('yo@gmail.com');
        $newsLetterUser->setUuid('123456789');
        $manager->persist($newsLetterUser);

        $newsLetterUser = new NewsLetterUser();
        $newsLetterUser->setEmail('alex@gmail.com');
        $newsLetterUser->setUuid('987654321');
        $manager->persist($newsLetterUser);
        $manager->flush();
    }
}
