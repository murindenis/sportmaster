<?php

namespace App\DataFixtures;

use App\Entity\Inventory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InventoryFixtures extends Fixture
{
    public const REFERENCE = 'app.inventory_';

    /**
     * @var array|array[]
     */
    private array $inventorys = [
        ['id' => 1, 'sdk' => 111, 'sku' => '11111'],
        ['id' => 2, 'sdk' => 112, 'sku' => '11112'],
        ['id' => 3, 'sdk' => 113, 'sku' => '11113'],
        ['id' => 4, 'sdk' => 114, 'sku' => '11114'],
        ['id' => 5, 'sdk' => 115, 'sku' => '11115'],
        ['id' => 6, 'sdk' => 116, 'sku' => '11116'],
        ['id' => 7, 'sdk' => 117, 'sku' => '11117'],
        ['id' => 8, 'sdk' => 118, 'sku' => '11118'],
    ];


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->inventorys as $inventory) {
            $newInventory = new Inventory();
            $newInventory
                ->setSdk($inventory['sdk'])
                ->setSku($inventory['sku']);

            $this->addReference(self::REFERENCE . $inventory['id'], $newInventory);

            $manager->persist($newInventory);
        }

        $manager->flush();
    }
}