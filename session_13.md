# Session 13 — Exercice de synthèse PHP

## Catalogue de produits dynamique avec formulaires et PDO

**Durée : 4h**

Cette séance sert à mettre en pratique les notions vues dans les deux chapitres précédents.

Vous avez d’abord découvert que PHP permet de produire du HTML dynamiquement, de manipuler des variables, des tableaux indexés et des tableaux associatifs.
Vous avez ensuite vu comment une requête HTTP apporte des données en **GET** ou en **POST**, comment un script PHP peut jouer le rôle de **point de traitement**, et comment utiliser **PDO** pour lire et écrire dans une base de données MySQL.

Dans cette séance, vous allez réunir ces éléments dans un mini-système de gestion de produits.

L’objectif n’est pas encore de construire un back-office complet ou une architecture complexe.
L’objectif est de comprendre le passage concret suivant :

**requête → lecture des données → traitement PHP → accès base de données → affichage HTML**

---

# Objectif de la séance

À la fin de cette séance, vous devez être capable de réaliser une petite application PHP qui :

* lit des produits depuis une base MySQL avec **PDO** ;
* affiche ces produits dans une page HTML ;
* ajoute un produit via un **formulaire HTML** ;
* modifie un produit existant ;
* supprime un produit ;
* distingue correctement ce qui relève de **GET**, de **POST**, de l’affichage, et du traitement.

---

# Ce que cette séance mobilise

## Notions venant de la session 11

Vous devez réutiliser ici :

* la syntaxe de base de PHP ;
* les variables ;
* les tableaux associatifs ;
* l’insertion de PHP dans une page HTML ;
* `echo` ;
* la lecture de données structurées.

## Notions venant de PHP-102

Vous devez également réutiliser :

* le rôle du script qui reçoit et traite la requête ;
* la différence entre **GET** et **POST** ;
* la connexion à MySQL avec **PDO** ;
* `query()` pour une requête fixe ;
* `prepare()` + `execute()` pour une requête contenant des valeurs variables ;
* `fetch()` et `fetchAll()`.

---

# Contexte

Vous devez créer un petit système de gestion de produits pour un site e-commerce.

Chaque produit possède un nom, un type, un prix ou une fourchette de prix, une image, une note éventuelle, et éventuellement un prix promotionnel.

Le système doit permettre :

* d’afficher le catalogue ;
* d’ajouter un produit ;
* de modifier un produit ;
* de supprimer un produit.

---

# Contraintes

## Organisation

Vous devez respecter la structure de fichiers demandée dans le cours.

Le projet doit au minimum séparer :

* la configuration de la base de données ;
* le traitement PHP ;
* les vues HTML / PHP ;
* les formulaires.

## Base de données

Vous devez importer la table et les données suivantes.

