<?php

namespace App\Tests\Service;

use App\Entity\Inventory;
use App\Entity\Store;
use App\Entity\StoreInventory;
use PHPUnit\Framework\TestCase;

class StoreInventoryTest extends TestCase
{
    public function testStoreInventory(): void
    {
        $store = new Store();

        $inventory = new Inventory();

        $storeInventory = new StoreInventory();
        $storeInventory
            ->setStore($store)
            ->setInventory($inventory)
            ->setStock(10);

        $this->assertEquals($storeInventory->getStock(), 10);
        $this->assertEquals($storeInventory->getStore(), $store);
        $this->assertEquals($storeInventory->getInventory(), $inventory);
        $this->assertIsInt($storeInventory->getStock());
        $this->assertIsObject($storeInventory->getStore());
        $this->assertIsObject($storeInventory->getInventory());
        $this->assertNotEmpty($storeInventory->getStore());
        $this->assertNotEmpty($storeInventory->getInventory());
        $this->assertNotEmpty($storeInventory->getStock());
        $this->assertInstanceOf(Store::class, $store);
        $this->assertInstanceOf(Inventory::class, $inventory);
        $this->assertInstanceOf(StoreInventory::class, $storeInventory);
    }
}
