<?php

namespace App\DataFixtures\Product;

use DateTime;
use App\Entity\Product\PromoCode;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PromoCodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $promoCode = new PromoCode();
        $promoCode->setName('Vente flash !');
        $promoCode->setCreatedAt(new DateTime());
        $promoCode->setStartedAt(new DateTime());
        $promoCode->setEndedAt(new DateTime('+1 day'));
        $promoCode->setIsActive(true);
        $promoCode->setReduce(10);
        $promoCode->setCode('FLASH10');
        $manager->persist($promoCode);

        $promoCode = new PromoCode();
        $promoCode->setName('Promo coup de coeur');
        $promoCode->setCreatedAt(new DateTime());
        $promoCode->setStartedAt(new DateTime());
        $promoCode->setEndedAt(new DateTime('+1 day'));
        $promoCode->setIsActive(false);
        $promoCode->setReduce(20);
        $promoCode->setCode('COEUR20');
        $manager->persist($promoCode);

        $manager->flush();
    }
}
