<?php
include_once './view/navbar.php';

?>
<link rel="stylesheet" href="./css/listeProduit.css">
	<h1> Votre recherche : 
		<?php
			if(isset($search) && $search != '') {
				echo $search;
			} else {
				echo '';
			}
		?>
    </h1>
	<div class="imgR">
		<div class="row justify-content-around">
			<?php
				if(isset($error)) {
					if($error == true) {
						echo '<div class="alert alert-danger" role="alert">
						Votre recherche est vide
					</div>';
					} 
				}
				else if (isset($error2)) {
					if($error2 == true) {
						echo '<div class="alert alert-danger" role="alert">
						Aucun produit trouvé
					</div>';
					}
				} else {
					foreach($resultProduit as $uneLigne){ 
						echo '<div class="col-sm-3 center product">
								<h4> '.$uneLigne->getNom().'</h4>
								<img class="img_Prod" src="./img/'.$uneLigne->getImage().'" width = "200px"> 
								<p id="description">' .$uneLigne->getDescription().'</p>
								<p>
									Couleur : '.$uneLigne->getCouleur().'
								</p>
								<p>
									Prix : '.$uneLigne->getPrix().'€
								</p>
								<p>
									Dimensions : '.$uneLigne->getLongueur().' x '.$uneLigne->getLargeur().' x '.$uneLigne->getHauteur().' cm <br>
									Poids : '.$uneLigne->getPoids().' g
								</p>
								<a href="./index.php?uc=panier&action=panier&id='.$uneLigne->getId().'" class="btn btn-primary" type="submit">Ajouter au panier</button></a>
							</div>';
					}  	
				}
			?>
		</div>
	</div>
</body>
</html> 