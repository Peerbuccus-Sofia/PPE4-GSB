<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Entity\Recherches;
use App\Form\RechercheAppType;
use App\Form\InscriptionVisiteurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppartementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ConnexionController extends AbstractController
{
    /**
     * @Route("/inscriptionVisiteur", name="inscriptionVisiteur")
     */
    public function inscriptionVisiteur(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $visiteur = new Visiteur();
        $form = $this->createForm(InscriptionVisiteurType::class, $visiteur);
        $form->handleRequest($request); // le formulaire analyse la request passé en parametre 

        if($form->isSubmitted() && $form->isValid()){ // si le formulaire est soumis et que les champs sont valide

            $roles[] = "ROLE_VISITEUR";
            $visiteur->setRoles($roles);
            
            $hash = $encoder->encodePassword($visiteur, $visiteur->getPassword());
            $visiteur->setPassword($hash);
            
            $manager->persist($visiteur); // faire persister dans le temps le visiteur
            $manager->flush(); //enregistre dans la bdd

            return $this->redirectToRoute('app_login');
        }
        return$this->render('connexion/inscription/inscriptionVisiteur.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('test');
    }

    /**
     * @Route("/connexion", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // dernir nom d'utilisateur rentrer par le user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/", name="accueil")
     * @param AppartementRepository $repository
     * retourne tous les appartements disponible
     */
    public function index(Request $request, PaginatorInterface $paginator ,AppartementRepository $repository, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $visiteur = new Visiteur();
        $form = $this->createForm(InscriptionVisiteurType::class, $visiteur);
        $form->handleRequest($request); // le formulaire analyse la request passé en parametre 

        if($form->isSubmitted() && $form->isValid()){ // si le formulaire est soumis et que les champs sont valide
            $hash = $encoder->encodePassword($visiteur, $visiteur->getPassword());
            $visiteur->setPassword($hash);

            $manager->persist($visiteur); // faire persister dans le temps le visiteur
            $manager->flush(); //enregistre dans la bdd

            return $this->redirectToRoute('app_login');
        }

        //filtre de recherche
        // $recherche = new Recherches();
        // $formrecherche = $this->createForm(RechercheAppType::class, $recherche);
        // $formrecherche->handleRequest($request);

        //pagination
        $apparts = $paginator->paginate(
            $repository->getAppartAlouer(),
            $request->query->getInt('page', 1),  //Numéro de la page en cours, 1 par défaut
            6
        );
        $user = $this->getUser();
        // dd($user);
        return $this->render('connexion/index.html.twig', [
            'form' => $form->createView(),
            'apparts' => $apparts,
            'user' => $user,
            // 'formR' => $formrecherche->createView()
        ]);
    }

    
}
