<?php

namespace App\Entity;

use App\Entity\Visiteur;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use DateTimeInterface;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="I_FK_DEMANDE_VISITEUR", columns={"VISITEUR_ID"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDDEMANDE", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddemande;

   

    /**
     * @var string|null
     *
     * @ORM\Column(name="TYPEDEM", type="string", length=32)
     */
    private $typedem;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATELIMITE", type="date")
     */
    private $datelimite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="VILLE", type="string", length=32)
     */
    private $ville;

    /**
     * @var int|null
     *
     * @ORM\Column(name="prix", type="integer", length=5)
     */
    private $prix;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur" , inversedBy="demandes")
     * @ORM\JoinColumn(nullable=false, name="VISITEUR_ID", referencedColumnName="IDPERS") 
     */
    private $visiteur;

    public function getIddemande(): ?int
    {
        return $this->iddemande;
    }

    public function getVisiteur()
    {
        return $this->visiteur;
    }

    public function setVisiteur($visiteur): self
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    public function getTypedem(): ?string
    {
        return $this->typedem;
    }

    public function setTypedem(?string $typedem): self
    {
        $this->typedem = $typedem;

        return $this;
    }

    public function getDatelimite(): ?\DateTimeInterface
    {
        return $this->datelimite;
    }

    public function setDatelimite(?\DateTimeInterface $datelimite): self
    {
        $this->datelimite = $datelimite;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


}
