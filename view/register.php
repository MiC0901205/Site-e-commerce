
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/register.css" media="screen" type="text/css"/>
        <title>Inscription</title>
    </head>
    <body>      
        <div id="container">
        <form method="POST" action="../index.php?uc=register&action=enregistrement">
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