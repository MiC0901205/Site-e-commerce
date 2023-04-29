<?php
require_once('./model/login_db.php');
require_once('./repository/ProduitRepository.php');
require_once('./repository/ClientRepository.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {
    case 'panier':     

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 

        $pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) &&($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache'); 

        if(isset($_SESSION['adresse_mail'])){
            $sql = ClientRepository::selectInfoClient($_SESSION['adresse_mail']);

            $nom = $sql[0];
            $prenom = $sql[1];

        } else {
            echo "vous devez vous connecter pour voir votre panier"; 
            exit;
        }
        
        if(($pageRefreshed != 1)){
            if(isset($_GET['id'])){
                if(!isset($_SESSION['panierListe']['produit'])) {
                    $_SESSION['panierListe']['produit'] = array();
                } 
                if (array_key_exists($_GET['id'], $_SESSION['panierListe']['produit'])){
                    $_SESSION['panierListe']['produit'][$_GET['id']] =  $_SESSION['panierListe']['produit'][$_GET['id']] + 1;
                } else {
                    $_SESSION['panierListe']['produit'][$_GET['id']] = 1;
                } 
            } elseif(isset($_GET['removeid'])) {
                if(isset($_SESSION['panierListe']['produit'])){
                    if (array_key_exists($_GET['removeid'], $_SESSION['panierListe']['produit'])){
                        $_SESSION['panierListe']['produit'][$_GET['removeid']] =  $_SESSION['panierListe']['produit'][$_GET['removeid']] - 1;
                        if ($_SESSION['panierListe']['produit'][$_GET['removeid']] <= 0){
                            unset($_SESSION['panierListe']['produit'][$_GET['removeid']]);
                        }
                    } 
                } 
            }  elseif(isset($_GET['removeallid'])) {
                if(isset($_SESSION['panierListe']['produit'])){
                    if (array_key_exists($_GET['removeallid'], $_SESSION['panierListe']['produit'])){
                        unset($_SESSION['panierListe']['produit'][$_GET['removeallid']]);
                    } 
                } 
            }
        }

        $prixtot = 0;

        include './view/panier.php';

    break;

    default: 
        include './view/accueil.php';
}