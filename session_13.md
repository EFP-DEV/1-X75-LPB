# Exercice de gestion de produits PHP : Introduction à PDO et traitement de formulaires

## Objectifs d'apprentissage
- Connexion à une base de données MySQL avec PDO
- Exécution de requêtes SQL avec des requêtes préparées
- Création et traitement de formulaires HTML
- Implémentation des opérations CRUD basiques

## Contraintes

>Pour des informations détaillées sur les bonnes pratiques PDO et les idées reçues courantes : [PDO PHP Delusions](https://phpdelusions.net/pdo) et sa version traduite [PHP Delusions](https://github.com/EFP-DEV/1-X75-Atelier/blob/main/more/PDO_PHP_DELUSIONS.md)

> Respecter la structure de fichiers suivante [Structure MVC Web](https://github.com/EFP-DEV/
1-X75-Atelier/blob/main/more/structure_mvc_php.md)

## Contexte
Vous êtes chargé de créer un système de gestion de produits pour un site e-commerce. Vous devez utiliser PDO pour interagir avec la base de données MySQL et gérer les opérations CRUD (Créer, Lire, Mettre à jour, Supprimer) sur les produits.


## Conseils pour réussir
- Commencer par un code fonctionnel, puis améliorer l'organisation
- Tester soigneusement la connexion à la base de données avant de continuer
- Commencer par des requêtes simples avant d'ajouter des conditions plus complexes
- Valider et assainir toutes les entrées utilisateur avant de les utiliser dans les requêtes SQL

## Critères d'évaluation
- Système fonctionnel d'affichage et de gestion des produits
- Utilisation correcte de PDO et des requêtes préparées
- Traitement et gestion appropriés des formulaires et des données
- Implémentation de validation basique des entrées

## Prérequis
- Avoir installé PHP et un serveur web (Apache, Nginx, etc.)
- Avoir une connaissance de base de PHP et SQL
- Avoir un environnement de développement configuré (IDE, éditeur de texte, etc.)
- Avoir accès à un serveur de base de données MySQL
- Importer le table et les donnees

```SQL
-- Create products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price_min DECIMAL(10, 2) NULL,
    price_max DECIMAL(10, 2) NULL,
    price DECIMAL(10, 2) NULL,
    sale_price DECIMAL(10, 2) NULL,
    image VARCHAR(255) NOT NULL,
    is_sale BOOLEAN DEFAULT 0,
    rating TINYINT DEFAULT 0,
    product_type ENUM('standard', 'fancy', 'popular', 'special', 'sale') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample products
INSERT INTO products (name, price_min, price_max, price, sale_price, image, is_sale, rating, product_type) VALUES
('Fancy Product', 40.00, 80.00, NULL, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 0, 'fancy'),
('Special Item', NULL, NULL, 20.00, 18.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 5, 'special'),
('Sale Item', NULL, NULL, 50.00, 25.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 0, 'sale'),
('Popular Item', NULL, NULL, 40.00, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 5, 'popular'),
('Sale Item', NULL, NULL, 50.00, 25.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 0, 'sale'),
('Fancy Product', 120.00, 280.00, NULL, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 0, 'fancy'),
('Special Item', NULL, NULL, 20.00, 18.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 5, 'special'),
('Popular Item', NULL, NULL, 40.00, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 5, 'popular');
```

---

## 1 : Connexion à la base de données
- Configurer une connexion PDO à MySQL
- Créer un fichier `db.php` dans `/app/config/`
- Tester la connexion en récupérant la liste des produits

## 2 : Affichage du catalogue de produits
- Créer une page dans `/app/view/public/` pour afficher les produits
- Écrire une requête pour récupérer tous les produits
- Afficher les informations avec un formatage de prix adapté au type de produit

## 3 : Formulaire de gestion des produits
- Créer un formulaire HTML pour ajouter des produits
- Implémenter un gestionnaire pour traiter les données soumises
- Utiliser des requêtes préparées PDO pour insérer de nouveaux produits

## 4 : Modification de produits
- Créer une page listant les produits avec lien "Modifier"
- Afficher un formulaire pré-rempli avec les données du produit
- Implémenter la mise à jour et la suppression avec PDO
