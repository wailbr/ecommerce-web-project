<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$uid = $data['uid'] ?? null;
$email = $data['email'] ?? null;

if (!$uid || !$email) {
    echo json_encode(['success' => false, 'error' => 'UID ou email manquant']);
    exit;
}

$stmt = $conn->prepare("SELECT id, nom, prenom, role FROM users WHERE firebase_uid = ?");
$stmt->bind_param("s", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nom'] = $user['nom'];
    $_SESSION['user_prenom'] = $user['prenom'];
    $_SESSION['user_role'] = $user['role'];

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Utilisateur introuvable']);
}

$stmt->close();
$conn->close();
?>
