<?php
// Informations pour se connecter à la base de données en local phpMyAdmin
$db_host = "localhost";
$db_name = "db_arcadiaZoo";
$db_user = "root";
$db_password = "root";

    try{
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '';
    }  
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }