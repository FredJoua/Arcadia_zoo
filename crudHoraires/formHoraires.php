<?php
include_once "../dbconn.php"; 

$message = "";

// Création d'un nouvel horaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $jour = $_POST['jour'];
    $ouverture = $_POST['ouverture'];
    $fermeture = $_POST['fermeture'];

    try {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO horaires (jour, ouverture, fermeture) VALUES (:jour, :ouverture, :fermeture)";
        $stmt = $conn->prepare($sql);

        // Liaison des valeurs avec les paramètres de la requête
        $stmt->bindParam(':jour', $jour);
        $stmt->bindParam(':ouverture', $ouverture);
        $stmt->bindParam(':fermeture', $fermeture);

        // Exécution de la requête
        if ($stmt->execute()) {
            $message = "Nouvel horaire ajouté avec succès!";
            // Redirection vers une page de confirmation ou autre
            header("Location: formHoraires.php");
            exit();
        } else {
            $message = "Erreur lors de l'ajout de l'horaire. : " . implode(", ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        // En cas d'erreur PDO, afficher un message d'erreur
        $message = "Erreur PDO lors de l'ajout de l'horaire : " . $e->getMessage();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Les Horaires</title>

    <!-- Bootstrap CSS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleFooter.css">
</head>

<body>
    <header>
        <?php include_once '../headerLogout.php'; ?>
    </header>
    <section class="form my-4 mx-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <img src="../img/Toucan3.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="text py-3">Form Créer Les Horaires</h1>
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <form action="formHoraires.php" method="post">
                        <div class="form-row">
                            <div class="col-lg-10">
                                <input type="text" name="jour" placeholder="Indiquez les jours ouverts" class="form-control my-3 p-3" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-10">                                
                                <lable for="time" class="form-lable">Horaire d'ouverture</lable>
                                <input type="time" name="ouverture" placeholder="Heure d'ouverture" class="form-control my-3 p-3" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-10">
                                <lable for="time" class="form-lable">Horaire de fermeture</lable>
                                <input type="time" name="fermeture" placeholder="Heure de fermeture" class="form-control my-3 p-3" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-10 d-flex justify-content-center">
                                <div class="d-grid gap-2 col-5 mx-auto">
                                    <button type="submit" name="create" class="btn btn-outline-success">Enregistrer</button>
                                </div>
                                <div class="d-grid gap-2 col-5 mx-auto">
                                    <a href="formHoraires.php" class="btn btn-outline-danger">Annuler</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
<?php include "../footer.php"; ?>
</html>
