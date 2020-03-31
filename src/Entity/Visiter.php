<?php

namespace App\Entity;

use App\Entity\Visiteur;
use App\Entity\Appartement;
use Doctrine\ORM\Mapping as ORM;

/**
 * Visiter
 *
 * @ORM\Table(name="visiter", indexes={@ORM\Index(name="I_FK_VISITER_APPARTEMENT", columns={"IDAPPART"}), @ORM\Index(name="I_FK_VISITER_VISITEUR", columns={"IDPERS"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\VisiterRepository")
 */
class Visiter
{

    /**
     * @var \Visiteur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur", inversedBy="visites")
     * @ORM\JoinColumn(nullable=false, name="IDPERS", referencedColumnName="IDPERS") 
     */
    private $idpers;

    /**
     * 
     * 0@var \Appartement
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="App\Entity\Appartement", inversedBy="visites", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, name="IDAPPART", referencedColumnName="IDAPPART") 
     */
    private $idappart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DATEVISITE", type="datetime", nullable=true)
     */
    private $datevisite;

    public function getVisiteur()
    {
        return $this->idpers;
    }
    public function setVisiteur($visiteur): self
    {
        $this->idpers = $visiteur;

        return $this;
    }

    public function getAppartement()
    {
        return $this->idappart;
    }

    public function setAppartement($appartement) : self
    {
        $this->idappart = $appartement;

        return $this;
    }

    public function getDatevisite(): ?\DateTimeInterface
    {
        return $this->datevisite;
    }

    public function setDatevisite(?\DateTimeInterface $datevisite): self
    {
        $this->datevisite = $datevisite;

        return $this;
    }
}
