<?php
session_start();
if(isset($_POST['adresse_mail']) && isset($_POST['mdp']))
{
   echo " Le if a marché";
    // connexion à la base de données
    $user = 'root';
    $psw = '';
    $dbName = 'db_site_ecommerce';
    $localhost = 'localhost:3307';
    $db = mysqli_connect($localhost, $user, $psw,$dbName)
           or die('Connexion echouée');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $mail = mysqli_real_escape_string($db,htmlspecialchars($_POST['adresse_mail'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['mdp']));

    
   if($mail !== "" && $password !== "")
   {
      $password = sha1($password);
      $requete = "SELECT count(*) FROM client where 
            adresse_mail = '".$mail."' and mdp = '".$password."' AND confirm_mail = TRUE";
      echo $requete;
      $exec_requete = mysqli_query($db,$requete);
      $reponse      = mysqli_fetch_array($exec_requete);
      $count = $reponse['count(*)'];
      if($count!=0) // adresse mail et mot de passe correctes
      {
         $_SESSION['adresse_mail'] = $mail;
         header('Location: principale.php');
      }
      else
      {
         header('Location: Connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }
   }
   else
   {
      header('Location: Connexion.php?erreur=2'); // utilisateur ou mot de passe vide
   }
}
else
{
   header('Location: Connexion.php');
}
mysqli_close($db); // fermer la connexion
?>