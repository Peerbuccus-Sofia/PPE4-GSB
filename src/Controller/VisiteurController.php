<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Visiteur;
use App\Form\DemandeType;
use App\Entity\Appartement;
use App\Entity\Visiter;
use App\Form\DemandeAppartType;
use App\Form\RechercheAppartType;
use App\Repository\DemandeRepository;
use App\Repository\VisiteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppartementRepository;
use App\Repository\LocataireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class VisiteurController extends AbstractController
{
    /**
     * @Route("/ficheappart/{idappart}", name="ficheappart")
     */
    public function getficheAppart(Appartement $unappart, AppartementRepository $repositoryAppart, LocataireRepository $repositoryLoc){
            $loc = $repositoryLoc->getloc($unappart->getIdappart());
            $tarif = $repositoryAppart->getloyercharge($unappart->getIdappart());
            dump($tarif);
            dump($unappart);
        return $this->render('visiteur/ficheappart.html.twig', [
            'unAppart' => $unappart,
            'tarifs' => $tarif,
            'loc' => $loc
        ]);        
    }

     /**
     * @Route("/ficheappart/{idappart}/visiter", name="visite")
     */
    public function visite(Request $request, EntityManagerInterface $manager ,Appartement $apparts)
    {
        $user = $this->getUser();

        $visite = new Visiter;
        $form = $this->createFormBuilder($visite)
                    ->add('datevisite')
                    ->add('idpers')
                    ->add('idappart')
                    ->getForm();

        $form->handleRequest($request); //analyse les POST 
        if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide
            $manager->persist($visite); //faire persiter dans le temps les infos du visiteur
            $manager->flush(); //enregistrer dans la bdd
            $this->addFlash('success', 'Votre demande de visite a bien été enregistrer');

            return $this->redirectToRoute('acceuil');
        }
            
        return $this->render('visiteur/visite.html.twig', [
            'formVisite' => $form,
            'user' => $user,
            'appart' =>$apparts
        ]);
    }

    /**
     *@Route("/rechercherAppart", name="rechercher")
     * filtre de recherche 
     */
    public function rechercherappart(Request $request, PaginatorInterface $paginator , EntityManagerInterface $manager, AppartementRepository $repo/*, Visiteur $visiteur*/)
        {
        $form= $this->createForm(DemandeAppartType::class); // formulaire permettant de faire une recherche d'appartement
        $form->handleRequest($request); //analyse les POST 
        
        $apparts=[];
        if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide
            $critere = $form->getData();
           // dd($critere);
            $apparts = $repo->rechercheappart($critere);
            $apparts = $paginator->paginate(
                $apparts, // on passe des données
                $request->query->getInt('page', 1),  //Numéro de la page en cours, 1 par défaut
                6
            );   
        }
        return $this->render('visiteur/rechercheappart.html.twig', [
            'demandeappart' => $form->createView(),
            'apparts' => $apparts
        ]);
    }

    /**
     * @Route("/demandeAppart", name="demandeAppart")
     */
public function getdemande(Request $request, EntityManagerInterface $manager)
    {       
        $demande = new Demande;
        $user = $this->getUser();
       //$form = $this->createForm(DemandeType::class, $demande);
       $form = $this->createFormBuilder($demande) //créer un formulaire
                    ->add('typedem', ChoiceType::class, [
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
                    ->add('datelimite')
                    ->add('ville', ChoiceType::class, [
                        'choices' => [
                            'Ville' => [
                                'Paris' => 'Paris',
                                'Montpellier' => 'Montpellier',
                                'Nice' => 'Nice',
                                'Lille' => 'Lille',
                                'Lyon' => 'Lyon',
                                'Marseille' => 'Marseille'
                            ],
                           ],
                    ])
                    ->add('prix')
                    ->add('visiteur', HiddenType::class, [
                        'empty_data' => $user      
                    ])
                    ->add('Envoyer ma demande', SubmitType::class)
                    ->getForm();
                    dump($user);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){ //si form est soumis et que les champs sont valide 
             $data = $form->getData();
            dump($data); 
           // dump($demande);
            $manager->persist($demande); //faire persiter dans le temps les infos de la demande
            $manager->flush(); //enregistrer dans la bdd
            $this->addFlash('success', 'Votre demande a bien été enregistrer, vous recevrez une réponse dans un délai de 7 jours ');
            return $this->redirectToRoute('accueil');
       
        }
        return $this->render('visiteur/demande.html.twig', [
            'form' => $form->createView(),
             'user' => $user 
        ]);
    }

   

}
