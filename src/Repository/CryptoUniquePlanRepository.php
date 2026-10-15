<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CryptoUniquePlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CryptoUniquePlan>
 */
class CryptoUniquePlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CryptoUniquePlan::class);
    }

    public function save(CryptoUniquePlan $CryptoUniquePlan, bool $flush = true): void
    {
        $this->getEntityManager()->persist($CryptoUniquePlan);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CryptoUniquePlan $CryptoUniquePlan, bool $flush = true): void
    {
        $this->getEntityManager()->remove($CryptoUniquePlan);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
