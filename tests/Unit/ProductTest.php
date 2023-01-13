<?php

namespace App\Tests\Unit;

use App\Entity\Product\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    public function getEntity(): Product
    {
        return (new Product())
            ->setName('Coiffeuse')
            ->setPrice(16000)
            ->setReleaseAt(new \DateTimeImmutable())
            ->setDescription('j\'adore la coiffure');
    }

    public function testProductIsValid(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $product = $this->getEntity();
        $errors = $container->get('validator')->validate($product);

        $this->assertCount(0, $errors);
    }

    public function testProductIsNotValid(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $product = $this->getEntity()
            ->setName('');

        $errors = $container->get('validator')->validate($product);

        $this->assertCount(1, $errors);
    }
}
