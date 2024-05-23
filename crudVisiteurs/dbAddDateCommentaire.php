<?php
try {
    $conn = new PDO('mysql:host=localhost; dbname=db_arcadiazoo', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour ajouter la colonne 'date_validation' à la table 'visiteurs'
    $alterTableQuery = "ALTER TABLE visiteurs ADD COLUMN date_validation DATETIME";
    $conn->exec($alterTableQuery);

    echo "La colonne 'date_validation' a été ajoutée à la table 'visiteurs' avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de l'ajout de la colonne 'date_validation' : " . $e->getMessage();
}
$conn = null;
?>
