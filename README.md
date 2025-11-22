🛒 E-Commerce Web Project

Projet complet de site e-commerce — PHP, MySQL, HTML/CSS/JS.

Ce projet simule une boutique en ligne complète avec un système d’authentification, un panier dynamique, une gestion de produits, une page de vente et une interface d’administration.

🚀 Fonctionnalités principales
🔐 Authentification

Création de compte

Connexion / Déconnexion

Sessions sécurisées

Vérification des rôles

🛍️ Catalogue produits

Page d’accueil dynamique

Page produit individuelle

Recherche / tri

Catégories (téléphones, PC, accessoires…)

🛒 Panier

Ajout / suppression d’articles

Calcul automatique du total

Mise à jour des quantités

📦 Système de vente “SELL”

Page SELL pour publier un produit

Upload d’images

Sauvegarde en base SQL

🛠️ Back-office Admin

Ajouter / modifier / supprimer un produit

Gestion des utilisateurs

Gestion des commandes

Interface claire pour administrer l’ensemble

📁 Architecture du projet
ecommerce-web-project/
│
├── src/
│   ├── php/                → scripts backend (traitement)
│   ├── includes/           → header, footer, config, fonctions
│   ├── admin/              → espace administrateur
│   └── pages/              → pages front (index, login, shop…)
│
├── assets/
│   ├── img/                → images produits & UI
│   ├── css/                → styles
│   └── js/                 → scripts front-end
│
├── sql/
│   └── database.sql        → structure de la base
│
└── docs/                   → documents supplémentaires

🗄️ Base de données MySQL

La base comporte plusieurs tables clés :

users

products

categories

cart

orders

order_items

Importation :

mysql -u root -p ecommerce < sql/database.sql

🛠️ Technologies utilisées

PHP 8

MySQL

HTML5 / CSS3

JavaScript

Bootstrap (si utilisé)

XAMPP / WAMP

👤 Auteur

Wail Brimesse
Développeur Web — ECE Paris
2025

🔮 Améliorations possibles

Passage à un framework PHP (Laravel / Symfony)

API REST avec JWT

Version mobile responsive améliorée

Dashboard admin plus complet

Recherche avancée avec filtres
