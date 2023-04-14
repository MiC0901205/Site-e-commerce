<?php
        require_once('model/Connexion_db.php'); // Fichier PHP contenant la connexion à votre BDD 
        session_start();
    
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

                if(!preg_match('/[0-9]{10}/', $tel)){
                    $valid = false;
                    $er_tel = "Le numéro de tel n'est pas valide";
                }  

                
                if($valid){
                {   
                    $sql=" UPDATE `client` SET nom = '$nom', prenom = '$prenom', adresse = '$adresse', ville = '$ville', cp = '$cp', tel = '$tel'";
                    $sql .= ' WHERE adresse_mail = "'.$_SESSION['adresse_mail'].'";'; 
                    if ($db->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $db->error;
                    }
                }
                }
            }
        } else {
            try{ 
                $cnx = getBddConnexion();

                $sql = ' SELECT nom, prenom, adresse, ville, cp, tel';
                $sql .= ' FROM client';
                // le paramètre est nommée :<nom> 
                $sql .= ' WHERE adresse_mail = "'.$_SESSION['adresse_mail'].'";';   

                // exécute la requête 
                $result = $cnx->query($sql); 

                $resultat = mysqli_fetch_array($result);

                $nom = $resultat['nom'];
                $prenom = $resultat['prenom'];
                $adresse = $resultat['adresse'];
                $ville = $resultat['ville'];
                $cp = $resultat['cp'];
                $tel = $resultat['tel'];         
            
                // ferme la connexion 
                unset($cnx); 
            } catch (Exception $ex) {
                die('Erreur : ' . $ex->getMessage()); 
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
        <form action="Infosclient.php" method="post">
        <center><h2>Modifier vos données personnelles</h2></center>
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
            
            <input type="submit" id="inscription" value="Valider">
        </form>
        </div>
    </body>
</html>