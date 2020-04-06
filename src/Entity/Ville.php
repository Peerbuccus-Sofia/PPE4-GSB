<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appartement", mappedBy="villes")
     */
    private $nomVille;

    public function setNomville($nomVille)
    {
        $this->nomVille = $nomVille;
        return $this;
    }

    public function __construct()
    {
        $this->nomVille = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    // /**
    //  * @return Collection|Appartement[]
    //  */
    // public function getNomVille(): Collection
    // {
    //     return $this->nomVille;
    // }

    // public function addNomVille(Appartement $nomVille): self
    // {
    //     if (!$this->nomVille->contains($nomVille)) {
    //         $this->nomVille[] = $nomVille;
    //         $nomVille->setVilles($this);
    //     }

    //     return $this;
    // }

    // public function removeNomVille(Appartement $nomVille): self
    // {
    //     if ($this->nomVille->contains($nomVille)) {
    //         $this->nomVille->removeElement($nomVille);
    //         // set the owning side to null (unless already changed)
    //         if ($nomVille->getVilles() === $this) {
    //             $nomVille->setVilles(null);
    //         }
    //     }

    //     return $this;
    // }
}
