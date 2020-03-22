<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 * @UniqueEntity(
 * fields = {"username"},
 * message = "Le nom d'utilisateur que vous avez choisi existe déjà"
 * )
 */
class Admin implements UserInterface
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
     * 
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PASSWORD", type="string", length=255)
     */
    private $plainPassword;

    /**
     * @var string|null
     * @ORM\Column(name="ROLE", type="json", length=32, nullable=true, options={"default"="ROLE_ADMIN","fixed"=true})
     */
    private $roles;

    public function getIdpers(): ?int
    {
        return $this->idpers;
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
        return $this->plainPassword;
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
        $roles[]= "ROLE_ADMIN";

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {   
        $this->roles = $roles;
        return $this;
    }

    public function getSalt(){}

    public function getRole(){
        return $this->role;
    }

    // public function getRoles(){
    //     return ['ROLE_ADMIN'];
    // }

    // public function setRoles(){

    // }

}
