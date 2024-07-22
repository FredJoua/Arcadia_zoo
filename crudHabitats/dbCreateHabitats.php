<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Db Habitats</title>
</head>

<body>
    <?php

    // Informations pour se connecter à la base de données
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
        // Créer la table Habitats si elle n'existe pas déjà
        $createTableHabitats = "CREATE TABLE IF NOT EXISTS habitats (
            id_habitat INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            habitat VARCHAR(50) NOT NULL,
            description_habitat VARCHAR(255) NOT NULL DEFAULT 'Aucune description',
            img LONGBLOB,
            prenom_animal VARCHAR(100),
            race VARCHAR(100) NOT NULL,
            etat_sante VARCHAR(100) NOT NULL,
            detail_sante VARCHAR(100),
            nourriture VARCHAR(100),
            grammage INT COMMENT 'en gr',
            date_visite TIMESTAMP NULL DEFAULT NULL,
            date_repas_pris TIMESTAMP NULL DEFAULT NULL,
            heure_repas_pris TIME NULL DEFAULT NULL,
            miseajour_le DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        $conn->exec($createTableHabitats);
        echo "La table Habitats a été créée avec succès.";

        // Créer la table habitat_image
        $createTableImage = "CREATE TABLE IF NOT EXISTS habitat_image (
        id_image INT AUTO_INCREMENT PRIMARY KEY,
        habitat_id INT UNSIGNED NOT NULL,
        image LONGBLOB NOT NULL,
        FOREIGN KEY (habitat_id) REFERENCES habitats(id_habitat) ON DELETE CASCADE ON UPDATE CASCADE
    )";

        $conn->exec($createTableImage);
        echo "La table habitat_image a été créée avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la création des tables : " . $e->getMessage();
    }

    $conn = null;
    ?>
</body>

</html>
