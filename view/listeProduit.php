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
							</p>
							<p>
								Poids : '.$product['Poids'].' g	
							</p>
							';
							if($product['qteStock'] == 0) {
								echo '<p>
										Quantité en stock : <span style="color: red;">Rupture de stock</span>
									</p>';
								echo '<button class="btn btn-primary" disabled>Ajouter au panier</button></a>';
							} else {
								echo '<p>
										Quantité en stock : '.$product['qteStock'].'
									</p>';
								echo '<a href="./index.php?uc=panier&action=panier&id='.$product['idProduit'].'" class="btn btn-primary" type="submit">Ajouter au panier</button></a>';
							}
						echo '</div>';
				}  	
			?>
		</div>
	</div>
</body>
</html>