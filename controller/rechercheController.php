<?php
require_once('./repository/ProduitRepository.php');


$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {

    case 'search':

        $search = $_POST['search'];

        if ($search == ""){
            $error = true;
        } else {   
            $resultProduit = ProduitRepository::searchProduit($search);

            if(count($resultProduit) == 0){
                $error2 = true;
            }
        }
        include './view/recherche.php';
    break;
}