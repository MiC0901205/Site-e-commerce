<?php

require_once('./model/login_db.php');
require_once('./model/Client.php');

class ClientRepository {

    public static function insertClient($nom, $prenom, $adresse, $mail, $ville, $cp, $tel, $mdp) {
        $db = loginDB();
        $sql= $db->prepare("INSERT INTO `client` (`nom`, `prenom`, `adresse`, `adresse_mail`, `confirm_mail`, `cle`, `ville`, `cp`, `tel`, `mdp`) VALUES (:nom, :prenom, :adresse, :adresse_mail, :confirm_mail, :cle, :ville, :cp, :tel, :mdp)");
        $sql->execute(array('nom' => $nom, 'prenom' => $prenom, 'adresse' => $adresse, 'adresse_mail' => $mail, 'confirm_mail' => 0, 'cle' => '', 'ville' => $ville, 'cp' => $cp, 'tel' => $tel, 'mdp' => $mdp));
        
        $db = null;

        return $sql;
    }

    public static function selectMail($mail){
        $db = loginDB();
        $req_mail = $db->prepare("SELECT adresse_mail FROM client WHERE adresse_mail = :mail");
        $req_mail->bindParam(':mail', $mail);
        $req_mail->execute();

        $req_mail->setFetchMode(PDO::FETCH_CLASS, 'Client'); 
        $req = $req_mail->fetch();

        $db = null;

        return $req;
    }

    public static function recupUser($mail, $mdp){
        $db = loginDB();

        $recupUser = $db->prepare('SELECT adresse_mail, mdp, idClient, isAdmin FROM client WHERE adresse_mail = :mail AND mdp = :mdp AND confirm_mail = 1');
        $recupUser->bindParam(':mail', $mail);
        $recupUser->bindParam(':mdp', $mdp);
        $recupUser->execute();

        $db = null;

        return $recupUser;
    }

    public static function recupCle($mail) {
        $db = loginDB();

        $req = $db->prepare('SELECT cle FROM client WHERE adresse_mail = :adresse_mail');
        $req->bindParam(':adresse_mail', $mail);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS, 'Client'); 
        $cle = $req->fetch();

        $db = null; 

        return $cle;
    }

    public static function selectUser($cle, $login){
        $db = loginDB();

        $sql = $db->prepare("SELECT * From client Where cle = :cle And adresse_mail = :adresse_mail");
        $sql->bindParam(':cle', $cle);
        $sql->bindParam(':adresse_mail',  $login);
        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_CLASS, 'Client'); 
        $rows = $sql->fetch();

        $db = null;

        return $rows;
    }

    public static function updateConfirmMail($param, $mail){
        $db = loginDB();

        $req = $db->prepare("UPDATE client SET confirm_mail= :confirm_mail WHERE adresse_mail like :adresse_mail");
        $req->bindParam(':confirm_mail', $param);
        $req->bindParam(':adresse_mail', $mail);
        $req->execute();
        

        $db = null;

        return $req;

    }

    public static function updateCle($cle, $login) {
        $db = loginDB();

        $sql = $db->prepare("UPDATE client SET cle= :cle WHERE adresse_mail like :mail ");
        $sql->bindParam(':cle', $cle);
        $sql->bindParam(':mail', $login);
        $sql->execute();

        $db = null; 

        return $sql;
    }

    public static function updateUser($client) {
        $db = loginDB();
        
        $sql= $db->prepare("UPDATE `client` SET nom = :nom, prenom = :prenom, adresse = :adresse, ville = :ville, cp = :cp, tel = :tel WHERE adresse_mail = :mail"); 
        $sql->bindParam(':nom', $client->getNom());
        $sql->bindParam(':prenom', $client->getPrenom());
        $sql->bindParam(':adresse', $client->getAdresse());
        $sql->bindParam(':ville', $client->getVille());
        $sql->bindParam(':cp', $client->getCp());
        $sql->bindParam(':tel', $client->getTel());
        $sql->bindParam(':mail', $client->getAdresseMail());

        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function selectInfoClient($mail) {
        $db = loginDB();

        $sql = $db->prepare('SELECT nom, prenom, adresse, ville, cp, tel FROM client WHERE adresse_mail = :mail');   
        $sql->bindParam(':mail', $mail);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Client'); 
        $req = $sql->fetch();

        $db = null;

        return $req;
    }

    public static function historiqueCmd($mail) {
        $db = loginDB();

        $sql = $db->prepare('SELECT co.idCommande, date FROM commandes co JOIN client cl on cl.idClient = co.idClient WHERE adresse_mail = :mail');   
        $sql->bindParam(':mail', $mail);
        // exécute la requête 
        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function RecupProdByCmd($uneCommande) {
        $db = loginDB();

        $sql = $db->prepare('SELECT nom, qte, prix FROM commande_produit C JOIN commandes co on co.idCommande = C.idCommande JOIN produit p on p.idProduit = C.idProduit WHERE co.idCommande = :idCmd');  
        $sql->bindParam(':idCmd', $uneCommande['idCommande']);
        $sql->execute();

        $db = null;

        return $sql;

    }
}