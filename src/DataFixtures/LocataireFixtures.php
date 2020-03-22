<?php

namespace App\DataFixtures;

use App\Entity\Locataire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LocataireFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i< 9; $i++){
            $proprio = new Locataire();
            $proprio->setNom("NomLocataire$i")
                     ->setPrenom("PrenomLocataire")
                     ->setTel("099999999$i")
                     ->setLogin("Log$i")
                     ->setMdp("blabla")
                     ->setDatenaissance(NULL)
                     ->setRib("00000000000000$i")
                     ->setTelbanque("0845147455")
                     ->setIdappart("$i");
            $manager->persist($proprio);      
        }

        $manager->flush();
    }
}
