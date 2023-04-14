<?php
session_start();
$pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) &&($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache'); 

include './view/navbar.php'; 
include './model/Connexion_db.php'; 

?>
<link rel="stylesheet" href="./css/panier.css">
<div id="panier"> 
    <form action="paiement.php" method="POST">
        <h1>Panier</h1>
        <div id="commandes">
            <?php
            $cnx = getBddConnexion();           
            // écrire la requête sql de sélection des produits 
            // contenant le mot Lorem dans leur description 
            if(isset($_SESSION['adresse_mail'])){
                $sql = 'select nom, prenom' ;
                $sql .= ' from client '; 
                $sql .= ' where adresse_mail = "'.$_SESSION['adresse_mail'].'"';
            } else {
                echo "vous devez vous connecter pour voir votre panier"; 
                exit;
            }

            if(($pageRefreshed != 1)){
                if(!isset($_SESSION['panierListe'])){
                    $_SESSION['panierListe'] = array();
                }
                if(isset($_GET['id'])){
                    if(!isset($_SESSION['panierListe']['batterie'])) {
                        $_SESSION['panierListe']['batterie'] = array();
                    } 
                    if (array_key_exists($_GET['id'], $_SESSION['panierListe']['batterie'])){
                        $_SESSION['panierListe']['batterie'][$_GET['id']] =  $_SESSION['panierListe']['batterie'][$_GET['id']] + 1;
                    } else {
                        $_SESSION['panierListe']['batterie'][$_GET['id']] = 1;
                    } 
                } elseif(isset($_GET['removeid'])) {
                    if(isset($_SESSION['panierListe']['batterie'])){
                        if (array_key_exists($_GET['removeid'], $_SESSION['panierListe']['batterie'])){
                            $_SESSION['panierListe']['batterie'][$_GET['removeid']] =  $_SESSION['panierListe']['batterie'][$_GET['removeid']] - 1;
                            if ($_SESSION['panierListe']['batterie'][$_GET['removeid']] <= 0){
                                unset($_SESSION['panierListe']['batterie'][$_GET['removeid']]);
                            }
                        } 
                    } 
                }  elseif(isset($_GET['removeallid'])) {
                    if(isset($_SESSION['panierListe']['batterie'])){
                        if (array_key_exists($_GET['removeallid'], $_SESSION['panierListe']['batterie'])){
                            unset($_SESSION['panierListe']['batterie'][$_GET['removeallid']]);
                        } 
                    } 
                }

                if(isset($_GET['idProduit'])){
                    if(!isset($_SESSION['panierListe']['produit'])) {
                        $_SESSION['panierListe']['produit'] = array();
                    } 
                    if (array_key_exists($_GET['idProduit'], $_SESSION['panierListe']['produit'])){
                        $_SESSION['panierListe']['produit'][$_GET['idProduit']] =  $_SESSION['panierListe']['produit'][$_GET['idProduit']] + 1;
                    } else {
                        $_SESSION['panierListe']['produit'][$_GET['idProduit']] = 1;
                    } 
                } elseif(isset($_GET['removeidProduit'])) {
                    if(isset($_SESSION['panierListe']['produit'])){
                        if (array_key_exists($_GET['removeidProduit'], $_SESSION['panierListe']['produit'])){
                            $_SESSION['panierListe']['produit'][$_GET['removeidProduit']] =  $_SESSION['panierListe']['produit'][$_GET['removeidProduit']] - 1;
                            if ($_SESSION['panierListe']['produit'][$_GET['removeidProduit']] <= 0){
                                unset($_SESSION['panierListe']['produit'][$_GET['removeidProduit']]);
                            }
                        } 
                    } 
                }  elseif(isset($_GET['removeallidProduit'])) {
                    if(isset($_SESSION['panierListe']['produit'])){
                        if (array_key_exists($_GET['removeallidProduit'], $_SESSION['panierListe']['produit'])){
                            unset($_SESSION['panierListe']['produit'][$_GET['removeallidProduit']]);
                        } 
                    } 
                }
            }
   
            // exécute la requête 
            $result = $cnx->query($sql); 

            // nb lignes résultat 
            $nb_lignes = mysqli_num_rows($result); 
        
            $resultat = mysqli_fetch_array($result);

            echo '<div class="col-sm-4">
                <h4> Commandes de '.$resultat['prenom'].' '.$resultat['nom'].'</h4>
                </div>';

            echo '<div class="row justify-content-around">';

            $prixtot = 0;
            if(isset($_SESSION['panierListe']) && ((isset($_SESSION['panierListe']['batterie']) && count($_SESSION['panierListe']['batterie']) > 0) || (isset($_SESSION['panierListe']['produit']) && count($_SESSION['panierListe']['produit']) > 0))){
                if(isset($_SESSION['panierListe']['batterie'])){
                    foreach($_SESSION['panierListe']['batterie'] as $id => $qte){
                        $sql = 'select b.idBatterie, c.valeurCateg, Prix, Couleur, Image, Nom' ;
                        $sql .= ' from batterie b ';
                        $sql .= ' join categorie c on c.idCateg = b.idCateg ' ;
                        $sql .= 'join produit p on p.idProduit = b.idProduit' ; 
                        // le paramètre est nommée :<nom> 
                        $sql .= ' where b.idBatterie = '.$id.''; 
                        
                        // exécute la requête 
                        $result = $cnx->query($sql); 
                    
                        // nb lignes résultat 
                        $nb_lignes = mysqli_num_rows($result); 
                    
                        $resultat = mysqli_fetch_array($result);
                        
                        $prixtot += $resultat['Prix'] * $qte;

                        echo '<div class="col-sm-3 center product">
                                    <h4> '.$resultat['Nom'].'</h4>
                                    <img src="./img/'.$resultat['Image'].'" width = "200px"> 
                                    <p>
                                        Couleur : '.$resultat['Couleur'].'
                                    </p>
                                    <p>
                                        Prix : '.$resultat['Prix'].'€
                                    </p>
                                    <a href="./panier.php?removeallid='.$resultat['idBatterie'].'" class="btn btn-primary" type="submit">Supprimer du panier</a>
                                    <p> Quantité : <div class="d-flex flex-row justify-content-center">
                                                    <div style="text-align:center"><a href="./panier.php?removeid='.$resultat['idBatterie'].'" class="qte_a"> - </a>
                                                </div>
                                                <span class="qte_span">'.$qte. '</span>
                                                <div style="text-align:center">
                                                    <a href="./panier.php?id='.$resultat['idBatterie'].'" class="qte_a"> + </a>
                                                </div>
                                            </div>
                                    </p>
                                    </div>';
                    
                    }
                echo '</div>'; 
                }
                if(isset($_SESSION['panierListe']['produit']) && count($_SESSION['panierListe']) > 0){
                    foreach($_SESSION['panierListe']['produit'] as $id => $qte){
                        $sql = 'select p.idProduit, Prix, Couleur, Image, Nom' ;
                        $sql .= ' from produit p '; 
                        // le paramètre est nommée :<nom> 
                        $sql .= ' where p.idProduit = '.$id.''; 
                        
                        // exécute la requête 
                        $result = $cnx->query($sql); 
                    
                        // nb lignes résultat 
                        $nb_lignes = mysqli_num_rows($result); 
                    
                        $resultat = mysqli_fetch_array($result);

                        $prixtot += $resultat['Prix'] * $qte;
                        echo '<div class="col-sm-3 center product">
                                    <h4> '.$resultat['Nom'].'</h4>
                                    <img src="./img/'.$resultat['Image'].'" width="200px" height="200px" > 
                                    <p>
                                        Couleur : '.$resultat['Couleur'].'
                                    </p>
                                    <p>
                                        Prix : '.$resultat['Prix'].'€
                                    </p>
                                    <a href="./panier.php?removeallidProduit='.$resultat['idProduit'].'" class="btn btn-primary" type="submit">Supprimer du panier</a>
                                    <p> Quantité : <div class="d-flex flex-row justify-content-center">
                                                    <div style="text-align:center">
                                                        <a href="./panier.php?removeidProduit='.$resultat['idProduit'].'" class="qte_a"> - </a>
                                                    </div><span class="qte_span">'.$qte. '</span>
                                                    <div style="text-align:center">
                                                        <a href="./panier.php?idProduit='.$resultat['idProduit'].'" class="qte_a"> + </a>
                                                    </div>
                                                </div>
                                    </p>
                                    </div>';
                    
                    }
                echo '</div>';
                }
                echo '<p>
                    Prix totale : '.$prixtot.'€
                </p>';

                echo '<div class="d-flex flex-row bouton">
                    <input type="submit" name="submit" id="Valider" value="Valider">
                    <div id="annuler">
                        <a href="index.php">Annuler</a>
                    </div>
                </div>';
            } else {
                echo ' Votre panier est vide ';
            }             
            ?>
        </div>
    </form>
</div>
