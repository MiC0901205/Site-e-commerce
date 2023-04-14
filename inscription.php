<?php
        require_once('model/Connexion_db.php'); // Fichier PHP contenant la connexion à votre BDD 
        session_start();
        
        function validateDate($date, $format = 'Y-m-d H:i:s')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

    
        // S il y a une session alors on ne retourne plus sur cette page 
        
        if (isset($_SESSION['id'])){
            header('Location: index.php');
        exit;
        }
 
    
        // Si la variable "$_Post" contient des informations alors on les traitres
         
        if(!empty($_POST)){
            extract($_POST);
            $valid = true;
 
        if (isset($_POST)){
            $user = 'root';
            $psw = '';
            $dbName = 'db_site_ecommerce';
            $localhost = 'localhost:3307';
            $db = mysqli_connect($localhost, $user, $psw,$dbName)
                   or die('Connexion echouée');           
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
                $er_nom = ("Le nom d' utilisateur ne peut pas être vide");
            }

            if(empty($prenom)){
                $valid = false;
                $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
            }

            if(empty($cp)){
                $valid = false;
                $er_cp = ("Le code postal ne peut pas être vide");
            }

            if(empty($mail)){
                $valid = false;
                $er_mail = "Le mail ne peut pas être vide";
 
                
            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
                $valid = false;
                $er_mail = "Le mail n'est pas valide";
 
            }else{
                
                $req_mail = $db->query("SELECT adresse_mail FROM client WHERE adresse_mail = \"".$mail."\"");
 
                $req_mail = $req_mail->fetch_array();
 
                if ($req_mail['adresse_mail'] <> ""){
                    $valid = false;
                    $er_mail = "Ce mail existe déjà";
                }
            }
            
            if(empty($ville)){
                $valid = false;
                $er_ville = ("La ville ne peut pas être vide");
            }

            elseif(!preg_match('/[0-9]{5}/', $cp)){
                $valid = false;
                $er_cp = "Le code postal n'est pas valide";

            }              

            if(!preg_match('/[0-9]{10}/', $tel)){
                $valid = false;
                $er_tel = "Le numéro de tel n'est pas valide";
            }  

            if(empty($mdp)) {
                $valid = false;
                $er_mdp = "Le mot de passe ne peut pas être vide";
 
            }elseif($mdp != $confmdp){
                $valid = false;
                $er_mdp = "La confirmation du mot de passe ne correspond pas";
            }
            echo $valid;
            
            if($valid){
                
                $mdp = sha1($mdp);
                $date_creation_compte = date('Y-m-d H:i:s');
 
                
                $sql=("INSERT INTO `client` (`nom`, `prenom`, `adresse`, `adresse_mail`, `confirm_mail`, `ville`, `cp`, `tel`, `mdp`) 
                VALUES ('$nom', '$prenom', '$adresse', '$mail', FALSE, '$ville', '$cp', '$tel', '$mdp')");
                if ($db->query($sql) === TRUE) {
                    echo "New record created successfully";
                    header("Location: confirmation_mail.php?adresse_mail=$mail");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . $db->error;
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/inscription.css" media="screen" type="text/css"/>
        <title>Inscription</title>
    </head>
    <body>      
        <div id="container">
        <form action="inscription.php" method="post">
        <h1>Inscription</h1>
            <div class="infosNP">
                <div class="Nom">
                    <?php
                        
                        if (isset($er_nom)){
                        ?>
                            <div><?= $er_nom ?></div>
                        <?php   
                        }
                    ?>
                    
                    <label><b>Nom</b></label>
                    <input type="text" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required>
                </div>

                <div class="Prenom" style="margin-left: 40px;">
                    <?php
                        if (isset($er_prenom)){
                        ?>
                            <div><?= $er_prenom ?></div>
                        <?php   
                        }
                    ?>
                    <label><b>Prenom</b></label>
                    <input type="text" placeholder="Votre prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" required>
                </div>
            </div>   

            <?php
                if (isset($er_adresse)){
                ?>
                    <div><?= $er_adresse ?></div>
                <?php   
                }
            ?>
            <label><b>Adresse</b></label>
            <input type="text" placeholder="Votre adresse" name="adresse" value="<?php if(isset($adresse)){ echo $adresse; }?>" required>  
            

            <?php
                if (isset($er_mail)){
                ?>
                    <div><?= $er_mail ?></div>
                <?php   
                }
            ?>
            <label><b>Adresse mail</b></label>
            <input type="mail" placeholder="Adresse mail" size ="30" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" required>

            <?php
                if (isset($er_ville)){
                ?>
                    <div><?= $er_ville ?></div>
                <?php   
                }
            ?>
            <label><b>Ville</b></label>
            <input type="text" placeholder="Votre ville" name="ville" value="<?php if(isset($ville)){ echo $ville; }?>" required>  
            
            <?php
                if (isset($er_cp)){
                ?>
                    <div><?= $er_cp ?></div>
                <?php   
                }
            ?>
            <label><b>Code Postal</b></label>
            <input type="text" maxlength="5" minlength = "5" placeholder="Votre code postal" name="cp" value="<?php if(isset($cp)){ echo $cp; }?>" required>  

            <?php
                if (isset($er_tel)){
                ?>
                    <div><?= $er_tel ?></div>
                <?php   
                }
            ?>
            <label><b>Telephone</b></label>
            <input type="text" maxlength="10" minlength = "10" placeholder="Votre numéro de téléphone" name="tel" value="<?php if(isset($tel)){ echo $tel; }?>" >
            
            <?php
                if (isset($er_mdp)){
                ?>
                    <div><?= $er_mdp ?></div>
                <?php   
                }
            ?>
            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Mot de passe*" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required>
            <label><b>Confirmer le mot de passe</b></label>
            <input type="password" placeholder="Confirmer le mot de passe" name="confmdp" required>

            <input type="submit" id="inscription" value="S'inscrire">
        </form>
        </div>
    </body>
</html>