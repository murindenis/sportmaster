<?php

namespace App\Repository;

use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Store|null find($id, $lockMode = null, $lockVersion = null)
 * @method Store|null findOneBy(array $criteria, array $orderBy = null)
 * @method Store[]    findAll()
 * @method Store[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoreRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Store::class);
    }


    /**
     * @param int $productSdk
     * @param int $productCount
     * @return array
     */
    public function findPriorityStoreByProduct(int $productSdk, int $productCount): array
    {
        $qb = $this->createQueryBuilder('s');

        $qb
            ->join('s.storeInventorys', 'si')
            ->join('si.inventory', 'i')
            ->andWhere($qb->expr()->eq('i.sdk', ':product_sdk'))
            ->andWhere($qb->expr()->gte('si.stock', ':product_count'))
            ->setParameter('product_sdk', $productSdk)
            ->setParameter('product_count', $productCount)
            ->orderBy('s.priority');

        return $qb->getQuery()->getResult();
    }
}
