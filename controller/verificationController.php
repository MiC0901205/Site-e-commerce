<?php

use function PHPSTORM_META\map;

require_once('./model/Client.php');
require_once('./repository/ClientRepository.php');


$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

   case 'demandeConnexion':
      include 'view/login.php';
      break;


   case 'confirm_mail' :

      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      } 
      // utiliser phpMailer pour faire fonctionner la confirmation
      $login = $_GET['adresse_mail'];   

      // Génération aléatoire d'une clé
      $cle = md5(microtime(TRUE)*100000);

      $sql = ClientRepository::updateCle($cle, $login);

      // Préparation du mail contenant le lien d'activation
      $destinataire = $login;
      $sujet = "Activer votre compte" ;
      $entete = "From: register@site-e-commerce.com" ;
      
      // Le lien d'activation est composé du login(log) et de la clé(cle)
      $message = 'Bienvenue sur notre site de vente de batteries externes,
      
      Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
      ou copier/coller dans votre navigateur Internet.
      
      https://pecheur.alwaysdata.net/index.php?uc=login&action=validate_mail&mail='.urlencode($login).'&cle='.urlencode($cle).'
      
      ---------------
      Ceci est un mail automatique, Merci de ne pas y répondre.';
            
      mail($destinataire, $sujet, $message, $entete);
      header('Location: ./index.php?uc=register&action=enregistrement&mail_send=true');
      break;

   case 'validateConnexion':
      $loginBlocked = false;

      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }  

      if (!isset($_SESSION['login_attempts'])) {
         $_SESSION['login_attempts'] = 0;
      }

      if(isset($_POST['connexion'])) {
         if(!empty($_POST['adresse_mail']) && !empty($_POST['mdp'])){
            $mail = htmlspecialchars($_POST['adresse_mail']);
            $mdp = hash('sha256', $_POST['mdp']);

            $recupUser = ClientRepository::recupUser($mail, $mdp);
            
            if($recupUser->rowCount() > 0) {
               $recupUser->setFetchMode(PDO::FETCH_CLASS, 'Client'); 
               $info = $recupUser->fetch();
               $_SESSION['adresse_mail'] = $info->getAdresseMail();
               $_SESSION['mdp'] = $info->getMdp();
               $_SESSION['id'] = $info->getId();
               $_SESSION['isAdmin'] = $info->getIsAdmin();
               $_SESSION['login_attempts'] = 0;

               header('Location: ./index.php?uc=validation&action=connexion');
               
            } else {
               $blockDuration = 300;
               $_SESSION['login_attempts']++;
               header('Location: ./index.php?uc=login&action=demandeConnexion&error=true');
               var_dump($_SESSION['login_attempts']);
               if ($_SESSION['login_attempts'] >= 5) {
                  $elapsedTime = time() - $_SESSION['login_blocked_time'];
                  if ($elapsedTime < $blockDuration) {
                     $loginBlocked = true;
                  } else {
                     // Réinitialiser les variables de blocage
                     $_SESSION['login_blocked'] = false;
                     $_SESSION['login_blocked_time'] = 0;
                     $_SESSION['login_attempts'] = 0;
                     $loginBlocked = false;
                  }
                  header('Location: ./index.php?uc=login&action=demandeConnexion&connexion=blocked');
                  exit();
              }
            }

         } else {
            echo "Veuillez compléter tous les champs";
         }
      }
   break;
    
   case 'validate_mail':
      $cle = ClientRepository::recupCle($_GET['mail']);

      if($cle->getCle() == $_GET['cle']){
         $req = ClientRepository::updateConfirmMail(1, $_GET['mail']);

         if(isset($_GET['cle']) && isset($_GET['mail'])){
            $cle = $_GET['cle'];
            $login = $_GET['mail'];
            $rows = ClientRepository::selectUser($cle, $login);

            if ($rows == true){
               $req = ClientRepository::updateConfirmMail(TRUE, $_GET['mail']);

               if ($req == TRUE) {
                  echo $msg;
                  header('Location: ./index.php?uc=login&action=demandeConnexion&mail_confirm=true&login='.$login.'');
                  exit;
               }
               else{
                  echo " Une erreur s'est produite lors de la confirmation du mail ";
               }
            }
            else{
                echo " Le lien de confirmation n'est pas valide ";
            }
         }

      } else {
         echo "Votre mail n'a pas été validée";
      }
      break;

   default:
      include 'view/login.php';
   break;

}


?>