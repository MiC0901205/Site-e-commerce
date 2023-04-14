<?php

require_once('./model/login_db.php');

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


      // Insertion de la clé dans la base de données (à adapter en INSERT si besoin)
      $sql = $db->prepare("UPDATE client SET cle= :cle WHERE adresse_mail like :mail ");
      $sql->bindParam(':cle', $cle);
      $sql->bindParam(':mail', $login);

      $sql->execute();
      // Préparation du mail contenant le lien d'activation
      $destinataire = $login;
      $sujet = "Activer votre compte" ;
      $entete = "From: connexion@Site e-commerce.com" ;
      
      // Le lien d'activation est composé du login(log) et de la clé(cle)
      $message = 'Bienvenue sur notre site de vente de batteries externes,
      
      Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
      ou copier/coller dans votre navigateur Internet.
      
      https://pecheur.alwaysdata.net/index.php?uc=login&action=validate_mail&mail='.urlencode($login).'&cle='.urlencode($cle).'
      
      ---------------
      Ceci est un mail automatique, Merci de ne pas y répondre.';
            
      mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
      //echo '<a href="./index.php?uc=login&mail='.urlencode($login).'">Cliquer ici pour valider votre compte</a>'; 
      // Update du confirm_mail dans la base de données (à adapter en INSERT si besoin)
      break;

   case 'validateConnexion':
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }  
      if(isset($_POST['connexion'])) {
         if(!empty($_POST['adresse_mail']) && !empty($_POST['mdp'])){
            $mail = htmlspecialchars($_POST['adresse_mail']);
            $mdp = sha1($_POST['mdp']);

            $recupUser = $db->prepare('SELECT * FROM client WHERE adresse_mail = ? AND mdp = ? AND confirm_mail = 1');
            $recupUser->execute(array($mail, $mdp));
            
            if($recupUser->rowCount() > 0) {
               $info = $recupUser->fetch();
               $_SESSION['adresse_mail'] = $info['adresse_mail'];
               $_SESSION['mdp'] = $info['mdp'];
               $_SESSION['id'] = $info['idClient'];
               $_SESSION['isAdmin'] = $info['isAdmin'];
               
               header('Location: ./index.php?uc=validation&action=connexion');
               
            } else {
               echo "Votre mot de passe ou adresse mail est incorrecte";
            }

         } else {
            echo "Veuillez compléter tous les champs";
         }
      }
   break;
    
   case 'validate_mail':
      $req = $db->prepare('SELECT cle FROM client WHERE adresse_mail = :adresse_mail');
      $req->bindParam(':adresse_mail', $_GET['mail']);
      $req->execute();

      $cle = $req->fetch(PDO::FETCH_ASSOC);

      var_dump($cle);
      echo 'tot';
      if($cle['cle'] == $_GET['cle']){
         $req = $db->prepare("UPDATE client SET confirm_mail=1 WHERE adresse_mail like :adresse_mail");
         $req->bindParam(':adresse_mail', $_GET['mail']);
         $req->execute();
         header('Location: ./index.php?uc=login&action=demandeConnexion');
      } else {
         echo "Votre mail n'a pas été validée";
      }
      break;

   default:
      include 'view/login.php';
      break;

   $db = null; // fermer la connexion   

}


?>