```sql
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

## PDO

La connexion doit se faire avec **PDO**.

Vous devez configurer au minimum :

* `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`
* `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`

## Requêtes

Vous devez utiliser :

* `query()` pour lire une liste complète de produits ;
* `prepare()` et `execute()` dès qu’une valeur variable intervient, par exemple :

  * ajouter un produit ;
  * récupérer un produit par son `id` ;
  * modifier un produit ;
  * supprimer un produit.

---

# Travail demandé

## 1. Vérifier la connexion et relire les bases

Créez un fichier de configuration pour la connexion à la base de données.

Dans un premier temps, testez simplement que la connexion fonctionne en récupérant tous les produits.

À ce stade, vous devez déjà être capables de :

* créer l’objet PDO ;
* exécuter une requête simple ;
* récupérer les lignes avec `fetchAll()` ;
* constater que chaque ligne est un **tableau associatif**.

### Résultat attendu

Une page de test ou un affichage simple permettant de vérifier que la base répond et que les produits sont bien récupérés.

---

## 2. Afficher le catalogue de produits

Créez une vue publique qui affiche tous les produits.

Chaque produit doit montrer au minimum :

* son nom ;
* son image ;
* son type ;
* son prix ;
* sa note éventuelle.

Le prix affiché doit s’adapter au type de produit :

* si `price_min` et `price_max` existent, afficher une fourchette ;
* si `price` existe seul, afficher ce prix ;
* si `is_sale = 1` et qu’un `sale_price` existe, afficher l’ancien et le nouveau prix de manière compréhensible.

Cette étape sert à relier :

* les données SQL ;
* les tableaux associatifs PHP ;
* la génération de HTML avec PHP.

### Résultat attendu

Une page catalogue lisible, générée dynamiquement à partir des données de la base.

---

## 3. Ajouter un produit avec un formulaire

Créez un formulaire HTML permettant d’ajouter un produit.

Le formulaire doit contenir les champs utiles selon votre logique minimale, par exemple :

* nom ;
* image ;
* type de produit ;
* prix ;
* prix minimum ;
* prix maximum ;
* prix soldé ;
* note ;
* statut promotionnel.

Le formulaire doit être envoyé en **POST**.

Le script de traitement doit :

* lire les données reçues ;
* vérifier qu’elles existent au minimum dans une forme exploitable ;
* exécuter une requête préparée pour insérer le produit ;
* rediriger ou réafficher la liste après insertion.

### Résultat attendu

Un nouveau produit peut être ajouté depuis le formulaire et apparaît ensuite dans le catalogue.

---

## 4. Modifier un produit existant

Créez une page ou une section qui liste les produits avec un lien ou un bouton **Modifier**.

Le lien de modification peut passer par **GET** pour transmettre l’identifiant du produit à charger.

Exemple attendu dans la logique :

* `edit.php?id=3`

Dans la page de modification :

* récupérez l’`id` du produit ;
* lisez le produit correspondant avec une requête préparée ;
* affichez un formulaire prérempli ;
* envoyez les modifications en **POST** ;
* mettez à jour la ligne avec PDO.

### Résultat attendu

Un produit existant peut être chargé, affiché dans un formulaire, puis mis à jour correctement.

---

## 5. Supprimer un produit

Ajoutez une possibilité de suppression.

Vous pouvez le faire :

* soit par un petit formulaire ;
* soit par un traitement séparé.

Dans tous les cas, vous devez :

* identifier clairement le produit visé ;
* utiliser une requête préparée ;
* éviter toute ambiguïté entre affichage et suppression.

### Résultat attendu

Un produit peut être supprimé de la base, et disparaît ensuite de la liste.

---

# Logique attendue dans le flux

Pendant cet exercice, vous devez comprendre clairement le rôle de chaque étape.

## Ce qui relève de GET

GET sert ici surtout à **demander une page** ou à **désigner un élément à afficher**.

Exemples :

* afficher la liste ;
* demander le formulaire de modification d’un produit ;
* transmettre un identifiant dans l’URL.

## Ce qui relève de POST

POST sert ici à **envoyer des données à traiter**.

Exemples :

* ajouter un produit ;
* envoyer les modifications d’un produit ;
* confirmer une suppression.

## Ce qui relève du traitement PHP

Le script PHP doit :

* lire `$_GET` ou `$_POST` ;
* décider quoi faire ;
* appeler la base de données si nécessaire ;
* transmettre les données à la vue.

## Ce qui relève de la vue

La vue doit surtout :

* afficher les produits ;
* afficher les formulaires ;
* réafficher les données reçues de manière lisible.

---

# Conseils de réalisation

Commencez par obtenir un affichage fonctionnel, même simple.

Ensuite seulement, ajoutez :

* le formulaire d’ajout ;
* la modification ;
* la suppression ;
* l’amélioration de la structure.

Ne cherchez pas à rendre le projet “parfait” dès le début.
Cherchez d’abord à rendre chaque étape **fonctionnelle**, puis **claire**, puis **mieux organisée**.

Quand une page ne fonctionne pas, vérifiez dans cet ordre :

1. la requête arrive-t-elle bien ?
2. les données sont-elles bien lues ?
3. la connexion PDO fonctionne-t-elle ?
4. la requête SQL est-elle correcte ?
5. l’affichage HTML correspond-il aux données récupérées ?

---

# Critères d’évaluation

L’évaluation portera sur les points suivants.

## Fonctionnement général

Le catalogue doit permettre :

* d’afficher les produits ;
* d’ajouter un produit ;
* de modifier un produit ;
* de supprimer un produit.

## Compréhension des données

Le code doit montrer que vous comprenez :

* la différence entre **GET** et **POST** ;
* la structure des données reçues ;
* l’usage des tableaux associatifs avec PDO.

## Utilisation de PDO

Vous devez utiliser correctement :

* la connexion PDO ;
* `query()` pour une requête fixe ;
* `prepare()` + `execute()` pour une requête avec valeurs variables ;
* `fetch()` et `fetchAll()` au bon moment.

## Organisation minimale

Le code doit rester lisible.

On doit pouvoir distinguer :

* la configuration ;
* le traitement ;
* l’affichage.

## Validation minimale

Vous devez vérifier au minimum les données essentielles avant insertion ou mise à jour.

Par exemple :

* un nom vide ne doit pas être accepté ;
* un type de produit doit appartenir aux valeurs prévues ;
* les prix doivent rester cohérents avec le type de produit.

---

# Progression recommandée

## Étape 1

Connexion PDO + lecture de tous les produits.

## Étape 2

Affichage HTML du catalogue.

## Étape 3

Formulaire d’ajout en POST + insertion.

## Étape 4

Lien de modification en GET + formulaire prérempli + update en POST.

## Étape 5

Suppression avec requête préparée.

---

# Ce qu’il faut retenir après l’exercice

À la fin de cette séance, vous devez avoir constaté concrètement que :

* PHP sert à produire du HTML à partir de données ;
* les résultats de PDO sont faciles à manipuler sous forme de tableaux associatifs ;
* GET sert surtout à demander ou cibler une ressource ;
* POST sert à envoyer des données à traiter ;
* le script PHP joue le rôle de point de passage entre la requête, la logique et la base de données ;
* PDO permet de lire et modifier les données de manière explicite et claire.

---

# Formule courte à retenir

```text
La page reçoit une requête.
PHP lit GET ou POST.
Le script décide du traitement.
PDO parle à MySQL.
Les résultats reviennent sous forme de tableaux associatifs.
PHP produit le HTML final.
```
