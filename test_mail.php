<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ton.email@gmail.com';
    $mail->Password = 'mot_de_passe_app';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('ton.email@gmail.com', 'Test Mail');
    $mail->addAddress('ton.email@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test de PHPMailer';
    $mail->Body    = 'Ce mail est un test.';

    $mail->send();
    echo '✅ Message envoyé avec succès.';
} catch (Exception $e) {
    echo '❌ Erreur : ' . $mail->ErrorInfo;
}
