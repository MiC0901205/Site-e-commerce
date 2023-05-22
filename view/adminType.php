<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="header">
        <div class="btn-group">
            <a href="../index.php?uc=admin&action=admin" class="btn btn-primary">Retour</a>
        </div>
    </div>
    <h1 id='title' style='margin-top: -5%;'>Gestion des types de produits</h1>
    <?php
    if(isset($_GET['modif'])){
        if($_GET['modif'] == 1) {
            echo '<div class="alert alert-success" role="alert">
            Les données du type ont bien été modifiées
            </div>';
        } else if($_GET['modif'] == 0) {
            echo "<div class='alert alert-danger' role='alert'>
            Les données du type n'ont pas été modifiées
            </div>";
        }
    }
    if(isset($_GET['inserted'])) {
        if($_GET['inserted'] == true) {
            echo '<div class="alert alert-success" role="alert">
                Le type a bien était ajouté
            </div>'; 
        }
    }
    if(isset($_GET['removeid'])) {
        echo "<div class='alert alert-danger' role='alert'>
            La suppression du type à l'id ".$_GET['removeid']." a bien été effectuée.
        </div>"; 
    }
    if(isset($_GET['suppr'])) {
        echo "<div class='alert alert-success' role='alert'>
            La suppression a bien été annulée
        </div>"; 
    }
    ?>

    <div id="btn-action" class="btn btn-action" style="display:flex;">
        <div class="ajouter-infos">
            <a href="../index.php?uc=admin&action=ajoutType">
                <input id="add-button" class="ajouter" type="button" value="Ajouter un type"/>
            </a>
        </div>
        <div class="supprimer-infos">
            <a href="#">
                <input id="delete-button" class="supprimer" type="button" value="Supprimer le type" disabled/>
            </a>
        </div>
        <div class="modifier-infos">
            <a href="#">
                <input id="edit-button" class="modifier" type="button" value="Modifier le type" disabled/>
            </a>
        </div>
    </div>

    <!-- Liste des produits -->
    <h2>Liste des produits</h2>

    <!-- Filtre par type de batterie --> 
    <table>
    <thead>
        <tr>
        <th></th>
        <th>ID</th>
        <th>Libelle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultat as $produit) { ?>
        <tr>
            <td><input id="<?php echo $produit['idType']; ?>" type="checkbox" class="checkbox-produit" value="<?php echo $produit['idType']; ?>" onclick="updateButtons()"></td>
            <td><?php echo $produit['idType']; ?></td>
            <td class="nom-produit"><?php echo $produit['libelle']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <script src="../js/adminType.js"></script>
</body>
</html>