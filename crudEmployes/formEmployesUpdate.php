<?php
include_once("../dbconn.php");

$id_employe = $nom = $prenom = $email = $motdepasse = $role_profession = $code_profession = "";
$errorMessage = $successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Méthode GET pour afficher les données de l'employé
    if (!isset($_GET["id_employe"])) {
        header("location:tableListingEmployes.php");
        exit;
    }

    $id = $_GET["id_employe"];
    // Lire la ligne de l'employé sélectionné dans la base de données
    $sql = "SELECT * FROM employes WHERE id_employe = $id";
    $query = $conn->query($sql);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    
    if (!$row) {
        header("location:tableListingEmployes.php");
        exit;
    }
    
    $id_employe = $row['id_employe'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $email = $row['email'];
    $motdepasse = $row['motdepasse'];
    $role_profession = $row['role_profession']; 
    $code_profession = $row['code_profession'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Méthode POST pour apporter des modifications
    $id_employe = $_POST["id_employe"];
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

    // Mettre à jour les données de l'employé dans la base de données
    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($motdepasse) && !empty($role_profession) && !empty($code_profession)) {
        $sql = "UPDATE employes SET nom='$nom', prenom='$prenom', email='$email', motdepasse='$motdepasse', role_profession='$role_profession', code_profession='$code_profession' WHERE id_employe = $id_employe";
        $query = $conn->query($sql);
        
        if ($query->execute()) {
            $successMessage = "Données employé modifiée avec succès";
            header("location:tableListingEmployes.php");
            exit;
        } else {
            $errorMessage = "Erreur dans la mise à jour: " . $query->errorInfo()[2];
        }
    } else {
        $errorMessage = "ATTENTION ! Tous les champs doivent être remplis";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier employé</title>


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

                <form action="formEmployesUpdate.php" method="post">
                    <input type="hidden" name="id_employe" value="<?php echo $id_employe; ?>">
                    <div class="row">
                        <div class="col mb-3">
                            <input class="form-control" type="text" name="nom" placeholder="Nom de famille" value="<?php echo $nom; ?>" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col mb-3">
                            <input class="form-control" type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom; ?>" >
                        </div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" placeholder="exemple@email.com" value="<?php echo $email; ?>">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="motdepasse" placeholder="Mot de passe" value="<?php echo $motdepasse; ?>"> 
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="est_employe" value="1" id="est_employe" <?php if ($role_profession == "Est Employé") echo "checked"; ?>>
                        <label class="form-check-label" for="est_employe">Est Employé</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="est_veterinaire" value="1" id="est_veterinaire" <?php if ($role_profession == "Est Vétérinaire") echo "checked"; ?>>
                        <label class="form-check-label" for="est_veterinaire">Est Vétérinaire</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="est_autre" value="1" id="est_autre" <?php if ($role_profession == "Est Autre") echo "checked"; ?>>
                        <label class="form-check-label" for="est_autre">Est Autre</label>
                    </div>

                    <hr class="mb-3">
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" name="submit" class="btn btn-outline-success">Enregistrer</button>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a type="cancel" href="tableListingEmployes.php" class="btn btn-outline-danger">Annuler</a>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <!-- Lien de redirection après succès -->
                        <a href="../index.php" class="btn btn-secondary">Retour à la page d'accueil</a>
                    </div>
                </form>
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

    <!-- Bootstrap js link --> 
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
    <?php include_once '../footer.php'; ?>
</html>