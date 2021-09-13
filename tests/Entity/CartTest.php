<?php

namespace App\Tests\Service;

use App\Entity\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testCart(): void
    {
        $cart = new Cart();

        $this->assertInstanceOf(Cart::class, $cart);
    }
}
