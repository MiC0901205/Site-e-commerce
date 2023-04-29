<?php

require_once('./model/login_db.php');
require_once('./repository/ProduitRepository.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'typeBatterie':
        try{     
            $listeProduct = ProduitRepository::selectBatterieByType($_GET['type']);

            $titlePage = "Batterie" . " " . $_GET['type'];

            include './view/listeProduit.php';
        
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'petiteCapaciteBatterie':
        try {
            $listeProduct = ProduitRepository::selectProduitByCapacite('0', $_GET['capacite']);

            $titlePage = "Batterie" . " " . $_GET['capacite'] . " Ampères";

            include './view/listeProduit.php';
            
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'moyenneCapaciteBatterie': 
        try {
            $listeProduct = ProduitRepository::selectProduitByCapacite('5000', $_GET['capacite']);

            $titlePage = "Batterie" . " de 5000 à " . $_GET['capacite'] . " Ampères";

            include './view/listeProduit.php';
            
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'grandeCapaciteBatterie': 
        try {
            $listeProduct = ProduitRepository::selectProduitByCapacite('20000', $_GET['capacite']);

            $titlePage = "Batterie" . " de 20000 à " . $_GET['capacite'] . " Ampères";

            include './view/listeProduit.php';
            
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        }
        break;

    case 'petiteTailleBatterie':
        try{ 
            $listeProduct = ProduitRepository::selectProduitByTaille('0', $_GET['taille']);

            $titlePage = "Batterie de " . $_GET['taille']. " cm";

            include './view/listeProduit.php';
        
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
        break;

    case 'moyenneTailleBatterie':
        try{ 
            ProduitRepository::selectProduitByTaille('1000', $_GET['taille']);

            $titlePage = "Batterie de 1000 à " . $_GET['taille']. " cm";

            include './view/listeProduit.php';
         
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
        break;

    case 'grandeTailleBatterie':
        try{ 
            $listeProduct = ProduitRepository::selectProduitByTaille('5000', $_GET['taille']);

            $titlePage = "Batterie de 5000 à " . $_GET['taille']. " cm";

            include './view/listeProduit.php';
         
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
        break;
         
    case 'typeProduit':
        try{ 
            $listeProduct = ProduitRepository::selectProduitByType($_GET['type']);

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