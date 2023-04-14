<?php

$host = 'mysql-pecheur.alwaysdata.net';
$dbName = 'pecheur_db_site_ecommerce';
$users = 'pecheur';
$pass = 'mickap0901@';
    
$charset = 'utf8mb4';

// se connecter à la base de données
try{
    $db = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset",$users, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e){
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>

 