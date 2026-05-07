<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Accès refusé");
}

echo "Bienvenue " . $_SESSION['username'];