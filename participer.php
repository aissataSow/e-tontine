<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Vérifie que l'ID de la tontine est envoyé en POST
if (!isset($_POST['tontine_id'])) {
    header("Location: tontines.php");
    exit();
}

$tontine_id = (int) $_POST['tontine_id'];

// Vérifie si l'utilisateur participe déjà à cette tontine
$stmt = $pdo->prepare("SELECT COUNT(*) FROM participations WHERE user_id = ? AND tontine_id = ?");
$stmt->execute([$user_id, $tontine_id]);
$dejaParticipant = $stmt->fetchColumn();

if ($dejaParticipant == 0) {
    // L'utilisateur ne participe pas encore, on l'inscrit

    // Insertion de la participation
    $insert = $pdo->prepare("INSERT INTO participations (user_id, tontine_id) VALUES (?, ?)");
    $insert->execute([$user_id, $tontine_id]);

    // Récupération du nom de la tontine pour le message de confirmation
    $stmtNom = $pdo->prepare("SELECT nom FROM tontines WHERE id = ?");
    $stmtNom->execute([$tontine_id]);
    $tontineNom = $stmtNom->fetchColumn();

    // Redirection vers une page de confirmation avec le nom de la tontine
    header("Location: confirmation_participation.php?tontine_nom=" . urlencode($tontineNom));
    exit();
} else {
    // L'utilisateur est déjà participant : on le redirige vers les cotisations
    header("Location: cotisations.php");
    exit();
}
?>
