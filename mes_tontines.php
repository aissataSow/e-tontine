<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'includes/db.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

// Récupération des tontines + état de cotisation mensuelle
$stmt = $pdo->prepare("
    SELECT t.id, t.nom, t.description, t.type,
           (SELECT COUNT(*) FROM cotisations c 
            WHERE c.tontine_id = t.id 
              AND c.user_id = ? 
              AND MONTH(c.date_cotisation) = MONTH(CURRENT_DATE()) 
              AND YEAR(c.date_cotisation) = YEAR(CURRENT_DATE())
           ) AS a_cotise
    FROM tontines t
    JOIN participations p ON p.tontine_id = t.id
    WHERE p.user_id = ?
");
$stmt->execute([$user_id, $user_id]);
$tontines = $stmt->fetchAll();
?>

<h2>📘 Mes Tontines</h2>

<?php if (count($tontines) > 0): ?>
    <ul class="tontine-list" style="list-style: none; padding: 0;">
        <?php foreach ($tontines as $tontine): ?>
            <li style="border: 1px solid #ccc; border-radius: 8px; padding: 15px; margin-bottom: 15px; background: #f9f9f9;">
                <strong style="font-size: 1.1em; color: #16a085;">
                    <?= htmlspecialchars($tontine['nom']) ?> (<?= htmlspecialchars($tontine['type']) ?>)
                </strong><br>
                
                <p style="margin: 8px 0;"><?= nl2br(htmlspecialchars($tontine['description'])) ?></p>
                
                <p>
                    <span style="color: <?= $tontine['a_cotise'] ? 'green' : 'red' ?>;">
                        <?= $tontine['a_cotise'] ? '✅ Cotisation effectuée cette semaine' : '❌ Cotisation non faite cette semeine' ?>
                    </span>
                </p>

                <?php if (!$tontine['a_cotise']): ?>
                    <a href="cotisations.php?tontine=<?= $tontine['id'] ?>" class="btn btn-primary" style="margin-right: 10px;">💰 Cotiser</a>
                <?php endif; ?>

                <a href="details_tontine.php?tontine=<?= $tontine['id'] ?>" class="btn btn-secondary">🔍 Voir détails</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Vous n'avez encore participé à aucune tontine.</p>
<?php endif; ?>

<br><br><br><br><br><br><br><br><br><br>
<?php include 'includes/footer.php'; ?>
