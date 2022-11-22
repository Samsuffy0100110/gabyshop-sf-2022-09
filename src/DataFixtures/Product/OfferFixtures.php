<?php

namespace App\DataFixtures\Product;

use DateTime;
use App\Entity\Product\Offer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $offer = new Offer();
        $offer->setName("Super Promo de Noël");
        $offer->setReduce(10);
        $offer->setTypeReduce("percent");
        $offer->setIsActive(true);
        $offer->setStartedAt(new DateTime('2023-12-01'));
        $offer->setEndedAt(new DateTime('2023-12-31'));
        $offer->addProduct($this->getReference('product_1'));
        $this->addReference('Super Promo de Noël', $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setName("Super Promo de Paques");
        $offer->setReduce(20);
        $offer->setTypeReduce("amount");
        $offer->setIsActive(true);
        $offer->setStartedAt(new DateTime('2023-04-01'));
        $offer->setEndedAt(new DateTime('2023-04-30'));
        $offer->addProduct($this->getReference('product_2'));
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setName("Super Promo de la Saint Valentin");
        $offer->setReduce(30);
        $offer->setTypeReduce("percent");
        $offer->setIsActive(true);
        $offer->setStartedAt(new DateTime('2023-02-01'));
        $offer->setEndedAt(new DateTime('2023-02-14'));
        $offer->addProduct($this->getReference('product_3'));
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setName("Super Promo de la Fête des Mères");
        $offer->setReduce(40);
        $offer->setTypeReduce("amount");
        $offer->setIsActive(true);
        $offer->setStartedAt(new DateTime('2023-05-01'));
        $offer->setEndedAt(new DateTime('2023-05-31'));
        $offer->addProduct($this->getReference('product_4'));
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
