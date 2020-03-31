<?php

namespace App\Entity;

use App\Entity\Visiter;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Appartement
 *
 * @ORM\Table(name="appartement", indexes={@ORM\Index(name="I_FK_APPARTEMENT_PROPRIETAIRE", columns={"PROPRIETAIRE_ID"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\AppartementRepository")
 * @Vich\Uploadable()
 */
class Appartement
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDAPPART", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idappart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ADR", type="string", length=255, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $adr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="VILLE", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $ville;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CP", type="smallint", nullable=true, options={"default"="NULL"})
     */
    private $cp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ETAGE", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $etage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TYPEAPPART", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $typeappart;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LOYER", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $loyer;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CHARGE", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $charge;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ASCENSEUR", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $ascenseur;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="PREAVIS", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $preavis;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATELIBRE", type="date", nullable=true, options={"default"="NULL"})
     */
    private $datelibre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TAUXCOTISATION", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $tauxcotisation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TAILLE", type="string", length=32, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $taille;


    /**
     * @var string|null
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    
    /**
     * @var File|null
     * Vich\UploadableField(mapping="appart_image", fileNameProperty="filename")
     */
    private $imageFile;
    
    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Proprietaire", inversedBy="apparts")
     * @ORM\JoinColumn(nullable=false, name="PROPRIETAIRE_ID", referencedColumnName="IDPERS") 
     */
    private $proprietaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Locataire", mappedBy="appartement")
     */
    private $locataires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visite", mappedBy="appartement", orphanRemoval=true)
     */
    private $lesvisites;

    // /**
    //  * @ORM\OneToMany(targetEntity="App\Entity\Visiter", mappedBy="appartement")
    //  */
    // private $visites;

   
    public function __construct()
    {
        $this->locataires = new ArrayCollection();
        $this->lesvisites = new ArrayCollection(); 
       // $this->visites = new ArrayCollection();  
    }
   

    public function getIdappart(): ?int
    {
        return $this->idappart;
    }

     /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return (string) $this->getIdappart();
    }

    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    public function setProprietaire($proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
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

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(?int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getEtage(): ?string
    {
        return $this->etage;
    }

    public function setEtage(?string $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getTypeappart(): ?string
    {
        return $this->typeappart;
    }

    public function setTypeappart(?string $typeappart): self
    {
        $this->typeappart = $typeappart;

        return $this;
    }

    public function getLoyer(): ?string
    {
        return $this->loyer;
    }

    public function setLoyer(?string $loyer): self
    {
        $this->loyer = $loyer;

        return $this;
    }

    public function getCharge(): ?string
    {
        return $this->charge;
    }

    public function setCharge(?string $charge): self
    {
        $this->charge = $charge;

        return $this;
    }

    public function getAscenseur(): ?bool
    {
        return $this->ascenseur;
    }

    public function setAscenseur(?bool $ascenseur): self
    {
        $this->ascenseur = $ascenseur;

        return $this;
    }

    public function getPreavis(): ?bool
    {
        return $this->preavis;
    }

    public function setPreavis(?bool $preavis): self
    {
        $this->preavis = $preavis;

        return $this;
    }

    public function getDatelibre(): ?\DateTimeInterface
    {
        return $this->datelibre;
    }

    public function setDatelibre(?\DateTimeInterface $datelibre): self
    {
        $this->datelibre = $datelibre;

        return $this;
    }

    public function getTauxcotisation(): ?string
    {
        return $this->tauxcotisation;
    }

    public function setTauxcotisation(?string $tauxcotisation): self
    {
        $this->tauxcotisation = $tauxcotisation;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): Appartement
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Appartement
     */
    public function setImageFile(?File $imagefile): Appartement
    {
        $this->imageFile = $imagefile;
        if ($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


     /**
      * @return Collection|Locataires[]
      */
      public function getLocataires(): Collection
      {
           return $this->locataires;
      }
      
      public function addLocataire(Locataire $locataire): self
      {
          if(!$this->locataires->contains($locataire)){
              $this->locataires[] = $locataire;
              $locataire->setAppartement($this);
          }
          return $this;
      }
  
      public function removeLocataire(Locataire $locataire): self //supprimer locataire
      {
          if($this->locataires->contains($locataire)){
              $this->locataires->removeElement($locataire);
              if($locataire->getAppartement() === $this ){
                  $locataire->setAppartement(null);
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
              $lesvisite->setAppartement($this);
          }

          return $this;
      }

      public function removeLesvisite(Visite $lesvisite): self
      {
          if ($this->lesvisites->contains($lesvisite)) {
              $this->lesvisites->removeElement($lesvisite);
              // set the owning side to null (unless already changed)
              if ($lesvisite->getAppartement() === $this) {
                  $lesvisite->setAppartement(null);
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
    //           $visite->setAppartement($this);
    //       }
    //       return $this;
    //   }
  
    //   public function removeVisite(Visiter $visite): self //supprimer une visite
    //   {
    //       if($this->visites->contains($visite)){
    //           $this->visites->removeElement($visite);
    //           if($visite->getAppartement() === $this ){
    //               $visite->setAppartement(null);
    //           }
    //       }
    //       return $this;
    //   }

}
