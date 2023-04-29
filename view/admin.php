<?php
require_once('./model/login_db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css"/>
</head>
<body>
    <h1>Back-office du site</h1>

    <div class="ajouter-produit">
        <a href="../index.php?uc=admin&action=ajoutProduit">
            <input class="btn btn-primary annuler" type="button" value="Ajouter un produit"/>
        </a>
    </div>

    <!-- Liste des produits -->
    <h2>Liste des produits</h2>

    <!-- Filtre par type de batterie --> 
    <label class="selectProduit" style="margin-left:10%;" for="typeProduit">Filtrer par type de produit :</label>
        <select style="margin-left:10%;" id="typeProduit">
            <option value="">Tous</option>
            <option value="1">Batterie</option>
            <option value="2">Souris</option>
            <option value="3">Clavier</option>
            <option value="4">Cable de recharge</option>
        </select>
    </label>
    <table>
    <thead>
        <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Longueur (en cm)</th>
        <th>Largeur (en cm)</th>
        <th>Hauteur (en cm)</th>
        <th>Prix (en €)</th>
        <th>idType</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Connexion à la base de données avec PDO
            $db = loginDB();
            
            // Requête SQL pour récupérer la liste des produits
            $requete = "SELECT idProduit, Nom, Longueur, Largeur, Hauteur, Prix, idType FROM produit";
            $resultat = $db->query($requete);
        ?>

        <?php foreach ($resultat as $produit) { ?>
        <tr>
            <td><?php echo $produit['idProduit']; ?></td>
            <td class="nom-produit"><?php echo $produit['Nom']; ?></td>
            <td><?php echo $produit['Longueur']; ?></td>
            <td><?php echo $produit['Largeur']; ?></td>
            <td><?php echo $produit['Hauteur']; ?></td>
            <td><?php echo $produit['Prix']; ?></td>
            <td><?php echo $produit['idType']; ?></td>
            <td style="width:220px;">
            <button class="btn btn-danger btn-sm">Supprimer</button>
            <button class="btn btn-primary btn-sm">Détails</button>
            <button class="btn btn-warning btn-sm">Modifier</button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>

    <script>
    // Filtrage par type de batterie
    const selectTypeBatterie = document.getElementById("typeProduit");

    selectTypeBatterie.addEventListener("change", function() {
        const typeProduit = this.value;
        const produits = document.querySelectorAll("tbody tr");

        produits.forEach(function(produit) {
        const typeBatterieProduit = produit.querySelector("td:nth-child(7)").textContent;

        if (typeProduit === "" || typeProduit === typeBatterieProduit) {
            produit.style.display = "table-row";
        } else {
            produit.style.display = "none";
        }
        });
    });
    </script>
</body>
</html>