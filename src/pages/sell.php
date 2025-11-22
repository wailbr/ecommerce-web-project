<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/header.php'; // Ajout du header

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['firebase_uid'])) {
    header('Location: login.php');
    exit;
}

// Récupération de l'ID utilisateur
$stmt = $conn->prepare("SELECT id FROM users WHERE firebase_uid = ?");
$stmt->execute([$_SESSION['firebase_uid']]);
$user = $stmt->fetch();

if (!$user) {
    die("Utilisateur introuvable.");
}

$vendeur_id = $user['id'];
$success = false;

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie_id = $_POST['categorie_id'];
    $image = $_FILES['image'];

    // Insertion du produit
    $stmt = $conn->prepare("INSERT INTO products (nom, description, prix, vendeur_id, categorie_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $description, $prix, $vendeur_id, $categorie_id]);
    $product_id = $conn->lastInsertId();

    // Image
    if ($image['error'] === 0) {
        $upload_dir = "assets/images/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $image_name = uniqid() . '_' . basename($image["name"]);
        $image_path = $upload_dir . $image_name;

        if (move_uploaded_file($image["tmp_name"], $image_path)) {
            $stmt = $conn->prepare("INSERT INTO images (product_id, image_url) VALUES (?, ?)");
            $stmt->execute([$product_id, $image_path]);
        }
    }

    $success = true;
}

// Récupération des catégories
$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vendre un produit - NeoMarket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fefefe;
            margin: 0;
            padding: 0;
        }
        .flex-container {
            display: flex;
            gap: 40px;
            justify-content: center;
            align-items: flex-start;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .flex-child {
            flex: 1;
            background-color: #fffaf2;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.05);
        }
        h1, h2 {
            text-align: center;
            color: #2c2c2c;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 15px;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            padding: 10px;
            border: 1px solid #c1a988;
            border-radius: 6px;
            font-size: 1rem;
            margin-top: 5px;
            background-color: #f5eee6;
            transition: border-color 0.3s ease;
        }
        input[type="file"] {
            margin-top: 10px;
            background-color: #f5eee6;
            border: 1px solid #c1a988;
            border-radius: 6px;
            padding: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="file"]:hover,
        select:hover {
            border-color: #a58d6c;
            box-shadow: 0 0 5px rgba(165, 141, 108, 0.3);
            cursor: pointer;
        }
        button {
            margin-top: 25px;
            padding: 12px;
            background-color: #d4bea0;
            color: black;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #bda686;
            transform: scale(1.02);
        }
        .success {
            background-color: #e2ffe2;
            color: #2b662b;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #9ed69e;
        }
        .product-card {
            background-color: #fff;
            border: 1px solid #c1a988;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s ease;
        }
        .product-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .product-content {
            display: flex;
            align-items: center;
            padding: 20px;
        }
        .product-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
            background-color: #f5eee6;
        }
        .product-info {
            flex: 1;
        }
        .info-button {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #d4bea0;
            color: black;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }
        .info-button:hover {
            background-color: #bda686;
        }
        .product-description {
            display: none;
            margin-top: 10px;
            background-color: #fffaf2;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #c1a988;
        }
    </style>
</head>
<body>

<div class="flex-container">

    <!-- FORMULAIRE À GAUCHE -->
    <div class="flex-child">
        <h1>Vendre un produit</h1>

        <?php if ($success): ?>
            <div class="success">Produit ajouté avec succès !</div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="nom">Nom du produit</label>
            <input type="text" name="nom" required>

            <label for="description">Description</label>
            <textarea name="description" rows="5" required></textarea>

            <label for="prix">Prix (€)</label>
            <input type="number" name="prix" step="0.01" required>

            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" required>
                <option value="">-- Sélectionner --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="image">Image du produit</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit">Ajouter le produit</button>
        </form>
    </div>

    <!-- PRODUITS À DROITE -->
    <div class="flex-child">
        <h2>Mes produits en vente</h2>

        <?php
        $stmt = $conn->prepare("SELECT p.*, c.nom AS categorie_nom, i.image_url FROM products p 
                                LEFT JOIN categories c ON p.categorie_id = c.id 
                                LEFT JOIN images i ON p.id = i.product_id
                                WHERE p.vendeur_id = ?");
        $stmt->execute([$vendeur_id]);
        $mes_produits = $stmt->fetchAll();
        ?>

        <?php if (count($mes_produits) > 0): ?>
            <?php foreach ($mes_produits as $index => $produit): ?>
                <div class="product-card">
                    <div class="product-content">
                        <img src="<?= htmlspecialchars($produit['image_url']) ?>" alt="Image du produit" class="product-image">
                        <div class="product-info">
                            <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                            <p><strong>Prix :</strong> <?= htmlspecialchars(number_format($produit['prix'], 2)) ?> €</p>
                            <p><strong>Catégorie :</strong> <?= htmlspecialchars($produit['categorie_nom'] ?? 'Non catégorisé') ?></p>
                            <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($produit['date_ajout']))) ?></p>

                            <button class="info-button" onclick="toggleDescription(<?= $index ?>)">Plus d'informations</button>
                            <div id="desc-<?= $index ?>" class="product-description">
                                <p><?= nl2br(htmlspecialchars($produit['description'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Vous n'avez pas encore mis de produit en vente.</p>
        <?php endif; ?>
    </div>

</div>

<script>
function toggleDescription(index) {
    const desc = document.getElementById('desc-' + index);
    if (desc.style.display === 'block') {
        desc.style.display = 'none';
    } else {
        desc.style.display = 'block';
    }
}
</script>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>