<?php
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
*/
//require 'vendor/autoload.php';

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$typeContrat = $_POST['type_contrat'];

// Créer un nouvel objet PHPMailer
//$mail = new PHPMailer(true);

try {
    // Paramètres SMTP de Gmail
    /*
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'votre_adresse_email@gmail.com'; // Votre adresse e-mail Gmail
    $mail->Password = 'votre_mot_de_passe'; // Votre mot de passe Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Destinataire
    $mail->setFrom('studifred@gmail.com', 'Arcadia Zoo');
    $mail->addAddress($email, "$prenom $nom");

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Bienvenue chez Arcadia Zoo';
    $mail->Body    = "Bonjour $prenom $nom,<br><br>Votre adresse e-mail pour Arcadia Zoo a été créée : $email<br>Type de contrat : $typeContrat<br><br>Veuillez contacter l'administrateur pour obtenir votre mot de passe.<br><br>";

    // Envoyer l'e-mail
    $mail->send();
    echo "Un e-mail a été envoyé à $email avec les instructions pour obtenir votre mot de passe. Veuillez contacter l'administrateur.";
    */
} catch (Exception $e) {
    // Gérer les erreurs
    echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
}
?>
