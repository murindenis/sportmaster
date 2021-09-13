<?php

namespace App\DataFixtures;

use App\Entity\StoreInventory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StoreInventoryFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE = 'app.store_inventory_';

    /**
     * @var array|array[]
     */
    private array $storeInventorys = [
        [
            'store_id' => 1,
            'inventorys' => [
                ['id' => 1, 'stock' => 10],
                ['id' => 2, 'stock' => 10],
                ['id' => 3, 'stock' => 10],
            ]
        ],
        [
            'store_id' => 2,
            'inventorys' => [
                ['id' => 3, 'stock' => 10],
                ['id' => 4, 'stock' => 10],
                ['id' => 5, 'stock' => 10]
            ]
        ],
        [
            'store_id' => 3,
            'inventorys' => [
                ['id' => 5, 'stock' => 10],
                ['id' => 6, 'stock' => 10],
                ['id' => 7, 'stock' => 10],
                ['id' => 8, 'stock' => 10]
            ]
        ]
    ];


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach ($this->storeInventorys as $storeInventory) {
            foreach ($storeInventory['inventorys'] as $inventory) {
                $newStoreInventory = new StoreInventory();
                $newStoreInventory
                    ->setStore($this->getReference(StoreFixtures::REFERENCE . $storeInventory['store_id']))
                    ->setInventory($this->getReference(InventoryFixtures::REFERENCE . $inventory['id']))
                    ->setStock($inventory['stock']);

                $manager->persist($newStoreInventory);

                $this->addReference(self::REFERENCE . $i, $newStoreInventory);
                $i++;
            }
        }

        $manager->flush();
    }


    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            StoreFixtures::class,
            InventoryFixtures::class,
        ];
    }
}