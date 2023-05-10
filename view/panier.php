<?php
include 'navbar.php'; 
require_once('./repository/ProduitRepository.php');

?>
<link rel="stylesheet" href="../css/panier.css">
<div id="panier"> 
    <form action="./index.php?uc=paiement&action=paiement" method="POST">
        <h1>Panier</h1>
        <div id="commandes">
            <?php

            echo "<div class='col-sm-4'>
            <h4> Commandes de l'utilisateur : $prenom $nom</h4>
            </div>";
    
            echo '<div class="row justify-content-around">';   

            if(isset($_SESSION['panierListe']) && (isset($_SESSION['panierListe']['produit']) && count($_SESSION['panierListe']['produit']) > 0)) {
                if(isset($_SESSION['panierListe']['produit']) && count($_SESSION['panierListe']) > 0){
                    foreach($_SESSION['panierListe']['produit'] as $id => $qte){
                        if(!empty($id)) {
                            $Produit = ProduitRepository::selectProduitById($id);
                            
                            $idProduit = $Produit->getId();
                            $prix = $Produit->getPrix();
                            $couleur = $Produit->getCouleur();
                            $image = $Produit->getImage();
                            $nom = $Produit->getNom();

                            $prixtot += $prix * $qte;

                            echo '<div class="col-sm-3 center product">
                                        <h4> '.$nom.'</h4>
                                        <img class="img_Prod" src="./img/'.$image.'" width = "200px"> 
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
                        } else {
                            echo "Il n' y a pas d'id correspondant à un produit";
                        }
                    }
                echo '</div>';
                }

                echo '<p>
                Prix totale : '.$prixtot.'€
                </p>';

            echo '<div class="d-flex flex-row bouton">
                    <input class="btn-valider" type="submit" name="submit" id="Valider" value="Payer">
                    <a href="./index.php?uc=accueil" id="annuler">Annuler</a>
                </div>
            </div>';
            
            } else {
                echo ' Votre panier est vide ';
            }             
            ?>
        </div>
    </form>
</div>
