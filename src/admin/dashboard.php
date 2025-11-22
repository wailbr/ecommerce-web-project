<?php
include('../includes/auth_check.php');
include('../php/db.php');

// Vérifier que l'utilisateur est admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Requêtes de stats
$total_users = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$total_products = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$total_value = $conn->query("SELECT SUM(prix) FROM products")->fetch_row()[0];

// Derniers produits
$latest_products = $conn->query("
    SELECT p.nom, p.prix, u.nom AS vendeur, p.date_ajout
    FROM products p
    LEFT JOIN users u ON p.vendeur_id = u.id
    ORDER BY p.date_ajout DESC
    LIMIT 5
");
?>



<?php include('../includes/header.php'); ?>

<div class="admin-dashboard" style="padding: 40px;">
    <h1>Dashboard Administrateur</h1>

    <div class="stats" style="display: flex; gap: 20px; margin: 30px 0;">
        <div class="card">
            <h3>Utilisateurs</h3>
            <p><?= $total_users ?></p>
        </div>
        <div class="card">
            <h3>Produits en vente</h3>
            <p><?= $total_products ?></p>
        </div>
        <div class="card">
            <h3>Valeur totale (€)</h3>
            <p><?= number_format($total_value, 2) ?></p>
        </div>
    </div>

    <h2>Derniers produits ajoutés</h2>
    <table class="table">
        <tr>
            <th>Nom</th>
            <th>Prix (€)</th>
            <th>Vendeur</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $latest_products->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nom']) ?></td>
            <td><?= htmlspecialchars($row['prix']) ?></td>
            <td><?= htmlspecialchars($row['vendeur']) ?></td>
            <td><?= htmlspecialchars($row['date_ajout']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include('../includes/footer.php'); ?>
