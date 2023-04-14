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
}

?>
