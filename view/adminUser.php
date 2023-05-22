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
    <h1 id='title' style='margin-top: -5%;'>Gestion des utilisateurs</h1>
    <?php
    if(isset($_GET['modif'])){
        if($_GET['modif'] == 1) {
            echo "<div class='alert alert-success' role='alert'>
            Les données de l'utilisateur ont bien été modifiées
            </div>";
        } else if($_GET['modif'] == 0) {
            echo "<div class='alert alert-danger' role='alert'>
            Les données de l'utilisateur n'ont pas été modifiées
            </div>";
        }
    }
    if(isset($_GET['inserted'])) {
        if($_GET['inserted'] == true) {
            echo "<div class='alert alert-success' role='alert'>
                L'utilisateur a bien était ajouté
            </div>"; 
        }
    }
    if(isset($_GET['removeid'])) {
        echo "<div class='alert alert-danger' role='alert'>
            La suppression de l'utilisateur à l'id ".$_GET['removeid']." a bien été effectuée.
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
            <a href="../index.php?uc=admin&action=ajoutUser">
                <input id="add-button" class="ajouter" type="button" value="Ajouter un utilisateur"/>
            </a>
        </div>
        <div class="supprimer-infos">
            <a href="#">
                <input id="delete-button" class="supprimer" type="button" value="Supprimer le utilisateur" disabled/>
            </a>
        </div>
        <div class="modifier-infos">
            <a href="#">
                <input id="edit-button" class="modifier" type="button" value="Modifier le utilisateur" disabled/>
            </a>
        </div>
    </div>

    <!-- Liste des utilisateurs -->
    <h2>Liste des utilisateurs</h2>

    <label class="selectUser" style="margin-left:10%; margin-top:2%" for="role">Filtrer par role d'utilisateur : </label>
        <select style="margin-left:0.5%;" id="selectRole">
            <option value="">Tous</option>
            <option value="ROLE_USER">ROLE_USER</option>
            <option value="ROLE_ADMIN">ROLE_ADMIN</option>
            <option value="ROLE_ADMIN_MAUI">ROLE_ADMIN_MAUI</option>
        </select>
    <table>
    <thead>
        <tr>
        <th></th>
        <th>ID</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse</th>
        <th>Adresse Mail</th>
        <th>Ville</th>
        <th>Cp</th>
        <th width="12%">Tel</th>
        <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultat as $user) { ?>
        <tr>
            <td><input id="<?php echo $user['id']; ?>" type="checkbox" class="checkbox" value="<?php echo $user['id']; ?>" onclick="updateButtons()"></td>
            <td><?php echo $user['id']; ?></td>
            <td class="nom"><?php echo $user['nom']; ?></td>
            <td><?php echo $user['prenom']; ?></td>
            <td><?php echo $user['adresse']; ?></td>
            <td><?php echo $user['adresse_mail']; ?></td>
            <td><?php echo $user['ville']; ?></td>
            <td><?php echo $user['cp']; ?></td>
            <td><?php echo $user['tel']; ?></td>
            <td><?php echo $user['role']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <script src="../js/adminUser.js"></script>
</body>
</html>