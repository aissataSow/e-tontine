<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['tontine'])) {
    echo "<p>Tontine non spécifiée.</p>";
    include 'includes/footer.php';
    exit();
}

$tontine_id = (int)$_GET['tontine'];
$user_id = $_SESSION['user_id'];

// Vérifier que l'utilisateur participe à cette tontine
$check = $pdo->prepare("SELECT COUNT(*) FROM participations WHERE tontine_id = ? AND user_id = ?");
$check->execute([$tontine_id, $user_id]);
if ($check->fetchColumn() == 0) {
    echo "<p>Accès refusé à cette tontine.</p>";
    include 'includes/footer.php';
    exit();
}

// Récupérer infos de la tontine
$stmt = $pdo->prepare("SELECT nom, type, description FROM tontines WHERE id = ?");
$stmt->execute([$tontine_id]);
$tontine = $stmt->fetch();

// Récupérer les participants
$stmt2 = $pdo->prepare("
    SELECT u.username 
    FROM users u 
    JOIN participations p ON p.user_id = u.id 
    WHERE p.tontine_id = ?
");
$stmt2->execute([$tontine_id]);
$participants = $stmt2->fetchAll();

// Récupérer les cotisations
$stmt3 = $pdo->prepare("
    SELECT c.montant, c.date_cotisation, u.username
    FROM cotisations c
    JOIN users u ON c.user_id = u.id
    WHERE c.tontine_id = ?
    ORDER BY c.date_cotisation DESC
");
// Récupérer les participants avec date de participation
$stmt2 = $pdo->prepare("
    SELECT u.username, p.created_at
    FROM users u 
    JOIN participations p ON p.user_id = u.id 
    WHERE p.tontine_id = ?
    ORDER BY p.created_at ASC
");
$stmt2->execute([$tontine_id]);
$participants = $stmt2->fetchAll();

// Déterminer le bénéficiaire du mois en cours
$currentMonthIndex = (int)date('n') - 1; // Janvier = 0
$beneficiaire = $participants[$currentMonthIndex % count($participants)]['username'];

$stmt3->execute([$tontine_id]);
$cotisations = $stmt3->fetchAll();
?>

<h2>📄 Détails de la Tontine</h2>

<section style="margin-bottom: 30px;">
    <h3 style="color: #2c3e50;"><?= htmlspecialchars($tontine['nom']) ?> (<?= $tontine['type'] ?>)</h3>
    <p style="color: #555;"><?= nl2br(htmlspecialchars($tontine['description'])) ?></p>
</section>

<section style="margin-bottom: 30px;">
    <h4>🎯 Bénéficiaire du mois</h4>
    <p style="font-size: 1.2em; font-weight: bold; color: #27ae60;">
        <?= htmlspecialchars($beneficiaire) ?>
    </p>
</section>


<section style="margin-bottom: 30px;">
    <h4>👥 Participants</h4>
    <ul>
        <?php foreach ($participants as $p): ?>
            <li><?= htmlspecialchars($p['username']) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<section>
    <h4>💳 Cotisations</h4>
    <?php if (empty($cotisations)): ?>
        <p>Aucune cotisation enregistrée pour cette tontine.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #16a085; color: white;">
                    <th style="padding: 10px; text-align: left;">Membre</th>
                    <th style="padding: 10px; text-align: left;">Montant (FCFA)</th>
                    <th style="padding: 10px; text-align: left;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cotisations as $c): ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;"><?= htmlspecialchars($c['username']) ?></td>
                        <td style="padding: 10px;"><?= number_format($c['montant'], 0, ',', ' ') ?></td>
                        <td style="padding: 10px;"><?= date('d/m/Y', strtotime($c['date_cotisation'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<br><br>
<a href="mes_tontines.php" style="text-decoration: none; color: #2980b9;">← Retour à mes tontines</a>

<?php include 'includes/footer.php'; ?>
