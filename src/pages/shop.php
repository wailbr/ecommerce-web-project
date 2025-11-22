<?php
require_once 'includes/db.php';

// Récupérer les filtres GET
$productName = $_GET['productName'] ?? '';
$categoryId = $_GET['category'] ?? '';
$priceMin = $_GET['priceMin'] ?? '';
$priceMax = $_GET['priceMax'] ?? '';

// Construction de la requête SQL
$sql = "SELECT p.*, c.nom AS category, i.image_url 
        FROM products p
        LEFT JOIN categories c ON p.categorie_id = c.id
        LEFT JOIN images i ON p.id = i.product_id
        WHERE 1";

$params = [];

if ($productName) {
    $sql .= " AND p.nom LIKE ?";
    $params[] = "%$productName%";
}
if ($categoryId) {
    $sql .= " AND p.categorie_id = ?";
    $params[] = $categoryId;
}
if ($priceMin !== '') {
    $sql .= " AND p.prix >= ?";
    $params[] = $priceMin;
}
if ($priceMax !== '') {
    $sql .= " AND p.prix <= ?";
    $params[] = $priceMax;
}

$sql .= " GROUP BY p.id ORDER BY p.id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Récupération des catégories pour le select
$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NeoMarket - Shop</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Segoe UI", Tahoma, sans-serif;
      background-color: #fdfcf8;
      color: #333;
    }
    .header {
      background-color: #d6c2a1;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header .logo {
      font-size: 1.5rem;
      font-weight: bold;
    }
    .header .nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      gap: 20px;
    }
    .header .nav a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }
    .header .nav a:hover {
      text-decoration: underline;
    }
    .main-container {
      display: flex;
      align-items: flex-start;
      column-gap: 90px;
      padding: 40px 20px;
    }
    .filter-section {
      width: 300px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .filter-section h2 {
      margin-top: 0;
      font-size: 1.2rem;
      margin-bottom: 15px;
    }
    .filter-section label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
    }
    .filter-section input,
    .filter-section select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font: inherit;
    }
    .filter-section button {
      display: block;
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font: inherit;
      cursor: pointer;
      font-weight: 500;
      margin-bottom: 10px;
    }
    .filter-section button.apply-btn {
      background-color: #c9a66b;
      color: #333;
    }
    .filter-section button.reset-btn {
      background-color: #ddd;
      color: #333;
      margin-bottom: 0;
    }
    .filter-section button:hover {
      opacity: 0.9;
    }
    .product-section {
      flex: 1;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }
    .product-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 15px;
      text-align: center;
    }
    .product-card img {
      max-width: 100%;
      max-height: 180px;
      object-fit: contain;
      display: block;
      margin: 0 auto;
      border-radius: 5px;
    }
    .product-card h3 {
      margin: 10px 0 5px;
      font-size: 1.1rem;
    }
    .product-card p {
      margin: 5px 0;
    }
    .product-card .product-price {
      font-weight: 600;
    }
    .product-card .product-category {
      color: #777;
      font-size: 0.9rem;
      margin-bottom: 15px;
    }
    .product-card .btn {
      display: inline-block;
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      background-color: #c9a66b;
      color: #333;
      text-decoration: none;
      font-weight: 500;
      cursor: pointer;
    }
    .product-card .btn:hover {
      background-color: #b58f5f;
    }
    .footer {
      background-color: #d6c2a1;
      text-align: center;
      padding: 10px 20px;
    }
    .footer p { margin: 0; }
  </style>
</head>
<body>
  <header class="header">
    <div class="logo">LOGO</div>
    <nav class="nav">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Shop</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main class="main-container">
    <aside class="filter-section">
      <h2>Filtrer</h2>
      <form action="shop.php" method="GET">
        <label for="productName">Nom du produit</label>
        <input type="text" id="productName" name="productName" value="<?= htmlspecialchars($productName) ?>" />

        <label for="category">Catégorie</label>
        <select id="category" name="category">
          <option value="">Toutes les catégories</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $categoryId ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat['nom']) ?>
            </option>
          <?php endforeach; ?>
        </select>

        <label for="priceMin">Prix min (€)</label>
        <input type="number" id="priceMin" name="priceMin" value="<?= htmlspecialchars($priceMin) ?>" />

        <label for="priceMax">Prix max (€)</label>
        <input type="number" id="priceMax" name="priceMax" value="<?= htmlspecialchars($priceMax) ?>" />

        <button type="submit" class="apply-btn">Appliquer</button>
        <button type="reset" class="reset-btn" onclick="window.location.href='shop.php'">Réinitialiser</button>
      </form>
    </aside>

    <section class="product-section">
      <?php foreach ($products as $product): ?>
        <div class="product-card">
          <img src="<?= htmlspecialchars($product['image_url'] ?: 'assets/images/placeholder.png') ?>" alt="<?= htmlspecialchars($product['nom']) ?>">
          <h3 class="product-name"><?= htmlspecialchars($product['nom']) ?></h3>
          <p class="product-price"><?= number_format($product['prix'], 2, ',', ' ') ?> €</p>
          <p class="product-category"><?= htmlspecialchars($product['category']) ?></p>
          <a href="#" class="btn">Voir</a>
        </div>
      <?php endforeach; ?>
    </section>
  </main>

  <footer class="footer">
    <p>Copyright © 2025 NeoMarket.fr</p>
  </footer>
</body>
</html>