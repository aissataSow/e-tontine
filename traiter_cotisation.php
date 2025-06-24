<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tontine_id = $_POST['tontine_id'] ?? null;
$montant = 5250; // Montant fixe

if (!$tontine_id) {
    die("⚠️ Tontine non spécifiée.");
}

// Vérifie que l'utilisateur participe à la tontine
$stmt = $pdo->prepare("SELECT * FROM participations WHERE user_id = ? AND tontine_id = ?");
$stmt->execute([$user_id, $tontine_id]);
$participation = $stmt->fetch();

if (!$participation) {
    die("⚠️ Vous ne participez pas à cette tontine.");
}

// Vérifie s’il a déjà cotisé cette semaine
$check = $pdo->prepare("
    SELECT id FROM cotisations
    WHERE user_id = ? AND tontine_id = ?
    AND YEARWEEK(date_cotisation, 1) = YEARWEEK(CURDATE(), 1)
");
$check->execute([$user_id, $tontine_id]);
$alreadyPaid = $check->fetch();

if ($alreadyPaid) {
    header("Location: cotisations.php?error=1");
    exit();
}

// Enregistre la cotisation
$stmt = $pdo->prepare("INSERT INTO cotisations (user_id, tontine_id, montant, date_cotisation)
                       VALUES (?, ?, ?, NOW())");
$stmt->execute([$user_id, $tontine_id, $montant]);

header("Location: cotisations.php?success=1");
exit();
