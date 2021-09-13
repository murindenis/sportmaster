<?php

namespace App\Tests\Service;

use App\Entity\CartProduct;
use App\Service\CartManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CartManagerTest extends KernelTestCase
{
    public function testUpdateCart(): void
    {
        self::bootKernel();
        $cartProductRepository = static::$container->get('doctrine')->getRepository(CartProduct::class);
        $entityManager = static::$container->get('doctrine')->getManager();

        $cartId = 1;
        $cartProducts = $cartProductRepository->findByCart($cartId);

        $cartManager = new CartManager($entityManager);
        $newCartProducts = $cartManager->updateCart($cartProducts);

        $this->assertCount(6, $newCartProducts);
        foreach ($newCartProducts as $cartProduct) {
            $this->assertNotNull($cartProduct->getStore());
        }
    }
}
