<?php
include_once '../dbconn.php';
include_once '../header.php';

if ($conn === null) {
    die("Erreur de connexion à la base de données.");
}

$sql = "SELECT * FROM horaires";
$stmt = $conn->query($sql);
$days = [
    'Monday' => 'Lundi',
    'Tuesday' => 'Mardi',
    'Wednesday' => 'Mercredi',
    'Thursday' => 'Jeudi',
    'Friday' => 'Vendredi',
    'Saturday' => 'Samedi',
    'Sunday' => 'Dimanche'
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visite Guidée Habitats</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="styleHoraires.css">
</head>
<body>
    <header>
        <?php include '../headerLogout.php'; ?>
    </header>

    <div class="container-fluid p-0">
        <div class="jumbotron bg-cover text-white mb-0" style="background-image: url(../img/horaireBandeau.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 50vh; position: relative;">
            <div class="container py-5" style="position: absolute; bottom: 0; left: 50px; background-color: rgba(11, 149, 244, 0.6); padding: 15px;">
                <h1 class="display-4 font-weight-bold">Les Horaires</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center mb-4">Horaires d'ouverture</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>Heures d'ouverture</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo $days[$row['jour']]; ?></td>
                                <td>
                                    <?php if ($row['fermeture_exceptionnelle']): ?>
                                        Fermé exceptionnellement
                                    <?php else: ?>
                                        de <?php echo date('H:i', strtotime($row['ouverture'])); ?> à <?php echo date('H:i', strtotime($row['fermeture'])); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
<?php include "../footer.php"; ?>
</html>
<?php $conn = null; ?>
