<?php
include_once("../dbconn.php");

$habitat = $description_habitat = $img = $prenom_animal = $race = "";
$errorMessage = $successMessage = "";
$photos = null;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Method GET pour montrer les données de l'habitat
    if (!isset($_GET["id_habitat"])) {
        header("location:tableListingHabitats.php");
        exit;
    }

    $id = $_GET["id_habitat"];
    // Read la ligne de l'habitat sélectionné dans la bd
    $sql = "SELECT * FROM habitats WHERE id_habitat=:id";
    $query = $conn->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:tableListingHabitats.php");
        exit;
    }

    $id_habitat = $row['id_habitat'];
    $habitat = $row['habitat'];
    $description_habitat = $row['description_habitat'];
    $prenom_animal = $row['prenom_animal'];
    $race = $row['race'];

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
    
    // Convertir l'image en base64 pour l'afficher dans le formulaire
    if ($row['img']) {
        $photos = "data:image/jpeg;base64," . base64_encode($row['img']);
    }
} else {
    // Method POST pour apporter des modifications
    $id_habitat = $_POST['id_habitat'];
    $habitat = $_POST['habitat'];
    $description_habitat = $_POST['description_habitat'];
    $prenom_animal = $_POST['prenom_animal'];
    $race = $_POST['race'];

    // Gestion de l'upload d'image
    $img = null;
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $img = file_get_contents($_FILES['img']['tmp_name']);
    }

    do {
        if (empty($habitat) || empty($description_habitat) || empty($prenom_animal) || empty($race)) {
            $errorMessage = "ATTENTION ! Tous les champs doivent être remplis";
            break;
        }

        $sql = "UPDATE habitats SET habitat=:habitat, description_habitat=:description_habitat, prenom_animal=:prenom_animal, race=:race";
        if ($img !== null) {
            $sql .= ", img=:img";
        }
        $sql .= " WHERE id_habitat = :id_habitat";

        $query = $conn->prepare($sql);
        $query->bindParam(':id_habitat', $id_habitat, PDO::PARAM_INT);
        $query->bindParam(':habitat', $habitat, PDO::PARAM_STR);
        $query->bindParam(':description_habitat', $description_habitat, PDO::PARAM_STR);
        $query->bindParam(':prenom_animal', $prenom_animal, PDO::PARAM_STR);
        $query->bindParam(':race', $race, PDO::PARAM_STR);
        if ($img !== null) {
            $query->bindParam(':img', $img, PDO::PARAM_LOB);
        }

        if ($query->execute()) {
            $successMessage = "Données vétérinaire modifiée avec succès";
            header("location:tableListingHabitats.php");
            exit();
        } else {
            $errorMessage = "Erreur dans la mise à jour: " . implode(", ", $query->errorInfo());
            break;
        }
    } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier habitat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .readonly {
            background-color: #e9ecef; /* Couleur de fond grise */
            cursor: not-allowed; /* Curseur non autorisé */
        }
    </style>

</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-3">
                <div class="alert alert-warning text-center" role="alert">
                    <h4 class="alert-heading">Espace Employes: Mise à jour info animaux</h4>
                    <hr>
                </div>

                <form action="formUpdateAnimauxAdmin.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_habitat" value="<?php echo htmlspecialchars($id_habitat); ?>">

                    <div class="mb-3">
                        <?php if ($photos): ?>
                            <img src="<?php echo $photos; ?>" alt="Photo de l'habitat" class="img-thumbnail">
                        <?php endif; ?>
                        <input class="form-control" type="file" id="img" name="img[]" multiple>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="habitat" placeholder="Habitat" value="<?php echo htmlspecialchars($habitat); ?>">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control my-3 p-3" name="description_habitat" placeholder="Description habitat"><?php echo htmlspecialchars($description_habitat); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="prenom_animal" placeholder="Prénom animal" value="<?php echo htmlspecialchars($prenom_animal); ?>">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="race" placeholder="Race" value="<?php echo htmlspecialchars($race); ?>">
                    </div>

                    <?php
                    // Message d'alerte pour le succès
                    if (!empty($successMessage)) {
                        echo '
                        <div class="row mb-3">
                            <div class="offset-sm-3 col-sm-6">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>' . htmlspecialchars($successMessage) . '</strong>
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="close"></button>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                    <hr class="mb-3">
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" name="submit" class="btn btn-outline-success">Enregistrer</button>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="tableListingHabitats.php" class="btn btn-outline-danger">Annuler</a>
                        </div>
                    </div>
                </form>

                <div class="mt-3">
                    <!-- Lien de redirection vers la page d'accueil à tout moment -->
                    <a href="../index.php" class="btn btn-secondary">Retour à la page d'accueil</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
