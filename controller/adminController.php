<?php

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'admin':
        include './view/admin.php';
    break;
    
    case 'ajoutProduit':
       include './view/ajoutProduit.php';

}