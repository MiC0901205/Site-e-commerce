<?php
require_once('./model/login_db.php');
require_once('./repository/ProduitRepository.php');
require_once('./repository/UserRepository.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {
    case 'panier':     

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 

        $pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) &&($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache'); 

        if(isset($_SESSION['adresse_mail'])){
            $Client = UserRepository::selectInfoClient($_SESSION['adresse_mail']);

            $nom = $Client->getNom();
            $prenom = $Client->getPrenom();

        } else {
            if(isset($_GET['connexion']) && $_GET['connexion'] == 'blocked') {
                header('Location: ./index.php?uc=accueil&connexion=blocked');
            } else {
                header('Location: ./index.php?uc=login&action=demandeConnexion&out=redirect');
            }
            exit;
        }

        if((!$pageRefreshed)){

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
                            echo 'je suis ici maintenant';
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
    break;
}