<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'includes/db.php';

$pageTitle = "Tableau de bord";
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

// Récupérer les tontines
$stmt = $pdo->prepare("
    SELECT t.nom, t.type, t.description
    FROM tontines t
    JOIN participations p ON p.tontine_id = t.id
    WHERE p.user_id = ?
");

$stmt->execute([$user_id]);
$mesTontines = $stmt->fetchAll();

// Cotisations récentes
$stmt2 = $pdo->prepare("
    SELECT c.tontine_id, c.montant, c.date_cotisation, t.nom AS tontine_nom
    FROM cotisations c
    JOIN tontines t ON t.id = c.tontine_id
    WHERE c.user_id = ?
    ORDER BY c.date_cotisation DESC
    LIMIT 5
");

// Vérifier s'il manque une cotisation cette semaine
$alerteCotisation = false;

$stmt3 = $pdo->prepare("
    SELECT t.id
    FROM tontines t
    INNER JOIN participations p ON p.tontine_id = t.id
    WHERE p.user_id = ?
");
$stmt3->execute([$user_id]);
$tontines = $stmt3->fetchAll(PDO::FETCH_COLUMN);

foreach ($tontines as $tontine_id) {
    $stmt4 = $pdo->prepare("
        SELECT COUNT(*) FROM cotisations
        WHERE user_id = ? AND tontine_id = ? AND YEARWEEK(date_cotisation, 1) = YEARWEEK(NOW(), 1)
    ");
    $stmt4->execute([$user_id, $tontine_id]);
    $hasPaid = $stmt4->fetchColumn();

    if (!$hasPaid) {
        $alerteCotisation = true;
        break;
    }
}

$stmt2->execute([$user_id]);
$dernieresCotisations = $stmt2->fetchAll();
?>

<style>
.carousel-wrapper {
    width: 100%;
    max-width: 100%;
    overflow: hidden;
    margin: 30px 0;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.carousel-track {
    display: flex;
    animation: scroll-left 25s linear infinite;
    width: max-content;
}

.carousel-track img {
    width: 300px;
    height: 180px;
    object-fit: cover;
    margin-right: 10px;
    border-radius: 8px;
}

@keyframes scroll-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

@media (max-width: 768px) {
    .carousel-track img {
        width: 240px;
        height: 140px;
    }
}
</style>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2 style="font-size: 2.2em; font-weight: bold; color: #2c3e50; margin-bottom: 10px;">
        📊 Tableau de bord
    </h2>

    <!-- Icône Notification -->
    <div style="position: relative;">
        <div onclick="toggleNotification()" style="font-size: 1.6em; color: #2c3e50; cursor: pointer;" title="Voir les notifications">
            🔔
        </div>

        <div id="notifBox" style="display: none; position: absolute; right: 0; top: 30px; background: #f4f4f4; border: 1px solid #ccc; padding: 12px 16px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 10; min-width: 220px; font-size: 0.95em; color: #333;">
            <?php if ($alerteCotisation): ?>
                🔔 <strong>N'oubliez pas de cotiser cette semaine !</strong>
            <?php else: ?>
                <span id="noNotifMsg">✅ Aucune notification pour le moment.</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function toggleNotification() {
    const box = document.getElementById("notifBox");
    box.style.display = (box.style.display === "none" || box.style.display === "") ? "block" : "none";

    // Si pas d'alerte (aucune notification), masquer après 3s
    const noNotif = document.getElementById("noNotifMsg");
    if (noNotif) {
        setTimeout(() => {
            box.style.display = "none";
        }, 3000);
    }
}
</script>




<p style="font-size: 1.2em; color: #34495e; margin-bottom: 20px;">
    👋 Bienvenue, <strong style="color: #16a085;"><?= htmlspecialchars($_SESSION['username']) ?></strong> !
</p>

<!-- 🎞️ Carrousel d'images -->
<div class="carousel-wrapper">
    <div class="carousel-track">
        <img src="images/img5.jpg" alt="img1">
        <img src="images/argent.jpg" alt="img2">
        <img src="images/img2.jpg" alt="img5">
        <img src="images/evolution.jpg" alt="img3">
        <img src="images/cotisation.jpg" alt="img4">
        <img src="images/img1.jpg" alt="img5">
        <img src="images/img3.jpg" alt="img6">
    </div>
</div>

<section style="margin-bottom: 40px;">
    <h3 style="color: #2c3e50;">Vos tontines actives :</h3>

    <?php if (empty($mesTontines)): ?>
        <p>⚠️ Vous ne participez à aucune tontine. <a href="tontines.php">Voir les tontines disponibles</a></p>
    <?php else: ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($mesTontines as $tontine): ?>
                <li style="border: 1px solid #ccc; border-radius: 8px; padding: 15px; margin-bottom: 15px; background: #f9f9f9;">
                    <strong style="font-size: 1.1em; color: #16a085;"><?= htmlspecialchars($tontine['nom']) ?></strong>
                    <em style="font-size: 0.9em; color: #777; margin-left: 10px;">
                        (<?= ucfirst(htmlspecialchars($tontine['type'])) ?>)
                    </em>
                    <p style="margin-top: 8px; text-align: justify; color: #555;">
                        <?= nl2br(htmlspecialchars($tontine['description'])) ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<section>
    <h3 style="color: #2c3e50;">Dernières cotisations effectuées :</h3>

    <?php if (empty($dernieresCotisations)): ?>
        <p>Aucune cotisation enregistrée pour le moment.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #16a085; color: white;">
                    <th style="padding: 10px; text-align: left;">Tontine</th>
                    <th style="padding: 10px; text-align: left;">Montant (FCFA)</th>
                    <th style="padding: 10px; text-align: left;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dernieresCotisations as $cotisation): ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;"><?= htmlspecialchars($cotisation['tontine_nom']) ?></td>
                        <td style="padding: 10px;"><?= number_format($cotisation['montant'], 0, ',', ' ') ?></td>
                        <td style="padding: 10px;"><?= date('d/m/Y', strtotime($cotisation['date_cotisation'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
