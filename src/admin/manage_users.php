<?php
include('../includes/auth_check.php');
include('../php/db.php');

// Sécurité : accès admin uniquement
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Requête pour récupérer les utilisateurs
$result = $conn->query("SELECT * FROM users");
?>

<?php include('../includes/header.php'); ?>

<div class="admin-users" style="padding: 40px;">
    <h1>Gestion des utilisateurs</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Date d'inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['nom']) ?></td>
                <td><?= htmlspecialchars($user['prenom']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['date_inscription'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>
