<?php

require_once('./model/login_db.php');
require_once('./model/Commande.php');

class CommandeRepository {

    public static function insertCommande($idClient) {
        $db = loginDB();

        $sql = $db->prepare("INSERT INTO `commandes`(`date`, `idClient`) VALUES (CURRENT_TIMESTAMP, :idClient);");
        $sql->bindParam(':idClient', $idClient);
        $sql->execute();
        
        $db = null;

        return $sql;
    }

    public static function selectLastCommande() {
        $db = loginDB();

        $sql = $db->prepare('SELECT max(idCommande) as idCommande FROM commandes;');
        $sql->execute(); 
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Commande'); 
        $req = $sql->fetch();
        
        $db = null;

        return $req;
    }

    public static function InsertCmdWithProd($idCommande, $idProduit, $qte) {
        $db = loginDB();

        $sql = $db->prepare("INSERT INTO `commande_produit`(`idCommande`, `idProduit`, `qte`) VALUES (:idCommande, :idProduit, :qte);");
        $sql->bindParam(':idCommande', $idCommande);
        $sql->bindParam(':idProduit', $idProduit);
        $sql->bindParam(':qte', $qte);

        $sql->execute(); 

        $db = null;

        return $sql;
    }
}