firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
        // Utilisateur connecté → rediriger vers l'accueil ou dashboard
        fetch('/NM/php/save_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ uid: user.uid, email: user.email })
        }).then(() => {
            window.location.href = '/NM/index.php';
        });
    }
});

function loginUser(email, password) {
    firebase.auth().signInWithEmailAndPassword(email, password)
        .catch(error => alert(error.message));
}

function registerUser(email, password) {
    firebase.auth().createUserWithEmailAndPassword(email, password)
        .catch(error => alert(error.message));
}
