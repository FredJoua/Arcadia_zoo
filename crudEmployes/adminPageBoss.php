<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 85px; 
        }

    </style>

</head>

<body>
    <?php include_once "../headerLogout.php"; ?>

    <h1>ARCADIA ZOO - Espace admin Directeur</h1>
    <div class="container-fluid mt-5">
        <!-- Première rangée -->
        <div class="row">
            <!-- Première colonne -->
            <div class="col-md-4">
                <div class="custom-container">
                    <div class="center-content">
                        <h3 class="card-title">Gestion du personnel</h3><br>
                        <a class="btn btn-outline-warning" href="formInsertIntoEmployes.php">Formulaire d'embauche</a><br>
                        <a class="btn btn-outline-warning" href="formEmployesUpdate.php">Modifier Employés</a><br>
                        <a class="btn btn-outline-warning" href="tableListingEmployes.php">listing des employés</a>
                    </div>
                </div>
            </div>
            <!-- Deuxième colonne -->
            <div class="col-md-4">
                <div class="custom-container">
                    <div class="center-content">
                        <h3 class="card-title">Gestion des services</h3><br>
                        <a class="btn btn-outline-warning" href="../pageVisiteHabitats.php">Visite Guidée Zoo</a><br>
                        <a class="btn btn-outline-warning" href="../pageZooEnTrain.php">Visite Parc en Train</a><br>
                        <a class="btn btn-outline-warning" href="../pageRestaurant.php">Le Restaurent</a>
                    </div>
                </div>
            </div>
            <!-- Troisième colonne -->
            <div class="col-md-4">
                <div class="custom-container">
                    <div class="center-content">
                        <h3 class="card-title">Horaires</h3><hr>
                        <a class="btn btn-outline-warning" href="../crudHoraires/formUpdateHoraires.php">Mise à jour des Horaires</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row separator"></div>
        <!-- Deuxième rangée  -->
        <div class="row">
            <div class="col-md-4">
                <div class="custom-container">
                    <div class="center-content">
                        <h3 class="card-title">Les Habitats</h3><br>
                        <div>
                            <a class="btn btn-outline-warning" href="savane.php" style="margin-right: 30px;">Savane</a>
                            <a class="btn btn-outline-warning" href="jungle.php">Jungle</a>
                        </div>
                        <div style="margin-top: 30px;">
                            <a class="btn btn-outline-warning" href="marais.php" style="margin-right: 30px;">Marais</a>
                            <a class="btn btn-outline-warning" href="autreHabitats.php">Autres</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-container">
                    <div class="center-content">
                        <h3 class="card-title">CR sur les animaux</h3><br>
                        <a class="btn btn-outline-warning" href="../crudHabitats/tableListingRapportVeterinaires.php">Comptes Rendus par les vétérinaires</a><br>
                        <a class="btn btn-outline-warning" href="../crudHabitats/tableListingCREmployes.php">Comptes Rendus par les Employes</a><br>
                        <a class="btn btn-outline-warning" href="../crudHabitats/tableListingHabitats.php">Listing des animaux</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-container">
                    <div class="center-content">
                        <h3 class="card-title">Statistique sur la consultation des habitats</h3><br>
                        <a class="btn btn-outline-warning" href="../crudHabitats/dashboardConsultations.php">Nombre de vues par animaux</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
    <?php include "../footer.php"; ?>
</html>
