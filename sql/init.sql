-- Création de la base de données
CREATE DATABASE IF NOT EXISTS neomarket DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE neomarket;

-- Table des utilisateurs (avec rôle)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firebase_uid VARCHAR(128) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    role ENUM('client', 'admin') NOT NULL DEFAULT 'client',
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des catégories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);

-- Table des produits (sans champ image)
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    vendeur_id INT,
    categorie_id INT,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vendeur_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Table des images (liée aux produits)
CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Table du panier (cart_items)
CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantite INT DEFAULT 1,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Table des transactions (paiement futur)
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT NOT NULL,
    acheteur_id INT NOT NULL,
    vendeur_id INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    statut ENUM('en_attente', 'payé', 'annulé') DEFAULT 'en_attente',
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produit_id) REFERENCES products(id),
    FOREIGN KEY (acheteur_id) REFERENCES users(id),
    FOREIGN KEY (vendeur_id) REFERENCES users(id)
);