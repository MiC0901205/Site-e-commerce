<?php

class Commande {
    // Properties
    private $idCommande;
    private $date;
    private $idUser;


    // SETTER AND GETTER idCommande
    public function setIdCmd($idCommande) {
        $this->idCommande = $idCommande;
    }
    public function getIdCmd() {
        return $this->idCommande;
    }

    // SETTER AND GETTER nom
    public function setDate($date) {
        $this->date = $date;
    }
    public function getDate() {
        return $this->date;
    }

    // SETTER AND GETTER prenom
    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }
    public function getIdUser() {
        return $this->idUser;
    }

}