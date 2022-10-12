<?php

namespace App\Service;

use App\Service\CartService;

class MondialRelayService
{
    public function shipByTotWeight(CartService $cartService)
    {
        $totalWeight = $cartService->getTotalWeight();

        if ($totalWeight > 0 &&  $totalWeight <= 200) {
            return 'Livraison gratuite';
        } elseif ($totalWeight > 201 && $totalWeight <= 500) {
            return 'Mondial Relay 0.5kg';
        } elseif ($totalWeight > 501 && $totalWeight <= 1000) {
            return 'Mondial Relay 1kg';
        } elseif ($totalWeight > 1001 && $totalWeight <= 2000) {
            return 'Mondial Relay 2kg';
        } elseif ($totalWeight > 2001 && $totalWeight <= 3000) {
            return 'Mondial Relay 3kg';
        } elseif ($totalWeight > 3001 && $totalWeight <= 4000) {
            return 'Mondial Relay 4kg';
        } elseif ($totalWeight > 4001 && $totalWeight <= 5000) {
            return 'Mondial Relay 5kg';
        } elseif ($totalWeight > 5001 && $totalWeight <= 7000) {
            return 'Mondial Relay 7kg';
        } elseif ($totalWeight > 7001 && $totalWeight <= 10000) {
            return 'Mondial Relay 10kg';
        } elseif ($totalWeight > 10001 && $totalWeight <= 15000) {
            return 'Mondial Relay 15kg';
        } elseif ($totalWeight > 15001 && $totalWeight <= 20000) {
            return 'Mondial Relay 20kg';
        } elseif ($totalWeight > 20001 && $totalWeight <= 30000) {
            return 'Mondial Relay 30kg';
        } else {
            return 'pas de livraison possible';
        }
    }
}
