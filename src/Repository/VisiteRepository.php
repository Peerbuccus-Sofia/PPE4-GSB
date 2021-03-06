<?php

namespace App\Repository;

use App\Entity\Visite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Visite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visite[]    findAll()
 * @method Visite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visite::class);
    }

    /**
     * @return Visite[] Returns an array of Visite objects
     */
    public function getVisitesPasserByIdpers($idvisiteur)
    {
        $currentdate = new \DateTime('now'); //Date du jour
        return $this->createQueryBuilder('v')
                    ->where('v.visiteurs = :idpers')
                    ->setParameter('idpers', $idvisiteur)
                    ->andwhere('v.datevisite < :date')
                    ->setParameter('date', $currentdate->format('Y-m-d'))
                    ->getQuery()
                    ->getResult();
    }

    public function getVisitesProchaineByIdpers($idvisiteur)
    {
        $currentdate = new \DateTime('now'); //Date du jour
        return $this->createQueryBuilder('v')
                    ->where('v.visiteurs = :idpers')
                    ->setParameter('idpers', $idvisiteur)
                    ->andwhere('v.datevisite > :date')
                    ->setParameter('date', $currentdate->format('Y-m-d'))
                    ->getQuery()
                    ->getResult();
    }
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Visite
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
