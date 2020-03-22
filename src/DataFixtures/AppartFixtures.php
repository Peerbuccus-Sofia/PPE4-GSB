<?php

namespace App\DataFixtures;

use App\Entity\Appartement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppartFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i< 9; $i++){
            $appart = new Appartement();
            $appart->setIdpers($i)
                   ->setAdr("efghjk")
                   ->setVille("edfh")
                   ->setCp("12035")
                   ->setEtage(null)
                   ->setTypeappart("fgh")
                   ->setLoyer("1250")
                   ->setCharge("250")
                   ->setAscenseur(TRUE)
                   ->setPreavis(TRUE)
                   ->setDatelibre(NULL)
                   ->setTauxcotisation("10%")
                   ->setTaille("25");

            $manager->persist($appart);      
        }
        $manager->flush();
    }
}
