<?php
include_once "../dbconn.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
    $commentaires = isset($_POST['commentaires']) ? $_POST['commentaires'] : '';
    $statut = 'En attente';

    // Vérifier si le champ de commentaires n'est pas vide
    if (!empty($commentaires)) {
        try {
            // Préparer la requête d'insertion
            $sql = "INSERT INTO visiteurs (pseudo, commentaires, statut) VALUES (:pseudo, :commentaires, :statut)";
            $query = $conn->prepare($sql); // Utiliser $cnx au lieu de $conn
            
            // Liaison des valeurs avec les paramètres de la requête
            $query->bindParam(':pseudo', $pseudo);
            $query->bindParam(':commentaires', $commentaires);
            $query->bindParam(':statut', $statut);
            
            // Exécution de la requête
            if ($query->execute()) {
                // Redirection vers une page de confirmation ou autre
                header("Location: commentsEnAttente.php");
                exit();
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

$cnx = null;
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
                <img src="../img/lama3.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="text py-3">Votre avis compte!</h1>
                <form action="formAvisVisiteurs.php" method="post">
                    <div class="form-row">
                        <div class="col-lg-10">
                            <input type="text" name="pseudo" value="" placeholder="votre pseudo" class="form-control my-3 p-3" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-10">
                            <textarea name="commentaires" type="text" class="form-control my-3 p-3" rows="8" placeholder="Votre commentaire"></textarea>
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
