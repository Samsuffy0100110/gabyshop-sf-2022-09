<?php

namespace App\Service;

use DateTime;
use App\Entity\Product\Offer;
use App\Entity\Product\Custom;
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

    public function addIdAndQuantity($id, $quantity)
    {
        $cart = $this->session->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id] += $quantity;
        } else {
            $cart[$id] = $quantity;
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
                $attribut = $this->entityManager->getRepository(Attribut::class)->find($id);
                $product = $attribut->getProduct();
                $custom = $this->entityManager->getRepository(Custom::class)->findOneBy(['attribut' => $id]);
                $description = $this->entityManager->getRepository(Custom::class)->findOneBy(['attribut' => $id]);

                foreach ($attribut->getCustoms() as $custom) {
                    $description = $custom->getDescription();
                }
                $offers = $this->entityManager->getRepository(Offer::class)->createQueryBuilder('o')
                    ->select('o')
                    ->join('o.product', 'p')
                    ->where('p.id = :id')
                    ->andWhere('o.isActive = :isActive')
                    ->andWhere('o.startedAt <= :now')
                    ->andWhere('o.endedAt >= :now')
                    ->setParameter('id', $product->getId())
                    ->setParameter('isActive', true)
                    ->setParameter('now', new DateTime())
                    ->setFirstResult(0)
                    ->getQuery()
                    ->getResult();

                if ($offers) {
                    $primaryName = $offers[0]->getName();
                    $primaryReduce = $offers[0]->getReduce();
                    $primaryType = $offers[0]->getTypeReduce();
                    if (isset($offers[1])) {
                        $secondaryName = $offers[1]->getName();
                        $secondaryReduce = $offers[1]->getReduce();
                        $secondaryType = $offers[1]->getTypeReduce();
                    } else {
                        $secondaryName = null;
                        $secondaryReduce = null;
                        $secondaryType = null;
                    }
                } else {
                    $primaryName = null;
                    $primaryReduce = null;
                    $primaryType = null;
                    $secondaryName = null;
                    $secondaryReduce = null;
                    $secondaryType = null;
                }

                if (!$attribut) {
                    $this->delete($id);
                    continue;
                }
                $cartComplete[] = [
                    'attribut' => $attribut,
                    'quantity' => $quantity,
                    'product' => $product,
                    'custom' => $custom,
                    'description' => $description,
                    'primaryOfferName' => $primaryName,
                    'primaryOfferReduce' => $primaryReduce,
                    'primaryOfferTypeReduce' => $primaryType,
                    'secondaryOfferName' => $secondaryName,
                    'secondaryOfferReduce' => $secondaryReduce,
                    'secondaryOfferTypeReduce' => $secondaryType,
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

    public function getTotalWeight()
    {
        $totalWeight = 0;
        foreach ($this->getFull() as $item) {
            $totalWeight += $item['product']->getWeight() * $item['quantity'];
        }
        return $totalWeight;
    }

    public function __toString()
    {
        return $this->getTotal();
    }
}
