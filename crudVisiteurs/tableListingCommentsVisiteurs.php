<?php
    include "../dbconn.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve_comment'])) {
        $comment_id = $_POST['id_comment'];
    
        // Mettre à jour le statut du commentaire à 'Publié' avec la date de validation actuelle
        $sql_update = "UPDATE visiteurs SET statut = 'Publié', date_validation = NOW() WHERE id_visiteur = :id_comment";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':id_comment', $comment_id);
    
        if ($stmt_update->execute()) {
            // Commentaire approuvé avec succès
            header('Location: tableListingCommentsVisiteurs.php');
            exit();
        } else {
            // Erreur lors de la mise à jour du statut
            echo "Erreur lors de l'approbation du commentaire : " . implode(", ", $stmt_update->errorInfo());
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject_comment'])) {
        $comment_id = $_POST['id_comment'];
    
        // Mettre à jour le statut du commentaire à 'Rejeté' avec la date de validation actuelle
        $sql_update = "UPDATE visiteurs SET statut = 'Rejeté', date_validation = NOW() WHERE id_visiteur = :id_comment";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':id_comment', $comment_id);
    
        if ($stmt_update->execute()) {
            // Commentaire rejeté avec succès
            header('Location: tableListingCommentsVisiteurs.php');
            exit();
        } else {
            // Erreur lors de la mise à jour du statut
            echo "Erreur lors du rejet du commentaire : " . implode(", ", $stmt_update->errorInfo());
        }
    }
    
    $sql = "SELECT * FROM visiteurs WHERE commentaires IS NOT NULL AND commentaires <> '' ORDER BY FIELD(statut, 'En attente', 'Publié', 'Rejeté')";
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Erreur message : " . $conn->$error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Commentaires</title>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 75px; /* Ajustez cette valeur selon vos besoins */
        }
    </style>
</head>
<body>
    <header>
        <?php include_once '../headerLogout.php'; ?>
    </header>

    <section class="container my-5">
        <h3>Liste des Commentaires</h3>
        <a class="btn btn-outline-success my-3" href="../crudEmployes/adminPageEmployes.php" role="button">Retour Espace Employes</a>
        <br>
        <hr>
        <table class="table" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Commentaires</th>
                    <th>Date validation</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <tr>
                        <td>{$row['id_visiteur']}</td>
                        <td>{$row['pseudo']}</td>
                        <td>{$row['commentaires']}</td>
                        <td>{$row['date_validation']}</td>
                        <td>{$row['statut']}</td>
                        <td>
                            <form action='tableListingCommentsVisiteurs.php' method='post'>
                                <input type='hidden' name='id_comment' value='{$row['id_visiteur']}'>
                                <button type='submit' name='approve_comment' class='btn btn-success'><i class='fas fa-square-check'></i></button>
                                <button type='submit' name='reject_comment' class='btn btn-danger'><i class='fas fa-times'></i></button>
                            </form>
                        </td>
                    </tr>
                    ";
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
