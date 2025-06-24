<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pageTitle) ? $pageTitle : 'TontineApp' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        /* background-color: white; */
        padding: 15px 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        padding-bottom: 5px;
    }

    main {
        padding-top: 120px;
    }
</style>

<style>
    /* Supprime le scroll horizontal */
    html, body {
        overflow-x: hidden;
    }

    /* Empêche les éléments de dépasser horizontalement */
    * {
        box-sizing: border-box;
        max-width: 100%;
    }

    /* Animation d'apparition */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Animation de disparition */
@keyframes fadeOut {
    from {
        opacity: 1;
        transform: scale(1);
    }
    to {
        opacity: 0;
        transform: scale(0.9);
    }
}

#logoutPopup {
    animation: fadeIn 0.3s ease-out forwards;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

#logoutPopup.hide {
    animation: fadeOut 0.3s ease-out forwards;
}

</style>

</head>
<body>
<header>
    <h1>E-Tontine</h1>
    <nav>
        <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="dashboard.php">Accueil</a></li>
                <li><a href="tontines.php">Tontines</a></li>
                <li><a href="mes_tontines.php">Mes tontines</a></li>
                <li><a href="cotisations.php">Cotisations</a></li>
                <li><a href="apropos.php">A propos</a></li>
                <li><a href="historique.php">Historique</a></li>
                <li><a href="#" id="logoutBtn">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="index.php">Connexion</a></li>
                <li><a href="register.php">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
