<?php

namespace App\Repository;

use App\Entity\Concerner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Concerner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concerner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concerner[]    findAll()
 * @method Concerner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcernerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concerner::class);
    }

    // /**
    //  * @return Concerner[] Returns an array of Concerner objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Concerner
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
