<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/proprio", name="proprio")
     */

class ProprieController extends AbstractController
{
    
    public function index()
    {
        return $this->render('proprie/index.html.twig', [
            'controller_name' => 'ProprieController',
        ]);
    }
}
