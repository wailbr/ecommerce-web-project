<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - NeoMarket</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="admin-header">
    <nav>
        <div class="logo">
            <a href="dashboard.php">NeoMarket Admin</a>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_users.php">Utilisateurs</a></li>
            <li><a href="manage_products.php">Produits</a></li>
            <li><a href="../index.php">Retour au site</a></li>
            <li><a href="../logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>
<main class="admin-main">
