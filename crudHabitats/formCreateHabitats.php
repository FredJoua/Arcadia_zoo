<?php
session_start();
include_once("../dbconn.php");

$habitat = $description_habitat = $img = $prenom_animal = $race = $etat_sante = $detail_sante = $nourriture = $grammage = $date_visite = $date_repas_pris = $heure_repas_pris = "";
$errorMessage = $successMessage = "";

// Vérifier si le formulaire a été soumis
if (isset($_POST["submit"])) {
    $habitat = $_POST['habitat'] ?? '';
    $description_habitat = $_POST['description_habitat'] ?? '';
    $prenom_animal = $_POST['prenom_animal'] ?? '';
    $race = $_POST['race'] ?? '';
    $etat_sante = $_POST['etat_sante'] ?? '';
    $detail_sante = $_POST['detail_sante'] ?? '';
    $nourriture = $_POST['nourriture'] ?? '';
    $grammage = $_POST['grammage'] ?? '';
    $date_visite = $_POST['date_visite'] ?? '';
    $date_repas_pris = $_POST['date_repas_pris'] ?? '';
    $heure_repas_pris = $_POST['heure_repas_pris'] ?? '';

    // Gestion des fichiers d'image
    $uploadedImages = [];
    $targetDir = "uploads/";
    if (isset($_FILES['img'])) {
        foreach ($_FILES['img']['name'] as $key => $image) {
            $targetFile = $targetDir . basename($_FILES['img']['name'][$key]);
            if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $targetFile)) {
                $uploadedImages[] = $targetFile;
            }
        }
    }

    // Convertir le tableau des chemins d'images en chaîne séparée par des virgules
    $img = implode(',', $uploadedImages);

    try {
        // Code d'insertion dans la base de données
        $sql = "INSERT INTO habitats (habitat, description_habitat, img, prenom_animal, race, etat_sante, detail_sante, nourriture, grammage, date_visite, date_repas_pris, heure_repas_pris) 
                VALUES (:habitat, :description_habitat, :img, :prenom_animal, :race, :etat_sante, :detail_sante, :nourriture, :grammage, :date_visite, :date_repas_pris, :heure_repas_pris)";
        $query = $conn->prepare($sql);
        $query->bindParam(':habitat', $habitat);
        $query->bindParam(':description_habitat', $description_habitat);
        $query->bindParam(':img', $img);
        $query->bindParam(':prenom_animal', $prenom_animal);
        $query->bindParam(':race', $race);
        $query->bindParam(':etat_sante', $etat_sante);
        $query->bindParam(':detail_sante', $detail_sante);
        $query->bindParam(':nourriture', $nourriture);
        $query->bindParam(':grammage', $grammage);
        $query->bindParam(':date_visite', $date_visite);
        $query->bindParam(':date_repas_pris', $date_repas_pris);
        $query->bindParam(':heure_repas_pris', $heure_repas_pris);

        // Exécution de la requête
        if ($query->execute()) {
            // Redirection vers une page de confirmation ou autre
            header("Location: formCreateHabitats.php");
            exit();
        } else {
            echo "Erreur d'insertion du rapport : " . implode(", ", $query->errorInfo());
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion du rapport : " . $e->getMessage();
    }
    exit(); // Terminer le script après la redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-3">
                <div class="alert alert-warning text-center" role="alert">
                    <h4 class="alert-heading">Formulaire Creation D'Habitat</h4>
                    <p></p>
                    <hr>
                </div>

                <form action="formCreateHabitats.php" method="post" enctype="multipart/form-data">
                    <div class="mb mb-3">
                        <input class="form-control" name="habitat" id="habitat" type="text" placeholder="Habitat" required>
                    </div>
                    <div class="mb mb-3">
                        <textarea class="form-control my-3 p-3" name="description_habitat" id="description_habitat" placeholder="Description habitat" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="img" name="img[]" multiple required>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <input class="form-control" type="text" name="prenom_animal" placeholder="Prénom de l'Animal" required>
                        </div>
                        <div class="col mb-3">
                            <input class="form-control" type="text" name="race" placeholder="Race de l'Animal" required>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <textarea name="etat_sante" id="etat_sante" class="form-control my-3 p-3" rows="2" placeholder="Santé de l'animal" required></textarea>
                    </div>
                    <div class="col mb-3">
                        <textarea name="detail_sante" id="detail_sante" class="form-control my-3 p-3" rows="2" placeholder="Détail de la santé" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nourriture" placeholder="Nourriture" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="number" name="grammage" placeholder="Grammage (en gr)" required>
                    </div>

                    <div class="col mb-3">
                        <label for="date_visite">Date de la visite:</label>
                        <input class="form-control" type="date" name="date_visite"  required>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="date_repas_pris">Date repas pris:</label>
                            <input class="form-control" type="date" name="date_repas_pris" required>
                        </div>
                        <div class="col mb-3">
                            <label for="heure_repas_pris">Heure repas pris:</label>
                            <input class="form-control" type="time" name="heure_repas_pris" required>
                        </div>
                    </div>

                    <hr class="mb-3">
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" name="submit" class="btn btn-outline-success">Enregistrer</button>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="listingEmployes.php" class="btn btn-outline-danger">Annuler</a>
                        </div>
                    </div>
                </form>

                <div class="mt-3">
                    <!-- Lien de redirection après succès -->
                    <a href="../index.php" class="btn btn-secondary">Retour à la page d'accueil</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
