<?php
include_once("../dbconn.php");

    // Requête pour récupérer les animaux appartenant à l'habitat "Savane" avec une seule image par animal
    $sql = "SELECT h.id_habitat, h.prenom_animal, hi.image
            FROM habitats h
            LEFT JOIN (
                SELECT habitat_id, MIN(id_image) AS id_image
                FROM habitat_image
                GROUP BY habitat_id
            ) AS hi_grouped ON h.id_habitat = hi_grouped.habitat_id
            LEFT JOIN habitat_image hi ON hi_grouped.id_image = hi.id_image
            WHERE h.habitat = 'Savane'";

    $query = $conn->prepare($sql);
    $query->execute();
    $habitats = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitats Savane</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            width: 15rem;
            margin: 30px auto 65px auto; /* 100px de marge en haut pour laisser de la place au header, 50px de marge en bas pour l'espace avec le footer */
        }
        .card-img-top {
            height: 200px; /* Ajustez la hauteur */
            object-fit: cover;
        }
        .card-custom {
            width: 18rem;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .btn-group {
            margin-top: auto;
        }
        .info-text {
            margin-left: 5px;
            padding: 3px;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <?php include_once "../header.php"; // Inclusion du header ?>
    </header>

    <div class="container-fluid p-0">
        <div class="jumbotron bg-cover text-white mb-0" style="background-image: url(../img/bg_savane1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 30vh; position: relative;">
            <div class="container py-5" style="position: absolute; bottom: 0; left: 50px; background-color: rgba(11, 149, 244, 0.6); padding: 15px;">
                <h1 class="display-4 font-weight-bold">Habitats Savane</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-3">
                <div class="info-text">
                    <h3>Bienvenue dans la Savane !</h3>
                    <p>Explorez la savane africaine et découvrez ses incroyables habitants : lions majestueux, éléphants imposants, girafes gracieuses et bien d'autres. Notre espace "Habitats Savane" reproduit fidèlement cet écosystème fascinant, vous offrant une expérience immersive unique.</p>
                    <p>Apprenez-en davantage sur la vie sauvage et les efforts de conservation pour protéger ces espèces emblématiques. Merci de soutenir la biodiversité en visitant notre zoo. Bonne visite !</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($habitats as $habitat): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 rounded-0 shadow card-custom">
                            <?php if (!empty($habitat['image'])): ?>
                                <img class="card-img-top rounded-0" src="data:image/jpeg;base64,<?php echo base64_encode($habitat['image']); ?>" alt="Image de l'habitat">
                            <?php else: ?>
                                <p>Image non disponible</p>
                            <?php endif; ?>
                            <div class="card-body mt-3 mb-3">
                                <h4 class="card-title"><?php echo htmlspecialchars($habitat['prenom_animal']); ?></h4>
                                <div class="btn-group">
                                    <a href="pageDetailHabitats.php?id=<?php echo $habitat['id_habitat']; ?>" class="btn btn-sm btn-outline-secondary">Voir Détail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
    <?php include "../footer.php"; ?> 
</html>
