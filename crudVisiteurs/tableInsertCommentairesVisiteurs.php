<?php
session_start();
include_once "../dbconn.php";
include_once "../headerLogout.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = $_SESSION['pseudo'];
    $commentaire = $_POST['commentaires'];
    $statut = 'En attente';
    $date_creation = date("Y-m-d H:i:s");

    // Vérifier si le champ de commentaires n'est pas vide
    if (!empty($commentaires)) {
        try {
            $sql = "INSERT INTO visiteurs (pseudo, commentaires, statut, date_creation) VALUES (:pseudo, :commentaires, :statut, :date_creation)";
            $query = $conn->prepare($sql);
            $query->bindParam(':pseudo', $pseudo);
            $query->bindParam(':commentaires', $commentaires);
            $query->bindParam(':statut', $statut);
            $query->bindParam(':date_creation', $date_creation);

            if ($query->execute()) {
                echo "Commentaire inséré avec succès.";
            } else {
                echo "Erreur d'insertion du commentaire : " . implode(", ", $query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion du commentaire : " . $e->getMessage();
        }
    } else {
        echo "Le champ de commentaires est vide.";
    }
}

$conn = null;
?>
