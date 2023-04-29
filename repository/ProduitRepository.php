<?php

require_once('./model/login_db.php');
require_once('./model/Produit.php');

class ProduitRepository {

    public static function selectBatterieByType($type) {
        $db = loginDB();

        // écrire la requête sql de sélection des produits 
        $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE c.valeurCateg LIKE ?'); 
        $listeProduct->execute(array($type));

        // ferme la connexion
        $db = null;

        return $listeProduct;
    }

    public static function selectProduitByCapacite($min, $max) {
        $db = loginDB();

        // écrire la requête sql de sélection des produits 
        $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Capacite, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE Capacite > ? AND Capacite <= ?'); 
        $listeProduct->execute(array($min, $max));

        $db = null;

        return $listeProduct;
    }

    public static function selectProduitByTaille($min, $max) {
        $db = loginDB();

        // écrire la requête sql de sélection des produits 
        $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit  WHERE Largeur * Longueur * Hauteur > ? AND  Largeur * Longueur * Hauteur <= ?'); 
        $listeProduct->execute(array($min, $max));

        $db = null;

        return $listeProduct;
    }

    public static function selectProduitByType($type){
        $db = loginDB();

        // écrire la requête sql de sélection des produits 
        $listeProduct = $db->prepare('SELECT idProduit, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM produit WHERE idType LIKE ?'); 
        $listeProduct->execute(array($type));

        $db = null;

        return $listeProduct;
    }

    public static function selectProduitById($id) {
        $db = loginDB();

        $sql = $db->prepare('SELECT idProduit, Prix, Couleur, Image, Nom FROM produit where idProduit = :id'); 
        $sql->bindParam(':id', $id);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC); 
        $req = $sql->fetch();
        
        $tab = [
            // La requête a renvoyé au moins une ligne, on peut accéder aux valeurs du tableau $req
            $req['idProduit'],
            $req['Prix'],
            $req['Couleur'],
            $req['Image'],
            $req['Nom']
        ];

        $db = null;

        return $tab;
    }

}