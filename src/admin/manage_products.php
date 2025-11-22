<?php
include('../includes/auth_check.php');
include('../php/db.php');

// Sécurité : accès admin uniquement
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Requête pour récupérer les produits
$query = "
    SELECT p.id, p.nom, p.prix, p.date_ajout,
           c.nom AS categorie, u.nom AS vendeur
    FROM products p
    LEFT JOIN categories c ON p.categorie_id = c.id
    LEFT JOIN users u ON p.vendeur_id = u.id
    ORDER BY p.date_ajout DESC
";
$result = $conn->query($query);
?>

<?php include('../includes/header.php'); ?>

<div class="admin-products" style="padding: 40px;">
    <h1>Gestion des produits</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix (€)</th>
                <th>Catégorie</th>
                <th>Vendeur</th>
                <th>Date d'ajout</th>
            </tr>
        </thead>
        <tbody>
            <?php while($p = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nom']) ?></td>
                <td><?= number_format($p['prix'], 2) ?></td>
                <td><?= htmlspecialchars($p['categorie']) ?></td>
                <td><?= htmlspecialchars($p['vendeur']) ?></td>
                <td><?= $p['date_ajout'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>
