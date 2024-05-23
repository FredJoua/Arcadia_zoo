<?php
include_once "../dbconn.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $objet = isset($_POST['objet']) ? $_POST['objet'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $description_message = isset($_POST['description']) ? $_POST['description'] : '';
    $statut = 'En attente';

    // Vérifier si le champ de description_message n'est pas vide
    if (!empty($description_message)) {
        try {
            // Préparer la requête d'insertion
            $sql = "INSERT INTO contact (objet, email, description_message, statut) VALUES (:objet, :email, :description_message, :statut)";
            $query = $conn->prepare($sql); 
            
            // Liaison des valeurs avec les paramètres de la requête
            $query->bindParam(':objet', $objet);
            $query->bindParam(':email', $email);
            $query->bindParam(':description_message', $description_message);
            $query->bindParam(':statut', $statut);
            
            // Exécution de la requête
            if ($query->execute()) {
                // Redirection vers une page de confirmation ou autre
                header("Location: envoiDemande.php");
                exit();
            } else {
                echo "Erreur d'insertion du message : " . implode(", ", $query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion du message : " . $e->getMessage();
        }
    } else {
        echo "Le champ message est vide.";
    }
    exit(); // Terminer le script après la redirection
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contactez-nous</title>

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
        <?php
        include '../headerLogout.php';
        ?>
    </header>
<section class="form my-4 mx-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <img src="../img/cygne.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="text py-3">Besoin d'aide, Contactez-nous!</h1>
                <form action="formContactZoo.php" method="post">
                    <div class="form-row">
                        <div class="col-lg-10">
                        <input type="text" name="objet" value="" placeholder="Objet de votre demande" class="form-control my-3 p-3" required>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-10">
                            <input type="email" name="email" value="" placeholder="email@gmail.com" class="form-control my-3 p-3" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-10">
                            <textarea name="description" type="text" class="form-control my-3 p-3" rows="8" placeholder="Votre message"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-10 d-flex justify-content-center">
                            <div class="d-grid gap-2 col-5 mx-auto">
                                <button type="submit" name="approve_comment" class="btn btn-outline-success">Soumettre</button>
                            </div>
                            <div class="d-grid gap-2 col-5 mx-auto">
                                <a href="../index.php" class="btn btn-outline-danger">Annuler</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
<?php include "../footer.php" ?>
</html>
