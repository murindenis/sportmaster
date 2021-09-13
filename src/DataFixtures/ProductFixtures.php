<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public const REFERENCE = 'app.product_';

    /**
     * @var array|array[]
     */
    private array $products = [
        ['id' => 1, 'sdk' => 111, 'sku' => '11111'],
        ['id' => 2, 'sdk' => 112, 'sku' => '11112'],
        ['id' => 3, 'sdk' => 113, 'sku' => '11113'],
        ['id' => 4, 'sdk' => 114, 'sku' => '11114'],
        ['id' => 5, 'sdk' => 115, 'sku' => '11115'],
        ['id' => 6, 'sdk' => 116, 'sku' => '11116'],
        ['id' => 7, 'sdk' => 117, 'sku' => '11117'],
        ['id' => 8, 'sdk' => 118, 'sku' => '11118'],
        ['id' => 9, 'sdk' => 119, 'sku' => '11119'],
    ];


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->products as $product) {
            $newProduct = new Product();
            $newProduct
                ->setSdk($product['sdk'])
                ->setSku($product['sku']);

            $this->addReference(self::REFERENCE . $product['id'], $newProduct);

            $manager->persist($newProduct);
        }

        $manager->flush();
    }
}