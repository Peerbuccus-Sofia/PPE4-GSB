<?php

namespace App\Entity;

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
     * @var int
     *
     * @ORM\Column(name="IDPERS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idpers;

    /**
     * @var int
     *
     * @ORM\Column(name="IDAPPART", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idappart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DATEVISITE", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $datevisite = 'NULL';

    public function getIdpers(): ?int
    {
        return $this->idpers;
    }

    public function getIdappart(): ?int
    {
        return $this->idappart;
    }

    public function getDatevisite(): ?string
    {
        return $this->datevisite;
    }

    public function setDatevisite(?string $datevisite): self
    {
        $this->datevisite = $datevisite;

        return $this;
    }


}
