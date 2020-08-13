<?php

namespace App\Entity;


class UserSearch{


    /**
    * @var string|null
    */
    private $nom;


    /**
    * @var string|null
    */
    private $prenom;




    /**
     * Get the value of nom
     *
     * @return  string|null
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  string|null  $nom
     *
     * @return  self
     */ 
    public function setNom($nom): UserSearch
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return  string|null
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param  string|null  $prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom): UserSearch
    {
        $this->prenom = $prenom;

        return $this;
    }
}