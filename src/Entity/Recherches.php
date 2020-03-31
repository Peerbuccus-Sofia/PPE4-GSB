<?php

namespace App\Entity;


class Recherches
{
    /**
     * @var int|null
     */
    private $minprix;

    /**
     * @var int|null
     */
    private $maxprix;

    /**
     * @var string|nul
     */
    private $ville;

    /**
     * @var int|null
     */
    private $taille;
    
    /**
     * @var string|nul
     */
    private $typeappart;
    

   
    /**
     * Get the value of minprix
     *
     * @return  int|null
     */ 
    public function getMinprix()
    {
        return $this->minprix;
    }

    /**
     * Set the value of minprix
     *
     * @param  int|null  $minprix
     *
     * @return  self
     */ 
    public function setMinprix($minprix)
    {
        $this->minprix = $minprix;

        return $this;
    }

    /**
     * Get the value of maxprix
     *
     * @return  int|null
     */ 
    public function getMaxprix()
    {
        return $this->maxprix;
    }

    /**
     * Set the value of maxprix
     *
     * @param  int|null  $maxprix
     *
     * @return  self
     */ 
    public function setMaxprix($maxprix)
    {
        $this->maxprix = $maxprix;

        return $this;
    }

     /**
     * Get the value of ville
     *
     * @return  string|nul
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @param  string|nul  $ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    

    /**
     * Get the value of taille
     *
     * @return  int|null
     */ 
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set the value of taille
     *
     * @param  int|null  $taille
     *
     * @return  self
     */ 
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get the value of typeappart
     *
     * @return  string|nul
     */ 
    public function getTypeappart()
    {
        return $this->typeappart;
    }

    /**
     * Set the value of typeappart
     *
     * @param  string|nul  $typeappart
     *
     * @return  self
     */ 
    public function setTypeappart($typeappart)
    {
        $this->typeappart = $typeappart;

        return $this;
    }
}
