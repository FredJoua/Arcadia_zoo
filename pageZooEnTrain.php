<?php
session_start(); // Appel à session_start() en début de fichier
include "header.php"; // Inclusion du header après session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visite Guidée Habitats</title>
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
        <div class="jumbotron bg-cover text-white mb-0" style="background-image: url(img/TRAINZoo.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 50vh; position: relative;">
            <div class="container py-5" style="position: absolute; bottom: 0; left: 50px; background-color: rgba(11, 149, 244, 0.6); padding: 15px;">
                <h1 class="display-4 font-weight-bold">LE SAFARI-TRAIN</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>Arcadia Zoo Train</h1>
                <p>Embarquez à bord d'Arcadia Train, le temps d’un tour du monde. Tout au long de cette escapade vous croiserez bisons, 
                    rennes, géladas, lycaons, girafes, rhinocéros et autres animaux insolites ! 
                    Ce parcours original vous permettra de mieux observer les animaux et de les photographier à loisir.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 custom-card">
                    <img src="img/Tran2.jpg" class="card-img-top custom-img" alt="Photo 1">
                    <div class="card-body">
                        <h5 class="card-title">Safari train</h5>
                        <p class="card-text">La balade au plus près des animaux.</p><br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 custom-card">
                    <img src="img/Train2.jpg" class="card-img-top custom-img" alt="Photo 2">
                    <div class="card-body">
                        <h5 class="card-title">Rencontre avec les girafes</h5>
                        <p class="card-text">Le territoire des girafes d'Afrique de l'Ouest</p><br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 custom-card">
                    <img src="img/Train3.jpg" class="card-img-top custom-img" alt="Photo 3">
                    <div class="card-body">
                        <h5 class="card-title">L'incontournable rencotre des Rhinocéros</h5>
                        <p class="card-text">En immersion sur le territoire d'une famille de Rhinocéros </p><br>
                    </div>
                </div>
            </div>
        </div>

                <div class="row justify-content">
            <div class="col-md-8 text-justify">
                <h1>A savoir : </h1>
                <p>Sur 8 ha , le Arcadia safari train propose aux visiteurs de découvrir deux espaces offrant un panorama 
                    extraordinaire sur la nature du bocage normand aux côtés d’espèces de continents lointains. 
                    Un véritable safari en plein cœur de la Normandie dans lequel petits et grands apercevront la plaine américaine 
                    avec les bisons d’Amérique et les rennes !</p>

                <p>Ensuite, le train vous emmenera à travers la plaine africaine cette fois, 
                    où vous pourrez admirer zèbres, girafes, rhinocéros blans, 
                    cobes de Mrs Grey, gnous bleus et autruches.</p>

                <p>Au fil de la balade le TRAIN d'Arcadia proposera aussi de rencontrer des grands Koudous qui partagent 
                    le grand enclos des oryx algazelle. Cette immersions dans le monde sauvage ne manquera pas de ravir 
                    les curieux et les amateurs de nature !</p>

                    <div class="alert alert-info" role="alert">
                        Durée du trajet 20 à 25 minutes, inclus dans votre droit d’entrée.
                    </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
    <?php include "footer.php" ?>
</html>