<?php

namespace App\Repository;

use App\Entity\StoreInventory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StoreInventory|null find($id, $lockMode = null, $lockVersion = null)
 * @method StoreInventory|null findOneBy(array $criteria, array $orderBy = null)
 * @method StoreInventory[]    findAll()
 * @method StoreInventory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoreInventoryRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StoreInventory::class);
    }
}
