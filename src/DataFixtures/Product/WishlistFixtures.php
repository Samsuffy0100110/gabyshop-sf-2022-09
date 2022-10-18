<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\Wishlist;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Product\ProductFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WishlistFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $wishlist = new Wishlist();
        $wishlist->setUser($this->getReference('Admin'));
        $wishlist->setProduct($this->getReference('product_1'));
        $manager->persist($wishlist);

        $wishlist = new Wishlist();
        $wishlist->setUser($this->getReference('Admin'));
        $wishlist->setProduct($this->getReference('product_2'));
        $manager->persist($wishlist);

        $wishlist = new Wishlist();
        $wishlist->setUser($this->getReference('Admin'));
        $wishlist->setProduct($this->getReference('product_3'));
        $manager->persist($wishlist);

        $wishlist = new Wishlist();
        $wishlist->setUser($this->getReference('User'));
        $wishlist->setProduct($this->getReference('product_4'));
        $manager->persist($wishlist);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ProductFixtures::class,
        ];
    }
}
