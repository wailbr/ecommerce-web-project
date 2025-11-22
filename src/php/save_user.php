<?php
require_once 'db.php'; // Connexion à MySQL
session_start();

// On récupère les données JSON envoyées par JS
$data = json_decode(file_get_contents("php://input"), true);

// Sécurité : on vérifie que tout est bien reçu
if (!isset($data['uid'], $data['email'], $data['prenom'], $data['nom'])) {
    echo json_encode(['success' => false, 'error' => 'Champs manquants']);
    exit;
}

$uid = $data['uid'];
$email = $data['email'];
$prenom = $data['prenom'];
$nom = $data['nom'];

// Préparation de la requête SQL
$stmt = $conn->prepare("INSERT INTO users (firebase_uid, email, prenom, nom, role) VALUES (?, ?, ?, ?, 'client')");
$stmt->bind_param("ssss", $uid, $email, $prenom, $nom);

// Exécution et réponse
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erreur SQL']);
}

$stmt->close();
$conn->close();
?>
