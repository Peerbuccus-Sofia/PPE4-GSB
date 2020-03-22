<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concerner
 *
 * @ORM\Table(name="concerner", indexes={@ORM\Index(name="I_FK_CONCERNER_ARRONDISSEMENT", columns={"ARRONDI_DEM"}), @ORM\Index(name="I_FK_CONCERNER_DEMANDE", columns={"IDDEMANDE"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ConcernerRepository")
 */
class Concerner
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDDEMANDE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $iddemande;

    /**
     * @var int
     *
     * @ORM\Column(name="ARRONDI_DEM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $arrondiDem;

    public function getIddemande(): ?int
    {
        return $this->iddemande;
    }

    public function getArrondiDem(): ?int
    {
        return $this->arrondiDem;
    }


}
