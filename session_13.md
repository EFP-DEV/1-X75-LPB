# Session 13 — Exercice de synthèse PHP

## Catalogue de produits dynamique avec formulaires et PDO

**Durée : 4h**

Cette séance sert à mettre en pratique les notions vues dans les deux chapitres précédents.

Vous avez d’abord découvert que PHP permet de produire du HTML dynamiquement, de manipuler des variables, des tableaux indexés et des tableaux associatifs.
Vous avez ensuite vu comment une requête HTTP apporte des données en **GET** ou en **POST**, comment un script PHP peut jouer le rôle de **point de traitement**, et comment utiliser **PDO** pour dialoguer avec une base de données MySQL.

Dans cette séance, vous allez réunir ces éléments dans un mini-système de gestion de produits.

L’objectif n’est pas encore de construire un back-office complet, ni une architecture complexe, ni une version sécurisée d’une application web.
L’objectif est de comprendre concrètement le passage suivant :

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
* `query()` pour exécuter une requête SQL ;
* `fetch()` pour récupérer les résultats ligne par ligne.

---

# Avertissement important sur la sécurité

## Ce que vous faites ici est volontairement simplifié

Dans cet exercice, vous allez manipuler les requêtes SQL avec `query()` uniquement, parce que c’est ce que nous avons vu jusqu’ici.

Cela permet de comprendre plus simplement :

* comment construire une requête ;
* comment envoyer cette requête à MySQL ;
* comment récupérer les résultats ;
* comment relier SQL, PHP et HTML.

Mais il faut être très clair :

## Cette manière de faire n’est pas sûre

Dès qu’une requête contient des données venant de l’utilisateur, l’usage direct de `query()` avec interpolation ou concaténation de valeurs **n’est pas sécurisé**.

C’est une très mauvaise pratique dans un vrai projet.

Cela expose notamment à des problèmes comme :

* l’injection SQL ;
* la casse de requête à cause des guillemets ;
* des comportements imprévus ;
* des failles de sécurité graves.

## Donc il faut retenir ceci avec insistance

Dans cette séance :

* vous utilisez `query()` parce que nous sommes encore dans une étape d’apprentissage ;
* vous le faites pour comprendre le mécanisme général ;
* vous ne devez **pas** considérer cela comme une bonne pratique professionnelle.

Dans un projet réel, dès qu’une valeur variable intervient dans une requête SQL, on n’écrit pas cela “à la main” avec `query()`.
On utilise des requêtes préparées.

**Autrement dit : ce que vous faites ici est pédagogique, pas sûr, et ne doit pas devenir une habitude de travail.**

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
````

## PDO

La connexion doit se faire avec **PDO**.

Vous devez configurer au minimum :

* `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`
* `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`

## Requêtes

Dans cette séance, vous travaillez avec ce que nous avons vu jusqu’ici.

Vous utiliserez donc :

* `query()` pour lire la liste des produits ;
* `query()` aussi pour les autres opérations de l’exercice, même si cela implique des valeurs variables ;
* `fetch()` pour récupérer les résultats ligne par ligne.

## Rappel indispensable

Le fait d’utiliser `query()` avec des valeurs variables n’est **pas sûr**.

Vous le faites ici uniquement parce que les requêtes préparées n’ont pas encore été étudiées.

Il faut donc retenir deux choses en même temps :

1. cette séance vous aide à comprendre le mécanisme général ;
2. cette façon d’écrire les requêtes ne doit pas être reproduite telle quelle dans un vrai projet.

---

# Travail demandé

## 1. Vérifier la connexion et relire les bases

Créez un fichier de configuration pour la connexion à la base de données.

Dans un premier temps, testez simplement que la connexion fonctionne en récupérant tous les produits.

À ce stade, vous devez déjà être capables de :

* créer l’objet PDO ;
* exécuter une requête simple avec `query()` ;
* récupérer les lignes une par une avec `fetch()` ;
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
* construire une requête SQL d’insertion ;
* exécuter cette requête avec `query()` ;
* rediriger ou réafficher la liste après insertion.

### Résultat attendu

Un nouveau produit peut être ajouté depuis le formulaire et apparaît ensuite dans le catalogue.

