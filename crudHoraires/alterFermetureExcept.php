<?php
include_once "../dbconn.php"; 

try {
    // Ajouter la colonne `fermeture_exceptionnelle` si elle n'existe pas déjà
    $alterTable = "ALTER TABLE horaires ADD COLUMN fermeture_exceptionnelle BOOLEAN NOT NULL DEFAULT 0";
    $conn->exec($alterTable);
    echo "La colonne 'fermeture_exceptionnelle' a été ajoutée avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la modification de la table 'horaires' : " . $e->getMessage();
}
?>

