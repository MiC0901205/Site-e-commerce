<?php
session_start();
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
    // contenant le mot Lorem dans leur description 
    $sql = ' SELECT co.idCommande, date' ;
    $sql .= ' FROM commandes co'; 
	$sql .= ' JOIN client cl on cl.idClient = co.idClient' ;
	$sql .= ' WHERE adresse_mail = "'.$_SESSION['adresse_mail'].'"';   
    
    // exécute la requête 
    $result = $cnx->query($sql); 
  
    $prix = 0;
} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage()); 
} 
 
?>
<?php
include_once './view/navbar.php';
?>
<link rel="stylesheet" href="./css/historique_cmd.css">
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
                    foreach($result as $uneCommande){
                        $sql = ' SELECT nom, qte, prix' ;
                        $sql .= ' FROM commande_produit C'; 
                        $sql .= ' JOIN commandes co on co.idCommande = C.idCommande' ;
                        $sql .= ' JOIN produit p on p.idProduit = C.idProduit' ;  
                        $sql .= ' WHERE co.idCommande = '.$uneCommande['idCommande'].'' ;  

                        $result_Produit = $cnx->query($sql);

                        $sql = ' SELECT nom, qte, prix' ;
                        $sql .= ' FROM commandes_batterie cb' ; 
                        $sql .= ' JOIN commandes co on co.idCommande = cb.idCommande' ;
                        $sql .= ' JOIN batterie b on b.idBatterie = cb.idBatterie' ;
                        $sql .= ' JOIN produit p on p.idProduit = b.idProduit' ;  
                        $sql .= ' WHERE co.idCommande = '.$uneCommande['idCommande'].'' ; 
                        
                        $result_Batterie = $cnx->query($sql);

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

                            if($result_Batterie != false) {
                                foreach($result_Batterie as $uneLigne){
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