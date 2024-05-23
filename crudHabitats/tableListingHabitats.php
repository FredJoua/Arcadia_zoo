<?php
include_once("../dbconn.php");
// include_once("../headerLogout.php");

$sql = "SELECT * FROM habitats";
$result = $conn->query($sql);

if (!$result){
    die("Erreur de données");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Tous les Habitats</title>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="header.css">
    <style>
        .img-column img {
            display: block; /* Pour que chaque image soit sur une nouvelle ligne */
            max-width: 100px; /* Limiter la largeur des images */
            margin-bottom: 5px; /* Espacement entre les images */
        }
        .centered-header {
            text-align: center;
        }
    </style>
</head>
<body>
    <section class="container my-5 mt-4">
        <h3 class="custom-title">Liste des Habitats</h3>
        <a class="btn btn-outline-success" href="formCreateHabitats.php" role="button">Ajouter Habitat</a>
        <br>
        <hr>
        <table class="table" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
            <thead class="table-light">
                <tr>
                    <!-- Colonne principale pour Habitats -->
                    <th colspan="14" class="centered-header">Habitats</th>
                   
                </tr>
                <tr>
                    <!-- Sous-colonnes pour Animaux -->
                    <th colspan="6" class="centered-header">Animaux</th>
                    <!-- Sous-colonnes pour Rapport Vétérinaires -->
                    <th colspan="3" class="centered-header">Rapport Vétérinaires</th>
                    <!-- Sous-colonnes pour Rapport Employé -->
                    <th colspan="4" class="centered-header">Rapport Employé</th>
                    <!-- Sous-colonnes pour Action -->
                    <th colspan="1" class="centered-header">Action</th>
                </tr>
                <tr>
                    <!-- Colonnes spécifiques pour Animaux -->
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom Habitat</th>
                    <th>Description Habitat</th>
                    <th>Prénom Animal</th>
                    <th>Race</th>
                    <!-- Colonnes spécifiques pour Rapport Vétérinaires -->
                    <th>Etat Animal</th>
                    <th>Détail Santé</th>
                    <th>Date de visite</th>
                    <!-- Colonnes spécifiques pour Rapport Employé -->
                    <th>Nourriture</th>
                    <th>Grammage</th>
                    <th>Date repas pris</th>
                    <th>Heure repas pris</th>
                    <!-- Colonnes spécifiques pour Action -->
                     <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lire liste habitats depuis la base de données
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    // Convertir les chemins d'images en liste d'éléments <img>
                    $imgPaths = explode(',', $row['img']);
                    $imgTags = '';
                    foreach ($imgPaths as $imgPath) {
                        $imgTags .= "<img src='{$imgPath}' alt='Image'>";
                    }

                    echo "<tr>
                        <td>{$row['id_habitat']}</td>
                        <td class='img-column'>{$imgTags}</td>
                        <td>{$row['habitat']}</td>
                        <td>{$row['description_habitat']}</td>
                        <td>{$row['prenom_animal']}</td>
                        <td>{$row['race']}</td>

                        <td>{$row['etat_sante']}</td>
                        <td>{$row['detail_sante']}</td>
                        <td>{$row['date_visite']}</td>

                        <td>{$row['nourriture']}</td>
                        <td>{$row['grammage']}</td>
                        <td>{$row['date_repas_pris']}</td>
                        <td>{$row['heure_repas_pris']}</td>
                        <td>
                            <a href='formUpdateAnimauxAdmin.php?id_habitat={$row['id_habitat']}' class='link-warning'><i class='fas fa-pencil-square'></i></a>&nbsp
                            <a href='updateStatutHabitats.php?id_habitat={$row['id_habitat']}' class='link-danger'><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Bootstrap js link --> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>

</body>
</html>
