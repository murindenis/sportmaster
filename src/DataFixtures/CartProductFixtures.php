<?php

namespace App\DataFixtures;

use App\Entity\CartProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CartProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE = 'app.cart_product_';

    /**
     * @var array|array[]
     */
    private array $cartProducts = [
        [
            'cart_id' => 1,
            'products' => [
                ['id' => 1, 'count' => 1, 'store' => null],
                ['id' => 2, 'count' => 2, 'store' => null],
                ['id' => 3, 'count' => 2, 'store' => null],
                ['id' => 4, 'count' => 3, 'store' => null],
                ['id' => 5, 'count' => 3, 'store' => null],
                ['id' => 6, 'count' => 4, 'store' => null],
                ['id' => 9, 'count' => 4, 'store' => null],
            ]
        ]
    ];


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $i = 1;
        foreach ($this->cartProducts as $cartProduct) {
            foreach ($cartProduct['products'] as $product) {
                $newCartProduct = new CartProduct();
                $newCartProduct
                    ->setCart($this->getReference(CartFixtures::REFERENCE . $cartProduct['cart_id']))
                    ->setProduct($this->getReference(ProductFixtures::REFERENCE . $product['id']))
                    ->setCount($product['count'])
                    ->setStore($product['store']);

                $manager->persist($newCartProduct);

                $this->addReference(self::REFERENCE . $i, $newCartProduct);
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
            CartFixtures::class,
            ProductFixtures::class,
        ];
    }
}