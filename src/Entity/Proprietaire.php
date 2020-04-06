<?php

namespace App\Entity;

use App\Entity\Appartement;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Proprietaire
 *
 * @ORM\Table(name="proprietaire")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ProprietaireRepository")
 * @UniqueEntity(
 * fields = {"username"},
 * message = "Le nom d'utilisateur que vous avez choisi existe déjà"
 * )
 */
class Proprietaire implements UserInterface
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
     * @var string|null
     *
     * @ORM\Column(name="ADR", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $adr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="VILLE", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CP", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $cp;

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
     * @ORM\Column(name="ROLE", type="json", length=32, nullable=true, options={"default"="ROLE_VISITEUR","fixed"=true})
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appartement", mappedBy="proprietaire")
     */
    private $apparts;
    
    public function __construct()
    {
        $this->apparts = new ArrayCollection();   
    }

    public function getIdpers(): ?int
    {
        return $this->idpers;
    }

    public function getAdr(): ?string
    {
        return $this->adr;
    }

    public function setAdr(?string $adr): self
    {
        $this->adr = $adr;

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

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

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
    {
        
    }

    public function getSalt(){}


    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[]="ROLE_PROPRIO";

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {   
        $this->roles = $roles;
        return $this;
    }

     /**
      * @return Collection|Apparts[]
      */
    public function getApparts(): Collection
    {
         return $this->apparts;
    }
    
    public function addAppart(Appartement $appart): self
    {
        if(!$this->apparts->contains($appart)){
            $this->apparts[] = $appart;
            $appart->setProprietaire($this);
        }
        return $this;
    }

    public function removeAppart(Appartement $appart): self //supprimer appart
    {
        if($this->apparts->contains($appart)){
            $this->apparts->removeElement($appart);
            if($appart->getProprietaire() === $this ){
                $appart->setProprietaire(null);
            }
        }
        return $this;
    }


}
