<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$tontineNom = isset($_GET['tontine_nom']) ? htmlspecialchars($_GET['tontine_nom']) : "la tontine";

include 'includes/header.php';
?>

<div style="max-width: 700px; margin: 50px auto; text-align: center; padding: 30px; background: #eafaf1; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
    <h2 style="color: #27ae60;">🎉 Participation confirmée !</h2>
    <p style="font-size: 1.2em; color: #2c3e50;">
        ✅ Votre participation à la tontine <strong><?= $tontineNom ?></strong> a été enregistrée avec succès.
    </p>
    <p style="margin-top: 20px; color: #34495e;">
        Vous pouvez maintenant effectuer votre première cotisation.
    </p>
    <a href="cotisations.php" style="
        display: inline-block;
        margin-top: 25px;
        padding: 12px 25px;
        background-color: #27ae60;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background 0.3s ease;
    " onmouseover="this.style.backgroundColor='#1e8449'" onmouseout="this.style.backgroundColor='#27ae60'">
        💰 Cotiser maintenant
    </a>
</div>

<?php include 'includes/footer.php'; ?>
