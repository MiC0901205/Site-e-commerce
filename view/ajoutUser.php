<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/adminAjout.css" media="screen" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Ajout d'un utilisateur</h1>
    <form action="./index.php?uc=admin&action=verificationAjoutUser" method="POST" enctype="multipart/form-data">
    <?php 
        if(isset($_GET['error'])) {
            if($_GET['error'] == true) {
                echo "<div class='alert alert-danger' role='alert'>
                        L'insertion n'a pas été faite
                    </div>";
            } else {
                echo "<div class='alert alert-danger' style='margin-left: 50%;' role='alert'>
                        L'adresse mail existe déjà
                    </div>";
            }
        }
    ?>
    <div class="row align-items-stretch">
        <div class="form-group">
            <label class="label-info"> Informations de l'utilisateur : </label>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" placeholder="Veuillez saisir le nom" id="nom" name="nom" value="<?php if (isset($_POST['nom'])) { echo $_POST['nom']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="adresse_mail">Adresse mail :</label>
                <input type="text" class="form-control" placeholder="Veuillez saisir l'adresse mail" id="adresse_mail" name="adresse_mail" value="<?php if  (isset($_POST['adresse_mail'])) { echo $_POST['adresse_mail']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="tel">Telephone :</label>
                <input maxlength="14" minlength ="14" type="tel" placeholder="Veuillez saisir le numéro de téléphone" class="form-control tel" id="telephone" name="tel" value="<?php if (isset($_POST['tel'])) { echo $_POST['tel']; } ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="prenom">Prenom :</label>
                <input type="text" class="form-control" placeholder="Veuillez le prénom" id="prenom" name="prenom" value="<?php if (isset($_POST['prenom'])) { echo $_POST['prenom']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" class="form-control" placeholder="Veuillez saisir la ville" id="ville" name="ville" value="<?php if (isset($_POST['ville'])) { echo $_POST['ville']; } ?>" required>
            </div>
            <div class="form-group">
                <label for="cp">Code Postal :</label>
                <input type="text" class="form-control" placeholder="Veuillez saisir le code postal" id="cp" name="cp" value="<?php if (isset($_POST['cp'])) { echo $_POST['cp']; } ?>" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="adresse">Adresse :</label>
        <input class="form-control adresse" placeholder="Veuillez saisir l'adresse" id="adresse" name="adresse" value="<?php if (isset($_POST['adresse'])) { echo $_POST['adresse']; } ?>" required>
    </div>
    <div class="form-group">
        <label class="label-mdp"> Définir un mot de passe sécurisé : </label>
    </div>
    <label for="password" class="password_label">
        <b>Mot de passe</b>
        <input class="psw form-control" id="password" type="password" placeholder="Mot de passe*" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required oninput="checkPasswordStrength()" onblur="clearPasswordIndications()">
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
        <input class="psw form-control" type="password" placeholder="Confirmer le mot de passe*" name="confmdp" required>
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

    <div class="form-group">
        <label for="role">Role de l'utilisateur :</label>
        <select class="form-control select" id="role" name="role" required>
            <option value="">-- Sélectionnez le rôle de l'utilisateur --</option>
            <option value="1">ROLE_USER</option>
            <option value="2">ROLE_ADMIN</option>
            <option value="3">ROLE_ADMIN_MAUI</option>
        </select>
    </div>
    <div class="form-group row">
        <input type="submit" class="btn btn-primary btn-block" id="valider" value="Valider">
    </div>   
    <a href="../index.php?uc=admin&action=adminUser"><input class="btn btn-secondary btn-block" id="annulerAjout" type="button" value="Annuler"/></a>    
    </form>
    <script src="../js/authentification.js"></script> 
</body>