<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="visite", indexes={@ORM\Index(name="I_FK_VISITE_APPARTEMENT", columns={"IDAPPART"}), @ORM\Index(name="I_FK_VISITE_VISITEUR", columns={"IDPERS"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur", inversedBy="lesvisites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visiteurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Appartement", inversedBy="lesvisites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appartement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datevisite;

    public function getId(): ?int
    {
        return $this->id;
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
