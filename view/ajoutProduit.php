<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/adminProduit.css" media="screen" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Ajout d'un produit</h1>
    <form action="./index.php?uc=admin&action=verificationAjout" method="POST" enctype="multipart/form-data">
    <?php 
        if(isset($_GET['error'])) {
            if($_GET['error'] == true) {
                echo "<div class='alert alert-danger style=margin-left:50%;' role='alert'>
                        L'insertion n'a pas été faite
                    </div>";
            }
        }
    ?>
    <div class="row">
        <div class="form-group">
            <label class="label-info"> Informations du produit : </label>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nom">Nom du produit :</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php if (isset($_POST['nom'])) { echo $_POST['nom']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="text" class="form-control" id="image" name="image" placeholder="nom_dossier/nom_image.jpg" value="<?php if (isset($_POST['image'])) { echo $_POST['image']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" rows="3" value="<?php if (isset($_POST['description'])) { echo $_POST['description']; } ?>" required></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group infos_supp">
                <label for="couleur">Couleur :</label>
                <input type="text" class="form-control" id="couleur" name="couleur" value="<?php if (isset($_POST['couleur'])) { echo $_POST['couleur']; } ?>" required>
            </div>
            <div class="form-group infos_supp">
                <label for="qteStock">Quantité en stock :</label>
                <input type="number" class="form-control" id="qteStock" name="qteStock" value="<?php if (isset($_POST['qteStock'])) { echo $_POST['qteStock']; } ?>" required>
            </div>
            <div class="form-group infos_supp">
                <label for="seuilAlert">Seuil d'alerte :</label>
                <input type="number" class="form-control" id="seuilAlert" name="seuilAlert" value="<?php if (isset($_POST['seuilAlert'])) { echo $_POST['seuilAlert']; } ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="prix">Prix : (en €)</label>
            <input type="number" class="form-control" id="prix" name="prix" value="<?php if (isset($_POST['prix'])) { echo $_POST['prix']; } ?>" required>
        </div>
        <div class="form-group">
            <label class="label-dimension"> Dimensions du produit : </label>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="largeur">Largeur : (en cm)</label>
                <input type="number" class="form-control" id="largeur" name="largeur" value="<?php if (isset($_POST['largeur'])) { echo $_POST['largeur']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="longueur">Longueur : (en cm)</label>
                <input type="number" class="form-control" id="longueur" name="longueur" value="<?php if (isset($_POST['longueur'])) { echo $_POST['longueur']; } ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="hauteur">Hauteur : (en cm)</label>
                <input type="number" class="form-control" id="hauteur" name="hauteur" value="<?php if (isset($_POST['hauteur'])) { echo $_POST['hauteur']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="poids">Poids : (en kg)</label>
                <input type="number" class="form-control" id="poids" name="poids" value="<?php if (isset($_POST['poids'])) { echo $_POST['poids']; } ?>" required>
            </div>
        </div>
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
        <button type="submit" class="btn btn-primary" style="margin-top:2%;">Ajouter le produit</button>
    </form>
</body>