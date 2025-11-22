<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>À propos - NeoMarket</title>
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<!-- HEADER -->
<header class="header">
  <div class="logo">
    <a href="index.html">
      <img src="logo.png" alt="Logo de NeoMarket" />
    </a>
  </div>
  <nav class="nav">
    <a href="index.html">ACCUEIL</a>
    <a href="shop.html">BOUTIQUE</a>
    <a href="about.html" class="active">À PROPOS</a>
    <a href="contact.html">CONTACT</a>
  </nav>
</header>

<!-- MAIN CONTENT -->
<main>

  <!-- Introduction -->
  <section class="intro-section">
    <div class="intro-text">
      <h1>À propos de NeoMarket</h1>
      <p>NeoMarket est votre destination pour découvrir les dernières innovations technologiques. Nous sélectionnons les meilleurs smartphones, ordinateurs et accessoires pour offrir à nos clients une expérience d'achat unique, fiable et inspirante.</p>
    </div>
    <div class="intro-image">
      <img src="logo.png" alt="Logo NeoMarket">
    </div>
  </section>

  <!-- Notre Mission -->
  <section class="mission-section">
    <h2>Notre Mission</h2>
    <p>Chez NeoMarket, nous croyons que la technologie doit être accessible à tous. C’est pourquoi nous nous engageons à proposer des produits de qualité supérieure, tout en garantissant un service client attentif et une expérience d'achat en ligne simple et sécurisée.</p>
  </section>

  <!-- Nos Valeurs -->
  <section class="values-section">
    <h2>Nos Valeurs</h2>
    <div class="values">
      <div class="value-item">
        <h3>Innovation</h3>
        <p>Nous mettons en avant des produits innovants qui révolutionnent le quotidien de nos clients.</p>
      </div>
      <div class="value-item">
        <h3>Fiabilité</h3>
        <p>Chaque produit est sélectionné avec soin pour garantir qualité, performance et durabilité.</p>
      </div>
      <div class="value-item">
        <h3>Satisfaction Client</h3>
        <p>Notre priorité est votre satisfaction grâce à un support client dédié et une écoute attentive.</p>
      </div>
    </div>
  </section>

  <!-- Notre Équipe -->
  <section class="team-section">
    <h2>Notre Équipe</h2>
    <div class="team">
      <div class="team-member">
        <img src="images/yanis_skalli.jpg" alt="Yanis Skalli">
        <h3>SKALLI Yanis</h3>
        <p>Responsable Produits</p>
      </div>
      <div class="team-member">
        <img src="zaid.png" alt="Hassaoui Zaid">
        <h3>HASSAOUI Zaid</h3>
        <p>Directeur Général</p>
      </div>
      <div class="team-member">
        <img src="images/benahmed_rayan.jpg" alt="Benahmed Rayan">
        <h3>BENAHMED Rayan</h3>
        <p>Responsable Logistique</p>
      </div>
      <div class="team-member">
        <img src="images/yanis_feddila.jpg" alt="Yanis Feddila">
        <h3>FEDILLA Yanis</h3>
        <p>Responsable Service Client</p>
      </div>
      <div class="team-member">
        <img src="images/wail_brimesse.jpg" alt="Wail Brimesse">
        <h3>BRIMESSE Wail</h3>
        <p>Responsable Marketing</p>
      </div>
    </div>
  </section>

</main>

<!-- FOOTER -->
<footer class="footer">
  <p>&copy; 2025 NeoMarket.fr - Tous droits réservés</p>
  <div class="social-footer">
    <p>Suivez-nous sur nos réseaux sociaux</p>
    <div class="social-icons">
      <a href="https://www.linkedin.com/in/zaid-hassaoui" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" class="social-icon">
      </a>
      <a href="https://www.instagram.com/_zizou_06_/" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="social-icon">
      </a>
    </div>
  </div>
</footer>

</body>
</html>
