<?php
require_once('./model/Client.php');
require_once('./repository/ClientRepository.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'logout':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
 
        unset($_SESSION['id']);   
        unset($_SESSION['adresse_mail']);
        unset($_SESSION['panierListe']);
        unset($_SESSION['lastdate']);
        unset($_SESSION['isAdmin']);
    
        if(!isset($_GET['afk'])){
            header("Location: ./index.php");   
        } else {
            header("Location: ./index.php?afk=true");
        }
    break;
    
    case 'demandeRegister' :
        include './view/register.php';
    break;

    case 'enregistrement':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }  
        
        function validateDate($date, $format = 'Y-m-d H:i:s')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }
    
    
        // S il y a une session alors on ne retourne plus sur cette page 
        
        if (isset($_SESSION['id'])){
            header('Location: ./index.php');
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
                $mail = htmlentities(strtolower(trim($mail))); // On récupère le mail
                $ville = htmlentities(trim($ville)); // on récupère la ville
                $cp = htmlentities(trim($cp)); // on récupère le code postal
                $tel = htmlentities(trim($tel)); // on récupère le numero de tel
                $mdp = trim($mdp); // On récupère le mot de passe 
                $confmdp = trim($confmdp); //  On récupère la confirmation du mot de passe
        
                if(empty($nom)){
                    $valid = false;
                }
    
                if(empty($prenom)){
                    $valid = false;
                }
    
                if(empty($cp)){
                    $valid = false;
                }
    
                if(empty($mail)){
                    $valid = false;
                    
                }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i", $mail)){
                    echo $mail;
                    $valid = false;
    
                }else{
                    $req = ClientRepository::selectMail($mail);
                    if($req <> ""){
                        $valid = false;
                    }
                }
                
                if(empty($ville)){
                    $valid = false;
                }
    
                elseif(!preg_match('/[0-9]{5}/', $cp)){
                    $valid = false;
                }              
    
                if(!preg_match('/^[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$/', $tel)){
                    $valid = false;
                }  
    
                if(empty($mdp)) {
                    $valid = false;
    
                }elseif($mdp != $confmdp){
                    $valid = false;
                }
    
                if($valid){
                   
                    $mdp = hash('sha256', $_POST['mdp']);
                    
                    try {
                        $sql = ClientRepository::insertClient($nom, $prenom, $adresse, $mail, $ville, $cp, $tel, $mdp); 
                    } catch (Exception $ex){
                        header('Location: location: index.php?uc=login&action=demandeConnexion');
                        exit;
                    }

                    if (true) {
                        echo "New record created successfully";
                        header("Location: ./index.php?uc=mail&action=confirm_mail&adresse_mail=$mail");
                    } else {
                        echo $rows;
                        echo "Error: l'insertion n'a pas été faite";
                    }
                } else {
                    header('Location: ./index.php?uc=register&action=demandeRegister&error=true');
                }
            }
        } else {
            $etatMail = $_GET['mail_send'];
            header('Location: ./view/register.php?mail_send='.$etatMail);
        }
    break;

    case 'connexion':
        if(isset($_GET['deconnexion']))
        { 
            if($_GET['deconnexion']==true)
            {  
                session_unset();
                header("location: index.php?uc=logout&action=logout");
            }
        }
        else if($_SESSION['adresse_mail'] !== ""){
            $user = $_SESSION['adresse_mail'];
            // afficher un message
            echo "Bonjour $user, vous êtes connecté";
            header("Location: ./index.php?uc=accueil");
        }
    break;

    default :
        include './index.php';
    break;
}

?>
