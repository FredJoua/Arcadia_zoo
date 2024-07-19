<?php
session_start(); // Appel à session_start() en début de fichier
include "header.php"; // Inclusion du header après session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

    <style>
        .custom-card {
            height: 450px; /* Hauteur fixe pour les cartes */
        }

        .custom-img {
            height: 300px; /* Hauteur fixe pour les images */
            object-fit: cover; /* Pour conserver les proportions de l'image */
        }

        .card-title,
        .card-text {
            /* overflow: hidden;  Pour masquer le texte supplémentaire */ 
            /*text-overflow: ellipsis;  Pour ajouter des points de suspension si le texte est trop long */
            -webkit-line-clamp: 3; /* Pour limiter le texte à 3 lignes */
            display: -webkit-box;
            -webkit-box-orient: vertical;
            height: 1.5em; /* Hauteur fixe pour le titre et le texte */
        }
    </style>
<body>
    <div class="container-fluid p-0">
        <div class="jumbotron bg-cover text-white mb-0" style="background-image: url(img/Restaurant.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 50vh; position: relative;">
            <div class="container py-5" style="position: absolute; bottom: 0; left: 50px; background-color: rgba(11, 149, 244, 0.6); padding: 15px;">
                <h1 class="display-4 font-weight-bold">La Restauration</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>Arcadia et sa Restauration</h1>
                <p>Tout a été imaginé pour rendre votre pause agréable sans la faire traîner en longueur : 
                    après avoir récupéré un plateau et choisi vos entrée, boisson et dessert, 
                    vous commandez votre plat à la caisse. Et pouvez ainsi tranquillement vous installer et grignoter, 
                    pendant que votre plat est préparé en cuisine.</p><br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3 custom-card">
                    <img src="img/foodTruck.jpg" class="card-img-top custom-img" alt="Photo 1">
                    <div class="card-body">
                        <h5 class="card-title">Le Food-Truck</h5>
                        <p class="card-text">Pendant les vacances de Noël et de février, un food-truck est à votre disposition 
                            pour déjeuner sur l'esplanade des otaries.
                        </p><br>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3 custom-card">
                    <img src="img/piqueNique.jpg" class="card-img-top custom-img" alt="Photo 2">
                    <div class="card-body">
                        <h5 class="card-title">Pique-Nique</h5>
                        <p class="card-text">Les pique-niques sont autorisés sur les bancs installés 
                            le long du parcours de visite et sur les gradins.
                        </p><br>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content">
            <div class="col-md-8 text-justify">
                <h1>A savoir : </h1>
                    <p>A l'intérieur du parc zoologique (<strong>tout le long de l'année</strong>) : bar, fast-food (hot-dogs, sandwiches, crêpes sucrées), crêperie (salades et galettes), 
                        distributeurs de boissons fraîches, glaces.
                    </p>
                    
                    <p>Vous pouvez également pique-niquer à l’extérieur du zoo : avant de sortir, n’oubliez pas de vous faire tamponner le poignet à la caisse afin de pouvoir 
                        rentrer de nouveau dans le parc et continuer votre visite.
                    </p>

                    <p>Ensuite, le train vous emmenera à travers la plaine africaine cette fois, 
                        où vous pourrez admirer zèbres, girafes, rhinocéros blans, 
                        cobes de Mrs Grey, gnous bleus et autruches.
                    </p>

                <div class="alert alert-info" role="alert">
                    <strong>Attention : les pique-niques ne sont pas autorisés sur les tables des points de restauration !</strong>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
    <?php include "footer.php" ?>
</html>