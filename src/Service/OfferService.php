<?php

namespace App\Service;

use App\Repository\Product\OfferRepository;
use App\Repository\Product\ProductRepository;

class OfferService
{
    public function calculTotalOffersByProduct(
        ProductRepository $productRepository,
        OfferRepository $offerRepository
    ): float {

        $products = $productRepository->findAll();
        $offers = $offerRepository->findAll();
        $total = 0;
        $price = 0;
        $reduce = 0;
        foreach ($products as $product) {
            $product->getPrice();
            $price = $product->getPrice();
        }
        foreach ($offers as $offer) {
            $offer->getReduce();
            $reduce = $offer->getReduce();
        }
        if ($reduce == 'percent') {
            $reduce = $price * $reduce / 100;
        } else {
            $reduce = $reduce;
        }

        $total = $price - $reduce;

        return $total;
    }
}
