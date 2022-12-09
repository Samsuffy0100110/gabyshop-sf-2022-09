<?php

namespace App\Service;

use App\Service\CartService;
use App\Repository\Order\OrderRepository;
use App\Repository\Order\ShippingRepository;
use App\Repository\Product\CustomRepository;
use App\Repository\Order\OrderDetailsRepository;

class RemoveAllService
{
    public function removeAll(
        CartService $cart,
        OrderRepository $orderRepository,
        CustomRepository $customRepository,
        ShippingRepository $shippingRepository,
        OrderDetailsRepository $orderDetailsRepo
    ) {
        $orders = $orderRepository->findBy(['state' => 0]);
        foreach ($orders as $order) {
            $orderDetails = $orderDetailsRepo->findBy(['myOrder' => $order->getId()]);
            $customs = $customRepository->findBy(['customOrder' => $order->getId()]);
            foreach ($orderDetails as $orderDetail) {
                $orderDetailsRepo->remove($orderDetail, true);
            }
            foreach ($customs as $custom) {
                $customRepository->remove($custom, true);
            }
            $order->removeShipping($shippingRepository->findOneBy(['orderShipping' => $order->getId()]));
            $orderRepository->remove($order, true);
        }
        $customs = $customRepository->findBy(['customOrder' => null]);
        foreach ($customs as $custom) {
            $customRepository->remove($custom, true);
        }
        $orderDetails = $orderDetailsRepo->findBy(['myOrder' => null]);
        foreach ($orderDetails as $orderDetail) {
            $orderDetailsRepo->remove($orderDetail, true);
        }
        $cart->remove();
    }
}
