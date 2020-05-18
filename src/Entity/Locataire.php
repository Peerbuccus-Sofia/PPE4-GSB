<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Locataire
 *
 * @ORM\Table(name="locataire", indexes={@ORM\Index(name="I_FK_LOCATAIRE_APPARTEMENT", columns={"APPARTEMENT_ID"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\LocataireRepository")
 * @UniqueEntity( fields = {"username"} )
 */
class Locataire implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDPERS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Appartement" , inversedBy="locataires")
     * @ORM\JoinColumn(nullable=false, name="APPARTEMENT_ID", referencedColumnName="IDAPPART") 
     */
    private $appartement;

    /**
     * @ORM\Column(name="DATENAISSANCE", type="datetime")
     */
    private $datenaissance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RIB", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $rib;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TELBANQUE", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $telbanque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOM", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRENOM", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TEL", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USERNAME", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PASSWORD", type="string", length=255, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $password;

    /**
     * @var string|null
     * @ORM\Column(name="ROLE", type="json", length=32, nullable=true, options={"default"="ROLE_LOC","fixed"=true})
     */
    private $roles;

    public function getIdpers(): ?int
    {
        return $this->idpers;
    }

    public function getAppartement()
    {
        return $this->appartement;
    }

    public function setAppartement($appartement): self
    {
        $this->appartement = $appartement;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return (string) $this->getAppartement();
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(?\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getRib(): ?string
    {
        return $this->rib;
    }

    public function setRib(?string $rib): self
    {
        $this->rib = $rib;

        return $this;
    }

    public function getTelbanque(): ?string
    {
        return $this->telbanque;
    }

    public function setTelbanque(?string $telbanque): self
    {
        $this->telbanque = $telbanque;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {}    

    
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[]= "ROLE_LOC";

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {   
        $this->roles = $roles;
        return $this;
    }

    public function getSalt(){}


}
