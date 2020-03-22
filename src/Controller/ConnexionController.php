<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Form\InscriptionVisiteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


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
            $hash = $encoder->encodePassword($visiteur, $visiteur->getPassword());

            $visiteur->setPassword($hash);

            $manager->persist($visiteur); // faire persister dans le temps le visiteur
            $manager->flush(); //enregistre dans la bdd

            return $this->redirectToRoute('connexion');
        }
        return$this->render('connexion/inscriptionVisiteur.html.twig',[
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
    
}
