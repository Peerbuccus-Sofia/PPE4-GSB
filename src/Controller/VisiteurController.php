<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Repository\AppartementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class VisiteurController extends AbstractController
{
    /**
     * @Route("/", name="visiteuracceuil")
     * @param AppartementRepository $repository
     */
    public function index(Request $request, PaginatorInterface $paginator ,AppartementRepository $repository)
    {
         //$apparts = $repository->findAll();

        //$apparts = $repository->getAppartAlouer();
        $apparts = $repository->testgetAppartAlouer();
        $apparts = $paginator->paginate(
            $apparts, // on passe des données
            $request->query->getInt('page', 1),  //Numéro de la page en cours, 1 par défaut
            6
        );
        return $this->render('visiteur/index.html.twig', [
            'controller_name' => 'VisiteurController',
            'apparts' => $apparts
        ]);
    }

    /**
     * 
     */

    

    // public function demande(AppartementRepository $repository)
    // {
    //     $repository = $this->getDoctrine()->getRepository(Appartement::class);

    //     $lesapparts = $repository->getAppartAlouer();

    //     dump($lesapparts);

    //     return $this->render('visiteur/index.html.twig', [
    //         'controller_name' => 'VisiteurController',
    //     ]);
    // }
}
