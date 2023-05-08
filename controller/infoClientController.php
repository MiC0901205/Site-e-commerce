<?php

require_once('./repository/ClientRepository.php');
require_once('./model/Client.php');


$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'info':
        // S il y a une session alors on ne retourne plus sur cette page 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 

        $Client = ClientRepository::selectInfoClient($_SESSION['adresse_mail']);

        $nom = $Client->getNom();
        $prenom = $Client->getPrenom();
        $adresse = $Client->getAdresse();
        $ville = $Client->getVille();
        $cp = $Client->getCp();
        $tel = $Client->getTel();

        include 'view/infosclient.php';
    break;

    case 'verifInfo':
        // S il y a une session alors on ne retourne plus sur cette page 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 

        if(!isset($_SESSION['id'])){
            header('Location: index.php');
        exit;
        }
 
        // Si la variable "$_Post" contient des informations alors on les traitres
         
        if(!empty($_POST)){
            extract($_POST);
            $valid = true;
 
            if (isset($_POST)){         
                $nom = htmlentities(trim($nom)); // On récupère le nom
                $prenom = htmlentities(trim($prenom)); // on récupère le prénom
                $adresse = htmlentities(trim($adresse)); // on récupère l'adresse
                $ville = htmlentities(trim($ville)); // on récupère la ville
                $cp = htmlentities(trim($cp)); // on récupère le code postal
                $tel = htmlentities(trim($tel)); // on récupère le numero de tel
        
                if(empty($nom)){
                    $valid = false;
                    $er_nom = ("Le nom d' utilisateur ne peut pas être vide");
                }

                if(empty($prenom)){
                    $valid = false;
                    $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
                }
                
                if(empty($ville)){
                    $valid = false;
                    $er_ville = ("La ville ne peut pas être vide");
                }

                if(empty($cp)){
                    $valid = false;
                    $er_cp = ("Le code postal ne peut pas être vide");
                }
                elseif(!preg_match('/[0-9]{5}/', $cp)){
                    $valid = false;
                    $er_cp = "Le code postal n'est pas valide";

                }         
            
                if(!preg_match('/^[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$/', $tel)){
                    $valid = false;
                    $er_tel = "Le numéro de tel n'est pas valide";
                }  
                
                if($valid)
                {   
                    $client = new Client();
                    $client->setNom($nom);
                    $client->setPrenom($prenom);
                    $client->setAdresse($adresse);
                    $client->setVille($ville);
                    $client->setCp($cp);
                    $client->setTel($tel);
                    $client->setAdresseMail($_SESSION['adresse_mail']);

                    $sql = ClientRepository::updateUser($client);

                    if ($sql == TRUE) {
                        header("Location: ./index.php?uc=infoClient&action=info&modif=true");
                    } else {
                        echo "Error: La modification n'a pas été faite";
                    }
                }
            }
        } else {
            try{ 

                $Client = ClientRepository::selectInfoClient($_SESSION['adresse_mail']);

                $nom = $Client->getNom();
                $prenom = $Client->getPrenom();
                $adresse = $Client->getAdresse();
                $ville = $Client->getVille();
                $cp = $Client->getCp();
                $tel = $client->getTel();
 

            } catch (Exception $ex) {
                die('Erreur : ' . $ex->getMessage()); 
            } 
        }
    break;  
    
    case 'historique':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
         }  
        try{ 
            $sql = ClientRepository::historiqueCmd($_SESSION['adresse_mail']);
            
            $prix = 0;

            include './view/historique_cmd.php';

        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage()); 
        } 
    break;

    default :
        include './index.php';
    break;
}
