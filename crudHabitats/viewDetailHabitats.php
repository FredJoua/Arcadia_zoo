<?php
include_once "../dbconn.php";

$habitat_id = $_GET['id'];

try {
    // Récupérer les détails de l'habitat
    $sql = "SELECT * FROM habitats WHERE id_habitat = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $habitat_id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les animaux dans cet habitat
    $sql = "SELECT * FROM animals WHERE habitat_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $habitat_id]);
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Habitat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo $habitat['prenom']; ?></h1>
        <img src="path_to_image/<?php echo $habitat['img']; ?>" class="img-fluid" alt="Image">
        <p><?php echo $habitat['description']; ?></p>
        <h2>Animaux dans cet Habitat</h2>
        <div class="row">
            <?php foreach ($animals as $animal): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="path_to_image/<?php echo $animal['img']; ?>" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $animal['prenom']; ?></h5>
                            <p class="card-text">Race: <?php echo $animal['race']; ?></p>
                            <a href="viewAnimalDetails.php?id=<?php echo $animal['id']; ?>" class="btn btn-primary">Voir Détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
