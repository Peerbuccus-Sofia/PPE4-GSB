<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Visiteur
 *
 * @ORM\Table(name="visiteur")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 * @UniqueEntity(
 * fields = {"username"},
 * message = "Le nom d'utilisateur que vous avez choisi existe déjà"
 * )
 */

class Visiteur implements UserInterface
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
     * @var string
     * @ORM\Column(name="ADR", type="string", length=255, nullable=true, options={"default"="NULL","fixed"=true})
     * @Assert\NotBlank
     */
    private $adr;

    /**
     * @var string
     * @ORM\Column(name="VILLE", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     * @Assert\NotBlank
     */

    private $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="CP",type="integer", length=5,  nullable=true, options={"default"="NULL","fixed"=true})
     * @Assert\NotBlank
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM",type="string", length=32,  nullable=true, options={"default"="NULL","fixed"=true})
     * @Assert\NotBlank
     * 
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRENOM", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     * @Assert\NotBlank
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TEL", type="string", length=10, nullable=true, options={"default"="NULL","fixed"=true})
     * @Assert\NotBlank
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USERNAME", type="string", length=255, nullable=true, options={"fixed"=true})
     * @Assert\NotBlank
     * 
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PASSWORD", type="string", length=255, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $password;

    /**
     *  @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas taper le même mot de passe")
     */
    public $confirm_password;

    /**
     * @var string|null
     * @ORM\Column(name="ROLE", type="json", length=32, options={"default"="ROLE_VISITEUR","fixed"=true})
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Demande", mappedBy="visiteur")
     */
    private $demandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visite", mappedBy="visiteurs", orphanRemoval=true)
     */
    private $lesvisites;
    
    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->lesvisites = new ArrayCollection();   
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
    { }

    public function getSalt(){}


    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[]="ROLE_VISITEUR";

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {   
        $this->roles = $roles;
        return $this;
    }

     /**
      * @return Collection|Demande[]
      */
      public function getDemandes(): Collection
      {
           return $this->demandes;
      }
      
      public function addDemande(Demande $demande): self
      {
          if(!$this->demandes->contains($demande)){
              $this->demandes[] = $demande;
              $demande->setVisiteur($this);
          }
          return $this;
      }
  
      public function removeDemande(Demande $demande): self //supprimer demande
      {
          if($this->demandes->contains($demande)){
              $this->demandes->removeElement($demande);
              if($demande->getVisiteur() === $this ){
                  $demande->setVisiteur(null);
              }
          }
          return $this;
      }

      /**
       * @return Collection|Visite[]
       */
      public function getLesvisites(): Collection
      {
          return $this->lesvisites;
      }

      public function addLesvisite(Visite $lesvisite): self
      {
          if (!$this->lesvisites->contains($lesvisite)) {
              $this->lesvisites[] = $lesvisite;
              $lesvisite->setVisiteurs($this);
          }

          return $this;
      }

      public function removeLesvisite(Visite $lesvisite): self
      {
          if ($this->lesvisites->contains($lesvisite)) {
              $this->lesvisites->removeElement($lesvisite);
              // set the owning side to null (unless already changed)
              if ($lesvisite->getVisiteurs() === $this) {
                  $lesvisite->setVisiteurs(null);
              }
          }

          return $this;
      }


    //   /**
    //   * @return Collection|Visite[]
    //   */
    //   public function getVisites(): Collection
    //   {
    //        return $this->visites;
    //   }
      
    //   public function addVisite(Visiter $visite): self
    //   {
    //       if(!$this->visites->contains($visite)){
    //           $this->visites[] = $visite;
    //           $visite->setvisiteur($this);
    //       }
    //       return $this;
    //   }
  
    //   public function removeVisite(Visiter $visite): self //supprimer une visite
    //   {
    //       if($this->visites->contains($visite)){
    //           $this->visites->removeElement($visite);
    //           if($visite->getVisiteur() === $this ){
    //               $visite->setVisiteur(null);
    //           }
    //       }
    //       return $this;
    //   }
}
