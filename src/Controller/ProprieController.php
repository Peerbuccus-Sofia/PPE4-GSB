<?php

namespace App\Controller;

use App\Entity\Locataire;
use App\Entity\Appartement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/proprio", name="proprio_")
     */

class ProprieController extends AbstractController
{
    /**
     * @Route("/appart/{idproprio}", name="appartements")
     * Liste des appartements du propriètaire connecté
     */
    public function appart()
    {
        $user = $this->getUser();
        return $this->render('proprie/apparts.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/infoloc/{idpers}", name="loc")
     * fiche du locataire
     */
    public function loc(Locataire $locataire)
    {
        return $this->render('proprie/infoloc.html.twig', [
            'locataire' => $locataire
        ]);
    }

    /**
     * @Route("/nvlappart", name="nvlapp")
     */
    public function addappart(Request $request, EntityManagerInterface $manager)
    {
        $appart = new Appartement();
        $user = $this->getUser();
        $currentdate = new \DateTime('now');
        $form = $this->createFormBuilder($appart)
                     ->add('proprietaire', HiddenType::class, [
                         'empty_data' => $user
                     ])
                     ->add('adr')
                     ->add('ville')
                     ->add('cp')
                     ->add('etage')
                     ->add('typeappart', ChoiceType::class, [
                         'choices' => [
                             'Appartement' => [
                                 'F2' => 'F2',
                                 'F3' => 'F3',
                                 'F4' => 'F4',
                                 'F5' => 'F5',
                                 'F6' => 'F6',
                             ],
                            ],
                     ])
                     ->add('loyer')
                     ->add('charge')
                     ->add('ascenseur')
                     ->add('preavis')
                     ->add('datelibre')
                     ->add('tauxcotisation') 
                     ->add('taille')
                     ->add('imageFile', FileType::class, [
                         'required' =>false
                     ])
                     ->add('updated_at', HiddenType::class, [
                        'empty_data' => $currentdate
                    ])
                     ->getForm();

        $form->handleRequest($request); //analyse les POST 

        dump($appart);

        if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide
            $manager->persist($appart); //faire persiter dans le temps les infos du visiteur
            $manager->flush(); //enregistrer dans la bdd
            return $this->redirectToRoute('proprio_appartements', ['idproprio' => $user->getIdpers()]);
        }

        return $this->render('proprie/creeAppart.html.twig', [
            'formAppart' => $form->createView(), //afficher le formulaire 
            'user' => $user
        ]);
    }
}

