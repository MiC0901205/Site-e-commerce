<?php

class Type {
    // Properties
    private $idType;
    private $libelle;

    // SETTER AND GETTER idType
    public function setId($idType) {
        $this->idType = $idType;
    }
    public function getId() {
        return $this->idType;
    }

    // SETTER AND GETTER libelle
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    public function getLibelle() {
        return $this->libelle;
    }
}