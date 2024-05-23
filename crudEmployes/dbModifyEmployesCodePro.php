<?php
// Informations pour se connecter à la base de données
include_once("../dbconn.php");

try {
    // Créer la connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Définir le jeu de caractères 
    $conn->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher un message d'erreur détaillé
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

try {
    // Définition du type de données de la colonne code_profession en SMALLINT
    $alterTable = "ALTER TABLE Employes MODIFY COLUMN code_profession SMALLINT(4) NOT NULL DEFAULT 0";

    // Exécution de la requête ALTER TABLE
    $conn->exec($alterTable);
    echo "Le type de données de la colonne 'code_profession' a été modifié avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la modification du type de données de la colonne 'code_profession' : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$conn = null;
?>
