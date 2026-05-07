<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$email || !$password) {
    die("Champs manquants");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email invalide");
}

// vérifier email existant
$stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    die("Email déjà utilisé");
}

// hash password
$hash = password_hash($password, PASSWORD_BCRYPT);

// créer utilisateur (compte neutre)
$stmt = $pdo->prepare("
    INSERT INTO utilisateurs (username, email, password_hash)
    VALUES (?, ?, ?)
");

$stmt->execute([$username, $email, $hash]);

$userId = $pdo->lastInsertId();


// login direct après inscription (option recommandé)
$_SESSION['user_id'] = $userId;
$_SESSION['username'] = $username;


// rôle de base obligatoire
$stmt = $pdo->prepare("
    SELECT id FROM roles WHERE nom = 'auditor'
");
$stmt->execute();
$roleId = $stmt->fetchColumn();

if ($roleId) {
    $stmt = $pdo->prepare("
        INSERT INTO user_roles (user_id, role_id)
        VALUES (?, ?)
    ");
    $stmt->execute([$userId, $roleId]);
}


// redirection vers onboarding
header("Location: roles.html");
exit();