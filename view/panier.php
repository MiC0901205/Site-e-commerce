<?php
include 'navbar.php'; 
require_once('./repository/ProduitRepository.php');

?>
<link rel="stylesheet" href="./css/panier.css">
<div id="panier"> 
    <form action="../paiement.php" method="POST">
        <h1>Panier</h1>
        <div id="commandes">
            <?php

            echo '<div class="col-sm-4">
            <h4> Commandes de '.$prenom.' '.$nom.'</h4>
            </div>';
    
            echo '<div class="row justify-content-around">';   

            if(isset($_SESSION['panierListe']) && (isset($_SESSION['panierListe']['produit']) && count($_SESSION['panierListe']['produit']) > 0)) {
                if(isset($_SESSION['panierListe']['produit']) && count($_SESSION['panierListe']) > 0){
                    foreach($_SESSION['panierListe']['produit'] as $id => $qte){
                        $resultat = ProduitRepository::selectProduitById($_GET['id']);
                        
                        $idProduit = $resultat[0];
                        $prix = $resultat[1];
                        $couleur = $resultat[2];
                        $image = $resultat[3];
                        $nom = $resultat[4];

                        $prixtot += $prix * $qte;

                        echo '<div class="col-sm-3 center product">
                                    <h4> '.$nom.'</h4>
                                    <img src="./img/'.$image.'" width = "200px"> 
                                    <p>
                                        Couleur : '.$couleur.'
                                    </p>
                                    <p>
                                        Prix : '.$prix.'€
                                    </p>
                                    <a href="./index.php?uc=panier&action=panier&removeallid='.$idProduit.'" class="btn btn-primary" type="submit">Supprimer du panier</a>
                                    <p> Quantité : <div class="d-flex flex-row justify-content-center">
                                                    <div style="text-align:center"><a href="./index.php?uc=panier&action=panier&removeid='.$idProduit.'" class="qte_a"> - </a>
                                                </div>
                                                <span class="qte_span">'.$qte. '</span>
                                                <div style="text-align:center">
                                                    <a href="./index.php?uc=panier&action=panier&id='.$idProduit.'" class="qte_a"> + </a>
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
                        <a href="./index.php?uc=accueil">Annuler</a>
                    </div>
                </div>';
            } else {
                echo ' Votre panier est vide ';
            }             
            ?>
        </div>
    </form>
</div>
