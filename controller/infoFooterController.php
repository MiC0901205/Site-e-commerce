<?php 

require_once('./model/login_db.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);

switch ($action) {
    case 'conditionUtilisation':
        include 'view/terms_of_Use.php';
        break;

    case 'mentionLegale':
        include 'view/legal_notice.php';
        break;

    case 'cookies':
        include 'view/use_of_Cookies.php';
        break;
}