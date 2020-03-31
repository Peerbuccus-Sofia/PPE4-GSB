<?php

namespace App\Controller;

use App\Entity\Locataire;
use App\Repository\LocataireRepository;
use App\Entity\Appartement;
use App\Entity\Proprietaire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 /**
     * @Route("/locataire", name="locataire_")
     */

class LocataireController extends AbstractController
{
    /**
     * @Route("/proprietaire/{idpers}", name="infoproprio")
     */
    public function infoproprio(Proprietaire $proprio){
        return $this->render('locataire/infoproprio.html.twig', [
            'proprio' => $proprio
        ]);
    }
}
