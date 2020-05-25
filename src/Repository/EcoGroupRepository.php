<?php

namespace App\Repository;

use App\Entity\EcoGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EcoGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcoGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcoGroup[]    findAll()
 * @method EcoGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcoGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EcoGroup::class);
    }

    // /**
    //  * @return EcoGroup[] Returns an array of EcoGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EcoGroup
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
