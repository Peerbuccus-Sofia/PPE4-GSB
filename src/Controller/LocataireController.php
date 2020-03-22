<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 /**
     * @Route("/locataire", name="locataire_")
     */

class LocataireController extends AbstractController
{
   /**
    * @Route("/profil{id}", name="profil")
    */
    // public function profilloc($id, Request $request){
    //     $session = $request->getSession();
    //     $loc = $session->get('id', []);
    //     $loc[$id] = 1;
    // }
}
