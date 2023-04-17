<?php

require_once('./model/login_db.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'typeBatterie':
        try{     
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE c.valeurCateg LIKE ?'); 
            $listeProduct->execute(array("%".$_GET['type']."%"));
        
            $titlePage = "Batterie" . " " . $_GET['type'];

            // ferme la connexion
            $db = null;


            include './view/listeProduit.php';
        
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'petiteCapaciteBatterie':
        try {
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Capacite, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE Capacite <= ?'); 
            $listeProduct->execute(array("".$_GET['capacite'].""));

            $titlePage = "Batterie" . " " . $_GET['capacite'] . " Ampères";

            // ferme la connexion
            $db = null;

            include './view/listeProduit.php';
            
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'moyenneCapaciteBatterie': 
        try {
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Capacite, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE Capacite > ? AND Capacite <= ?'); 
            $listeProduct->execute(array('5000', "".$_GET['capacite'].""));

            $titlePage = "Batterie" . " de 5000 à " . $_GET['capacite'] . " Ampères";

            // ferme la connexion
            $db = null;

            include './view/listeProduit.php';
            
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'grandeCapaciteBatterie': 
        try {
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Capacite, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE Capacite > ? AND Capacite <= ?'); 
            $listeProduct->execute(array('20000', "".$_GET['capacite'].""));

            $titlePage = "Batterie" . " de 20000 à " . $_GET['capacite'] . " Ampères";

            // ferme la connexion
            $db = null;

            include './view/listeProduit.php';
            
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'petiteTailleBatterie':
        try{ 
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE Largeur * Longueur * Hauteur <= ?'); 
            $listeProduct->execute(array("".$_GET['taille'].""));

            $titlePage = "Batterie de " . $_GET['taille']. " cm";

            // ferme la connexion
            $db = null;

            include './view/listeProduit.php';
         
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
        break;

    case 'moyenneTailleBatterie':
        try{ 
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit  WHERE Largeur * Longueur * Hauteur > ? AND  Largeur * Longueur * Hauteur <= ?'); 
            $listeProduct->execute(array('1000', "".$_GET['taille'].""));

            $titlePage = "Batterie de 1000 à " . $_GET['taille']. " cm";

            // ferme la connexion
            $db = null;

            include './view/listeProduit.php';
         
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
        break;

    case 'grandeTailleBatterie':
        try{ 
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT b.idProduit, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit  WHERE Largeur * Longueur * Hauteur > ? AND  Largeur * Longueur * Hauteur <= ?'); 
            $listeProduct->execute(array('5000', "".$_GET['taille'].""));

            $titlePage = "Batterie de 5000 à " . $_GET['taille']. " cm";

            // ferme la connexion
            $db = null;

            include './view/listeProduit.php';
         
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
        break;
         
    case 'typeProduit':
        try{ 
            // écrire la requête sql de sélection des produits 
            $listeProduct = $db->prepare('SELECT idProduit, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM produit WHERE idType LIKE ?'); 
            $listeProduct->execute(array("".$_GET['type'].""));

            $typeTitles = array(
                2 => "Souris",
                3 => "Clavier",
                4 => "Cable"
            );
            
            $titlePage = $typeTitles[$_GET['type']] ?? '';


            // ferme la connexion
            $db = null;

            include './view/listeProduit.php';
         
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
        break;

    default:
        include './index.php';
        break;


}

?>