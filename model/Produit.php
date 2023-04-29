<?php

class Produit {
    // Properties
    private $idProduit;
    private $Nom;
    private $Prix;
    private $Couleur;
    private $Image;
    private $Largeur;
    private $Longueur;
    private $Hauteur;
    private $Poids;
    private $description;
    private $qteStock;
    private $seuilAlert;
    private $idType;

    // SETTER AND GETTER idClient
    public function setId($idProduit) {
        $this->idProduit = $idProduit;
    }
    public function getId() {
        return $this->idProduit;
    }

    // SETTER AND GETTER nom
    public function setNom($Nom) {
        $this->Nom = $Nom;
    }
    public function getNom() {
        return $this->Nom;
    }

    // SETTER AND GETTER prenom
    public function setPrix($Prix) {
        $this->Prix = $Prix;
    }
    public function getPrix() {
        return $this->Prix;
    }

    // SETTER AND GETTER prenom
    public function setCouleur($Couleur) {
        $this->Couleur = $Couleur;
    }
    public function getCouleur() {
        return $this->Couleur;
    }

    // SETTER AND GETTER adresse
    public function setImage($Image) {
        $this->Image = $Image;
    }
    public function getImage() {
        return $this->Image;
    }

    // SETTER AND GETTER Largeur
    public function setLargeur($Largeur) {
        $this->Largeur = $Largeur;
    }
    public function getLargeur() {
        return $this->Largeur;
    }
    
    // SETTER AND GETTER Longueur
    public function setLongueur($Longueur) {
        $this->Longueur = $Longueur;
    }
    public function getLongueur() {
        return $this->Longueur;
    }
    
    // SETTER AND GETTER Hauteur
    public function setHauteur($Hauteur) {
        $this->Hauteur = $Hauteur;
    }
    public function getHauteur() {
        return $this->Hauteur;
    }
    
    // SETTER AND GETTER Poids
    public function setPoids($Poids) {
        $this->Poids = $Poids;
    }
    public function getPoids() {
        return $this->Poids;
    }
    
    // SETTER AND GETTER description
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }
    
    // SETTER AND GETTER qteStock
    public function setQteStock($qteStock) {
        $this->qteStock = $qteStock;
    }
    public function getQteStock() {
        return $this->qteStock;
    }
    
    // SETTER AND GETTER seuilAlert
    public function setSeuilAlert($seuilAlert) {
        $this->seuilAlert = $seuilAlert;
    }
    public function getSeuilAlert() {
        return $this->seuilAlert;
    }
    
    // SETTER AND GETTER idType
    public function setIdType($idType) {
        $this->idType = $idType;
    }
    public function getIdType() {
        return $this->idType;
    }

}