<?php
session_start();
require_once 'includes/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

$pageTitle = "Connexion";
include 'includes/header.php';
?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green; text-align:center;">
        ✅ Inscription réussie ! Vous pouvez maintenant vous connecter.
    </p>
<?php endif; ?>

<h2 style="text-align: center">Connexion</h2>
<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
<p style="color:red;"><?= $message ?></p>
<p>Pas encore de compte ? <a href="register.php">S'inscrire</a></p>
<p><a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></p>


<?php include 'includes/footer.php'; ?>
