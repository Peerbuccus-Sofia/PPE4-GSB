<?php

namespace App\Repository;

use App\Entity\Locataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Locataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locataire[]    findAll()
 * @method Locataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locataire::class);
    }

    /**
     * @return Locataire[] Returns an array of Locataire objects
     * retourne un loc en fonction de l'id de l'appartement
     */
    public function getloc($idappart){
        return $this->createQueryBuilder('l')
                    ->join('l.appartement', 'a')
                    ->where('a.idappart = :appart')
                    ->setParameter('appart', $idappart)
                    ->getQuery()
                    ->getResult();
    }

    public function getlocbyid($idloc){
        return $this->createQueryBuilder('l')
                    ->join('l.appartement', 'a')
                    ->where('l.idpers = :idloc')
                    ->setParameter('idloc', $idloc)
                    ->getQuery()
                    ->getResult();
    }

    //
     /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Locataire
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
