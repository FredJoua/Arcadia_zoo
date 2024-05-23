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
    <title>Gestion des demandes</title>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <?php
        include_once '../headerLogout.php';
        ?>
    </header>

    <section class="container my-5">
        <h3>Liste des demandes</h3>
            <a class="btn btn-outline-success my-3" href="../adminPageEployes.php" role="button">Retour page AdminiEployés</a>
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

    <!-- Bootstrap js link --> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>
</body>
    <?php
    include_once '../footer.php';
    ?>
</html>
