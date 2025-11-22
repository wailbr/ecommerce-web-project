<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - NeoMarket</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<?php include 'includes/header.php'; ?>

<div class="login-root">
  <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh; flex-grow: 1;">
    <div class="loginbackground box-background--white padding-top--64">
      <div class="loginbackground-gridContainer">
        <!-- Animations de fond -->
        <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
          <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
          <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
          <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
          <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
          <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
          <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
          <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
          <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
          <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
        </div>
      </div>
    </div>

    <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
      <div class="formbg-outer">
        <div class="formbg">
          <div class="formbg-inner padding-horizontal--48">
            <span class="padding-bottom--15">Connexion à NeoMarket</span>
            <br/>

            <form id="login-form">
              <div class="field padding-bottom--24">
                <label for="email-login">Email</label>
                <input type="email" id="email-login" required>
              </div>

              <div class="field padding-bottom--24">
                <label for="password-login">Mot de passe</label>
                <input type="password" id="password-login" required>
              </div>

              <div class="field padding-bottom--24">
                <input type="submit" value="Se connecter">
              </div>

              <div class="field">
                <p style="text-align:center">Pas encore de compte ? <a href="register.php">Inscris-toi ici</a></p>
              </div>
            </form>
          </div>
        </div>
        <div class="footer-link padding-top--24">
          <span><a href="#">© NeoMarket</a></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Firebase SDKs -->
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth-compat.js"></script>
<script src="assets/js/firebase-config.js"></script>

<!-- Script de connexion Firebase -->
<script>
  const auth = firebase.auth();

  document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('email-login').value;
    const password = document.getElementById('password-login').value;

    auth.signInWithEmailAndPassword(email, password)
      .then((userCredential) => {
        const user = userCredential.user;

        fetch('php/check_user.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            uid: user.uid,
            email: user.email
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.href = 'shop.php';
          } else {
            alert('Utilisateur non reconnu');
          }
        });
      })
      .catch((error) => {
        alert(error.message);
      });
  });
</script>

<?php include 'includes/footer.php'; ?>
<script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth.js"></script>
<script src="/NM/assets/js/firebase-config.js"></script>
<script src="/NM/assets/js/firebase-auth.js"></script>

</body>
</html>
