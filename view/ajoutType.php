<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/adminAjout.css" media="screen" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Ajout d'un type</h1>
    <form action="./index.php?uc=admin&action=verificationAjoutType" method="POST" enctype="multipart/form-data">
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
            <label for="libelle">Libelle :</label>
            <input type="text" class="form-control" id="libelle" placeholder="Rentrer le libelle du type" name="libelle" value="<?php if (isset($_POST['libelle'])) { echo $_POST['libelle']; } ?>" required>
        </div>
        <div class="form-group row">
            <input type="submit" class="btn btn-primary btn-block" id="valider-prod" value="Valider">
        </div>   
        <a href="../index.php?uc=admin&action=adminType"><input class="btn btn-secondary btn-block" id="annulerAjout" type="button" value="Annuler"/></a>    
    </form>
</body>