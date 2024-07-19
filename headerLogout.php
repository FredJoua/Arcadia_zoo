<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap CSS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/styleHeader.css">
    <title>Arcadia Zoo_NAVBAR </title>

    <style>
        /* Effet d'atténuation (opacité) sur les éléments du menu lors du survol */
        .nav-link {
            transition: all 0.3s ease; /* Ajout d'une transition pour l'effet en douceur */
            position: relative; /* Nécessaire pour l'ajout du fond opaque */
            z-index: 1;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(70, 70, 70, 0.250); /* Couleur noire avec opacité */
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease; /* Ajout d'une transition pour l'effet en douceur */
        }

        .nav-link:hover::before {
            opacity: 1; /* Affiche le fond opaque lors du survol */
            border-radius: 4px; /* Ajoute des coins arrondis */
        }
    </style>
</head>

<body>
    <header class="custom-header"> 
        <nav class="navbar navbar-expand-md navbar-orange bg-light shadow-sm fixed-top">
            <div class="container">
                <a href="../../index.php" class="navbar-brand">
                    <!-- Logo Image -->
                    <img src="../img/logoZoo.png" width="85" alt="logo" class="d-inline-block align-middle mr-2">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php"><i class="fa-solid fa-house"></i> </a>
                        </li>
                      
                        <!-- Services -->                     
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Services
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../../../pageVisiteHabitats.php">Visite Guidée Habitat</a>
                                <a class="dropdown-item" href="../../../pageZooEnTrain.php">Viste du Zoo en Train</a>
                                <a class="dropdown-item" href="../../../pageRestaurant.php">Restaurant</a>
                            </div>
                        </li>
                      
                        <!-- Habitat -->                     
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="pageVisiteHabitats.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Habitats
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../crudHabitats/habitatsSavane.php">Savane</a>
                                <a class="dropdown-item" href="../crudHabitats/habitatsJungle.php">Jungle</a>
                                <a class="dropdown-item" href="../crudHabitats/habitatsMarais.php">Marais</a>                       
                                <a class="dropdown-item" href="../crudHabitats/pageTousLesHabitats.php">Tous</a>                       
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../crudHoraires/affichageHoraires.php">Les Horaires du Zoo</a>
                        </li>                            
                        <li class="nav-item">
                            <a class="nav-link" href="../crudVisiteurs/formAvisVisiteurs.php">Votre avis compte!</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../crudContactZoo/formContactZoo.php">Nous Contacter</a>
                        </li>

                        <li class="nav-item">
                            <a href="../index.php" class="btn btn-link bg-darkred text-white" title="deconnexion Pro">
                                <i class="fas fa-power-off text-warning"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            </div>
        </nav>
    </header>
</body>
</html>