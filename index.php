<?php

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_URL);
if(empty($uc))
{
    $uc = 'accueil';
}

switch ($uc) {
    
    case 'login':
        include 'controller/verificationController.php';
        break;

    case 'register':
        include 'controller/authentificationController.php';
        break;
    
    case 'mail':
        include 'controller/verificationController.php';
        break;
            
    case 'validation':
        include 'controller/authentificationController.php';
        break;

    case 'logout':
        include 'controller/authentificationController.php';
        break;

    case 'accueil':
        include 'view/accueil.php';
        break;
    
    case 'footer':
        include 'controller/infoFooterController.php';
        break;

    case 'produit':
        include 'controller/produitController.php';
        break;

    case 'infoClient':
        include 'controller/infoClientController.php';
        break;

    case 'panier':
        include 'controller/panierController.php';
        break;

    case 'admin':
        include 'controller/adminController.php';
        break;
}

?>
