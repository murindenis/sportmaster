<?php

namespace App\Service;

use App\Entity\CartProduct;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class CartManager
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;


    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param CartProduct[] $cartProducts
     * @return CartProduct[]
     */
    public function updateCart(array $cartProducts): array
    {
        $data = [];
        foreach ($cartProducts as $productCart) {
            $productSdk = $productCart->getProduct()->getSdk();
            $productCounts = $productCart->getCount();

            $priorityStoresByProduct = $this->getPriorityStoresByProduct($productSdk, $productCounts);
            $store = $this->getNeededStore($priorityStoresByProduct, $productCounts);

            if ($store) {
                $data[] = $productCart->setStore($store);
            } else {
                $this->removeCartProduct($productCart);
            }
        }

        return $data;
    }


    /**
     * @param int $productSdk
     * @param int $productCounts
     * @return array
     */
    private function getPriorityStoresByProduct(int $productSdk, int $productCounts): array
    {
        $priorityStoresByProduct = $this->em->getRepository(Store::class)->findPriorityStoreByProduct($productSdk, $productCounts);

        return $priorityStoresByProduct;
    }


    /**
     * @param array $priorityStoresByProduct
     * @param int $productCounts
     * @return Store|null
     */
    private function getNeededStore(array $priorityStoresByProduct, int $productCounts): ?Store
    {
        $store = null;
        if ($priorityStoresByProduct && $productCounts == 1) {
            $store = $priorityStoresByProduct[0];
        } elseif ($priorityStoresByProduct && $productCounts > 1) {
            $randStoreId = array_rand($priorityStoresByProduct, 1);
            $store = $priorityStoresByProduct[$randStoreId];
        }

        return $store;
    }


    /**
     * @param CartProduct $productCart
     */
    private function removeCartProduct(CartProduct $productCart): void
    {
        $this->em->remove($productCart);
    }
}




