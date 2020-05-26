<?php

namespace App\Repository;

use App\Entity\Birds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Birds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Birds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Birds[]    findAll()
 * @method Birds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BirdsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Birds::class);
    }

    // /**
    //  * @return Birds[] Returns an array of Birds objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findLastSixBirdsField()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(6)
            ->getQuery()->getResult();
    }

    public function findForGalleryField()
    {
        return $this->createQueryBuilder('b')
            ->addSelect('b.id')
            ->addSelect('b.image')
            ->addSelect('b.name')
            ->getQuery()->getResult();
    }

    public function findForGalleryIndexField()
    {
        return $this->createQueryBuilder('b')
            ->addSelect('b.id')
            ->addSelect('b.image')
            ->addSelect('b.name')
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(6)
            ->getQuery()->getResult();
    }
}
