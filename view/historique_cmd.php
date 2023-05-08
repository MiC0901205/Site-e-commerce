
<?php
include 'navbar.php';
include './repository/ProduitRepository.php';
?>
<link rel="stylesheet" href="../css/historique_cmd.css">
			<table>
			<caption>Historique des commandes</caption>
			<thead>
			  <tr>
				<th scope="col">idCommande</th>
				<th scope="col">Nom des produit (qte)</th>
				<th scope="col">Prix des produits</th>
				<th scope="col">Date de la commande</th>
			  </tr>
			</thead>
			<tbody>
                <?php 
                    foreach($sql as $uneCommande){
                        $result_Produit = ProduitRepository::RecupProdByCmd($uneCommande);

                        echo "<tr>
                            <th scope='row'> ".$uneCommande['idCommande']."</th>
                            <td>";
                            $prix = 0;
                            if($result_Produit != false){
                                foreach($result_Produit as $uneLigne){
                                    echo ''.$uneLigne['nom'].'('.$uneLigne['qte'].')';
                                    echo '</br>';
                                    $prix += $uneLigne['prix'] * $uneLigne['qte'];     
                                } 
                            }
                            
                        echo "</td>
                            <td>$prix</td>
                            <td>".$uneCommande['date']."</td>
                        </tr>";
                    }
                    unset($cnx);
                ?>
		</div>
	</div>
</body>
</html> 