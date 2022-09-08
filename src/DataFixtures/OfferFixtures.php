<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $offer = new Offer();
        $offer->setName("Promo 1");
        $offer->setPercent(10);
        $offer->setReduce(0);
        $offer->setIsActive(true);
        $offer->addProduct($this->getReference("product_1"));
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setName("Promo 2");
        $offer->setPercent(20);
        $offer->setReduce(0);
        $offer->setIsActive(true);
        $offer->addProduct($this->getReference("product_2"));
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setName("Promo 3");
        $offer->setPercent(0);
        $offer->setReduce(10);
        $offer->setIsActive(false);
        $offer->addProduct($this->getReference("product_3"));
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setName("Promo 4");
        $offer->setPercent(0);
        $offer->setReduce(20);
        $offer->setIsActive(true);
        $offer->addProduct($this->getReference("product_4"));
        $manager->persist($offer);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
