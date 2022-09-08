<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $shop = new Shop();
        $shop->setName("GABYshop");
        $shop->setShopNumberPro("123456789");
        $shop->setAdress("1 rue de la Paix");
        $shop->setZipCode("75000");
        $shop->setCity("Paris");
        $shop->setCountry("France");
        $shop->setPhone("06 23 45 67 89");
        $shop->setmail("admin@admin.fr");
        $shop->setDescription("GABYshop est une boutique en ligne de vente de produits de beauté et de bien-être.");
        $manager->persist($shop);

        $manager->flush();
    }
}
