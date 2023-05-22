
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/adminAjout.css">
    </head>
    <body>      
        <div id="container">
        <form action="./index.php?uc=admin&action=verificationModifUser&id=<?php echo $_GET['id'] ?>" method="post">
        <center><h2>Modifier les données de l'utilisateur</h2></center>
            <div class="row">
                <div class="col-md-6">
                    <div class="Nom">
                        <?php                      
                            if (isset($er_nom)){
                            ?>
                                <div><?= $er_nom ?></div>
                            <?php   
                            }
                        ?>
                        
                        <label><b>Nom</b></label>
                        <input type="text" placeholder="Nom de l'utilisateur" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required>
                    </div>

                    <div class="Prix">
                        <?php
                            if (isset($er_prenom)){
                            ?>
                                <div><?= $er_prenom ?></div>
                            <?php   
                            }
                        ?>
                        <label><b>Prenom</b></label>
                        <input type="text" placeholder="Prenom de l'utilisateur" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" required>
                    </div>   

                    <?php
                        if (isset($er_adresse_mail)){
                        ?>
                            <div><?= $er_adresse_mail ?></div>
                        <?php   
                        }
                    ?>
                    <label><b>Adresse Mail</b></label>
                    <input type="text" placeholder="Adresse mail de l'utilisateur" name="adresse_mail" value="<?php if(isset($adresse_mail)){ echo $adresse_mail; }?>" required>  
                </div>
                    
                <div class="col-md-6">

                    <?php
                        if (isset($er_ville)){
                        ?>
                            <div><?= $er_ville ?></div>
                        <?php   
                        }
                    ?>
                    <label><b>Ville</b></label>
                    <input type="text" placeholder="Ville de l'utilisateur" name="ville" value="<?php if(isset($ville)){ echo $ville; }?>" required>  

                    <?php
                        if (isset($er_cp)){
                        ?>
                            <div><?= $er_cp ?></div>
                        <?php   
                        }
                    ?>
                    <label><b>Code Postal</b></label>
                    <input type="text" placeholder="Code postal de l'utilisateur" name="cp" value="<?php if(isset($cp)){ echo $cp; }?>" >
                
                    <?php
                        if (isset($er_adresse)){
                        ?>
                            <div><?= $er_adresse ?></div>
                        <?php   
                        }
                    ?>
                    <label><b>Adresse</b></label>
                    <input type="text" placeholder="Adresse de l'utilisateur" name="adresse" value="<?php if(isset($adresse)){ echo $adresse; }?>" required>  
                </div>
            </div>
            <?php
                if (isset($er_tel)){
                ?>
                    <div><?= $er_tel ?></div>
                <?php   
                }
            ?>
            <label><b>Tel</b></label>
            <input type="text" maxlength="14" minlength ="14" placeholder="Numero de telephone de l'utilisateur" name="tel" id="telephone" value="<?php if(isset($tel)){ echo $tel; }?>" >

            <?php
                if (isset($er_idType)){
                ?>
                    <div><?= $er_idType ?></div>
                <?php   
                }
            ?>
            <div class="form-group">
                <label for="selectRole">Role de l'utilisateur :</label>
                <select class="form-control select" id="selectRole" name="role" required>
                    <option value="ROLE_USER" <?php if($role == 'ROLE_USER'){ echo 'selected'; }?>>ROLE_USER</option>
                    <option value="ROLE_ADMIN" <?php if($role == 'ROLE_ADMIN'){ echo 'selected'; }?>>ROLE_ADMIN</option>
                    <option value="ROLE_ADMIN_MAUI" <?php if($role == 'ROLE_ADMIN_MAUI'){ echo 'selected'; }?>>ROLE_ADMIN_MAUI</option>
                </select>
            </div>

            <div class="form-group row">
                <input type="submit" class="btn btn-primary btn-block" id="modif" value="Valider">
            </div>   
            <a href="./index.php?uc=admin&action=adminUser"><input class="btn btn-secondary btn-block" id="annul" type="button" value="Annuler"/></a>    
        </form>
        </div>
    </body>
    <script src="../js/adminUser.js"></script> 
</html>