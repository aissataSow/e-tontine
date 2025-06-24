<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT c.montant, c.date_cotisation, t.nom AS nom_tontine
    FROM cotisations c
    JOIN tontines t ON c.tontine_id = t.id
    WHERE c.user_id = ?
    ORDER BY c.date_cotisation DESC
");
$stmt->execute([$user_id]);
$cotisations = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<style>
    .container-historique {
        display: flex;
        justify-content: center;
        margin-top: 40px;
        padding: 20px;
    }

    .historique-table {
        width: 100%;
        max-width: 800px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Segoe UI', sans-serif;
        font-size: 15px;
    }

    th, td {
        padding: 14px 18px;
        text-align: left;
    }

    th {
        background: #f7f9fa;
        color: #2c3e50;
        font-weight: 600;
        border-bottom: 2px solid #ddd;
    }

    tr {
        transition: background 0.2s ease;
    }

    tr:nth-child(even) {
        background: #fcfcfc;
    }

    tr:hover {
        background: #f1f8ff;
    }

    @media (max-width: 600px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead {
            display: none;
        }

        td {
            position: relative;
            padding-left: 50%;
        }

        td::before {
            position: absolute;
            top: 14px;
            left: 18px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: bold;
            color: #555;
        }

        td:nth-of-type(1)::before { content: "Tontine"; }
        td:nth-of-type(2)::before { content: "Montant (FCFA)"; }
        td:nth-of-type(3)::before { content: "Date"; }
    }
</style>

<h2 style="text-align: center; font-family: 'Segoe UI', sans-serif; color: #2c3e50;">📜 Historique de vos cotisations</h2>

<div class="container-historique">
    <div class="historique-table">
        <?php if (count($cotisations) === 0): ?>
            <p style="padding: 20px; color: #777; text-align: center;">🙁 Vous n'avez encore effectué aucune cotisation.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Tontine</th>
                        <th>Montant (FCFA)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cotisations as $cotisation): ?>
                        <tr>
                            <td><?= htmlspecialchars($cotisation['nom_tontine']) ?></td>
                            <td><?= number_format($cotisation['montant'], 0, ',', ' ') ?></td>
                            <td><?= date('d/m/Y à H:i', strtotime($cotisation['date_cotisation'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<br><br><br><br><br><br>
<?php include 'includes/footer.php'; ?>
