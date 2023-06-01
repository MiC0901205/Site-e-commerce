<?php

require_once('./repository/ProduitRepository.php');
require_once('./repository/UserRepository.php');
require_once('./repository/TypeRepository.php');
require_once('./model/Produit.php');
require_once('./model/User.php');
require_once('./model/Type.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'admin':
        include './view/admin.php';
    break;

    case 'adminProduit':
        $resultat = ProduitRepository::selectTousProduit();
        $typesProduits = TypeRepository::getTypesProduits();
        include './view/adminProduit.php';
    break;
    
    case 'adminUser':
        $resultat = UserRepository::selectTousUser();
        include './view/adminUser.php';
    break;

    case 'adminType':
        $resultat = TypeRepository::getTypesProduits();
        include './view/adminType.php';
    break;

    case 'supprimerUser':
        $LesCmd = UserRepository::getLesCommandesByUser($_GET['id']);

        if(count($LesCmd) > 0) {
            foreach ($LesCmd as $idCommande) {
                UserRepository::deleteCmdP($idCommande);
                UserRepository::deleteStatutCmd($idCommande);
            }
            UserRepository::deleteCmd($_GET['id']);
        }

        UserRepository::deleteUser($_GET['id']);
        header('Location: ./index.php?uc=admin&action=adminUser&removeid='.$_GET['id'].'');
    break;

    case 'supprimerProduit':
        ProduitRepository::deleteProduit($_GET['idProduit']);
        header('Location: ./index.php?uc=admin&action=adminProduit&removeid='.$_GET['idProduit'].'');
    break;

    case 'supprimerType':
        TypeRepository::deleteType($_GET['idType']);
        header('Location: ./index.php?uc=admin&action=adminType&removeid='.$_GET['idType'].'');
    break;

    case 'ajoutProduit':
        $typesProduits = TypeRepository::getTypesProduits();
        include './view/ajoutProduit.php';
    break;

    case 'ajoutUser':
        include './view/ajoutUser.php';
    break;

    case 'ajoutType':
        include './view/ajoutType.php';
    break;

    case 'verificationAjoutProduit':

        $valid = true;

        if (!empty($_POST)) {
            // On récupère les données du formulaire
            $nom = htmlentities(trim($_POST['nom']));
            $prix = htmlentities(trim($_POST['prix']));
            $couleur = htmlentities(trim($_POST['couleur']));
            $image = htmlentities(trim($_POST['image']));
            $largeur = htmlentities(trim($_POST['largeur']));
            $longueur = htmlentities(trim($_POST['longueur']));
            $hauteur = htmlentities(trim($_POST['hauteur']));
            $poids = htmlentities(trim($_POST['poids']));
            $description = htmlentities(trim($_POST['description']));
            $qteStock = htmlentities(trim($_POST['qteStock']));
            $seuilAlert = htmlentities(trim($_POST['seuilAlert']));
            $idType = htmlentities(trim($_POST['idType']));

            // On vérifie que les champs obligatoires ne sont pas vides
            if (empty($nom)) {
                $valid = false;
            }

            if (empty($prix)) {
                $valid = false;
            }

            if (empty($couleur)) {
                $valid = false;
            }

            if (empty($largeur)) {
                $valid = false;
            }

            if (empty($longueur)) {
                $valid = false;
            }

            if (empty($hauteur)) {
                $valid = false;
            }

            if (empty($poids)) {
                $valid = false;
            }

            if (empty($description)) {
                $valid = false;
            }

            if (empty($qteStock)) {
                $valid = false;
            }

            if (empty($seuilAlert)) {
                $valid = false;
            }

            if (empty($idType)) {
                $valid = false;
            }
            
            // Si il n'y a pas d'erreur, on insère les données dans la base de données
            if ($valid) {
                try {
                    ProduitRepository::insertProduit($nom, $prix, $couleur, $image, $largeur, $longueur, $hauteur, $poids, $description, $qteStock, $seuilAlert, $idType);
                    header('Location: ./index.php?uc=admin&action=adminProduit&inserted=true');

                } catch (Exception $ex) {
                    header('Location: ./index.php?uc=admin&action=ajoutProduit&error=true');
                    exit;
                }
            }
        }
        break;
    
    case 'verificationAjoutUser':

        $valid = true;

        if (!empty($_POST)) {
            $nom = htmlentities(trim($_POST['nom'])); // On récupère le nom
            $prenom = htmlentities(trim($_POST['prenom'])); // on récupère le prénom
            $adresse = htmlentities(trim($_POST['adresse'])); // on récupère l'adresse
            $adresse_mail = htmlentities(strtolower(trim($_POST['adresse_mail']))); // On récupère le mail
            $ville = htmlentities(trim($_POST['ville'])); // on récupère la ville
            $cp = htmlentities(trim($_POST['cp'])); // on récupère le code postal
            $tel = htmlentities(trim($_POST['tel'])); // on récupère le numero de tel
            $mdp = trim($_POST['mdp']); // On récupère le mot de passe 
            $confmdp = trim($_POST['confmdp']); //  On récupère la confirmation du mot de passe
            $role = htmlentities(trim($_POST['role'])); 
    
            if(empty($nom)){
                $valid = false;
            }


            if(empty($prenom)){
                $valid = false;
            }


            if(empty($cp)){
                $valid = false;
            }

            if(empty($adresse_mail)){
                $valid = false;
                
            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i", $adresse_mail)){
                $valid = false;
            }else{
                $req = UserRepository::selectMail($adresse_mail);
                if($req <> ""){
                    $valid = false;
                    $error = true;
                }
            }

            
            if(empty($ville)){
                $valid = false;
            }
            elseif(!preg_match('/[0-9]{5}/', $cp)){
                $valid = false;
            }              

            if(!preg_match('/^[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$/', $tel)){
                $valid = false;
            }  

            function isPasswordStrong($password) {
                // Au moins 8 caractères
                if (strlen($password) < 8) {
                    return false;
                }
            
                // Au moins une lettre minuscule, une lettre majuscule et un chiffre
                if (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
                    return false;
                }
            
                // Au moins un caractère spécial
                if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
                    return false;
                }
            
                return true;
            }

            
            if (empty($mdp)) {
                $valid = false;
            } elseif (!isPasswordStrong($mdp)) {
                $valid = false;
                $errorMdp = true;
            }elseif($mdp != $confmdp){
                $valid = false;
            }

            // Si il n'y a pas d'erreur, on insère les données dans la base de données
            if ($valid) {
                $mdp = hash('sha256', $_POST['mdp']);

                try {
                    $sql = UserRepository::insertUserAdmin($nom, $prenom, $adresse, $adresse_mail, $ville, $cp, $tel, $mdp, $role); 
                    header('Location: ./index.php?uc=admin&action=adminUser&inserted=true');
                } catch (Exception $ex){
                    header('Location: ./index.php?uc=admin&action=ajoutUser&error=true');
                    exit;
                }
            }
        }
        break;

    case 'verificationAjoutType':

        $valid = true;

        if (!empty($_POST)) {
            // On récupère les données du formulaire
            $libelle = htmlentities(trim($_POST['libelle']));

            // On vérifie que les champs obligatoires ne sont pas vides
            if (empty($libelle)) {
                $valid = false;
            }
            
            // Si il n'y a pas d'erreur, on insère les données dans la base de données
            if ($valid) {
                try {
                    TypeRepository::insertType($libelle);
                    header('Location: ./index.php?uc=admin&action=adminType&inserted=true');

                } catch (Exception $ex) {
                    header('Location: ./index.php?uc=admin&action=ajoutType&error=true');
                    exit;
                }
            }
        }
        break;

    case 'infoProduit':

        $Produit = ProduitRepository::selectInfoProduit($_GET['id']);

        $nom = $Produit->getNom();
        $prix = $Produit->getPrix();
        $couleur = $Produit->getCouleur();
        $image = $Produit->getImage();
        $largeur = $Produit->getLargeur();
        $longueur = $Produit->getLongueur();
        $hauteur = $Produit->getHauteur();
        $poids = $Produit->getPoids();
        $description = $Produit->getDescription();
        $qteStock = $Produit->getQteStock();
        $seuilAlert = $Produit->getSeuilAlert();
        $idType = $Produit->getIdType();

        $types = array(
            1 => "Batterie",
            2 => "Souris",
            3 => "Clavier",
            4 => "Cable de recharge"
        );
        
        $type = isset($types[$idType]) ? $types[$idType] : "";
        
        include './view/modifProduit.php';
        break;

    case 'infoUser':

        $User = UserRepository::selectInfoUser($_GET['id']);

        $nom = $User->getNom();
        $prenom = $User->getPrenom();
        $adresse = $User->getAdresse();
        $adresse_mail = $User->getAdresseMail();
        $ville = $User->getVille();
        $cp = $User->getCp();
        $tel = $User->getTel();
        $role = $User->getRole();

        $roles = array(
            1 => "ROLE_USER",
            2 => "ROLE_ADMIN",
            3 => "ROLE_ADMIN_MAUI"
        );
        
        $roleUser = isset($types[$role]) ? $types[$role] : "";
        
        include './view/modifUser.php';
    break;

    case 'infoType':

        $type = TypeRepository::selectInfoType($_GET['id']);

        $libelle = $type->getLibelle();
        
        include './view/modifType.php';
        break;
    
    case 'verificationModifProduit':
        // S il y a une session alors on ne retourne plus sur cette page 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
    
        // Si la variable "$_Post" contient des informations alors on les traitres 
        if(!empty($_POST)){

            extract($_POST);
            $valid = true;
    
            if (isset($_POST)){ 

                $nom = htmlentities(trim($nom));
                $prix = htmlentities(trim($prix));
                $couleur = htmlentities(trim($couleur));
                $image = htmlentities(trim($image));
                $largeur = htmlentities(trim($largeur));
                $longueur = htmlentities(trim($longueur));
                $hauteur = htmlentities(trim($hauteur));
                $poids = htmlentities(trim($poids));
                $description = htmlentities(trim($description));
                $qteStock = htmlentities(trim($qteStock));
                $seuilAlert = htmlentities(trim($seuilAlert));
                $idType = htmlentities(trim($idType));      
        
                if(empty($nom)){
                    $valid = false;
                    $er_nom = ("Le nom de produit ne peut pas être vide");
                }

                if(empty($prix)){
                    $valid = false;
                    $er_prix = ("Le prix du produit ne peut pas être vide");
                }
                
                if(empty($couleur)){
                    $valid = false;
                    $er_couleur = ("La couleur du produit ne peut pas être vide");
                }

                if(empty($image)){
                    $valid = false;
                    $er_image = ("L'image du produit ne peut pas être vide");
                }

                if(empty($largeur)){
                    $valid = false;
                    $er_largeur = ("La largeur du produit ne peut pas être vide");
                }        
            
                if(empty($longueur)){
                    $valid = false;
                    $er_longueur = ("La longueur du produit ne peut pas être vide");
                } 

                if(empty($hauteur)){
                    $valid = false;
                    $er_hauteur = ("La hauteur du produit ne peut pas être vide");
                } 

                if(empty($poids)){
                    $valid = false;
                    $er_poids = ("Le poids du produit ne peut pas être vide");
                } 

                if(empty($description)){
                    $valid = false;
                    $er_description = ("La description du produit ne peut pas être vide");
                } 

                if(empty($qteStock)){
                    $valid = false;
                    $er_qteStock = ("La quantité en stock du produit ne peut pas être vide");
                } 

                if($seuilAlert === ''){
                    $valid = false;
                    $er_seuilAlert = ("Le seuil d'alerte du produit ne peut pas être vide");
                } 
                

                if(empty($idType)){
                    $valid = false;
                    $er_idType = ("Le type du produit ne peut pas être vide");
                } 
                
                if($valid)
                {   
                    $Produit = new Produit();
                    $Produit->setNom($nom);
                    $Produit->setPrix($prix);
                    $Produit->setCouleur($couleur);
                    $Produit->setImage($image);
                    $Produit->setLargeur($largeur);
                    $Produit->setLongueur($longueur);
                    $Produit->setHauteur($hauteur);
                    $Produit->setPoids($poids);
                    $Produit->setDescription($description);
                    $Produit->setQteStock($qteStock);
                    $Produit->setSeuilAlert($seuilAlert);
                    $Produit->setIdType($idType);
                    $Produit->setId($_GET['idProduit']);

                    $sql = ProduitRepository::updateProduit($Produit);

                    if ($sql == TRUE) {
                        header("Location: ./index.php?uc=admin&action=adminProduit&modif=1");
                    } else {
                        echo "Error: La modification n'a pas été faite";
                    }
                } else {
                    header("Location: ./index.php?uc=admin&action=adminProduit&modif=0");
                }
            }
        } else {
            try{ 

                $Produit = ProduitRepository::selectInfoProduit($_POST['idProduit']);

                $nom = $Produit->getNom();
                $prix = $Produit->getPrix();
                $couleur = $Produit->getCouleur();
                $image = $Produit->getImage();
                $largeur = $Produit->getLargeur();
                $longueur = $Produit->getLongueur();
                $hauteur = $Produit->getHauteur();
                $poids = $Produit->getPoids();
                $description = $Produit->getDescription();
                $qteStock = $Produit->getQteStock();
                $seuilAlert = $Produit->getSeuilAlert();
                $idType = $Produit->getIdType();
    
            } catch (Exception $ex) {
                die('Erreur : ' . $ex->getMessage()); 
            } 
        }
    break; 

    case 'verificationModifUser':
        // S il y a une session alors on ne retourne plus sur cette page 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
    
        // Si la variable "$_Post" contient des informations alors on les traitres 
        if(!empty($_POST)){

            extract($_POST);
            $valid = true;
    
            if (isset($_POST)){ 

                $nom = htmlentities(trim($nom));
                $prenom = htmlentities(trim($prenom));
                $adresse = htmlentities(trim($adresse));
                $adresse_mail = htmlentities(trim($adresse_mail));
                $ville = htmlentities(trim($ville));
                $cp = htmlentities(trim($cp));
                $tel = htmlentities(trim($tel));
                $role = htmlentities(trim($role));
               
                if(empty($nom)){
                    $valid = false;
                    $er_nom = ("Le nom d' utilisateur ne peut pas être vide");
                }

                if(empty($prenom)){
                    $valid = false;
                    $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
                }
                
                if(empty($adresse)){
                    $valid = false;
                    $er_adresse = ("L'adresse de l' utilisateur ne peut pas être vide");
                }

                if(empty($adresse_mail)){
                    $valid = false;
                    $er_adresse_mail = ("L'adresse mail de l' utilisateur ne peut pas être vide");
                }

                if(empty($ville)){
                    $valid = false;
                    $er_ville = ("La ville ne peut pas être vide");
                }

                if(empty($cp)){
                    $valid = false;
                    $er_cp = ("Le code postal ne peut pas être vide");
                }
                elseif(!preg_match('/[0-9]{5}/', $cp)){
                    $valid = false;
                    $er_cp = "Le code postal n'est pas valide";

                }         
            
                if(!preg_match('/^[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$/', $tel)){
                    $valid = false;
                    $er_tel = "Le numéro de tel n'est pas valide";
                }
                
                if(empty($role)){
                    $valid = false;
                    $er_role = ("Le role de l'utilisateur ne peut pas être vide");
                } 

                if($valid == 1)
                {   
                    $client = new User();
                    $client->setNom($nom);
                    $client->setPrenom($prenom);
                    $client->setAdresse($adresse);
                    $client->setAdresseMail($adresse_mail);
                    $client->setVille($ville);
                    $client->setCp($cp);
                    $client->setTel($tel);
                    $client->setRole($role);
                    $client->setId($_GET['id']);

                    $sql = UserRepository::updateUserAdmin($client);

                    if ($sql == TRUE) {
                        header("Location: ./index.php?uc=admin&action=adminUser&modif=1");
                    } else {
                        echo "Error: La modification n'a pas été faite";
                    }
                } else {
                    header("Location: ./index.php?uc=admin&action=adminUser&modif=0");
                }
            }
        } else {
            try{ 

                $Client = UserRepository::selectInfoUser($_POST['id']);

                $nom = $Client->getNom();
                $prenom = $Client->getPrenom();
                $adresse = $Client->getAdresse();
                $adresse_mail = $client->getAdresseMail();
                $ville = $Client->getVille();
                $cp = $Client->getCp();
                $tel = $client->getTel();
                $role = $client->getRole();

    
            } catch (Exception $ex) {
                die('Erreur : ' . $ex->getMessage()); 
            } 
        }
    break; 

    case 'verificationModifType':
        // S il y a une session alors on ne retourne plus sur cette page 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
    
        // Si la variable "$_Post" contient des informations alors on les traitres 
        if(!empty($_POST)){

            extract($_POST);
            $valid = true;
    
            if (isset($_POST)){ 

                $libelle = htmlentities(trim($libelle));   
        
                if(empty($libelle)){
                    $valid = false;
                    $er_libelle = ("Le libelle du type ne peut pas être vide");
                }
                
                if($valid)
                {   
                    $Type = new Type();
                    $Type->setId($_GET['idType']);
                    $Type->setLibelle($libelle);

                    $sql = TypeRepository::updateType($Type);

                    if ($sql == TRUE) {
                        header("Location: ./index.php?uc=admin&action=adminType&modif=1");
                    } else {
                        echo "Error: La modification n'a pas été faite";
                    }
                } else {
                    header("Location: ./index.php?uc=admin&action=adminType&modif=0");
                }
            }
        } else {
            try{ 

                $Type = TypeRepository::selectInfoType($_POST['idType']);

                $libelle = $Type->getLibelle();
    
            } catch (Exception $ex) {
                die('Erreur : ' . $ex->getMessage()); 
            } 
        }
    break; 
    
    default :
        include './view/admin.php';
    break;
}