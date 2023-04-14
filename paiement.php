<?php
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
            header('Location: confirm_paiement.php');
        } else {
            unset($_COOKIE["NP"]);
            unset($_COOKIE["CB"]);
            unset($_COOKIE["CV"]);
            unset($_COOKIE["Souvenir"]);
        }
    }
?>

<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css/paiement.css" media="screen" type="text/css"/>
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="paiement.php" method="POST">
                <h1>Paiement en ligne</h1>
                <br/>
                <label><b>Titulaire de la carte</b></label>
                <input type="text" class="<?php if(isset($errNP)){ echo "Messagebox"; }?>" placeholder="Entrer votre Prenom et Nom" name="NP" value="<?php if(isset($_COOKIE['NP'])){ echo $_COOKIE['NP']; }?>">
                <?php  
                    if (isset($errNP)){
                    ?>
                        <div class="errMessage"><?= $errNP ?></div>
                    <?php   
                    }
                ?>
                
                <label><b>Numéro de carte</b></label>
                <input type="text" class="<?php if(isset($errCB)){ echo "Messagebox"; }?>" placeholder="Entrer votre numero de carte" name="CB" maxlength="16" value="<?php if(isset($_COOKIE['CB'])){ echo $_COOKIE['CB']; }?>">
                <?php
                    if (isset($errCB)){
                    ?>
                        <div class="errMessage"><?= $errCB ?></div>
                    <?php  
                    }
                ?>
                
                <div class="date_expi">
                    <label><b>Date d'expiration</b></label>
                    <div class="d-flex flex-row date">
                        <select class="<?php if(isset($errMonth)){ echo "Messagebox"; }?>" name="Month" id="Month-select">
                            <option value="">Choisir le mois</option>
                            <option value="1">Janvier</option>
                            <option value="2">Février</option>
                            <option value="3">Mars</option>
                            <option value="4">Avril</option>
                            <option value="5">Mai</option>
                            <option value="6">Juin</option>
                            <option value="7">Juillet</option>
                            <option value="8">Aout</option>
                            <option value="9">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                        <?php
                            if (isset($errMonth)){
                            ?>
                                <div class="errMessage"><?= $errMonth ?></div>
                            <?php  
                            }
                        ?>
                        <select class="<?php if(isset($errYear)){ echo "Messagebox"; }?>" name="Year" id="Year-select" value="<?php if(isset($_COOKIE['Year'])){ echo $_COOKIE['Year']; }?>">
                            <option value="">Choisir l'année</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                        </select>
                        <?php
                            if (isset($errYear)){
                            ?>
                                <div class="errMessage"><?= $errYear ?></div>
                            <?php  
                            }
                        ?>
                    </div>
                </div>  
                <br/>
                <label><b>Code de vérification</b></label>
                <input type="text" class="<?php if(isset($errCV)){ echo "Messagebox"; }?>" placeholder="Entrer votre code de vérification" name="CV" maxlength="3" minlength="3" value="<?php if(isset($_COOKIE['CV'])){ echo $_COOKIE['CV']; }?>">
                    <?php 
                        if (isset($errCV)){
                        ?>
                            <div class="errMessage"><?= $errCV ?></div>
                        <?php   
                        }
                    ?>
                <div>
                    <?php
                        if(isset($_COOKIE['Souvenir']))
                        {
                            echo '<input type="checkbox" id="Souvenir" name="Souvenir" checked>';
                            
                        } else {
                            echo '<input type="checkbox" id="Souvenir" name="Souvenir">';
                        }
                    ?>
                    <label for="Compte_achat">Se souvenir</label>
                </div>
                <div class="d-flex flex-row bouton">
                    <input type="submit" name="valid" id='Valider' value='Valider'>
                    <div id="annuler">
                        <a href="panier.php">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>