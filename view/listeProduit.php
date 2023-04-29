<?php 
include 'navbar.php'; 
?>
<link rel="stylesheet" href="./css/listeProduit.css">
	<h1><?php echo $titlePage ?></h1>
	<div class="imgR">
		<div class="row justify-content-around">
			<?php
				// boucle de parcours du résultat
				foreach($listeProduct as $product){ 
				    echo '<div class="col-sm-3 center product">
							<h4> '.$product['Nom'].'</h4>
							<img class="img_Prod" src="./img/'.$product['Image'].'" width = "200px"> 
							<p id="description">' .$product['description'].'</p>
							<p>
								Couleur : '.$product['Couleur'].'
							</p>
							<p>
								Prix : '.$product['Prix'].'€
							</p>
							<p>
								Dimensions : '.$product['Longueur'].' x '.$product['Largeur'].' x '.$product['Hauteur'].' cm <br>
								Poids : '.$product['Poids'].' g
							</p>
							<a href="./index.php?uc=panier&action=panier&id='.$product['idProduit'].'" class="btn btn-primary" type="submit">Ajouter au panier</button></a>
						</div>';
				}  	
			?>
		</div>
	</div>
</body>
</html>