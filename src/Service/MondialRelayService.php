<?php

namespace App\Service;

use App\Service\CartService;

/**
 * This will suppress CyclomaticComplexity warning in
 * this class.
 *
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
class MondialRelayService
{
    public function shipByTotWeight(CartService $cartService)
    {
        $totalWeight = $cartService->getTotalWeight();

        switch (true) {
            case $totalWeight > 0 &&  $totalWeight <= 200:
                return 'Livraison gratuite';
            case $totalWeight > 201 && $totalWeight <= 500:
                return 'Mondial Relay 0.5kg';
            case $totalWeight > 501 && $totalWeight <= 1000:
                return 'Mondial Relay 1kg';
            case $totalWeight > 1001 && $totalWeight <= 2000:
                return 'Mondial Relay 2kg';
            case $totalWeight > 2001 && $totalWeight <= 3000:
                return 'Mondial Relay 3kg';
            case $totalWeight > 3001 && $totalWeight <= 4000:
                return 'Mondial Relay 4kg';
            case $totalWeight > 4001 && $totalWeight <= 5000:
                return 'Mondial Relay 5kg';
            case $totalWeight > 5001 && $totalWeight <= 7000:
                return 'Mondial Relay 7kg';
            case $totalWeight > 7001 && $totalWeight <= 10000:
                return 'Mondial Relay 10kg';
            case $totalWeight > 10001 && $totalWeight <= 15000:
                return 'Mondial Relay 15kg';
            case $totalWeight > 15001 && $totalWeight <= 20000:
                return 'Mondial Relay 20kg';
            case $totalWeight > 20001 && $totalWeight <= 30000:
                return 'Mondial Relay 30kg';
            default:
                return 'pas de livraison possible';
        }
    }
}
