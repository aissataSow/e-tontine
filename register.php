<?php
require_once 'includes/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $telephone = trim($_POST['telephone']);
    $adresse = trim($_POST['adresse']);
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "L'adresse email n'est pas valide.";
    } elseif (!preg_match('/^[0-9]{9}$/', $telephone)) {
        $message = "Le numéro de téléphone doit contenir exactement 9 chiffres.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Vérifie si le nom d'utilisateur ou l'email existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->rowCount() > 0) {
            $message = "Le nom d'utilisateur ou l'email est déjà utilisé.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (username, password, telephone, adresse, email) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$username, $hashedPassword, $telephone, $adresse, $email])) {
                header("Location: index.php?success=1");
                exit();
            } else {
                $message = "Erreur lors de l'inscription.";
            }
        }
    }
}

$pageTitle = "Inscription";
include 'includes/header.php';
?>

<h2 style="text-align: center">Inscription</h2>
<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
   <input type="email" name="email" placeholder="Adresse email" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; margin-bottom: 10px; box-sizing: border-box; width: 100%;">
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="text" name="telephone" placeholder="Téléphone (9 chiffres)" pattern="\d{9}" required>
    <input type="text" name="adresse" placeholder="Adresse" required>
    <button type="submit">S'inscrire</button>
</form>

<?php if ($message): ?>
<p style="color:red; text-align:center;"><?= $message ?></p>
<?php endif; ?>

<p>Déjà inscrit ? <a href="index.php">Se connecter</a></p>

<?php include 'includes/footer.php'; ?>
