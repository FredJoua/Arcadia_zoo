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
    // Préparation de la requête d'insertion
    $insertEmploye = "INSERT INTO Employes (nom, prenom, email, motdepasse, role_profession, code_profession) 
                      VALUES (:nom, :prenom, :email, :motdepasse, :role_profession, :code_profession)";

    // Création d'un employé
    $nom = "Pari";
    $prenom = "José";
    $email = "pari.jose@arcadiazoo.com";
    $motdepasse = "motdepasse"; // Choisir un mot de passe par défaut
    $role_profession = "Directeur";
    $code_profession = 777;

    // Préparation de la requête
    $query = $conn->prepare($insertEmploye);

    // Liaison des paramètres
    $query->bindParam(':nom', $nom);
    $query->bindParam(':prenom', $prenom);
    $query->bindParam(':email', $email);
    $query->bindParam(':motdepasse', $motdepasse);
    $query->bindParam(':role_profession', $role_profession);
    $query->bindParam(':code_profession', $code_profession);

    // Exécution de la requête
    if ($query->execute()) {
        echo "L'employé a été inséré avec succès.";
    } else {
        echo "Erreur lors de l'insertion de l'employé.";
    }
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion de l'employé : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$conn = null;
?>
