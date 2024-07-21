<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once ("../dbconn.php");
// include_once ("../headerLogout.php");
$nom = "";
$prenom = "";
$email = "";
$motdepasse = "";
$role_profession = "";
$code_profession = "";
$date_creation = "";

$errorMessage = "";
$successMessage = "";

if (isset($_POST["submit"])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];
    $role_profession = $_POST['role_profession'];
    $code_profession = $_POST['code_profession'];
    $date_creation = $_POST['date_creation'];

    // verfication si l'email existe déjà
    $numSecuExistsQuery = $conn->prepare("SELECT COUNT(*) FROM employes WHERE email = :email");
    $numSecuExistsQuery->bindParam(':email', $email);
    $numSecuExistsQuery->execute();
    $numSecuExists = $numSecuExistsQuery->fetchColumn();

    do {
        if (empty($nom) || empty($prenom) || empty($email) || empty($motdepasse) || empty($role_profession) || empty($code_profession) || empty($date_creation)) {
            $errorMessage = "Attention, tous les champs doivent être remplis";
            break;
        }

        // code d'insertion dans la base de données
        $sql = "INSERT INTO employes (nom, prenom, email, motdepasse, role_profession, code_profession, date_creation) VALUES (:nom, :prenom, :email, :motdepasse, :role_profession, :code_profession, :date_creation)";
        $query = $conn->prepare($sql);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':email', $email);
        $query->bindParam(':motdepasse', $motdepasse);
        $query->bindParam(':role_profession', $role_profession);
        $query->bindParam(':code_profession', $code_profession);
        $query->bindParam(':date_creation', $date_creation);

        // Ajout du code de débogage
        if ($query->execute()) {
            $successMessage = "L'enregistrement a été effectué avec succès.";
        } else {
            $errorMessage = "Erreur d'enregistrement dans la base de données: " . $conn->errorInfo()[2];
            // un message de débogage
            echo $errorMessage;
        }

    } while (false);

    // Fermer la connexion
    $conn = null;
}
?>