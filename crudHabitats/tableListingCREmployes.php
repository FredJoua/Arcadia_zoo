<?php
include_once("../dbconn.php");

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
    <title>Listing Comptes Rendu des Employes</title>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="header.css">

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 100px; 
        }
    </style>

</head>
<body>
    <header>
        <?php
           include '../headerLogout.php';
        ?>
    </header>
    <section class="container my-5 mt-4">
        <h3 class="custom-title">Liste table employes</h3>
        <a class="btn btn-outline-success" href="../crudEmployes/adminPageEmployes.php" role="button">Retours Espcace Employés</a>
        <br>
        <hr>
        <table class="table" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
            <thead class="table-light">

                <tr>
                    <!-- Sous-colonnes pour Rapport Employé -->
                    <th colspan="6" class="centered-header">Comptes Rendus Employé</th>
                </tr>
                <tr>
                    <!-- Colonnes spécifiques pour Rapport Employé -->
                    <th>Prénom Animal</th>
                    <th>Nourriture</th>
                    <th>Grammage</th>
                    <th>Date repas pris</th>
                    <th>Heure repas pris</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lire liste habitats depuis la base de données
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                    <td>{$row['prenom_animal']}</td>
                    <td>{$row['nourriture']}</td>
                    <td>{$row['grammage']}</td>
                    <td>{$row['date_repas_pris']}</td>
                    <td>{$row['heure_repas_pris']}</td>
                    <td>
                        <a href='formUpdateEmployes.php?id_habitat={$row['id_habitat']}' class='link-warning'><i class='fas fa-pencil-square'></i></a>&nbsp
                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Bootstrap js link --> 
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
    <?php include_once '../footer.php'; ?>
</html>