<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer les tontines auxquelles l'utilisateur participe
$stmt = $pdo->prepare("
    SELECT t.id, t.nom
    FROM tontines t
    INNER JOIN participations p ON p.tontine_id = t.id
    WHERE p.user_id = ?
");
$stmt->execute([$user_id]);
$mesTontines = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<!-- ✅ Message de confirmation stylé -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div id="successMessage" style="
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        margin: 20px auto;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        max-width: 600px;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    ">
        ✅ Votre cotisation de 5250 FCFA a été enregistrée avec succès !
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('successMessage');
            if (msg) msg.style.display = 'none';
        }, 5000);
    </script>
<?php endif; ?>

<!-- ❌ Message d'erreur si déjà cotisé -->
<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <div style="
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        margin: 20px auto;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        max-width: 600px;
        text-align: center;
        font-weight: bold;
    ">
        ⚠️ Vous avez déjà cotisé cette semaine pour cette tontine.
    </div>
<?php endif; ?>

<h2>💰 Effectuer une cotisation</h2>

<?php if (count($mesTontines) === 0): ?>
    <p>⚠️ Vous ne participez à aucune tontine. <a href="tontines.php">Voir les tontines disponibles</a></p>
<?php else: ?>
    <form method="post" action="traiter_cotisation.php" style="max-width: 600px; margin-top: 20px;">
        <label for="tontine_id"><strong>Choisissez une tontine :</strong></label><br>
        <select name="tontine_id" id="tontine_id" required style="width: 100%; padding: 8px; margin-bottom: 15px;">
            <option value="">-- Sélectionner une tontine --</option>
            <?php foreach ($mesTontines as $tontine): ?>
                <option value="<?= htmlspecialchars($tontine['id']) ?>">
                    <?= htmlspecialchars($tontine['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <p><strong>Montant de la cotisation :</strong> <span style="color: green;">5250 FCFA</span> (fixe)</p>

        <button type="submit" style="padding: 10px 20px;">💵 Cotiser</button>
    </form>
<?php endif; ?>

<br><br><br><br>
<?php include 'includes/footer.php'; ?>
