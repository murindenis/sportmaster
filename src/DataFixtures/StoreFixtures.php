<?php

namespace App\DataFixtures;

use App\Entity\Store;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StoreFixtures extends Fixture
{
    public const REFERENCE = 'app.store_';

    /**
     * @var array|array[]
     */
    private array $stores = [
        ['id' => 1, 'name' => 'Store 1', 'priority' => 1],
        ['id' => 2, 'name' => 'Store 2', 'priority' => 2],
        ['id' => 3, 'name' => 'Store 3', 'priority' => 3],
    ];


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->stores as $store) {
            $newStore = new Store();
            $newStore
                ->setName($store['name'])
                ->setPriority($store['priority']);

            $this->addReference(self::REFERENCE . $store['id'], $newStore);

            $manager->persist($newStore);
        }

        $manager->flush();
    }
}