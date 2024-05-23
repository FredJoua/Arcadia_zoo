<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styleFooter.css">
        <style>
        .carousel-item p {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Footer -->
    <footer class="bg-dark pt-5 pb-4">
        <div class="container text-md-left">
            <div class="row">
                <!-- Commentaires des clients -->
                <div class="col-md-3 col-lg-3 col-xl-3 mt-3 text-left light-background">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Commentaires des clients</h5>

                    <!-- insertion des commentaires validés dans le carrousel -->
                    <div id="commentCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            // Connexion à la base de données
                            $db_host = "localhost";
                            $db_name = "db_arcadiaZoo";
                            $db_user = "root";
                            $db_password = "root";

                            try {
                                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                // Requête pour récupérer les commentaires publiés
                                $query = "SELECT * FROM visiteurs WHERE statut = 'Publié' ORDER BY date_validation DESC LIMIT 2";
                                $result = $conn->query($query);

                                // Récupérer les commentaires dans un tableau
                                $active = true;
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    // Ajouter le commentaire dans une div avec la classe carousel-item
                                    echo '<div class="carousel-item';
                                    if ($active) {
                                        echo ' active';
                                        $active = false;
                                    }
                                    echo '">';
                                    echo '<p>' . $row['commentaires'] . '</p>';
                                    echo '</div>';
                                }
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#commentCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#commentCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Informations sur le garage -->
                <div class="col-md-3 col-lg-3 mx-auto mt-3 text-md-right">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Arcadia Zoo</h5>
                    <p class="text-white text-left">Chez Arcadia ZOO, le bonheur et le bien-être de nos animaux sont au cœur de notre mission.</p>
                </div>

                <!-- Contact -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-right">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Adresse</h5>
                    <ul class="list-unstyled text-white">
                        <li class="text-white text-left horizontal-align: middle;"><i class="fas fa-home mr-3" style="margin-right: 10px;"></i> 2, rue de Grosne, 90130 Bretagne</li>
                        <li class="text-white text-left"><i class="fas fa-envelope mr-3" style="margin-right: 10px;"></i> info@arcadiazoo.com</li>
                        <li class="text-white text-left"><i class="fas fa-phone mr-3" style="margin-right: 10px;"></i> 03 70 02 00 00</li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 text-white">
            <div class="text-center">
                <p class="text-warning"> &copy; 2024 Arcadia Zoo. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Carrousel Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        // Fonction pour mettre à jour le contenu du carrousel avec les commentaires
        function updateCarousel() {
            // Récupérer l'élément de la liste du carrousel
            var commentElement = document.querySelector('.commentCarousel ul');

            // Récupérer les commentaires depuis getComments.php
            fetch('getComments.php')
                .then(response => response.json())
                .then(comments => {
                    // Effacer le contenu actuel du carrousel
                    commentElement.innerHTML = '';

                    // Ajouter chaque commentaire à la liste du carrousel
                    comments.forEach(comment => {
                        var li = document.createElement('li');
                        li.textContent = comment;
                        commentElement.appendChild(li);
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération des commentaires:', error));
        }

        // Appeler la fonction pour mettre à jour le carrousel dès que la page est chargée
        document.addEventListener('DOMContentLoaded', function() {
            updateCarousel();

            // Mettre à jour le carrousel toutes les 5 secondes
            setInterval(updateCarousel, 5000);
        });
    </script>

</body>
</html>