<?php

namespace App\Tests\Service;

use App\Entity\CartProduct;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProduct(): void
    {
        $product = new Product();

        $cartProduct = new CartProduct();

        $product
            ->setSdk(123)
            ->setSku('123')
            ->addCartProduct($cartProduct)
            ->removeCartProduct($cartProduct)
            ->removeCartProduct($cartProduct);

        $this->assertEquals($product->getSdk(), 123);
        $this->assertIsInt($product->getSdk());
        $this->assertNotEmpty($product->getSdk());
        $this->assertEquals($product->getSku(), '123');
        $this->assertIsString($product->getSku());
        $this->assertNotEmpty($product->getSku());
        $this->assertInstanceOf(CartProduct::class, $cartProduct);
        $this->assertInstanceOf(Product::class, $product);
    }
}
