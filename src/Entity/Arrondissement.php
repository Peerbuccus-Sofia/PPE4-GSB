<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arrondissement
 *
 * @ORM\Table(name="arrondissement")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ArrondissementRepository")
 */
class Arrondissement
{
    /**
     * @var int
     *
     * @ORM\Column(name="ARRONDI_DEM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $arrondiDem;

    public function getArrondiDem(): ?int
    {
        return $this->arrondiDem;
    }


}
