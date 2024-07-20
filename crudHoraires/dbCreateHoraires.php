<?php
include_once "../dbconn.php"; 

try {
    // Créer la table `horaires` si elle n'existe pas
    $createTable = "CREATE TABLE IF NOT EXISTS horaires (
        id_horaire INT AUTO_INCREMENT PRIMARY KEY,
        jour VARCHAR(20) NOT NULL,
        ouverture TIME NOT NULL,
        fermeture TIME NOT NULL
    )";
    $conn->exec($createTable);
    echo "La table 'horaires' a été créée avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la création de la table 'horaires' : " . $e->getMessage();
}
?>