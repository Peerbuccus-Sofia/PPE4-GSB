<?php

namespace App\DataFixtures;

use App\Entity\Proprietaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProprioFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i< 10; $i++){
            $proprio = new Proprietaire();
            $proprio->setNom("Nom$i")
                     ->setPrenom("Prenom")
                     ->setAdr("$i rue du balais")
                     ->setVille("Ville n°$i")
                     ->setCp("7500$i")
                     ->setTel("099999999$i")
                     ->setLogin("Log$i")
                     ->setMdp("blabla");       
            $manager->persist($proprio);      
        }

        $manager->flush();
    }
}
