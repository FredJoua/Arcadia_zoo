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
        <div class="jumbotron bg-cover text-white mb-0" style="background-image: url(img/pageHabitats.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 50vh; position: relative;">
            <div class="container py-5" style="position: absolute; bottom: 0; left: 50px; background-color: rgba(11, 149, 244, 0.6); padding: 15px;">
                <h1 class="display-4 font-weight-bold">L'Habitat des Animaux</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>Arcadia et ses Habitants</h1>
                <p>Partez à la découverte des animaux d’Afrique. Entre les animaux de la Savane, la Jungle, et le Marais,
                    ceux des grandes plaines africaines et les oiseaux rares, ce circuit vous 
                    conduira à la découverte du fascinant continent africain avec des animaux 
                    emblématiques tels que les Lions, les Rhinocéros blancs, les Girafes, 
                    et d’autres moins connus, et pourtant fascinants comme les Hippopotames nains. 
                    Le relief peu prononcé, les nombreux observatoires couverts et les bancs offrent 
                    aux visiteurs une promenade accessible à tous.</p><br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="../crudHabitats/habitatsSavane.php" class="text-decoration-none text-dark">
                    <div class="card mb-3 custom-card">
                        <img src="img/savane.jpg" class="card-img-top custom-img" alt="Photo 1">
                        <div class="card-body">
                            <h5 class="card-title">La Savane d'Arcadia</h5>
                            <p class="card-text">Des points d’observation panoramiques invitent les visiteurs à s’évader, le temps d’un instant, sur les bords d’un point d’eau du Niger.</p><br>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="../crudHabitats/habitatsJungle.php" class="text-decoration-none text-dark">
                    <div class="card mb-3 custom-card">
                        <img src="img/Jungle1.jpg" class="card-img-top custom-img" alt="Photo 2">
                        <div class="card-body">
                            <h5 class="card-title">La Jungle d'Arcadia</h5>
                            <p class="card-text">Nos animaux de la jungle sont sûrement parmi les animaux les plus actifs et les plus adroits du parc.</p><br>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="../crudHabitats/habitatsMarais.php" class="text-decoration-none text-dark">
                    <div class="card mb-3 custom-card">
                        <img src="img/Hipo.jpg" class="card-img-top custom-img" alt="Photo 3">
                        <div class="card-body">
                            <h5 class="card-title">Le Marais d'Arcadia</h5>
                            <p class="card-text">Un exemple tout simple, venez vous mettre en immersion sur le territoire d'une famille de Rhinocéros </p><br>
                        </div>
                    </div>
                </a>
            </div>
        </div>

                <div class="row justify-content">
            <div class="col-md-8 text-justify">
                <h1>A savoir : </h1>
                <p>Tout ces animaux sauvages du monde entier profitent d’un cadre de vie exceptionnel, 
                    alternant milieux ouverts et boisés. L’espace alloué à chacun de nos pensionnaires 
                    leur permet d’exprimer un maximum de comportements naturels.</p>
                    
                <p>Les aménagements paysagés, indispensables au bien-être de certaines espèces, 
                    ont été réalisés en parfaite harmonie avec le cadre prestigieux de cet endroit.</p>

                <p>Ensuite, le train vous emmenera à travers la plaine africaine cette fois, 
                    où vous pourrez admirer zèbres, girafes, rhinocéros blans, 
                    cobes de Mrs Grey, gnous bleus et autruches.</p>

                <p>ous les continents sont représentés ! Vous découvrirez ici des espèces animales 
                    aussi connues que les Ours bruns, les Loups, les imposants Bisons d’Amérique. </p>

                    <div class="alert alert-info" role="alert">
                        Durée de la visite, environ 3h.
                    </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
    <?php include "footer.php" ?>
</html>