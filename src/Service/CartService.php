<?php

namespace App\Service;

use App\Entity\Product\Product;
use App\Entity\Product\Attribut;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    protected $session;
    protected $entityManager;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->session = $requestStack->getSession();
        $this->entityManager = $entityManager;
    }

    public function add($id)
    {
        $cart = $this->session->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $this->session->set('cart', $cart);
    }

    public function remove()
    {
        return $this->session->remove('cart');
    }

    public function delete($id)
    {
        $cart = $this->session->get('cart', []);
        unset($cart[$id]);
        return $this->session->set('cart', $cart);
    }

    public function decrease($id)
    {
        $cart = $this->session->get('cart', []);
        if ($cart[$id] > 1) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }
        return $this->session->set('cart', $cart);
    }

    public function getFull()
    {
        $cartComplete = [];
        if ($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                // $product_object = $this->em->getRepository(Product::class)->findOneById($id);
                // $attributs = $this->em->getRepository(Attribut::class)->findByProduct($product_object);
                $attribut = $this->entityManager->getRepository(Attribut::class)->find($id);
                // $products = $this->em->getRepository(Product::class)->find($attribut->getProduct());
                if (!$attribut) {
                    $this->delete($id);
                    continue;
                }
                $cartComplete[] = [
                    'attribut' => $attribut,
                    'quantity' => $quantity,

                ];
            }
        }
        return $cartComplete;
    }

    public function get()
    {
        return $this->session->get('cart');
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getFull() as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }
}
