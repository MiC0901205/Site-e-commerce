<?php 
 
/*  
 * /bdd‐pdo/bdd‐pdo‐select.php 
 * code de connexion à la base de données 
 * + sélection d'enregistrements 
 *  
 * @auteur: Thierry Savary 
 * @date: 01/2021 
 */ 
 
// il faut d'abord se connecter 
include './model/Connexion_db.php'; 
 
// exécute la requête paramétrée 
 
try{     

	// écrire la requête sql de sélection des produits 
	$sql = $db->prepare('SELECT b.idProduit, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description FROM batterie b JOIN categorie c on c.idCateg = b.idCateg JOIN produit p on p.idProduit = b.idProduit WHERE c.valeurCateg LIKE ?'); 
	$sql->execute(array("%Antichoc%"));

	// nb lignes résultat 
	$result = $sql->fetch(PDO::FETCH_ASSOC);

	// ferme la connexion
	$db = null;

} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage()); 
} 
 
?>
<?php
include_once './view/navbar.php';
?>
<link rel="stylesheet" href="./css/ronde.css">
	<h1> Batteries Antichoc </h1>
	<div class="imgR">
		<div class="row justify-content-around">
			<?php
				// boucle de parcours du résultat
				foreach($result as $uneLigne){ 
				    echo '<div class="col-sm-3 center product">
							<h4> '.$uneLigne['Nom'].'</h4>
							<img src="./img/'.$uneLigne['Image'].'" width = "200px"> 
							<p id="description">' .$uneLigne['description'].'</p>
							<p>
								Couleur : '.$uneLigne['Couleur'].'
							</p>
							<p>
								Prix : '.$uneLigne['Prix'].'€
							</p>
							<p>
								Dimensions : '.$uneLigne['Longueur'].' x '.$uneLigne['Largeur'].' x '.$uneLigne['Hauteur'].' cm <br>
								Poids : '.$uneLigne['Poids'].' g
							</p>
							<a href="./panier.php?id='.$uneLigne['idBatterie'].'" class="btn btn-primary" type="submit">Ajouter au panier</button></a>
						</div>';
				}  	
			?>
		</div>
	</div>
</body>
</html> 