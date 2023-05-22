<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1 class="title">Back Office du site</h1>
    <div class="container">
        <div class="card">
            <h3>Gestion des produits</h3>
            <p>Accédez à l'interface de gestion des produits pour effectuer des opérations telles que l'ajout, la modification et la suppression de produits.</p>
            <a href="./index.php?uc=admin&action=adminProduit" class="btn">Accéder</a>
        </div>

        <div class="card">
            <h3>Gestion des clients</h3>
            <p>Accédez à l'interface de gestion des clients  pour effectuer des opérations telles que l'ajout, la modification et la suppression de clients.</p>
            <a href="./index.php?uc=admin&action=adminUser" class="btn">Accéder</a>
        </div>

        <div class="card">
            <h3>Gestion des types de produit</h3>
            <p>Gérez les types de produits disponibles dans votre système. Vous pouvez ajouter, modifier et supprimer des types de produits pour organiser votre catalogue.</p>
            <a href="./index.php?uc=admin&action=adminType" class="btn">Accéder</a>
        </div>
    </div>
</body>
</html>