<?php
session_start();
require 'db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    die("Champs manquants");
}

// Récupération utilisateur + rôles
$stmt = $pdo->prepare("
    SELECT u.id, u.username, u.password_hash,
           GROUP_CONCAT(r.nom) AS roles
    FROM utilisateurs u
    LEFT JOIN user_roles ur ON u.id = ur.user_id
    LEFT JOIN roles r ON ur.role_id = r.id
    WHERE u.email = ?
    GROUP BY u.id
");
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password_hash'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['roles'] = $user['roles'];

    echo "Connexion réussie";

} else {
    echo "Email ou mot de passe incorrect";
}