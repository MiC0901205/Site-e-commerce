<?php 
 
/*  
 * /bdd‐pdo/bdd‐pdo‐select.php 
 * code de connexion à la base de données 
 * + sélection d'enregistrements 
 *  
 * @auteur: Mickaël Pecheur
 * @date: 01/2021 
 */ 
 
// il faut d'abord se connecter 
include './model/Connexion_db.php'; 
 
// exécute la requête paramétrée 
 
try{ 
    
    // écrire la requête sql de sélection des produits 
    // contenant le mot Lorem dans leur description 
    $sql = ' SELECT b.idBatterie, c.valeurCateg, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description' ;
    $sql .= ' FROM batterie b ';
    $sql .= ' JOIN categorie c ON c.idCateg = b.idCateg ' ;
    $sql .= 'JOIN produit p ON p.idProduit = b.idProduit' ; 
    // le paramètre est nommée :<nom> 
    $sql .= ' WHERE nom LIKE "%'.$_GET['search'].'%" ' ; 
    $sql .= ' OR description LIKE "%'.$_GET['search'].'%" ' ; 

    // exécute la requête 
    $result = $cnx->query($sql);
    
    $nb_lignes = mysqli_num_rows($result);

    $sql = ' SELECT p.idProduit, Prix, Couleur, Image, Poids, Nom, Largeur, Longueur, Hauteur, description' ;
    $sql .= ' FROM produit p ';
    // le paramètre est nommée :<nom> 
    $sql .= ' WHERE nom LIKE "%'.$_GET['search'].'%" ' ; 
    $sql .= ' OR description LIKE "%'.$_GET['search'].'%" ' ; 

    // exécute la requête 
    $resultProduit = $cnx->query($sql); 

    // nb lignes résultat 
    $nb_lignes += mysqli_num_rows($resultProduit); 

 
    // ferme la connexion 
    unset($cnx); 
} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage()); 
} 
 
?>
<?php
include_once './view/navbar.php';
?>
<link rel="stylesheet" href="./css/ronde.css">
	<h1> Recherche : 
        <?php 
            echo $_GET['search'] 
        ?>
    </h1>
	<div class="imgR">
		<div class="row justify-content-around">
			<?php
                if ($_GET['search'] == ""){
                    echo "Votre recherche est vide";
                    exit;
                }
                if ($nb_lignes == 0){
                    echo "Aucun produit trouvé";
                    exit;
                }
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

                foreach($resultProduit as $uneLigne){ 
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
							<a href="./panier.php?idProduit='.$uneLigne['idProduit'].'" class="btn btn-primary" type="submit">Ajouter au panier</button></a>
						</div>';
				}  	
			?>
		</div>
	</div>
</body>
</html> 