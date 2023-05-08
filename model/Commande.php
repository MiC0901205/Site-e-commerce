<?php

class Commande {
    // Properties
    private $idCommande;
    private $date;
    private $idClient;


    // SETTER AND GETTER idClient
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
    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }
    public function getIdClient() {
        return $this->idClient;
    }

}