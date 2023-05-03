
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/adminProduit.css">
    </head>
    <body>      
        <div id="container">
        <form action="./index.php?uc=admin&action=verificationModif" method="post">
        <center><h2>Modifier les données du produit</h2></center>
            <?php  
                if(isset($_GET['modif']) && $_GET['modif'] == true) {
                    echo '<div class="alert alert-success" role="alert">
                    Vos données ont bien été modifiées
                    </div>';
                }      
            ?>
            <div class="infosProduit">
                <div class="Nom">
                    <?php                      
                        if (isset($er_nom)){
                        ?>
                            <div><?= $er_nom ?></div>
                        <?php   
                        }
                    ?>
                    
                    <label><b>Nom</b></label>
                    <input type="text" placeholder="Nom du produit" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required>
                </div>

                <div class="Prix">
                    <?php
                        if (isset($er_prix)){
                        ?>
                            <div><?= $er_prix ?></div>
                        <?php   
                        }
                    ?>
                    <label><b>Prix</b></label>
                    <input type="text" placeholder="Prix du produit" name="prix" value="<?php if(isset($prix)){ echo $prix; }?>" required>
                </div>
            </div>   

            <?php
                if (isset($er_couleur)){
                ?>
                    <div><?= $er_couleur ?></div>
                <?php   
                }
            ?>
            <label><b>Couleur</b></label>
            <input type="text" placeholder="Couleur du produit" name="couleur" value="<?php if(isset($couleur)){ echo $couleur; }?>" required>  
            

            <?php
                if (isset($er_image)){
                ?>
                    <div><?= $er_image ?></div>
                <?php   
                }
            ?>
            <label><b>Image</b></label>
            <input type="text" placeholder="Image du produit" name="image" value="<?php if(isset($image)){ echo $image; }?>" required>  
            
            <?php
                if (isset($er_largeur)){
                ?>
                    <div><?= $er_largeur ?></div>
                <?php   
                }
            ?>
            <label><b>Largeur</b></label>
            <input type="number" placeholder="Largeur du produit" name="largeur" value="<?php if(isset($largeur)){ echo $largeur; }?>" required>  

            <?php
                if (isset($er_longueur)){
                ?>
                    <div><?= $er_longueur ?></div>
                <?php   
                }
            ?>
            <label><b>Longueur</b></label>
            <input type="number" placeholder="Longueur du produit" name="longueur" value="<?php if(isset($longueur)){ echo $longueur; }?>" >
            
            <?php
                if (isset($er_hauteur)){
                ?>
                    <div><?= $er_hauteur ?></div>
                <?php   
                }
            ?>
            <label><b>Hauteur</b></label>
            <input type="number" placeholder="Hauteur du produit" name="hauteur" value="<?php if(isset($hauteur)){ echo $hauteur; }?>" >
            
            <?php
                if (isset($er_poids)){
                ?>
                    <div><?= $er_poids ?></div>
                <?php   
                }
            ?>
            <label><b>Poids</b></label>
            <input type="number" placeholder="Poids du produit" name="poids" value="<?php if(isset($poids)){ echo $poids; }?>" >

            <?php
                if (isset($er_description)){
                ?>
                    <div><?= $er_description ?></div>
                <?php   
                }
            ?>
            <label><b>Description</b></label>
            <input type="text" placeholder="Description du produit" name="description" value="<?php if(isset($description)){ echo $description; }?>" >

            <?php
                if (isset($er_qteStock)){
                ?>
                    <div><?= $er_qteStock ?></div>
                <?php   
                }
            ?>
            <label><b>Quantité en stock</b></label>
            <input type="number" placeholder="Quantité en stock du produit" name="qteStock" value="<?php if(isset($qteStock)){ echo $qteStock; }?>" >

            <?php
                if (isset($er_seuilAlert)){
                ?>
                    <div><?= $er_seuilAlert ?></div>
                <?php   
                }
            ?>
            <label><b>Seuil d'alerte</b></label>
            <input type="number" placeholder="Seuil d'alerte du produit" name="seuilAlert" value="<?php if(isset($seuilAlert)){ echo $seuilAlert; }?>" >

            <?php
                if (isset($er_idType)){
                ?>
                    <div><?= $er_idType ?></div>
                <?php   
                }
            ?>
            <div class="form-group">
                <label for="idType">Type de produit :</label>
                <select class="form-control select" id="idType" name="idType" required>
                <option value="">-- Sélectionnez un type --</option>
                <option value="1">Batterie</option>
                <option value="2">Souris</option>
                <option value="3">Clavier</option>
                <option value="4">Cable de recharge</option>
                </select>
            </div>

            <input type="submit" class="btn-valider-modif" id="modif" value="Valider">
            <a href="../index.php?uc=admin&action=admin"><input class="btn btn-secondary btn-annuler-modif" type="button" value="Annuler"/></a>
        </form>
        </div>
    </body>
</html>