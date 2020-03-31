<?php

namespace App\Repository;

use App\Entity\Demande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Demande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demande[]    findAll()
 * @method Demande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demande::class);
    }

    // public function rechercheappart($critere)
    // {
    //     return $this->createQueryBuilder('d')
    //                 ->where('d.typedem = :typedem')
    //                 ->setParameter('typedem', $critere->getTypedem())
    //                 ->andwhere('d.ville = :ville')
    //                 ->setParameter('ville', $critere->getVille())
    //                 ->andwhere('d.prix = :prix')
    //                 ->setParameter('prix', $critere->getPrix())
    //                 ->getQuery()
    //                 ->getResult()
    //                 ;
    // }
    


    // /**
    //  * @return Demande[] Returns an array of Demande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Demande
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
