<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Db employés</title>
</head>

<body>
    <?php

    // Informations pour se connecter à la db local
    $db_host = "localhost";
    $db_name = "db_arcadiaZoo";
    $db_user = "root";
    $db_password = "root";
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
        $createTable = "CREATE TABLE Employes (
            id_employe INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(50) NOT NULL,
            prenom VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            motdepasse VARCHAR(100) NOT NULL UNIQUE,
            role_profession VARCHAR(50) NOT NULL, 
            code_profession TINYINT(1) NOT NULL DEFAULT 0,
            date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            miseajour_le DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        $conn->exec($createTable);
        echo "La table employés a été créée avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la creation de la table employés : " . $e->getMessage();
    }
    $conn = null;
    ?>
</body>

</html>