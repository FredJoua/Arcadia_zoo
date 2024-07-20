<?php
include "../dbconn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['repondu_demande'])) {
    $contact_id = $_POST['id_contact'];

    // Mettre à jour le statut du réponse à 'Répondu' avec la date de validation actuelle
    $sql_update = "UPDATE contact SET statut = 'Répondu', date_validation = NOW() WHERE id_contact = :id_contact";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bindParam(':id_contact', $contact_id);

    if ($stmt_update->execute()) {
        // Commentaire approuvé avec succès
        header('Location: tableListingDemande.php');
        exit();
    } else {
        // Erreur lors de la mise à jour du statut
        echo "Erreur lors de l'approbation de la demande : " . implode(", ", $stmt_update->errorInfo());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject_demande'])) {
    $contact_id = $_POST['id_contact'];

    // Mettre à jour le statut de la demande à 'Rejeté' avec la date de validation actuelle
    $sql_update = "UPDATE contact SET statut = 'Rejeté', date_validation = NOW() WHERE id_contact = :id_contact";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bindParam(':id_contact', $contact_id);

    if ($stmt_update->execute()) {
        // Demande rejeté avec succès
        header('Location: tableListingDemande.php');
        exit();
    } else {
        // Erreur lors de la mise à jour du statut
        echo "Erreur lors du rejet du la demande : " . implode(", ", $stmt_update->errorInfo());
    }
}

$sql = "SELECT * FROM contact ORDER BY FIELD(statut, 'En attente', 'Publié', 'Rejeté')";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion des demandes</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleFooter.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 100px; /* Ajustez cette valeur selon besoins */
        }
    </style>

</head>
<body>
    <header>
        <?php
        include_once '../headerLogout.php';
        ?>
    </header>

    <section class="container my-5">
        <h3>Liste des demandes</h3>
            <a class="btn btn-outline-success my-3" href="../crudEmployes/adminPageEmployes.php" role="button">Retour page AdminiEployés</a>
            <br>
        <hr>
        <table class="table" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Objet de la demande</th>
                    <th>Email Visiteur</th>
                    <th>Description du message</th>
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
                        <td>{$row['id_contact']}</td>
                        <td>{$row['objet']}</td>
                        <td><a href='mailto:{$row['email']}'>{$row['email']}</a></td>
                        <td>{$row['description_message']}</td>
                        <td>{$row['date_validation']}</td>
                        <td>{$row['statut']}</td>
                        <td>
                            <form action='tableListingDemande.php' method='post'>
                                <input type='hidden' name='id_contact' value='{$row['id_contact']}'>
                                <button type='submit' name='repondu_demande' class='btn btn-success'><i class='fas fa-square-check'></i></button>
                                <button type='submit' name='reject_demande' class='btn btn-danger'><i class='fas fa-times'></i></button>
                            </form>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </section>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
    <?php
    include_once '../footer.php';
    ?>
</html>
