<?php
include_once("../dbconn.php");
// include_once("../headerLogout.php");

$sql = "SELECT * FROM employes";
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
    <title>Listing Tous les Employés</title>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <section class="container my-5 mt-4">
        <h3 class="custom-title">Liste des Employés</h3>
        <a class="btn btn-outline-success" href="formInsertIntoEmployes.php" role="button">Ajouter Employé(e)</a>
        <br>
        <hr>
        <table class="table" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
            <thead class="table-light">
                <tr>
                    <th data-sortable="true" data-field="id">ID</th>
                    <th data-sortable="true" data-field="nom">Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Profession</th>
                    <th>ID Profession</th>
                    <th>Date de creation</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Lire toute la liste des employés depuis la base de données
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['id_employe']}</td>
                        <td>{$row['nom']}</td>
                        <td>{$row['prenom']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['motdepasse']}</td>
                        <td>{$row['role_profession']}</td>
                        <td>{$row['code_profession']}</td>
                        <td>{$row['date_creation']}</td>
                        <td>{$row['statut']}</td>
                        <td>
                            <a href='formEmployesUpdate.php?id_employe={$row['id_employe']}' class='link-warning'><i class='fas fa-pencil-square'></i></a>&nbsp
                            <a href='updateStatutEmployes.php?id_employe={$row['id_employe']}' class='link-danger'><i class='fas fa-trash'></i></a>
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
