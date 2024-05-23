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
    <title>Listing Animaux</title>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <section class="container my-5 mt-4">
        <h3 class="custom-title">Liste des Animaux</h3>
        <a class="btn btn-outline-success" href="formInsertIntoAnimaux.php" role="button">Ajouter nouvau animal</a>
        <br>
        <hr>
        <table class="table" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
            <thead class="table-light">
                <tr>
                    <th data-sortable="true" data-field="id">ID Habitat</th>
                    <th data-sortable="true" data-field="nom">Prenom</th>
                    <th>Etat de l'Animal</th>
                    <th>Nourriture</th>
                    <th>Grammage</th>
                    <th>Date de passage</th>
                    <th>Détail de Santé</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Lire liste habitats depuis la base de données
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['id_habitat']}</td>
                        <td>{$row['etat_sante']}</td>
                        <td>{$row['nourriture']}</td>
                        <td>{$row['grammage']}</td>
                        <td>{$row['date_visite']}</td>
                        <td>{$row['detail_sante']}</td>
                        <td>
                            <a href='formUpdateRapportVeterinaire.php?id_employe={$row['id_habitat']}' class='link-warning'><i class='fas fa-pencil-square'></i></a>&nbsp
                            <a href='updateStatutRapportVeterinaire.php?id_employe={$row['id_habitat']}' class='link-danger'><i class='fas fa-trash'></i></a>
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
