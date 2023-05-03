<?php

require_once('./repository/ProduitRepository.php');
require_once('./model/Produit.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'admin':
        $resultat = ProduitRepository::selectTousProduit();
        include './view/admin.php';
    break;
    
    case 'ajoutProduit':
        include './view/ajoutProduit.php';

    case 'verificationAjout':

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
                    header('Location ./index.php?uc=admin&action=admin&inserted=true');

                } catch (Exception $ex) {
                    header('Location: ./index.php?uc=admin&action=ajoutProduit&error=true');
                    exit;
                }
            }
        }
        break;

    case 'infoProduit':

        $Produit = ProduitRepository::selectInfoProduit(31);

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

        include './view/modifProduit.php';
        break;
    
    case 'verificationModif':

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

                if(empty($seuilAlert)){
                    $valid = false;
                    $er_seuilAlert = ("Le sueil d'alerte du produit ne peut pas être vide");
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

                    $sql = ProduitRepository::updateProduit($Produit);

                    if ($sql == TRUE) {
                        header("Location: ./index.php?uc=admin&action=infoProduit&modif=true");
                    } else {
                        echo "Error: La modification n'a pas été faite";
                    }
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
}