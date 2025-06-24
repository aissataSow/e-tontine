<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'includes/db.php';

$pageTitle = "Tontines";
include 'includes/header.php';
?>

<!-- TITRE ET DESCRIPTION GÉNÉRALE EN HAUT -->
<div style="text-align: center; margin-bottom: 40px;">
    <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700; color: #2c3e50;">
        Tontines Mensuelles et Annuelles
    </h1>
    <p style="font-size: 1.1rem; color: #34495e; max-width: 600px; margin: 0 auto;">
        Découvrez nos tontines adaptées à vos besoins, mensuelles et annuelles, avec toutes les règles expliquées.
    </p>
</div>

<!-- CONTENEUR FLEX -->
<div style="
    display: flex; 
    gap: 30px; 
    flex-wrap: wrap; 
    align-items: stretch; 
    max-width: 1200px; 
    margin: 0 auto;
">

    <!-- TONTINES MENSUELLES -->
    <div style="
        flex: 1 1 45%;
        background: #ecf0f1; 
        border-radius: 12px; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-sizing: border-box;
    ">
        <div>
            <h2 style="color: #27ae60; margin-bottom: 15px;">🟢 Tontines Mensuelles</h2>
            <p class="tontine-rules" style="color: #2c3e50; line-height: 1.5; margin-bottom: 25px; text-align: justify;">
                Chaque membre verse <strong>5 250 FCFA</strong> chaque week-end.<br>
                Le bénéficiaire du mois reçoit <strong>200 000 FCFA</strong> nets.<br>
                Les <strong>250 FCFA</strong> d’intérêt par personne sont collectés chaque semaine par le <strong>gérant</strong>.<br>
                Le cycle dure <strong>10 mois</strong> avec une rotation entre les 10 membres.
            </p>

            <ul class="tontine-list" style="padding-left: 0; list-style: none;">
                <?php
                $stmtMensuel = $pdo->prepare("SELECT * FROM tontines WHERE type = 'mensuel'");
                $stmtMensuel->execute();
                $tontinesMensuelles = $stmtMensuel->fetchAll();

                if (count($tontinesMensuelles) === 0) {
                    echo "<p>Aucune tontine mensuelle disponible pour le moment.</p>";
                }

                foreach ($tontinesMensuelles as $tontine): ?>
                    <li style="
                        margin-bottom: 20px; 
                        background: white; 
                        border-radius: 8px; 
                        padding: 15px; 
                        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
                    ">
                        <strong style="color: #27ae60; font-size: 1.1rem;"><?= htmlspecialchars($tontine['nom']) ?></strong><br>
                        <?= nl2br(htmlspecialchars($tontine['description'])) ?><br><br>
                        <form method="post" action="participer.php" style="margin-top: 10px;">
                            <input type="hidden" name="tontine_id" value="<?= $tontine['id'] ?>">
                            <button type="submit" style="
                                background-color: #27ae60; 
                                color: white; 
                                border: none; 
                                padding: 8px 16px; 
                                border-radius: 5px; 
                                cursor: pointer;
                                transition: background-color 0.3s ease;
                            " onmouseover="this.style.backgroundColor='#219150'" onmouseout="this.style.backgroundColor='#27ae60'">
                                Participer
                            </button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- TONTINES ANNUELLES -->
    <div style="
        flex: 1 1 45%;
        background: #ecf0f1; 
        border-radius: 12px; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-sizing: border-box;
    ">
        <div>
            <h2 style="color: #2980b9; margin-bottom: 15px;">🔵 Tontines Annuelles</h2>
            <p class="tontine-rules" style="color: #2c3e50; line-height: 1.5; margin-bottom: 25px; text-align: justify;">
                Même principe : versement de <strong>5 250 FCFA</strong> chaque week-end pendant <strong>11 mois</strong>.<br>
                La cagnotte est conservée par le <strong>gérant</strong> jusqu’à la fin.<br>
                À la fin, les 10 membres se partagent le capital accumulé (hors intérêts).
            </p>

            <ul class="tontine-list" style="padding-left: 0; list-style: none;">
                <?php
                $stmtAnnuel = $pdo->prepare("SELECT * FROM tontines WHERE type = 'annuel'");
                $stmtAnnuel->execute();
                $tontinesAnnuelles = $stmtAnnuel->fetchAll();

                if (count($tontinesAnnuelles) === 0) {
                    echo "<p>Aucune tontine annuelle disponible pour le moment.</p>";
                }

                foreach ($tontinesAnnuelles as $tontine): ?>
                    <li style="
                        margin-bottom: 20px; 
                        background: white; 
                        border-radius: 8px; 
                        padding: 15px; 
                        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
                    ">
                        <strong style="color: #2980b9; font-size: 1.1rem;"><?= htmlspecialchars($tontine['nom']) ?></strong><br>
                        <?= nl2br(htmlspecialchars($tontine['description'])) ?><br><br>
                        <form method="post" action="participer.php" style="margin-top: 10px;">
                            <input type="hidden" name="tontine_id" value="<?= $tontine['id'] ?>">
                            <button type="submit" style="
                                background-color: #2980b9; 
                                color: white; 
                                border: none; 
                                padding: 8px 16px; 
                                border-radius: 5px; 
                                cursor: pointer;
                                transition: background-color 0.3s ease;
                            " onmouseover="this.style.backgroundColor='#1c598a'" onmouseout="this.style.backgroundColor='#2980b9'">
                                Participer
                            </button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
