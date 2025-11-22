<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>NeoMarket</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Lien absolu vers le style.css -->
  <link rel="stylesheet" href="/NM/assets/css/style.css">
</head>
<body>

<header class="header enhanced-header">
  <div class="logo">
    <a href="/NM/index.php">NeoMarket</a>
  </div>
  
  <nav class="nav enhanced-nav">
    <a href="/NM/index.php">Home</a>
    <a href="/NM/shop.php">Shop</a>
    <a href="/NM/about.php">About</a>
    <a href="/NM/contact.php">Contact</a>

    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="/NM/logout.php">Logout</a>
      <span class="user-greeting">Bonjour, <?= htmlspecialchars($_SESSION['user_prenom']) ?></span>
    <?php else: ?>
      <a href="/NM/login.php">Login</a>
    <?php endif; ?>
  </nav>
</header>
