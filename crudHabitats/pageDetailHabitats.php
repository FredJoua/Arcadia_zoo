<?php
    include_once("../dbconn.php");

    if (isset($_GET['id'])) {
        $id_habitat = $_GET['id'];

        // Incrémenter le compteur de consultations
        $sqlUpdate = "UPDATE habitats SET consultations = consultations + 1 WHERE id_habitat = :id_habitat";
        $queryUpdate = $conn->prepare($sqlUpdate);
        $queryUpdate->bindParam(':id_habitat', $id_habitat, PDO::PARAM_INT);
        $queryUpdate->execute();

        // Requête pour récupérer les détails de l'habitat et toutes les images de l'animal sélectionné
        $sql = "SELECT h.habitat, h.description_habitat, h.prenom_animal, hi.image
                FROM habitats h
                LEFT JOIN habitat_image hi ON h.id_habitat = hi.habitat_id
                WHERE h.id_habitat = :id_habitat";
        $query = $conn->prepare($sql);
        $query->bindParam(':id_habitat', $id_habitat, PDO::PARAM_INT);
        $query->execute();
        $habitat_details = $query->fetchAll(PDO::FETCH_ASSOC);

        // Si aucun enregistrement n'est trouvé
        if (!$habitat_details) {
            echo "Aucun habitat trouvé.";
            exit;
        }
    } else {
        echo "Aucun habitat sélectionné.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Habitat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            width: 24rem;
            margin: 100px auto 0 auto; /* 100px de marge en haut pour laisser de la place au header */
        }
        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .details-header {
            font-weight: bold;
        }
        .content-wrapper {
            margin-bottom: 100px; /* Espace pour le footer */
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <?php include_once "../header.php"; ?>
    </header>

    <div class="container-fluid p-0">
        <div class="jumbotron bg-cover text-white mb-0" style="background-image: url(../img/BannerHoraires.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 30vh; position: relative;">
            <div class="container py-5" style="position: absolute; bottom: 0; left: 50px; background-color: rgba(11, 149, 244, 0.6); padding: 15px;">
                <h1 class="display-4 font-weight-bold">L'Habitat des Animaux</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5 content-wrapper">
        <?php if (!empty($habitat_details)): ?>
            <div class="card border-0 rounded-0 shadow">
                <div id="habitatCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($habitat_details as $index => $detail): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <?php if (!empty($detail['image'])): ?>
                                <img class="d-block w-100" src="data:image/jpeg;base64,<?php echo base64_encode($detail['image']); ?>" alt="Image de l'habitat">
                            <?php else: ?>
                                <p>Image non disponible</p>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#habitatCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#habitatCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="card-body mt-3 mb-3">
                    <h4 class="card-title"><?php echo htmlspecialchars($habitat_details[0]['prenom_animal']); ?></h4>
                    <p class="details-header">Habitat: <?php echo htmlspecialchars($habitat_details[0]['habitat']); ?></p>
                    <p class="details-header">Description: <?php echo htmlspecialchars($habitat_details[0]['description_habitat']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>Aucun détail disponible pour cet habitat.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
    <?php include "../footer.php"; ?>
</html>
