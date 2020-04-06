<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="visite", indexes={@ORM\Index(name="FK_B09C8CBB3217A767", columns={"APPARTEMENT_ID"}), @ORM\Index(name="FK_B09C8CBBCA3CE735", columns={"VISITEUR_ID"})})
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="IDVISITE", type="integer", nullable=false)
     */
    private $idvisite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur", inversedBy="lesvisites")
     * @ORM\JoinColumn(nullable=false, name="VISITEUR_ID", referencedColumnName="IDPERS")
     */
    private $visiteurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Appartement", inversedBy="lesvisites")
     * @ORM\JoinColumn(nullable=false, name="APPARTEMENT_ID", referencedColumnName="IDAPPART")
     */
    private $appartement;

    /**
     * @ORM\Column(type="datetime", name="datevisite")
     */
    private $datevisite;

    public function getIdVisite(): ?int
    {
        return $this->idvisite;
    }

    public function getVisiteurs(): ?Visiteur
    {
        return $this->visiteurs;
    }

    public function setVisiteurs(?Visiteur $visiteurs): self
    {
        $this->visiteurs = $visiteurs;

        return $this;
    }

    public function getAppartement(): ?Appartement
    {
        return $this->appartement;
    }

    public function setAppartement(?Appartement $appartement): self
    {
        $this->appartement = $appartement;

        return $this;
    }

    public function getDatevisite(): ?\DateTimeInterface
    {
        return $this->datevisite;
    }

    public function setDatevisite(\DateTimeInterface $datevisite): self
    {
        $this->datevisite = $datevisite;

        return $this;
    }
}
