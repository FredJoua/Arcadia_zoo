<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer employé</title>
        
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
                            <a href="tableListingEmployes.php" class="btn btn-outline-danger">Annuler</a>
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