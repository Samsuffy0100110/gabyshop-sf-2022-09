<?php

namespace App\DataFixtures\Product;

use DateTime;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Communication\Commentary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Product\ProductFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentaryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $commentary = new Commentary();
        $commentary->setUser($this->getReference('User'));
        $commentary->setProduct($this->getReference('product_1'));
        $commentary->setComment('Super produit, je recommande !');
        $commentary->setCreatedAt(new DateTime());
        $commentary->setIsPublished(true);
        $commentary->setRating(5);
        $manager->persist($commentary);

        $commentary = new Commentary();
        $commentary->setUser($this->getReference('User'));
        $commentary->setProduct($this->getReference('product_2'));
        $commentary->setComment('Je ne recommande pas ce produit, il est trop cher !');
        $commentary->setCreatedAt(new DateTime());
        $commentary->setIsPublished(true);
        $commentary->setRating(1);
        $manager->persist($commentary);

        $commentary = new Commentary();
        $commentary->setUser($this->getReference('User'));
        $commentary->setProduct($this->getReference('product_1'));
        $commentary->setComment('Je ne recommande pas ce produit, il est trop cher !');
        $commentary->setCreatedAt(new DateTime());
        $commentary->setIsPublished(true);
        $commentary->setRating(1);
        $manager->persist($commentary);

        $commentary = new Commentary();
        $commentary->setUser($this->getReference('User'));
        $commentary->setProduct($this->getReference('product_2'));
        $commentary->setComment('Produit de qualité, je recommande !');
        $commentary->setCreatedAt(new DateTime());
        $commentary->setIsPublished(true);
        $commentary->setRating(4);
        $manager->persist($commentary);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ProductFixtures::class,
        ];
    }
}
