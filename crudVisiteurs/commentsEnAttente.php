<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Message visiteur Commentaires en attente de validation</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleFooter.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 100px; /* Ajustez cette valeur selon besoins */
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
                    <img src="../img/Biche.jpg" class="img-fluid" alt="">
                </div>

                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="text py-3">Commentaire en attente de validation</h1>
                    <form>
                        <div class="form-row">
                            <div class="col-lg-10">
                                <textarea name="commentaire" type="text" class="form-control my-3 p-3" rows="5" readonly>Votre commentaire a été enregistré avec succès et sera publié une fois que notre modérateur l'aura approuvé !"</textarea>
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
    <?php include_once '../footer.php'; ?>
</html>
