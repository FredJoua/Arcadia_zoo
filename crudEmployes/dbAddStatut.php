<?php
try {
    $conn = new PDO('mysql:host=localhost; dbname=db_arcadiazoo', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour ajouter la colonne 'statut' à la table 'employes'
    $alterTableQuery = "ALTER TABLE employes ADD COLUMN statut VARCHAR(10) NOT NULL DEFAULT 'actif'";
    $conn->exec($alterTableQuery);

    echo "La colonne 'statut' a été ajoutée à la table 'employes' avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de l'ajout de la colonne 'statut' : " . $e->getMessage();
}
$conn = null;
?>