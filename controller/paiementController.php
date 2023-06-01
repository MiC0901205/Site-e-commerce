<?php

include './repository/UserRepository.php';
require_once('./model/User.php');
require_once('./repository/CommandeRepository.php');
require_once('./model/Commande.php');
require_once('./repository/ProduitRepository.php');


$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'paiement':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
        include './view/paiement.php';
    break;

    case 'verifPaiement':

        $valid = true;
        if(isset($_POST["valid"])){
            if(empty($_POST["NP"])){
                $errNP = "Le nom ne doit pas être vide";
                $valid = false;
            } 
            if(strlen($_POST["CB"]) != 16 || !preg_match('/[0-9]{16}/', $_POST["CB"])){
                $errCB = "Le numéro de carte ne doit contenir que 16 chiffres";
                $valid = false;
            }
            if(!(isset($_POST["Month"]) && intval($_POST["Month"]) > 0 && intval($_POST["Month"]) < 13)){
                $errMonth = "Le mois doit être saisi" . $_POST["Month"];
                $valid = false;
            }

            if(!(isset($_POST["Year"]) && intval($_POST["Year"]) > 2021 && intval($_POST["Year"]) < 2033)){
                $errYear = "L'année doit être saisie" . $_POST["Year"];
                $valid = false;
            }

            if(strlen($_POST["CV"]) != 3 || !preg_match('/[0-9]{3}/', $_POST["CV"])){
                $errCV = "Le code de vérification ne doit contenir que 3 chiffres";
                $valid = false;
            }
            if($valid == true){
                if(isset($_POST['Souvenir']) && ($_POST['Souvenir']) == "on"){
                    setcookie('NP',  $_POST["NP"]);
                    setcookie('CB',  $_POST["CB"]);
                    setcookie('CV',  $_POST["CV"]);
                    setcookie('Souvenir',  $_POST["Souvenir"]);
                } else {
                    unset($_COOKIE["NP"]);
                    unset($_COOKIE["CB"]);
                    unset($_COOKIE["CV"]);
                    unset($_COOKIE["Souvenir"]);
                }
                header('Location: ./index.php?uc=paiement&action=confirmPaiement');
            } else {
                unset($_COOKIE["NP"]);
                unset($_COOKIE["CB"]);
                unset($_COOKIE["CV"]);
                unset($_COOKIE["Souvenir"]);

                header('Location: ./index.php?uc=paiement&action=paiement&error=true');
            }
        }
    break;
    
    case 'confirmPaiement':

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 

        if(!isset($_SESSION['panierListe']))
        {
            header('Location: ./index.php?uc=infoClient&action=historique');
            exit;
        }

        // exécute la requête paramétrée 
        try{
            $User = UserRepository::RecupIdUser($_SESSION['adresse_mail']);

            $id = $User->getId();

            $sql = CommandeRepository::insertCommande($id);

            if ($sql) {

                $Commande = CommandeRepository::selectLastCommande();

                $idCommande = $Commande->getIdCmd();

                $dateActuelle = date("Y-m-d H:i:s");

                $cmdStatut = CommandeRepository::InsertCmdStatut($idCommande, 1, $dateActuelle);
            
                if(isset($_SESSION['panierListe']['produit'])){
                    foreach($_SESSION['panierListe']['produit'] as $id => $qte){
                        $sql = CommandeRepository::InsertCmdWithProd($idCommande, $id, $qte);
                        
                        $stockQte = ProduitRepository::SelectQteStock($id);

                        $quantite = $stockQte - $qte;

                        $req = ProduitRepository::UpdateStock($id, $quantite);

                    }
                    if ($sql) {
                        include './view/confirm_paiement.php';
                     } else {
                         echo "Error: " . $sql . "<br>" . $cnx->error;
                     }
                    $dateActuellePrepa = date("Y-m-d H:i:s", strtotime($dateActuelle . " +10 minutes"));

                    $cmdStatut = CommandeRepository::InsertCmdStatut($idCommande, 2, $dateActuellePrepa);
                }
            } else {
                echo "Error: " . $sql . "<br>" . $cnx->error;
            }
            // ferme la connexion 
            unset($cnx); 
            unset($_SESSION['panierListe']); 
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
    break;
    
    default :
        include './view/panier.php';
    break;
}
    