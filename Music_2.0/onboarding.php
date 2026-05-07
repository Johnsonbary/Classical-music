<?php
session_start();
require 'db.php';

$userId = $_SESSION['user_id'];

$role = $_POST['role'];
$displayName = $_POST['display_name'] ?? null;
$bio = $_POST['bio'] ?? null;
$instrument = $_POST['instrument'] ?? null;

// fonction rôle
function assignRole($pdo, $userId, $role) {
    $stmt = $pdo->prepare("SELECT id FROM roles WHERE nom = ?");
    $stmt->execute([$role]);
    $roleId = $stmt->fetchColumn();

    if ($roleId) {
        $pdo->prepare("
            INSERT IGNORE INTO user_roles (user_id, role_id)
            VALUES (?, ?)
        ")->execute([$userId, $roleId]);
    }
}

// toujours auditeur
assignRole($pdo, $userId, 'auditor');


switch ($role) {

    case 'composer':
        assignRole($pdo, $userId, 'composer');

        $pdo->prepare("
            INSERT INTO compositeurs (name, bio, id_user)
            VALUES (?, ?, ?)
        ")->execute([$displayName, $bio, $userId]);
        break;

    case 'performer':
        assignRole($pdo, $userId, 'performer');

        $pdo->prepare("
            INSERT INTO interpretes (name, bio, id_user)
            VALUES (?, ?, ?)
        ")->execute([$displayName, $bio, $userId]);
        break;

    case 'both':
        assignRole($pdo, $userId, 'composer');
        assignRole($pdo, $userId, 'performer');

        $pdo->prepare("
            INSERT INTO compositeurs (name, bio, id_user)
            VALUES (?, ?, ?)
        ")->execute([$displayName, $bio, $userId]);

        $pdo->prepare("
            INSERT INTO interpretes (name, bio, id_user)
            VALUES (?, ?, ?)
        ")->execute([$displayName, $bio, $userId]);
        break;
}

header("Location: protecter.php");
exit();