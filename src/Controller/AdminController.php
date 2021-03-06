<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Entity\Locataire;
use App\Form\ProprioType;
use App\Form\VisiteurType;
use App\Entity\Appartement;
use App\Form\LocataireType;
use App\Entity\Proprietaire;
use App\Repository\VisiteurRepository;
use App\Repository\LocataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppartementRepository;
use App\Repository\ProprietaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
        $form = $this->createForm(VisiteurType::class, $visiteur);
         $form->handleRequest($request); //analyse les POST 

         if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide

            $passwordEncoded = $encoder->encodePassword($visiteur, $visiteur->getPassword());
            $visiteur->setPassword($passwordEncoded);

            $roles[] = "ROLE_VISITEUR";
            $visiteur->setRoles($roles);
            
            $manager->persist($visiteur); //faire persiter dans le temps les infos du visiteur
            $manager->flush(); //enregistrer dans la bdd

             return $this->redirectToRoute('admin_lesVisiteurs');
        }
        return $this->render('admin/visiteur/creevisiteur.html.twig', ['formVisiteur' => $form->createView()
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
        return $this->render('admin/visiteur/infovisiteur.html.twig', [
            'visiteur' => $visiteur]);
    }

    /**
     * @Route("/creeProprio", name="creeproprio")
     * ajouter un nouveau proprietaire dans le bdd
     */
    public function creepro(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $proprio = new Proprietaire();
        $form = $this->createForm(ProprioType::class, $proprio); //créer un formulaire

         $form->handleRequest($request); //analyse les POST 

         dump($proprio);

         if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide

            $passwordEncoded = $encoder->encodePassword($proprio, $proprio->getPassword()); //permet d'encoder le mdp
            $proprio->setPassword($passwordEncoded); //modifie le mdp en mdp encoder
            
            $role[] = "ROLE_PROPRIO";
            $proprio->setRoles($role);
            $manager->persist($proprio); //faire persiter dans le temps les infos du proprietaire
            $manager->flush(); //enregistrer dans la bdd
              
             return $this->redirectToRoute('admin_lesProprios');
        }

        return $this->render('admin/proprio/creeproprio.html.twig', [
            'formProprio' => $form->createView()
        ]);
    }

    /**
     * @Route("/listeProprio", name="lesProprios")
     * Retourne une collection de propriétaire 
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
    public function getproprio(Proprietaire $proprio, AppartementRepository $appartementRepository){
        $cotisations = $appartementRepository->getcotisations($proprio->getIdpers());
        return $this->render('admin/proprio/infoproprio.html.twig', [
            'proprio' => $proprio,
            'cotisations' => $cotisations,
            
        ]);
    }
   
    /**
     * @Route("proprio/{id}", name="suppproprio", methods="DELETE")
     * @ParamConverter("proprio", options={"mapping": {"id" : "idpers" }} )
     * @Method("DELETE")
     */
    public function deleteProprio(Request $request, Proprietaire $proprio, EntityManagerInterface $manager){
        dump('supp');
        if ($this->isCsrfTokenValid('delete'.$proprio->getIdpers(), $request->get('_token'))){
            $manager->remove($proprio);
            $manager->flush();
            $this->addFlash('success', 'Le propriétaire a été supprimer avec succès');
        }
        return $this->redirectToRoute('admin_lesProprios');
        $this->addFlash('success', 'Le propriétaire a été supprimer avec succès');
    }

    /**
     * @Route("proprio/{id}/editproprio", name="editproprio")
     * @ParamConverter("proprio", options={"mapping": {"id" : "idpers" }} )
     */
    public function editpro(Proprietaire $proprio ,Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(ProprioType::class, $proprio); //créer un formulaire
        $form->handleRequest($request); //analyse les POST 

         if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide
            $passwordEncoded = $encoder->encodePassword($proprio, $proprio->getPassword()); //permet d'encoder le mdp
            $proprio->setPassword($passwordEncoded); //modifie le mdp en mdp encoder

             $manager->persist($proprio); //faire persiter dans le temps les infos du proprietaire
             $manager->flush(); //enregistrer dans la bdd
            
            return $this->redirectToRoute('admin_infoproprio', [ 'id' => $proprio->getIdpers()]);
        }
        return $this->render('admin/proprio/editproprio.html.twig', [
            'formProprio' => $form->createView()
        ]);
    }

    /**
     * @Route("/listeProprio/{id}/appart/{idAppart}", name="infoappart")
     * @ParamConverter("listeProprio", options={"mapping": {"id" : "idpers" }} )
     * @ParamConverter("appart", options={"mapping" : {"idAppart" : "idappart" }} )
     */
    public function getappartPro(Appartement $appart, LocataireRepository $repo, AppartementRepository $appartementRepository){
        $tarif = $appartementRepository->getloyercharge($appart->getIdappart());
        $loc = $repo->getloc($appart->getIdappart());
        return $this->render('admin/infoappart.html.twig', [
            'loc' => $loc,
            'appart' => $appart,
            'tarifs' => $tarif
        ]);
    }

    /**
     * @Route("appart/{id}", name="suppappart", methods="DELETE")
     * @Method("DELETE")
     */
    public function deleteAppart(Request $request, Appartement $appart, EntityManagerInterface $manager){
        //pour la sécurité, vérifier que le token soit valide
        if ($this->isCsrfTokenValid('delete'.$appart->getIdappart(), $request->get('_token'))){
            $manager->remove($appart);
            $manager->flush(); 

        }
        return $this->redirectToRoute('admin_infoproprio', ['id' => $appart->getProprietaire()->getIdpers()] );
    }


    /**
     * @Route("/appart/{idappart}/edit/{id}", name="edit_appart")
     * @ParamConverter("appart", options={"mapping" : {"idappart" : "idappart" }} )
     * @ParamConverter("edit", options={"mapping" : {"id" : "idpers" }} )
     */
    public function edit(Request $request, EntityManagerInterface $manager, Proprietaire $proprio, Appartement $appart){
        $form = $this->createFormBuilder($appart)
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
            $this->addFlash('success', 'Le bien a été modifié avec succès');
            return $this->redirectToRoute('admin_infoappart', ['id' => $proprio->getIdpers(), 'idAppart' => $appart->getIdappart()]);
        }

        return $this->render('admin/appart/edit.html.twig', [
            'formAppart' => $form->createView(), //afficher le formulaire 
            'proprio' => $proprio
        ]);
    }
    
    /**
     * @Route("/creeAppart/{id}", name="creeAppart")
     * @ParamConverter("creeAppart", options={"mapping" : {"id" : "idpers" }} )
     */
    public function creeAppart(Request $request, EntityManagerInterface $manager, Proprietaire $proprio){
        // $repository = $this->getDoctrine()->getRepository(Proprietaire::class);
        // $proprio = $repository->find($id);
        $appart = new Appartement();
        //$currentdate = new \DateTime('now');
        $form = $this->createFormBuilder($appart)
                     ->add('proprietaire', HiddenType::class, [
                        'empty_data' => $proprio
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
                     ->getForm();

        $form->handleRequest($request); //analyse les POST 

        dump($appart);

        if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide

            $currentdate = new \DateTime('now');
            $appart->setUpdatedAt($currentdate);
            $manager->persist($appart); //faire persiter dans le temps les infos du visiteur
            $manager->flush(); //enregistrer dans la bdd

            return $this->redirectToRoute('admin_infoproprio', ['id' => $proprio->getIdpers()]);
        }

        return $this->render('admin/appart/creeAppart.html.twig', [
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
        return $this->render('admin/locataire/listelocataire.html.twig', [
            'locs' => $loc
        ]);
    }

    /**
     * @Route("/listeloc/{id}", name="infoloc")
     * retourne les infomations d'un locataire
     */
    public function getloc(Locataire $loc){
        return $this->render('admin/locataire/infolocataire.html.twig', [
            'loc' => $loc
        ]);
    }

    /**
     * @Route("/addloc", name="creeloc")
     * ajouter un nouveau locataire dans le bdd
     */
    public function creeloc(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $loc = new Locataire();
        $form = $this->createForm(LocataireType::class, $loc); //créer un formulaire

         $form->handleRequest($request); //analyse les POST 

         if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide

            $passwordEncoded = $encoder->encodePassword($loc, $loc->getPassword()); //permet d'encoder le mdp
            $loc->setPassword($passwordEncoded); //modifie le mdp en mdp encoder
            
            $role[] = "ROLE_LOC";
            $loc->setRoles($role);
            $manager->persist($loc); //faire persiter dans le temps les infos du proprietaire
            $manager->flush(); //enregistrer dans la bdd
              
             return $this->redirectToRoute('admin_lesLocataires');
        }

        return $this->render('admin/locataire/addloc.html.twig', [
            'formLoc' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{idpers}", name="editloc")
     */
    public function editloc(Locataire $loc, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $form = $this->createForm(LocataireType::class, $loc); //créer un formulaire
        $form->handleRequest($request); //analyse les POST 

         if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide

            $passwordEncoded = $encoder->encodePassword($loc, $loc->getPassword()); //permet d'encoder le mdp
            $loc->setPassword($passwordEncoded); //modifie le mdp en mdp encoder
            
            $role[] = "ROLE_LOC";
            $loc->setRoles($role);
            $manager->persist($loc); //faire persiter dans le temps les infos du proprietaire
            $manager->flush(); //enregistrer dans la bdd
              
             return $this->redirectToRoute('admin_infoloc', [ 'id' => $loc->getIdpers()]);
        }

        return $this->render('admin/locataire/editloc.html.twig', [
            'formLoc' => $form->createView()
        ]);
    }    

    /**
     * @Route("loc/{id}", name="deleteloc", methods="DELETE")
     * @ParamConverter("loc", options={"mapping": {"id" : "idpers" }} )
     * @Method("DELETE")
     */
    public function deleteLoc(Request $request, Locataire $loc, EntityManagerInterface $manager){
        dump('supp');
        if ($this->isCsrfTokenValid('delete'.$loc->getIdpers(), $request->get('_token'))){
            $manager->remove($loc);
            $manager->flush();
            $this->addFlash('success', 'Le locataire a été supprimer avec succès');
        }
        return $this->redirectToRoute('admin_lesLocataires');
        $this->addFlash('success', 'Le locataire a été supprimer avec succès');
    }

}
