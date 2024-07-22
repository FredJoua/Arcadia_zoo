<?php
include_once("../dbconn.php");

// Requêtes pour récupérer les habitats avec une seule image par animal
$sql = "SELECT h.id_habitat, h.prenom_animal, hi.image
        FROM habitats h
        LEFT JOIN (
            SELECT habitat_id, MIN(id_image) AS id_image
            FROM habitat_image
            GROUP BY habitat_id
        ) AS hi_grouped ON h.id_habitat = hi_grouped.habitat_id
        LEFT JOIN habitat_image hi ON hi_grouped.id_image = hi.id_image";
$query = $conn->prepare($sql);
$query->execute();
$habitats = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Habitats</title>
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
        <?php
        include_once "../header.php"; 
        ?>
    </header>

    <div class="container-fluid p-0">
        <div class="jumbotron bg-cover text-white mb-0" style="background-image: url(../img/bg_jungle.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 30vh; position: relative;">
            <div class="container py-5" style="position: absolute; bottom: 0; left: 50px; background-color: rgba(11, 149, 244, 0.6); padding: 15px;">
                <h1 class="display-4 font-weight-bold">Les Habitats</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-3">
                <div class="info-text">
                    <h3>Bienvenue dans nos Habitats : Savane, Jungle et Marais !</h3>
                    <p>Plongez au cœur de trois écosystèmes fascinants et découvrez la diversité incroyable de la vie sauvage que nous avons recréée pour vous.</p>
                </div>
                <div class="info-text">
                    <h4>La Savane</h4>
                    <p>Explorez la savane africaine et ses majestueux habitants : 
                        lions, éléphants, girafes et bien d'autres. Ressentez l'immensité 
                        des plaines herbeuses et apprenez-en davantage sur les comportements 
                        et les interactions de ces animaux emblématiques.</p>
                </div>
                <div class="info-text">
                    <h4>La Jungle</h4>
                    <p>Entrez dans la jungle luxuriante et vibrante, où vous rencontrerez 
                        des singes espiègles, des oiseaux colorés et des reptiles fascinants. 
                        Découvrez les secrets de cet habitat dense et la diversité exceptionnelle 
                        qu'il abrite.</p>
                </div>
                <div class="info-text">
                    <h4>Le Marais</h4>
                    <p>Terminez votre voyage en explorant les marais mystérieux, peuplés d'alligators, 
                        de tortues et d'oiseaux aquatiques. Comprenez l'importance de ces zones humides 
                        pour notre planète et les initiatives de conservation mises en place pour 
                        les protéger.</p>
                </div>
                <div class="alert alert-info" role="alert">
                    Nous vous invitons à vous immerger dans ces habitats reconstitués, 
                    à observer la faune de près et à soutenir nos efforts de conservation. 
                    Merci de votre visite et bonne exploration !
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
