<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CartFixtures extends Fixture
{
    public const REFERENCE = 'app.cart_';

    /**
     * @var array|int[][]
     */
    private array $carts = [
        ['id' => 1],
    ];


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->carts as $cart) {
            $newCart = new Cart();

            $this->addReference(self::REFERENCE . $cart['id'], $newCart);

            $manager->persist($newCart);
        }

        $manager->flush();
    }
}