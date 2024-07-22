<?php
include_once("../dbconn.php");

$habitat = $description_habitat = $prenom_animal = $race = "";
$errorMessage = $successMessage = "";
$photos = [];

// Récupérer les données de l'habitat et les images existantes en utilisant la méthode GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id_habitat"])) {
        header("location:tableListingHabitats.php");
        exit;
    }

    $id_habitat = $_GET["id_habitat"];

    // Lire les données de l'habitat
    $sql = "SELECT * FROM habitats WHERE id_habitat=:id";
    $query = $conn->prepare($sql);
    $query->bindParam(':id', $id_habitat, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:tableListingHabitats.php");
        exit;
    }

    $habitat = $row['habitat'];
    $description_habitat = $row['description_habitat'];
    $prenom_animal = $row['prenom_animal'];
    $race = $row['race'];

    // Lire les images associées à l'habitat
    $sql = "SELECT image FROM habitat_image WHERE habitat_id=:id";
    $query = $conn->prepare($sql);
    $query->bindParam(':id', $id_habitat, PDO::PARAM_INT);
    $query->execute();
    $images = $query->fetchAll(PDO::FETCH_ASSOC);

    // Convertir les images en base64 pour les afficher dans le formulaire
    foreach ($images as $image) {
        $photos[] = "data:image/jpeg;base64," . base64_encode($image['image']);
    }
} else {
    // Gérer les mises à jour via la méthode POST
    $id_habitat = $_POST['id_habitat'];
    $habitat = $_POST['habitat'];
    $description_habitat = $_POST['description_habitat'];
    $prenom_animal = $_POST['prenom_animal'];
    $race = $_POST['race'];

    // Gestion des nouvelles images uploadées
    $newImages = [];
    if (isset($_FILES['img'])) {
        foreach ($_FILES['img']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['img']['error'][$key] == UPLOAD_ERR_OK) {
                $newImages[] = file_get_contents($tmp_name);
            }
        }
    }

    do {
        if (empty($habitat) || empty($description_habitat) || empty($prenom_animal) || empty($race)) {
            $errorMessage = "ATTENTION ! Tous les champs doivent être remplis";
            break;
        }

        // Mettre à jour les informations de l'habitat
        $sql = "UPDATE habitats SET habitat=:habitat, description_habitat=:description_habitat, prenom_animal=:prenom_animal, race=:race WHERE id_habitat = :id_habitat";
        $query = $conn->prepare($sql);
        $query->bindParam(':id_habitat', $id_habitat, PDO::PARAM_INT);
        $query->bindParam(':habitat', $habitat, PDO::PARAM_STR);
        $query->bindParam(':description_habitat', $description_habitat, PDO::PARAM_STR);
        $query->bindParam(':prenom_animal', $prenom_animal, PDO::PARAM_STR);
        $query->bindParam(':race', $race, PDO::PARAM_STR);

        if ($query->execute()) {
            // Supprimer les anciennes images (si nécessaire)
            $sql = "DELETE FROM habitat_image WHERE habitat_id=:id_habitat";
            $query = $conn->prepare($sql);
            $query->bindParam(':id_habitat', $id_habitat, PDO::PARAM_INT);
            $query->execute();

            // Insérer les nouvelles images
            foreach ($newImages as $image) {
                $sql = "INSERT INTO habitat_image (habitat_id, image) VALUES (:habitat_id, :image)";
                $query = $conn->prepare($sql);
                $query->bindParam(':habitat_id', $id_habitat, PDO::PARAM_INT);
                $query->bindParam(':image', $image, PDO::PARAM_LOB);
                $query->execute();
            }

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

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="header.css">
    <style>
        .readonly {
            background-color: #e9ecef; /* Couleur de fond grise */
            cursor: not-allowed; /* Curseur non autorisé */
        }
        body {
            padding-top: 75px; /* Ajustez cette valeur selon vos besoins */
        }
        .container form {
            margin-bottom: 150px; /* Ajoutez un espace de 50px entre le formulaire et le footer */
        }
    </style>

</head>
<body>
    <header>
        <?php include_once '../headerLogout.php'; ?>
    </header>
 
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
                        <?php foreach ($photos as $photo): ?>
                            <img src="<?php echo $photo; ?>" alt="Photo de l'habitat" class="img-thumbnail mb-2">
                        <?php endforeach; ?>
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
                    
                    <div class="mt-3">
                        <!-- Lien de redirection vers la page d'accueil à tout moment -->
                        <a href="../index.php" class="btn btn-secondary">Retour à la page d'accueil</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap js link --> 
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
    <?php include_once '../footer.php'; ?>
</html>
