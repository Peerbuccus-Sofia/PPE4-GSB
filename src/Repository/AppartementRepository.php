<?php

namespace App\Repository;

use App\Entity\Locataire;
use App\Entity\Appartement;
use App\Entity\Recherches;
use App\Form\RechercheAppType;
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
     * Retourne un tableau d'objets Appartements qui n'a pas de locataire
     */
    public function getAppartAlouer(/*Recherches $recherche*/){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQueryBuilder();
        $loc = $query;

        $loc = $query->select('a.idappart')
                    ->from('App\Entity\Locataire', 'l')
                    ->innerjoin('l.appartement', 'a');

        //dump($loc);
        $query = $entityManager->createQueryBuilder();
        $currentdate = new \DateTime('now'); //Date du jour
        $lesapparts = $query->select('ap.idappart, ap.adr, ap.ville, ap.cp, ap.etage, ap.taille, ap.typeappart, ap.loyer, ap.charge, ap.ascenseur, ap.preavis, ap.datelibre, ap.tauxcotisation, ap.filename')
                            ->from('App\Entity\Appartement','ap')
                            ->where('ap.datelibre > :date')
                            ->setParameter('date', $currentdate->format('Y-m-d'))
                            ->andwhere($query->expr()->notIn('ap.idappart ', $loc->getDQL()))
                           ;
        //dump($lesapparts);
        return $lesapparts ->getQuery()->getResult();
    }

    /**
     * @return string
     * retourne le tarif d'un appartement par mois, c'est à dire le loyer + les charges comprises
     */
    public function getloyercharge($idappart){
        $em = $this->getEntityManager();
       $query = $em->createQueryBuilder();

        $tarif = $query->select('SUM(a.loyer) + SUM(a.charge) as tarif')
                        ->from('App\Entity\Appartement', 'a')
                        ->where('a.idappart =:idappart ')
                        ->setParameter('idappart', $idappart)
                        ->getQuery();
         dump($tarif);
        
        return $tarif->getResult();

    }

    public function rechercheappart($critere)
    {
        return $this->createQueryBuilder('a')
                    ->where('a.typeappart = :typeappart')
                    ->setParameter('typeappart', $critere->getTypeappart())
                    ->andwhere('a.ville = :ville')
                    ->setParameter('ville', $critere->getVille())
                    ->andwhere('a.loyer = :loyer')
                    ->setParameter('loyer', $critere->getLoyer())
                    ->getQuery()
                    ->getResult()
                    ;
    }

    public function getappartloc($idloc){
        
        return $this->createQueryBuilder('a')
                    ->from('App\Entity\Locataire', 'l')
                    ->join('l.appartement', 'ap')
                    ->where('l.idpers = :idloc')
                    ->setParameter('idloc', $idloc)
                    ->getQuery()
                    ->getResult();
    }

    /**
     * Retourne la valeur de cotisation par propriétaire
     */
    public function getcotisations($idproprio){
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder();
 
         $cotisation = $query->select('a.idappart, a.loyer, a.charge, a.tauxcotisation, ((SUM(a.loyer) + SUM(a.charge))*a.tauxcotisation)/100 as cotisation')
                         ->from('App\Entity\Appartement', 'a')
                         ->where('a.proprietaire =:idproprio ')
                         ->setParameter('idproprio', $idproprio)
                         ->groupBy('a.idappart')
                         ->getQuery();
          dump($cotisation);
         
         return $cotisation->getResult();
    }


    // public function getville()
    // {
    //     return $this->createQueryBuilder('a.ville')
    //         ->andWhere('a.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('a.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
}
