<?php
session_start();

if(!isset($_SESSION['panierListe']))
{
    header('Location: historique_cmd.php');
    exit;
}

include_once './view/navbar.php';

include './model/Connexion_db.php'; 
 
// exécute la requête paramétrée 
try{ 

    $sql = " SELECT idClient FROM client Where adresse_mail = '".$_SESSION['adresse_mail']."';";
    $result = $cnx->query($sql); 
    $resultat = mysqli_fetch_array($result);

    $sql = ' INSERT INTO `commandes` (`date`, `idClient`)';
    $sql .= " VALUES (CURRENT_TIMESTAMP, '".$resultat['idClient']."');";
    if ($cnx->query($sql) === TRUE) {

        $sql = 'SELECT max(idCommande) as idCommande FROM commandes;';
        $result = $cnx->query($sql); 
        $resultat = mysqli_fetch_array($result);
    
        $cmd_id = $resultat['idCommande'];
        echo "Votre commande a était validé et est référencé à l'id $cmd_id";
        if(isset($_SESSION['panierListe']['produit'])){
            foreach($_SESSION['panierListe']['produit'] as $id => $qte){
                $sql = ' INSERT INTO `commande_produit` (`idCommande`, `idProduit`, `qte`)';
                $sql .= " VALUES ($cmd_id, $id, $qte);";
                if ($cnx->query($sql) === TRUE) {
                } else {
                    echo "Error: " . $sql . "<br>" . $cnx->error;
                }
            }
        } 
        if(isset($_SESSION['panierListe']['batterie'])){
            foreach($_SESSION['panierListe']['batterie'] as $id => $qte){
                $sql = ' INSERT INTO `commandes_batterie` (`idCommande`, `idBatterie`, `qte`)';
                $sql .= " VALUES ($cmd_id, $id, $qte);";
                if ($cnx->query($sql) === TRUE) {
                } else {
                    echo "Error: " . $sql . "<br>" . $cnx->error;
                }
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $cnx->error;
    }
    // ferme la connexion 
    unset($cnx); 
} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage()); 
} 
unset($_SESSION['panierListe']);
?>
</br>
</br>
<a href="historique_cmd">Voir votre historique</a>
