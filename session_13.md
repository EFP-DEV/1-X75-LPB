# Session 13 — Lecture de produits avec PHP et PDO

**Durée : 4h**

Cette séance sert à faire le passage entre :

* le **HTML statique** ;
* les premières bases de **PHP** ;
* la lecture de données depuis une base MySQL avec **PDO**.

À ce stade, on ne crée pas encore de formulaire de gestion, on ne modifie rien en base, on ne supprime rien, et on n’utilise pas encore de requêtes préparées.

On se concentre uniquement sur une idée simple :

**lire des produits dans une base de données et les afficher dans des pages HTML générées par PHP**

---

# Objectif de la séance

À la fin de cette séance, vous devez être capables de :

* construire une page catalogue en HTML ;
* construire une page détail en HTML ;
* transformer ces pages statiques en pages dynamiques avec PHP ;
* établir une connexion à MySQL avec **PDO** ;
* lire des données avec `SELECT` ;
* parcourir plusieurs résultats avec une boucle PHP ;
* utiliser un lien de type `index.php?product=ID` pour afficher le détail d’un produit.

---

# Logique de progression

L’ordre de travail attendu est le suivant :

1. créer une **page catalogue HTML** contenant une carte produit et un lien ;
2. créer une **page détail HTML** ;
3. connecter PHP à MySQL avec **PDO** ;
4. remplacer le contenu statique par une lecture réelle de la base ;
5. utiliser une boucle PHP pour afficher plusieurs produits ;
6. utiliser un lien `index.php?product=ID` pour afficher un détail produit.

---

# Base de données à utiliser

```sql id="z4gq1b"
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

# Contraintes

Dans cette séance, on travaille uniquement en **lecture**.

Vous ne devez pas utiliser :

* `INSERT`
* `UPDATE`
* `DELETE`
* `prepare()`
* formulaires de gestion

Vous devez travailler uniquement avec :

* `SELECT`
* `query()`
* `fetch()`
* boucles PHP
* `$_GET`

---

# Travail demandé

## 1. Créer la page catalogue en HTML

Commencez par réaliser une page **catalogue statique** en HTML.

Cette page doit contenir au minimum :

* une structure HTML complète ;
* une carte produit ;
* un nom de produit ;
* une image ;
* un prix ;
* un lien vers une page détail.

Le but de cette première étape est de définir la structure visuelle et sémantique avant d’y injecter PHP.

### Résultat attendu

Une page HTML contenant au moins une carte produit avec un lien.

---

## 2. Créer la page détail en HTML

Créez ensuite une page **détail statique** en HTML.

Cette page doit permettre d’afficher au minimum :

* le nom du produit ;
* l’image ;
* le type ;
* le prix ;
* des informations complémentaires éventuelles.

Là aussi, le but est d’abord de poser une structure claire avant de la rendre dynamique.

### Résultat attendu

Une page HTML détail prête à recevoir des données dynamiques.

---

## 3. Mettre en place la connexion PDO

Une fois les deux pages préparées en HTML, créez la connexion à la base de données.

Créez un fichier de configuration contenant l’objet PDO.

La connexion doit au minimum prévoir :

* `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`
* `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`

### Résultat attendu

Un fichier de connexion réutilisable permettant d’interroger la base.

---

## 4. Afficher le catalogue avec PHP et une boucle

Remplacez maintenant la carte HTML fixe du catalogue par une lecture réelle des produits.

Écrivez une requête SQL simple :

```sql id="n7a1kq"
SELECT * FROM products
```

Exécutez-la avec `query()`.

Ensuite, utilisez une boucle PHP pour parcourir les résultats un par un avec `fetch()`.

Le principe attendu est le suivant :

```php id="0nxd35"
$stmt = $pdo->query("SELECT * FROM products");

while ($product = $stmt->fetch()) {
    // afficher la carte produit
}
```

Chaque produit doit être affiché sous forme de carte.

Dans chaque carte, le lien doit pointer vers :

```text id="3rf08g"
index.php?product=ID
```

où `ID` correspond à l’identifiant réel du produit.

### Résultat attendu

Une page catalogue dynamique affichant plusieurs produits lus dans la base.

---

## 5. Afficher le détail d’un produit avec `index.php?product=ID`

Ajoutez ensuite une lecture de `$_GET['product']`.

Le principe est :

* si aucun produit n’est demandé, on affiche le catalogue ;
* si un identifiant produit est présent dans l’URL, on affiche le détail de ce produit.

Exemple d’URL :

```text id="dxomiu"
index.php?product=3
```

Dans ce cas, le script doit lire la valeur transmise, faire une requête SQL de lecture, puis afficher la page détail.

À ce stade, comme `prepare()` n’a pas encore été vu, on reste dans une logique de découverte simple autour de `SELECT`.

### Résultat attendu

Un clic sur une carte du catalogue mène à l’affichage détaillé du produit correspondant.

---

# Résultats attendus en fin de séance

À la fin de la séance, le projet doit permettre les deux usages suivants :

## Catalogue

L’utilisateur arrive sur la page principale et voit une liste de produits générée depuis la base de données.

## Détail

L’utilisateur clique sur un lien produit et arrive sur une vue détaillée grâce à une URL de type :

```text id="d020vg"
index.php?product=ID
```

---

# Ce que cette séance doit faire comprendre

## HTML d’abord

On commence par construire la forme de la page avant d’y injecter des données.

## PHP ensuite

PHP ne remplace pas HTML.
PHP sert à produire HTML à partir de données.

## PDO comme source de données

PDO permet d’aller chercher les produits dans MySQL.

## Boucles PHP

Une liste de produits implique une répétition.
La boucle sert à générer plusieurs cartes à partir de plusieurs lignes SQL.

## GET pour désigner une ressource

Le paramètre `product` dans l’URL sert à demander le détail d’un produit précis.
