<?php
$host = 'localhost';
$user = 'root';
$password = ''; // si tu as mis un mot de passe dans XAMPP, indique-le ici
$database = 'neomarket';

// Connexion à MySQL
$conn = new mysqli($host, $user, $password, $database);

// Vérification
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>
