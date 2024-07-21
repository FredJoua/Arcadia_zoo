<?php
    session_start();
    include_once("../dbconn.php");
    include_once("formInsertIntoEmployes.php");

    $nom = $prenom = $email = $motdepasse = $role_profession = "";
    $errorMessage = $successMessage = "";

    // Vérifier si le formulaire a été soumis
    if (isset($_POST["submit"])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];
        $est_employe = isset($_POST['est_employe']) ? 1 : 0;
        $est_veterinaire = isset($_POST['est_veterinaire']) ? 1 : 0;
        $est_autre = isset($_POST['est_autre']) ? 1 : 0;

        // Déterminer le rôle de profession en fonction des cases cochées
        if ($est_employe) {
            $role_profession = "Est Employé";
            $code_profession = 101; // Est Employé
        } elseif ($est_veterinaire) {
            $role_profession = "Est Vétérinaire";
            $code_profession = 201; // Est Vétérinaire
        } elseif ($est_autre) {
            $role_profession = "Est Autre";
            $code_profession = 301; // Est Autre
        } else {
            // Par défaut, si aucune case n'est cochée
            $role_profession = ""; // Ou toute autre valeur par défaut que vous choisissez
            $code_profession = 0; // Ou toute autre valeur par défaut que vous choisissez
        }

        // Date d'embauche automatique
        $date_embauche = date("Y-m-d H:i:s");

        // Vérifier si la connexion est établie
        if ($conn) {
            // Vérification de l'existence d'un enregistrement avec la même adresse email
            $existingRecord = $conn->prepare("SELECT * FROM employes WHERE email = :email");
            $existingRecord->bindParam(':email', $email);
            $existingRecord->execute();
            $row = $existingRecord->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $errorMessage = "ATTENTION ! Un employé avec cette adresse email existe déjà.";
            } else {
                // code d'insertion dans la base de données
            $sql = "INSERT INTO employes (nom, prenom, email, motdepasse, role_profession, code_profession, date_creation) 
                    VALUES (:nom, :prenom, :email, :motdepasse, :role_profession, :code_profession, :date_creation)";
            $query = $conn->prepare($sql);

            $query->bindParam(':nom', $nom);
            $query->bindParam(':prenom', $prenom);
            $query->bindParam(':email', $email);
            $query->bindParam(':motdepasse', $motdepasse);
            $query->bindParam(':role_profession', $role_profession);
            $query->bindParam(':code_profession', $code_profession);
            $query->bindParam(':date_creation', $date_embauche);

                // Exécution de la requête
                if ($query->execute()) {
                    $successMessage = "L'enregistrement a été effectué avec succès.";
                } else {
                    $errorInfo = $query->errorInfo();
                    // Si l'erreur est due à une contrainte d'unicité violée
                    if ($errorInfo[1] == 1062) {
                        $errorMessage = "ATTENTION ! Un employé avec cette adresse email existe déjà.";
                    } else {
                        $errorMessage = "Erreur d'enregistrement dans la base de données: " . $errorInfo[2];
                    }
                }
            }
        } else {
            $errorMessage = "La connexion à la base de données a échoué.";
        }
    }

    // Fermer la connexion à la base de données
    $conn = null;

    // Redirection vers le formulaire avec un message (succès ou erreur)
    if (!empty($successMessage)) {
        header("location: tableListingEmployes.php?successMessage=$successMessage");
        exit;
    } elseif (!empty($errorMessage)) {
        header("location: tableListingEmployes.php?errorMessage=$errorMessage");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer employés</title>

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

        .container form {
            margin-bottom: 150px; /* Ajoutez un espace de 50px entre le formulaire et le footer */
        }

    </style>
</head>
<body>
    <header>
        <?php include_once '../headerLogout.php'; ?>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-3">
                <div class="alert alert-warning text-center" role="alert">
                    <h4 class="alert-heading">Form Créer Employés</h4>
                    <p></p>
                    <hr>
                </div>
                <!-- Message d'alerte pour le succès -->
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>CONFIRMATION !</strong> L'enregistrement a été effectué avec succès.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>ATTENTION !</strong> Erreur d'enregistrement.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="formInsertIntoEmployes.php" method="post">
                    <div class="row">
                        <div class="col mb-3">
                            <input class="form-control" type="text" name="nom" placeholder="Nom de famille" required oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col mb-3">
                            <input class="form-control" type="text" name="prenom" placeholder="Prénom" required >
                        </div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" placeholder="exemple@email.com" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="motdepasse" placeholder="Mot de passe" readonly> <!-- Champ de mot de passe en lecture seule -->
                    </div>
                    <input type="hidden" name="role_profession" id="role_profession" required> <!-- Champ caché pour role_profession -->

                        <div class="mb-3 form-check">
                            <!-- Champ caché avec valeur par défaut -->
                            <input type="hidden" name="est_employe" value="0">
                            <input type="checkbox" class="form-check-input" name="est_employe" value="101" id="est_employe">
                            <label class="form-check-label" for="est_employe">Est Employé</label>
                        </div>
                        <div class="mb-3 form-check">
                            <!-- Champ caché avec valeur par défaut -->
                            <input type="hidden" name="est_veterinaire" value="0">
                            <input type="checkbox" class="form-check-input" name="est_veterinaire" value="201" id="est_veterinaire">
                            <label class="form-check-label" for="est_veterinaire">Est Vétérinaire</label>
                        </div>
                        <div class="mb-3 form-check">
                            <!-- Champ caché avec valeur par défaut -->
                            <input type="hidden" name="est_autre" value="0">
                            <input type="checkbox" class="form-check-input" name="est_autre" value="301" id="est_autre">
                            <label class="form-check-label" for="est_autre">Est Autre</label>
                        </div>                        


                    <hr class="mb-3">
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" name="submit" class="btn btn-outline-success">Enregistrer</button>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="adminPageBoss.php" class="btn btn-outline-danger">Annuler</a>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <!-- Lien de redirection après succès -->
                        <a href="adminPageBoss.php" class="btn btn-outline-secondary">Retour page Admin Boss</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const nomInput = document.querySelector('input[name="nom"]');
        const prenomInput = document.querySelector('input[name="prenom"]');
        const emailInput = document.querySelector('input[name="email"]');
        const motdepasseInput = document.querySelector('input[name="motdepasse"]');

        nomInput.addEventListener('input', updateEmail);
        prenomInput.addEventListener('input', updateEmail);
        updatePassword(); // Appel initial pour générer le mot de passe

        function updateEmail() {
            const nom = nomInput.value.trim();
            const prenom = prenomInput.value.trim();
            const firstLetterNom = nom.charAt(0).toLowerCase();
            const firstLetterPrenom = prenom.charAt(0).toLowerCase();
            const generatedEmail = `${firstLetterPrenom}${nom}@arcadiazoo.com`;
            emailInput.value = generatedEmail;
            updatePassword(); // Mettre à jour le mot de passe à chaque changement de nom ou prénom
        }

        function updatePassword() {
            const nom = nomInput.value.trim();
            const prenom = prenomInput.value.trim();
            const firstLetterNom = nom.charAt(0).toLowerCase();
            const firstLetterPrenom = prenom.charAt(0).toLowerCase();
            const generatedPassword = `${firstLetterNom}${firstLetterPrenom}12345`;
            motdepasseInput.value = generatedPassword;
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const estEmployeCheckbox = document.getElementById('est_employe');
        const estVeterinaireCheckbox = document.getElementById('est_veterinaire');
        const estAutreCheckbox = document.getElementById('est_autre');

        estEmployeCheckbox.addEventListener('change', function() {
            if (this.checked) {
                estVeterinaireCheckbox.checked = false;
                estAutreCheckbox.checked = false;
            }
        });
        
        estVeterinaireCheckbox.addEventListener('change', function() {
            if (this.checked) {
                estEmployeCheckbox.checked = false;
                estAutreCheckbox.checked = false;
            }
        });
        
        estAutreCheckbox.addEventListener('change', function() {
            if (this.checked) {
                estEmployeCheckbox.checked = false;
                estVeterinaireCheckbox.checked = false;
            }
        });
    });
</script>

    <!-- Bootstrap js link --> 
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
<?php include_once '../footer.php'; ?>
</html>