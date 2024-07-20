<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>db Contact Zoo</title>
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
    $conn->exec("SET NAMES 'utf8'");
    } catch (PDOException $e) {
        // En cas d'erreur de connexion, afficher un message d'erreur détaillé
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
    
    try {
        $createTable = "CREATE TABLE contact (
            id_contact INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            objet VARCHAR(250) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            description_message TEXT,
            statut VARCHAR(250) NOT NULL DEFAULT 'En attente',
            date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $conn->exec($createTable);
        echo "La table contact a été créée avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la creation de la table contact : " . $e->getMessage();
    }
    $conn = null;
    ?>
</body>
</html>