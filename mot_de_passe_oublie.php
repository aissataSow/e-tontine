<?php
session_start();
require_once 'includes/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    // Vérifie si l'email existe
    $stmt = $pdo->prepare("SELECT id, username FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expire = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Sauvegarde du token dans la base
        $stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$user['id'], $token, $expire]);

        // Préparation de l'e-mail
        $resetLink = "http://localhost/e-tontine/reset_password.php?token=$token";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ton.email@gmail.com';
            $mail->Password   = 'ohkgwmjqkddzofrm'; // Mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('ton.email@gmail.com', 'E-Tontine');
            $mail->addAddress($email, $user['username']);

            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation de votre mot de passe';
            $mail->Body    = "
                <p>Bonjour <strong>{$user['username']}</strong>,</p>
                <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
                <p><a href=\"$resetLink\">Réinitialiser mon mot de passe</a></p>
                <p>Ce lien expirera dans 1 heure.</p>
            ";

            $mail->send();
            $message = "✅ Un lien de réinitialisation vous a été envoyé par email.";
        } catch (Exception $e) {
            $message = "❌ Erreur d'envoi du mail : " . $mail->ErrorInfo;
        }

    } else {
        $message = "❌ Aucune adresse email trouvée.";
    }
}

$pageTitle = "Mot de passe oublié";
include 'includes/header.php';
?>
<br>
<h2 style="text-align: center;">🔐 Mot de passe oublié</h2>

<form method="post" style="max-width: 400px; margin: auto;">
   <input type="email" name="email" placeholder="Adresse email" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; margin-bottom: 10px; box-sizing: border-box; width: 100%;">
    <button type="submit">Envoyer un lien de réinitialisation</button>
</form>

<?php if ($message): ?>
    <p style="text-align:center; color:<?= strpos($message, '✅') === 0 ? 'green' : 'red' ?>; margin-top: 15px;">
        <?= $message ?>
    </p>
<?php endif; ?>

<p style="text-align: center;"><a href="index.php">🔙 Retour à la connexion</a></p>
<br><br><br>
<?php include 'includes/footer.php'; ?>
