<?php

namespace App\Repository;

use App\Entity\Locataire;
use App\Entity\Appartement;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Appartement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appartement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appartement[]    findAll()
 * @method Appartement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppartementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appartement::class);
    }

    /**
     * @return Appartement[] 
     * Returns un tableau d'objets Appartement
     */

    public function getAppartAlouer() // array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            "SELECT IDAPPART, PROPRIETAIRE_ID, ADR, VILLE, CP, ETAGE, TYPEAPPART, LOYER, CHARGE, ASCENSEUR, PREAVIS, DATELIBRE, TAUXCOTISATION, filename
             FROM App\Entity\Appartement 
            WHERE IDAPPART NOT IN (
                SELECT IDAPPART
                FROM App\Entity\Appartement A 
                LEFT JOIN App\Entity\Locataire L 
                WITH A.IDAPPART=L.APPARTEMENT_ID)");

        $lesapparts = $query->getResult();
        return $lesapparts;
    }

    /**
     * @return Appartement[] 
     * Retourne un tableau d'objets Appartements qui n'a pas de locataire
     */
    public function testgetAppartAlouer(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQueryBuilder();
        $loc = $query;

        $loc = $query->select('a.idappart')
                    ->from('App\Entity\Locataire', 'l')
                    ->innerjoin('l.appartement', 'a');

        dump($loc);
        $query = $entityManager->createQueryBuilder();
        $lesapparts = $query->select('ap.idappart, ap.adr, ap.ville, ap.cp, ap.etage, ap.typeappart, ap.loyer, ap.charge, ap.ascenseur, ap.preavis, ap.datelibre, ap.tauxcotisation, ap.filename')
                            ->from('App\Entity\Appartement', 'ap')
                            ->where($query->expr()->notIn('ap.idappart ', $loc->getDQL()))
                            ->getQuery();
                            
         dump($lesapparts);
        return $lesapparts->getResult();
    }

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Appartement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
