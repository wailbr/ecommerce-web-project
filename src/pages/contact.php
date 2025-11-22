<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - NeoMarket</title>
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
    <a href="about.html">À PROPOS</a>
    <a href="contact.html" class="active">CONTACT</a>
  </nav>
</header>

<!-- MAIN CONTENT -->
<main>
  <!-- Formulaire de contact -->
  <section class="contact-form-section">
    <div class="contact-form-card">
      <h1>Contactez NeoMarket</h1>
      <form class="contact-form" id="contactForm">
        <div class="input-box">
          <input type="text" id="name" name="name" required placeholder=" ">
          <label for="name">Nom complet</label>
          <div class="icon">&#128100;</div>
        </div>
        <div class="input-box">
          <input type="email" id="email" name="email" required placeholder=" ">
          <label for="email">Adresse email</label>
          <div class="icon">&#9993;</div>
        </div>
        <div class="input-box">
          <textarea id="message" name="message" rows="5" required placeholder=" "></textarea>
          <label for="message">Votre message</label>
          <div class="icon">&#9998;</div>
        </div>
        <button type="submit" class="send-btn">Envoyer ✉️</button>
      </form>
      <div class="confirmation-message" id="confirmationMessage">✅ Message envoyé avec succès !</div>
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

<script>
  const form = document.getElementById('contactForm');
  const confirmationMessage = document.getElementById('confirmationMessage');

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    confirmationMessage.style.display = 'block';
    form.reset();
    setTimeout(() => {
      confirmationMessage.style.display = 'none';
    }, 3000);
  });
</script>

</body>
</html>
