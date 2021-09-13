<?php

namespace App\Tests\Service;

use App\Entity\Inventory;
use App\Entity\StoreInventory;
use PHPUnit\Framework\TestCase;

class InventoryTest extends TestCase
{
    public function testInventory(): void
    {
        $inventory = new Inventory();

        $storeInventory = new StoreInventory();

        $inventory
            ->setSdk(123)
            ->setSku('123')
            ->addStoreInventory($storeInventory)
            ->removeStoreInventory($storeInventory);

        $this->assertEquals($inventory->getSdk(), 123);
        $this->assertIsInt($inventory->getSdk());
        $this->assertNotEmpty($inventory->getSdk());
        $this->assertEquals($inventory->getSku(), '123');
        $this->assertIsString($inventory->getSku());
        $this->assertNotEmpty($inventory->getSku());
        $this->assertInstanceOf(StoreInventory::class, $storeInventory);
        $this->assertInstanceOf(Inventory::class, $inventory);
    }
}
