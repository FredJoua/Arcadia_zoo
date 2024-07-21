
<?php
session_start();
include "../dbconn.php";

if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['motdepasse'])) {
        $email = htmlspecialchars($_POST['email']);
        $motdepasse = ($_POST['motdepasse']);

        $sql = $conn->prepare("SELECT * FROM employes WHERE email=? AND motdepasse=?");
        $sql->execute(array($email, $motdepasse));

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            // Récupérer le code de profession de l'utilisateur
            $code_profession = $row['code_profession'];

            // Rediriger en fonction du code de profession
            switch ($code_profession) {
                case 101:
                    header("Location: adminPageEmployes.php");
                    break;
                case 201:
                    header("Location: adminPageVeterinaires.php");
                    break;
                case 777:
                    header("Location: adminPageBoss.php");
                    break;
                default:
                    // Redirection par défaut si le code de profession n'est pas reconnu
                    header("Location: loginAdmin.php");
                    break;
            }
            exit(); 
        } else {
            echo "Votre email ou mot de passe est incorrect";
        }
    }
}
// Fermez la connexion à la base de données
$conn = null;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Admin - Se connecter</title>

    <!-- Custom CSS -->
<style>
    body {
        padding-top: 85px; /* Ajustez cette valeur selon vos besoins */
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

    <section class="form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="../img/Ours.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="text py-3">Espace réservé à l'administration</h1>
                    <p class="text-warning">Veuillez insérer vos identifiants pour vous connecter</p>
                    <form method="post">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="email" name="email" placeholder="exemple@email.com" class="form-control my-3 p-3" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" name="motdepasse" placeholder="************" class="form-control my-3 p-3" required>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col-lg-7">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" name="submit" class="btn btn-outline-success w-100 me-2">Me connecter</button>
                                    <a href="../index.php" class="btn btn-outline-danger w-100">Annuler</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col-lg-7">
                                <a href="#">Mot de passe oublié</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap js link --> 
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
    <?php include_once '../footer.php'; ?>
</html>
</html>
