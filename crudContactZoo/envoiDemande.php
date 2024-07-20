<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Message Demande en attente</title>

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

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 100px; /* Ajustez cette valeur selon vos besoins */
        }
    </style>

</head>
<body>
    <header>
        <?php
        include '../header.php';
        ?>
    </header>

    <section class="form my-4 mx-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <img src="../img/Canard.jpg" class="img-fluid" alt="">
                </div>

                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="text py-3">Merci de votre intérêt !</h1>
                    <form>
                        <div class="form-row">
                            <div class="col-lg-10">
                                <textarea name="commentaire" type="text" class="form-control my-3 p-3" rows="5" readonly>Votre demande a été envoyée avec succès. Nous vous répondrons dans les plus brefs délais."</textarea>
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
    </section>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
    <?php include "../footer.php" ?>
</html>
