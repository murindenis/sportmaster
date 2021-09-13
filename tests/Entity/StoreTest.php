<?php

namespace App\Tests\Service;

use App\Entity\Store;
use App\Entity\StoreInventory;
use PHPUnit\Framework\TestCase;

class StoreTest extends TestCase
{
    public function testStore(): void
    {
        $storeInventory = new StoreInventory();

        $store = new Store();

        $store
            ->setName('Store 1')
            ->setPriority(1)
            ->removeStoreInventory($storeInventory);

        $this->assertEquals($store->getName(), 'Store 1');
        $this->assertIsString($store->getName());
        $this->assertNotEmpty($store->getName());
        $this->assertEquals($store->getPriority(), 1);
        $this->assertIsInt($store->getPriority());
        $this->assertNotEmpty($store->getPriority());
        $this->assertInstanceOf(Store::class, $store);
    }
}
