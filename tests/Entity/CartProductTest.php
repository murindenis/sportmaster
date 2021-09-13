<?php

namespace App\Tests\Service;

use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Entity\Product;
use App\Entity\Store;
use App\Entity\StoreInventory;
use PHPUnit\Framework\TestCase;

class CartProductTest extends TestCase
{
    public function testCartProduct(): void
    {
        $cart = new Cart();

        $product = new Product();

        $store = new Store();

        $cartProduct = new CartProduct();
        $cartProduct
            ->setCart($cart)
            ->setProduct($product)
            ->setStore($store)
            ->setCount(10);

        $this->assertEquals($cartProduct->getCount(), 10);
        $this->assertEquals($cartProduct->getCart(), $cart);
        $this->assertEquals($cartProduct->getProduct(), $product);
        $this->assertEquals($cartProduct->getStore(), $store);
        $this->assertIsInt($cartProduct->getCount());
        $this->assertIsObject($cartProduct->getCart());
        $this->assertIsObject($cartProduct->getProduct());
        $this->assertIsObject($cartProduct->getStore());
        $this->assertNotEmpty($cartProduct->getCart());
        $this->assertNotEmpty($cartProduct->getProduct());
        $this->assertNotEmpty($cartProduct->getCount());
        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertInstanceOf(Product::class, $product);
        $this->assertInstanceOf(Store::class, $store);
        $this->assertInstanceOf(CartProduct::class, $cartProduct);
    }
}
