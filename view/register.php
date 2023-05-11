
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/authentification.css" media="screen" type="text/css"/>
        <title>Inscription</title>
    </head>
    <body>
        <div id="container">
        <form method="POST" action="../index.php?uc=register&action=enregistrement">
        <?php
            if(isset($_GET['mail_send'])) {
                if(($_GET['mail_send']) == true) {
                    echo '<div class="alert alert-info" id="mail" style="display:block" role="alert">
                    Un mail vous a été envoyé, veuillez vérifier votre boite mail
                    </div>';
                } else if (($_GET['mail_send']) == false) {
                    echo "<div class='alert alert-danger' id='mail' style='display:block' role='alert'>
                    Votre mail n'existe pas, aucun mail n'a pu vous être envoyé
                    </div>";
                }
            }
            if(isset($_GET['error'])) {
                echo "<div class='alert alert-danger' id='mail' style='display:block' role='alert'>
                        Un compte est déjà lié à l'adresse mail rentrée
                    </div>";
            }
            if(isset($_GET['errorMdp'])) {
                echo "<div class='alert alert-danger' id='mail' style='display:block' role='alert'>
                    Votre mot de passe doit être plus complexe pour assurer sa sécurité
                    </div>";
            }
        ?>
            
        <h1>Inscription</h1>
            <div class="infos">
                <div class="infos_1">
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

                <div class="infos_2" style="margin-left: 40px;">
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
            <input id="telephone" type="text" maxlength="14" minlength ="14" placeholder="Votre numéro de téléphone" name="tel" value="<?php if(isset($tel)){ echo $tel; }?>" >
            
            <?php
                if (isset($er_mdp)){
                ?>
                    <div><?= $er_mdp ?></div>
                <?php   
                }
            ?>

            <label for="password" class="password_label">
                <b>Mot de passe</b>
                <input class="psw" id="password" type="password" placeholder="Mot de passe*" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required oninput="checkPasswordStrength()" onblur="clearPasswordIndications()">
                <div class="progress">
                    <div id="password-strength-bar"></div>
                </div>
                <div class="password-icon">
                    <i data-feather="eye" class="eye"></i>
                    <i data-feather="eye-off" class="eyeOff"></i>
                </div>
                <div>
                    <i class="info-icon" data-feather="info" style="display:none"></i>
                    <span id="password-indications"></span>
                </div>
            </label>
            
            <label class="password_label">
                <b>Confirmer le mot de passe</b>
                <input class="psw" type="password" placeholder="Confirmer le mot de passe*" name="confmdp" required>
                <div class="password-icon">
                    <i data-feather="eye" class="eye"></i>
                    <i data-feather="eye-off" class="eyeOff"></i>
                </div>
            </label>

            <!-- Inclure la bibliothèque Feather Icons JavaScript -->
            <script src="https://unpkg.com/feather-icons"></script>
            <script>
                feather.replace();
            </script>

            <input type="submit" id="inscription" value="S'inscrire">
            <a href="../index.php?uc=accueil"><input class="btn btn-secondary annuler" type="button" value="Annuler l'enregistrement"/></a>
            </form>
            <script src="../js/authentification.js"></script>
        </div>
    </body>
</html>