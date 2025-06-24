<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT user_id FROM password_resets WHERE token = ? AND expire_at > NOW()");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();

    if ($reset) {
        $pdo->prepare("UPDATE users SET password = ? WHERE id = ?")
            ->execute([$password, $reset['user_id']]);
        $pdo->prepare("DELETE FROM password_resets WHERE user_id = ?")
            ->execute([$reset['user_id']]);
        echo "✅ Mot de passe mis à jour. <a href='index.php'>Se connecter</a>";
    } else {
        echo "⛔ Lien invalide ou expiré.";
    }
} else {
    $token = $_GET['token'] ?? '';
    ?>
    <form method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <label>Nouveau mot de passe :</label><br>
        <input type="password" name="password" required>
        <button type="submit">Réinitialiser</button>
    </form>
    <?php
}
