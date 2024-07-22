<?php
    include_once("../dbconn.php");

    $sql = "SELECT prenom_animal, consultations FROM habitats ORDER BY consultations DESC";
    $query = $conn->prepare($sql);
    $query->execute();
    $consultations = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>

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

<body>
    <header>
        <?php
           include '../headerLogout.php';
        ?>
    </header>
    <div class="container mt-5">
        <h1 class="mb-4">Consultations des Animaux</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Animal</th>
                    <th>Consultations</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultations as $consultation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($consultation['prenom_animal']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['consultations']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
    <?php include "../footer.php"; ?>
</html>
