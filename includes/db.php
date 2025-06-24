<?php
$host = 'localhost';
$dbname = 'e_tontine';
$username = 'root';
$password = ''; // ou ton mot de passe
$telephone = '';
$adresse = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>



 