<?php
require_once('./model/login_db.php');
require_once('./repository/UserRepository.php');
require_once('./repository/ProduitRepository.php');

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
            
            if(!isset($_SESSION['panierListe']['produit'])) {
                $_SESSION['panierListe']['produit'] = array();
            }

            if (isset($_GET['id'])) {
                // Vérifier si la quantité demandée est inférieure ou égale à la quantité en stock du produit
                $product = ProduitRepository::selectInfoProduit($_GET['id']); // Remplacez cette fonction par votre méthode pour récupérer les informations du produit
                $stockQuantity = $product->getQteStock();
                $productId = $_GET['id'];
            
                if (array_key_exists($productId, $_SESSION['panierListe']['produit'])) {
                    // La quantité actuelle du produit dans le panier
                    $currentQuantity = $_SESSION['panierListe']['produit'][$productId];
            
                    if ($currentQuantity < $stockQuantity) {
                        // Augmenter la quantité du produit dans le panier uniquement si la quantité actuelle est inférieure à la quantité en stock
                        $_SESSION['panierListe']['produit'][$productId] = $currentQuantity + 1;
                    }
                } else {
                    // Ajouter le produit au panier avec une quantité de 1 si le produit n'est pas déjà présent
                    $_SESSION['panierListe']['produit'][$productId] = 1;
                    echo "success"; // Réponse de succès pour la requête AJAX
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
    break;
}