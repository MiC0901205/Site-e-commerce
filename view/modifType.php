
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
        <form action="./index.php?uc=admin&action=verificationModifType&idType=<?php echo $_GET['id'] ?>" method="post">
        <center><h2>Modifier les données du type</h2></center>
            <div class="row">
                    <?php                      
                        if (isset($er_libelle)){
                        ?>
                            <div><?= $er_libelle ?></div>
                        <?php   
                        }
                    ?>
                    
                    <label><b>Libelle</b></label>
                    <input type="text" placeholder="Libelle du type" name="libelle" value="<?php if(isset($libelle)){ echo $libelle; }?>" required>
                </div>

            <div class="form-group row">
                <input type="submit" class="btn btn-primary btn-block" id="modif" value="Valider">
            </div>   
            <a href="./index.php?uc=admin&action=adminProduit"><input class="btn btn-secondary btn-block" id="annul" type="button" value="Annuler"/></a>    
        </form>
        </div>
    </body>
</html>