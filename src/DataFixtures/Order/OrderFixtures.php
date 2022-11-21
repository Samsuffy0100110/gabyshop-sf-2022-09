<?php

namespace App\DataFixtures\Order;

use DateTime;
use App\Entity\Order\Order;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\AddressFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Order\ShippingFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDERS = [

        [
            'id' => 1,
            'reference' => '123456789',
            'user' => 'User',
            'address' => 'Chez Moi',
            'shipping' => 'Mondial Relay 0.5kg',
            'state' => 1,
        ],
        [
            'id' => 2,
            'reference' => '987654321',
            'user' => 'User',
            'address' => 'Taf',
            'shipping' => 'Mondial Relay 1kg',
            'state' => 1,
        ],
        [
            'id' => 3,
            'reference' => '1234567898',
            'user' => 'User',
            'address' => 'Taf',
            'shipping' => 'Livraison gratuite',
            'state' => 1,
        ],
        [
            'id' => 4,
            'reference' => '9876543212',
            'user' => 'Admin',
            'address' => 'Domicile',
            'shipping' => 'Mondial Relay 0.5kg',
            'state' => 1,
        ],
        [
            'id' => 5,
            'reference' => '1234567897',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 1kg',
            'state' => 1,
        ],
        [
            'id' => 6,
            'reference' => '9876543211',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Livraison gratuite',
            'state' => 1,
        ],
        [
            'id' => 7,
            'reference' => '1234567896',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 2kg',
            'state' => 1,
        ],
        [
            'id' => 8,
            'reference' => '9876543210',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 3kg',
            'state' => 1,
        ],
        [
            'id' => 9,
            'reference' => '1234567895',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 4kg',
            'state' => 1,
        ],
        [
            'id' => 10,
            'reference' => '9876543213',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 5kg',
            'state' => 1,
        ],
        [
            'id' => 11,
            'reference' => '1234567894',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 7kg',
            'state' => 1,
        ],
        [
            'id' => 12,
            'reference' => '9876543214',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 7kg',
            'state' => 1,
        ],
        [
            'id' => 13,
            'reference' => '1234567893',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 10kg',
            'state' => 1,
        ],
        [
            'id' => 14,
            'reference' => '9876543215',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 15kg',
            'state' => 1,
        ],
        [
            'id' => 15,
            'reference' => '1234567892',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 10kg',
            'state' => 1,
        ],
        [
            'id' => 16,
            'reference' => '9876543216',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 20kg',
            'state' => 1,
        ],
        [
            'id' => 17,
            'reference' => '1234567891',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 30kg',
            'state' => 1,
        ],
        [
            'id' => 18,
            'reference' => '9876543217',
            'user' => 'Admin',
            'address' => 'Boulot',
            'shipping' => 'Mondial Relay 2kg',
            'state' => 1,
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::ORDERS as $orderData) {
            $order = new Order();
            $order->setReference($orderData['reference']);
            $order->setUser($this->getReference($orderData['user']));
            $order->setAdress($this->getReference('Chez moi'));
            $order->addShipping($this->getReference($orderData['shipping']));
            $order->setState($orderData['state']);
            $order->setCreatedAt(new DateTime());
            $order->setUpdatedAt(new DateTime());
            $this->addReference($orderData['id'], $order);
            $manager->persist($order);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ShippingFixtures::class,
            AddressFixtures::class,
        ];
    }
}
