<?php
require_once('./model/login_db.php');
require_once('./repository/ProduitRepository.php');

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Back-office du site</h1>

    <?php
    if(isset($_GET['inserted'])) {
        if($_GET['inserted'] == true) {
            echo '<div class="alert alert-success" role="alert">
                Le produit a bien était ajouté
            </div>'; 
        }
    }
    if(isset($_GET['removeid'])) {
        echo "<div class='alert alert-danger' role='alert'>
            La suppression du produit à l'id ".$_GET['removeid']."
        </div>"; 
    }
    ?>

    <div id="btn-action" class="btn btn-action" style="display:flex;">
        <div class="ajouter-produit">
            <a href="../index.php?uc=admin&action=ajoutProduit">
                <input id="add-button" class="ajouter" type="button" value="Ajouter un produit"/>
            </a>
        </div>
        <div class="supprimer-produit">
            <a href="#">
                <input id="delete-button" class="supprimer" type="button" value="Supprimer le produit" disabled/>
            </a>
        </div><div class="modifier-produit">
            <a href="../index.php?uc=admin&action=infoProduit">
                <input id="edit-button" class="modifier" type="button" value="Modifier le produit" disabled/>
            </a>
        </div>
    </div>

    <!-- Liste des produits -->
    <h2>Liste des produits</h2>

    <!-- Filtre par type de batterie --> 
    <label class="selectProduit" style="margin-left:10%; margin-top:2%" for="typeProduit">Filtrer par type de produit : </label>
        <select style="margin-left:0.5%;" id="typeProduit">
            <option value="">Tous</option>
            <option value="1">Batterie</option>
            <option value="2">Souris</option>
            <option value="3">Clavier</option>
            <option value="4">Cable de recharge</option>
        </select>
    <table>
    <thead>
        <tr>
        <th></th>
        <th>ID</th>
        <th>Nom</th>
        <th>Longueur (en cm)</th>
        <th>Largeur (en cm)</th>
        <th>Hauteur (en cm)</th>
        <th>Prix (en €)</th>
        <th>idType</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultat as $produit) { ?>
        <tr>
            <td><input id="<?php echo $produit['idProduit']; ?>" type="checkbox" class="checkbox-produit" value="<?php echo $produit['idProduit']; ?>" onclick="updateButtons()"></td>
            <td><?php echo $produit['idProduit']; ?></td>
            <td class="nom-produit"><?php echo $produit['Nom']; ?></td>
            <td><?php echo $produit['Longueur']; ?></td>
            <td><?php echo $produit['Largeur']; ?></td>
            <td><?php echo $produit['Hauteur']; ?></td>
            <td><?php echo $produit['Prix']; ?></td>
            <td><?php echo $produit['idType']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <script src="../js/admin.js"></script>
</body>
</html>