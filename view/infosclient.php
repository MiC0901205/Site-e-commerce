
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/authentification.css">
    </head>
    <body>      
        <div id="container">
        <form action="./index.php?uc=infoClient&action=verifInfo" method="post">
        <center><h2>Modifier vos données personnelles</h2></center>
            <?php  
                if(isset($_GET['modif']) && $_GET['modif'] == true) {
                    echo '<div class="alert alert-success" role="alert">
                    Vos données ont bien été modifiées
                    </div>';
                }      
            ?>
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
            <input type="text" maxlength="14" minlength = "14" placeholder="Votre numéro de téléphone" name="tel" value="<?php if(isset($tel)){ echo $tel; }?>" >
            
            <input type="submit" id="modif" value="Valider">
            <a href="../index.php?uc=accueil"><input class="btn btn-secondary btn-annuler-modif" type="button" value="Annuler"/></a>
        </form>
        </div>
    </body>
</html>