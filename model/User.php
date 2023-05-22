<?php

class User {
    // Properties
    private $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $adresse_mail;
    private $confirm_mail;
    private $cle;
    private $ville;
    private $cp;
    private $tel;
    private $mdp;
    private $role;

    // SETTER AND GETTER idUser
    public function setId($idUser) {
        $this->id = $idUser;
    }
    public function getId() {
        return $this->id;
    }

    // SETTER AND GETTER nom
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function getNom() {
        return $this->nom;
    }

    // SETTER AND GETTER prenom
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    public function getPrenom() {
        return $this->prenom;
    }

    // SETTER AND GETTER adresse
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
    public function getAdresse() {
        return $this->adresse;
    }

    // SETTER AND GETTER adresseMail
    public function setAdresseMail($adresse_mail) {
        $this->adresse_mail = $adresse_mail;
    }
    public function getAdresseMail() {
        return $this->adresse_mail;
    }
    
    // SETTER AND GETTER adresseMail
    public function setConfirmMail($confirm_mail) {
        $this->confirm_mail = $confirm_mail;
    }
    public function getConfirmMail() {
        return $this->confirm_mail;
    }

    // SETTER AND GETTER cle
    public function setCle($cle) {
        $this->cle = $cle;
    }
    public function getCle() {
        return $this->cle;
    }

    // SETTER AND GETTER ville
    public function setVille($ville) {
        $this->ville = $ville;
    }
    public function getVille() {
        return $this->ville;
    }
    
    // SETTER AND GETTER cp
    public function setCp($cp) {
        $this->cp = $cp;
    }
    public function getCp() {
        return $this->cp;
    }
    
    // SETTER AND GETTER tel
    public function setTel($tel) {
        $this->tel = $tel;
    }
    public function getTel() {
        return $this->tel;
    }

    // SETTER AND GETTER mdp
    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }
    public function getMdp() {
        return $this->mdp;
    }

    // SETTER AND GETTER role
    public function setRole($role) {
        $this->role = $role;
    }
    public function getRole() {
        return $this->role;
    }

}