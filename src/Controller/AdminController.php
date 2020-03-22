<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Entity\Locataire;
use App\Entity\Appartement;
use App\Entity\Proprietaire;
use App\Repository\VisiteurRepository;
use App\Repository\LocataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProprietaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/admin", name="admin_")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/creeVisiteur", name="creeVisiteur")
     * ajoute un visiteur dans la bdd
     */
    public function creeVisiteur(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $visiteur = new Visiteur();
        $form = $this->createFormBuilder($visiteur)
                     ->add('nom')
                     ->add('prenom')
                     ->add('adr')
                     ->add('ville')
                     ->add('cp')
                     ->add('tel')
                     ->add('username')
                     ->add('password', PasswordType::class)
                     ->getForm();

         $form->handleRequest($request); //analyse les POST 

         dump($visiteur);
         

         if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide

            $passwordEncoded = $encoder->encodePassword($visiteur, $visiteur->getPassword());
            $visiteur->setPassword($passwordEncoded);

             $manager->persist($visiteur); //faire persiter dans le temps les infos du visiteur
             $manager->flush(); //enregistrer dans la bdd

             return $this->redirectToRoute('admin_lesVisiteurs');
        }

        return $this->render('admin/creevisiteur.html.twig', ['formVisiteur' => $form->createView()
        ]);
    }

    /**
     * @Route("/listeVisiteur", name="lesVisiteurs")
     * Retourne les visiteurs
     */
    public function getlesvisiteurs(VisiteurRepository $repository){
       // $repository = $this->getDoctrine()->getRepository(Visiteur::class);
        $visiteurs = $repository->findAll();
        return $this->render('admin/listevisiteur.html.twig', [
            'controller_name' => 'AdminController',
            'visiteurs' => $visiteurs
            ]);
    }

    /**
     * @Route("/listeVisiteur/{id}", name="infovisiteur")
     * retourne les informations d'un visiteur en fonction de son id 
     */
    public function getvisiteur(Visiteur $visiteur){
        return $this->render('admin/modifvisiteur.html.twig', [
            'visiteur' => $visiteur]);
    }

    /**
     * @Route("/creeProprio", name="creeproprio")
     * ajouter un nouveau proprietaire dans le bdd
     */
    public function creepro(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $proprio = new Proprietaire();
        $form = $this->createFormBuilder($proprio) //créer un formulaire
                // ajout des champs à mon formulaire
                     ->add('nom') 
                     ->add('prenom')
                     ->add('adr')
                     ->add('ville')
                     ->add('cp')
                     ->add('tel')
                     ->add('username')
                     ->add('password', PasswordType::class)
                     ->getForm();

         $form->handleRequest($request); //analyse les POST 

         dump($proprio);

         if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide

            $passwordEncoded = $encoder->encodePassword($proprio, $proprio->getPassword());
            $proprio->setPassword($passwordEncoded);

             $manager->persist($proprio); //faire persiter dans le temps les infos du proprietaire
             $manager->flush(); //enregistrer dans la bdd
              
             return $this->redirectToRoute('admin_lesProprios');
        }

        return $this->render('admin/creeproprio.html.twig', [
            'formProprio' => $form->createView()
        ]);
    }

    /**
     * @Route("/listeProprio", name="lesProprios")
     * Retourne une collection de propriétaire d'appartement
     */
    public function getlesproprios(ProprietaireRepository $repository){
        $proprio = $repository->findAll();
        return $this->render('admin/listeproprio.html.twig', [
            'controller_name' => 'AdminController',
            'proprios' => $proprio
        ]);
    }

    /**
     * @Route("/listeProprio/{id}", name="infoproprio")
     * retourne les informations d'une propriétaire en fonction de son id
     */
    public function getproprio(Proprietaire $proprio){
        return $this->render('admin/infoproprio.html.twig', [
            'proprio' => $proprio
        ]);
    }

    /**
     * @Route("/listeProprio/{id}/appart/{idAppart}", name="infoappart")
     * @ParamConverter("listeProprio", options={"mapping": {"id" : "idpers" }} )
     * @ParamConverter("appart", options={"mapping" : {"idAppart" : "idappart" }} )
     */
    public function getappartPro(Appartement $appart){
        return $this->render('admin/infoappart.html.twig', [
            'appart' => $appart
        ]);
    }
    /**
     * @Route("/creeAppart/{id}", name="creeAppart")
     */
    public function creeAppart(Request $request, EntityManagerInterface $manager, Proprietaire $proprio){
        // $repository = $this->getDoctrine()->getRepository(Proprietaire::class);
        // $proprio = $repository->find();
       
        $appart = new Appartement();

        $form = $this->createFormBuilder($appart)
                     ->add('proprietaire', EntityType::class, [
                         'class' => Proprietaire::class, 
                         'choice_label' => 'nom'
                     ])
                    //  ->add('proprietaire', HiddenType::class, [
                    //      'required' => true
                    //  ])
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
                     ->getForm();

        $form->handleRequest($request); //analyse les POST 

        dump($appart);

        if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide
            $manager->persist($appart); //faire persiter dans le temps les infos du visiteur
            $manager->flush(); //enregistrer dans la bdd
            return $this->redirectToRoute('admin_infoproprio', ['id' => $proprio->getIdpers()]);
        }

        return $this->render('admin/creeAppart.html.twig', [
            'formAppart' => $form->createView(), //afficher le formulaire 
            'proprio' => $proprio
        ]);
    }
    
    /**
     * @Route("/listeloc", name="lesLocataires")
     * retourne la liste des locataires d'appartement
     */
    public function getleslocataires(LocataireRepository $repository){
        $loc = $repository->findAll();
        return $this->render('admin/listelocataire.html.twig', [
            'locs' => $loc
        ]);
    }

    /**
     * @Route("/listeloc/{id}", name="infoloc")
     * retourne les infomations d'un locataire
     */
    public function getloc(Locataire $loc){
        return $this->render('admin/infolocataire.html.twig', [
            'loc' => $loc
        ]);
    }

}
