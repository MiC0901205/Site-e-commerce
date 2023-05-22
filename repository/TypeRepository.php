<?php

require_once('./model/login_db.php');

class TypeRepository {

    public static function getTypesProduits() {
            $db = loginDB();

            $sql = $db->prepare('SELECT idType, libelle FROM type');
            $sql->execute();

            $db = null;

            return $sql;
    }

    public static function deleteType($idType) {
        $db = loginDB();

        $req = $db->prepare('UPDATE `produit` SET `idType`= 0 WHERE idType = :id');
        $req->bindParam(':id', $idType);
        $req->execute();

        $sql = $db->prepare('DELETE FROM type WHERE idType = :id');
        $sql->bindParam(':id', $idType);
        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function insertType($libelle) {
        $db = loginDB();

        $sql = $db->prepare('INSERT INTO `type`(`libelle`) VALUES (:libelle)');
        $sql->bindParam(':libelle', $libelle);
        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function selectInfoType($id) {
        $db = loginDB();

        $sql = $db->prepare('SELECT libelle FROM type WHERE idType = :id');
        $sql->bindParam(':id', $id);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Type'); 
        $req = $sql->fetch();

        $db = null;

        return $req;
    }

    public static function updateType($type) {
        $db = loginDB();
        
        $sql= $db->prepare("UPDATE `type` SET libelle = :libelle WHERE idType = :idType"); 
        $sql->bindParam(':libelle', $type->getLibelle());
        $sql->bindParam(':idType', $type->getId());
        $sql->execute();

        $db = null;

        return $sql;
    }
}
?>