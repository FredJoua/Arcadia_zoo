<?php
try {
    $conn = new PDO('mysql:host=localhost; dbname=db_arcadiazoo', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour ajouter la colonne 'consultations' à la table 'habitats'
    $alterTableQuery = "ALTER TABLE habitats ADD consultations INT DEFAULT 0;";
    $conn->exec($alterTableQuery);

    echo "La colonne 'consultations' a été ajoutée à la table 'habitats' avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de l'ajout de la colonne 'consultations' : " . $e->getMessage();
}
$conn = null;
?>