### Attention

Cette étape est précisément l’une de celles qui montrent pourquoi `query()` seul n’est pas sûr.

Ici, vous allez probablement construire une requête SQL avec des valeurs venues du formulaire.
C’est acceptable **uniquement comme exercice de compréhension**.
Ce n’est **pas acceptable** dans une vraie application.

---

## 4. Modifier un produit existant

Créez une page ou une section qui liste les produits avec un lien ou un bouton **Modifier**.

Le lien de modification peut passer par **GET** pour transmettre l’identifiant du produit à charger.

Exemple attendu dans la logique :

* `edit.php?id=3`

Dans la page de modification :

* récupérez l’`id` du produit ;
* lisez le produit correspondant avec une requête SQL ;
* affichez un formulaire prérempli ;
* envoyez les modifications en **POST** ;
* mettez à jour la ligne dans la base.

### Résultat attendu

Un produit existant peut être chargé, affiché dans un formulaire, puis mis à jour correctement.

### Attention

Là encore, la construction d’une requête SQL de mise à jour avec des valeurs variables n’est pas sûre.

Vous pouvez le faire ici parce que l’objectif est de comprendre le passage entre formulaire, PHP et SQL.
Mais il faut absolument garder en tête que ce n’est pas une pratique valide pour un vrai projet.

---

## 5. Supprimer un produit

Ajoutez une possibilité de suppression.

Vous pouvez le faire :

* soit par un petit formulaire ;
* soit par un traitement séparé.

Dans tous les cas, vous devez :

* identifier clairement le produit visé ;
* construire la requête SQL de suppression ;
* éviter toute ambiguïté entre affichage et suppression.

### Résultat attendu

Un produit peut être supprimé de la base, et disparaît ensuite de la liste.

### Attention

Même pour un `DELETE`, l’usage direct de `query()` avec une valeur variable n’est pas considéré comme sûr.
Le fait que cela “marche” ne veut pas dire que c’est une bonne méthode.

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

# Ce qu’il faut faire avec prudence

Dans cette séance, vous manipulez un mode de travail simplifié.

Il faut donc faire particulièrement attention à :

* bien distinguer les données numériques et les données textuelles ;
* ne pas confondre affichage HTML et traitement SQL ;
* ne pas croire qu’une requête qui fonctionne est automatiquement une requête correcte du point de vue de la sécurité.

Une requête peut fonctionner techniquement et être malgré tout une mauvaise requête du point de vue professionnel.

C’est exactement le cas ici dès qu’une valeur variable est insérée directement dans le SQL.

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
* `query()` pour exécuter vos requêtes ;
* `fetch()` pour récupérer les résultats ;
* une logique claire entre lecture, traitement et affichage.

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

## Compréhension de la limite de l’exercice

Vous devez aussi montrer que vous avez compris que :

* cette version est une version d’apprentissage ;
* l’usage de `query()` avec données variables n’est pas sûr ;
* une vraie application devra remplacer cette logique par une méthode sécurisée plus tard.

---

# Progression recommandée

## Étape 1

Connexion PDO + lecture de tous les produits avec `query()` et `fetch()`.

## Étape 2

Affichage HTML du catalogue.

## Étape 3

Formulaire d’ajout en POST + insertion avec `query()`.

## Étape 4

Lien de modification en GET + formulaire prérempli + mise à jour en POST.

## Étape 5

Suppression d’un produit.

---

# Ce qu’il faut retenir après l’exercice

À la fin de cette séance, vous devez avoir constaté concrètement que :

* PHP sert à produire du HTML à partir de données ;
* les résultats de PDO peuvent être manipulés sous forme de tableaux associatifs ;
* GET sert surtout à demander ou cibler une ressource ;
* POST sert à envoyer des données à traiter ;
* le script PHP joue le rôle de point de passage entre la requête, la logique et la base de données ;
* PDO permet de lire et modifier les données de manière explicite ;
* une requête SQL construite directement avec des valeurs variables peut fonctionner, mais cela ne veut pas dire qu’elle est sûre.

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


Je peux aussi en faire une version encore plus pédagogique, avec un ton “consignes apprenants”, plus sec et plus direct.
```
