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
        if($id == null) {
            return [];
        }
        $db = loginDB();

        $sql = $db->prepare('SELECT idProduit, Prix, Couleur, Image, Nom FROM produit where idProduit = :id'); 
        $sql->bindParam(':id', $id);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Produit'); 
        $req = $sql->fetch();

        $db = null;

        return $req;
    }

    public static function selectTousProduit() {
          
        // Connexion à la base de données avec PDO
        $db = loginDB();
            
        // Requête SQL pour récupérer la liste des produits
        $requete = "SELECT idProduit, Nom, Longueur, Largeur, Hauteur, Prix, idType FROM produit";
        $resultat = $db->query($requete);

        $db = null;

        return $resultat;
    }

    public static function insertProduit($nom, $prix, $couleur, $image, $largeur, $longueur, $hauteur, $poids, $description, $qteStock, $seuilAlert, $idType) {
        // Connexion à la base de données avec PDO
        $db = loginDB();

        $requete = $db->prepare('INSERT INTO `produit`(`Nom`, `Prix`, `Couleur`, `Image`, `Largeur`, `Longueur`, `Hauteur`, `Poids`, `description`, `qteStock`, `seuilAlert`, `idType`) VALUES (:nom, :prix, :couleur, :image, :largeur, :longueur, :hauteur, :poids, :description, :qteStock, :seuilAlert, :idType)');
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prix', $prix);
        $requete->bindParam(':couleur', $couleur);
        $requete->bindParam(':image', $image);
        $requete->bindParam(':largeur', $largeur);
        $requete->bindParam(':longueur', $longueur);
        $requete->bindParam(':hauteur', $hauteur);
        $requete->bindParam(':poids', $poids);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':qteStock', $qteStock);
        $requete->bindParam(':seuilAlert', $seuilAlert);
        $requete->bindParam(':idType', $idType);

        $requete->execute();

        $db = null;
    }

    public static function deleteProduit($idProduit) {
        // Connexion à la base de données avec PDO
        $db = loginDB();

        $requete = $db->prepare('DELETE FROM `produit` WHERE idProduit = :id');
        $requete->bindParam(':id', $idProduit);

        $requete->execute();

        $db = null;
    }

    public static function RecupProdByCmd($uneCommande) {
        $db = loginDB();

        $sql = $db->prepare('SELECT nom, qte, prix FROM commande_produit C JOIN commandes co on co.idCommande = C.idCommande JOIN produit p on p.idProduit = C.idProduit WHERE co.idCommande = :idCmd');  
        $sql->bindParam(':idCmd', $uneCommande['idCommande']);
        $sql->execute();

        $db = null;

        return $sql;

    }

    public static function selectInfoProduit($id) {
        $db = loginDB();

        $sql = $db->prepare('SELECT `Nom`, `Prix`, `Couleur`, `Image`, `Largeur`, `Longueur`, `Hauteur`, `Poids`, `description`, `qteStock`, `seuilAlert`, `idType` FROM produit WHERE idProduit = :id');   
        $sql->bindParam(':id', $id);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Produit'); 
        $req = $sql->fetch();
        
        $db = null;

        return $req;
    }

    public static function updateProduit($produit) {
        $db = loginDB();
        
        $sql= $db->prepare("UPDATE `produit` SET Nom = :nom, Prix = :prix, Couleur = :couleur, Image = :image, Largeur = :largeur, Longueur = :longueur, Hauteur = :hauteur, Poids = :poids, description = :description, qteStock = :qteStock, seuilAlert = :seuilAlert, idType = :idType WHERE idProduit = :idProduit"); 
        $sql->bindParam(':nom', $produit->getNom());
        $sql->bindParam(':prix', $produit->getPrix());
        $sql->bindParam(':couleur', $produit->getCouleur());
        $sql->bindParam(':image', $produit->getImage());
        $sql->bindParam(':largeur', $produit->getLargeur());
        $sql->bindParam(':longueur', $produit->getLongueur());
        $sql->bindParam(':hauteur', $produit->getHauteur());
        $sql->bindParam(':poids', $produit->getPoids());
        $sql->bindParam(':description', $produit->getDescription());
        $sql->bindParam(':qteStock', $produit->getQteStock());
        $sql->bindParam(':seuilAlert', $produit->getSeuilAlert());
        $sql->bindParam(':idType', $produit->getIdType());
        $sql->bindParam(':idProduit', $produit->getId());

        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function searchProduit($search) {
        $db = loginDB();
        
        $sql = $db->prepare('SELECT p.idProduit, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM produit p WHERE nom LIKE :search OR description LIKE :search');
        $search = '%'.$search.'%'; // Ajouter les caractères joker autour de la recherche
        $sql->bindParam(':search', $search, PDO::PARAM_STR);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Produit'); 
        $req = $sql->fetchAll();

        $db = null; 

        return $req;
    
    }
}