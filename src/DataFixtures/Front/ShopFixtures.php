<?php

namespace App\DataFixtures\Front;

use App\Entity\Front\Shop;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

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
