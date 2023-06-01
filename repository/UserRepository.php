<?php
require_once('./model/login_db.php');
require_once('./model/User.php');
require_once('./model/Commande.php');

class UserRepository {

    public static function insertUser($nom, $prenom, $adresse, $mail, $ville, $cp, $tel, $mdp) {
        $db = loginDB();
        $sql= $db->prepare("INSERT INTO `user` (`nom`, `prenom`, `adresse`, `adresse_mail`, `confirm_mail`, `cle`, `ville`, `cp`, `tel`, `mdp`, `role`) VALUES (:nom, :prenom, :adresse, :adresse_mail, :confirm_mail, :cle, :ville, :cp, :tel, :mdp, :role)");
        $sql->bindValue(':nom', $nom);
        $sql->bindValue(':prenom', $prenom);
        $sql->bindValue(':adresse', $adresse);
        $sql->bindValue(':adresse_mail', $mail);
        $sql->bindValue(':confirm_mail', '0');
        $sql->bindValue(':cle', '');
        $sql->bindValue(':ville', $ville);
        $sql->bindValue(':cp', $cp);
        $sql->bindValue(':tel', $tel);
        $sql->bindValue(':mdp', $mdp);
        $sql->bindValue(':role', 'ROLE_USER');
        
        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function deleteUser($id) {
        $db = loginDB();

        $sql = $db->prepare('DELETE FROM `user` WHERE id = :id');
        $sql->bindParam(':id', $id);
        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function selectMail($mail){
        $db = loginDB();
        $req_mail = $db->prepare("SELECT adresse_mail FROM user WHERE adresse_mail = :mail");
        $req_mail->bindParam(':mail', $mail);
        $req_mail->execute();

        $req_mail->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $req = $req_mail->fetch();

        $db = null;

        return $req;
    }

    public static function recupUser($mail, $mdp){
        $db = loginDB();

        $recupUser = $db->prepare('SELECT adresse_mail, mdp, id, role FROM user WHERE adresse_mail = :mail AND mdp = :mdp AND confirm_mail = 1');
        $recupUser->bindParam(':mail', $mail);
        $recupUser->bindParam(':mdp', $mdp);
        $recupUser->execute();

        $db = null;

        return $recupUser;
    }

    public static function recupCle($mail) {
        $db = loginDB();

        $req = $db->prepare('SELECT cle FROM user WHERE adresse_mail = :adresse_mail');
        $req->bindParam(':adresse_mail', $mail);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $cle = $req->fetch();

        $db = null; 

        return $cle;
    }

    public static function selectUser($cle, $login){
        $db = loginDB();

        $sql = $db->prepare("SELECT * From user Where cle = :cle And adresse_mail = :adresse_mail");
        $sql->bindParam(':cle', $cle);
        $sql->bindParam(':adresse_mail',  $login);
        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $rows = $sql->fetch();

        $db = null;

        return $rows;
    }

    public static function updateConfirmMail($param, $mail){
        $db = loginDB();

        $req = $db->prepare("UPDATE user SET confirm_mail= :confirm_mail WHERE adresse_mail like :adresse_mail");
        $req->bindParam(':confirm_mail', $param);
        $req->bindParam(':adresse_mail', $mail);
        $req->execute();
        

        $db = null;

        return $req;

    }

    public static function updateCle($cle, $login) {
        $db = loginDB();

        $sql = $db->prepare("UPDATE user SET cle= :cle WHERE adresse_mail like :mail ");
        $sql->bindParam(':cle', $cle);
        $sql->bindParam(':mail', $login);
        $sql->execute();

        $db = null; 

        return $sql;
    }

    public static function updateUser($client) {
        $db = loginDB();
        
        $sql= $db->prepare("UPDATE `user` SET nom = :nom, prenom = :prenom, adresse = :adresse, ville = :ville, cp = :cp, tel = :tel WHERE adresse_mail = :mail"); 
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

        $sql = $db->prepare('SELECT nom, prenom, adresse, ville, cp, tel FROM user WHERE adresse_mail = :mail');   
        $sql->bindParam(':mail', $mail);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $req = $sql->fetch();

        $db = null;

        return $req;
    }

    public static function historiqueCmd($mail) {
        $db = loginDB();

        $sql = $db->prepare('SELECT co.idCommande, date FROM commandes co JOIN user u on u.id = co.idUser WHERE adresse_mail = :mail');   
        $sql->bindParam(':mail', $mail);
        // exécute la requête 
        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function RecupIdUser($mail) {
        $db = loginDB();

        $sql = $db->prepare ("SELECT id FROM user Where adresse_mail = :mail");
        $sql->bindParam(':mail', $mail);
        // exécute la requête 
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $req = $sql->fetch();

        $db = null;

        return $req;
    }

    public static function selectTousUser() {
          
        // Connexion à la base de données avec PDO
        $db = loginDB();
            
        // Requête SQL pour récupérer la liste des produits
        $requete = "SELECT `id`, `nom`, `prenom`, `adresse`, `adresse_mail`, `ville`, `cp`, `tel`, `role` FROM `user`";
        $resultat = $db->query($requete);

        $db = null;

        return $resultat;
    }

    public static function updateUserAdmin($user) {
        $db = loginDB();
        
        $sql= $db->prepare("UPDATE `user` SET `nom`= :nom,`prenom`= :prenom,`adresse`= :adresse,`adresse_mail`= :adresse_mail,`ville`= :ville,`cp`= :cp,`tel`= :tel,`role`= :role WHERE id = :id"); 
        $sql->bindParam(':nom', $user->getNom());
        $sql->bindParam(':prenom', $user->getPrenom());
        $sql->bindParam(':adresse', $user->getAdresse());
        $sql->bindParam(':adresse_mail', $user->getAdresseMail());
        $sql->bindParam(':ville', $user->getVille());
        $sql->bindParam(':cp', $user->getCp());
        $sql->bindParam(':tel', $user->getTel());
        $sql->bindParam(':role', $user->getRole());
        $sql->bindParam(':id', $user->getId());

        $sql->execute();

        $db = null;

        return $sql;
    }

    public static function selectInfoUser($id) {
        $db = loginDB();

        $sql = $db->prepare('SELECT `id`, `nom`, `prenom`, `adresse`, `adresse_mail`, `confirm_mail`, `cle`, `ville`, `cp`, `tel`, `mdp`, `role` FROM `user` WHERE id = :id');   
        $sql->bindParam(':id', $id);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $req = $sql->fetch();
        
        $db = null;

        return $req;
    }

    public static function insertUserAdmin($nom, $prenom, $adresse, $mail, $ville, $cp, $tel, $mdp, $role) {
        $db = loginDB();

        $sql = $db->prepare("INSERT INTO `user` (`nom`, `prenom`, `adresse`, `adresse_mail`, `confirm_mail`, `cle`, `ville`, `cp`, `tel`, `mdp`, `role`) VALUES (:nom, :prenom, :adresse, :adresse_mail, :confirm_mail, :cle, :ville, :cp, :tel, :mdp, :role)");
        $sql->bindValue(':nom', $nom);
        $sql->bindValue(':prenom', $prenom);
        $sql->bindValue(':adresse', $adresse);
        $sql->bindValue(':adresse_mail', $mail);
        $sql->bindValue(':confirm_mail', '1');
        $sql->bindValue(':cle', 'insertByAdmin');
        $sql->bindValue(':ville', $ville);
        $sql->bindValue(':cp', $cp);
        $sql->bindValue(':tel', $tel);
        $sql->bindValue(':mdp', $mdp);
        $sql->bindValue(':role', $role);
    
        $sql->execute();
    
        $db = null;
    
        return $sql;
    }

    public static function getLesCommandesByUser($id) {
        $db = loginDB();
    
        $sql = $db->prepare('SELECT co.idCommande, date FROM commandes co JOIN user u on u.id = co.idUser WHERE u.id = :id');   
        $sql->bindParam(':id', $id);
        
        // exécute la requête 
        $sql->execute();
        
        $result = $sql->fetchAll(PDO::FETCH_COLUMN, 0); // Récupère uniquement la première colonne (idCommande)
        
        $db = null;
    
        return $result;
    }

    public static function deleteCmdP($idCommande) {
        $db = loginDB();

        $sql = $db->prepare("DELETE FROM `commande_produit` WHERE idCommande = :id");
        $sql->bindParam(':id', $idCommande);
        
        $sql->execute();
    
        $db = null;
    
        return $sql;
    }

    public static function deleteStatutCmd($idCommande) {
        $db = loginDB();

        $sql = $db->prepare("DELETE FROM `commandes_statut` WHERE idCommande = :id");
        $sql->bindParam(':id', $idCommande);
        
        $sql->execute();
    
        $db = null;
    
        return $sql;
    }


    public static function deleteCmd($id) {
        $db = loginDB();

        $sql = $db->prepare("DELETE FROM `commandes` WHERE idUser = :id");
        $sql->bindParam(':id', $id);
        
        $sql->execute();
    
        $db = null;
    
        return $sql;
    }
}