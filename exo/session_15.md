# Session 15 — Exercice : Fonctions, réutilisation et scope

## Objectif

Créer un petit système en plusieurs fichiers pour apprendre à :

* définir des fonctions dans un fichier séparé ;
* les réutiliser dans un autre fichier avec `include` ;
* comprendre qu’une fonction chargée devient appelable dans le script ;
* comprendre qu’une variable extérieure n’entre pas automatiquement dans une fonction ;
* faire circuler les données explicitement avec des paramètres.

---

# Contexte

On vous donne des données dans un fichier `products.php`.

Votre travail est de construire vous-même les fonctions dans un fichier `product_model.php`, puis de les utiliser dans `index.php`.

Le point important de l’exercice n’est pas seulement d’afficher des produits.

Le point important est de comprendre ceci :

* une fonction peut être définie dans un fichier et utilisée dans un autre ;
* mais une fonction ne récupère pas automatiquement les variables extérieures ;
* si une fonction a besoin d’une donnée, cette donnée doit entrer en paramètre.

---

# Fichier `products.php`

Copiez-collez ce fichier :

```php
<?php

$products = [
    ["name" => "Chaise", "price" => 50, "promo" => false],
    ["name" => "Table", "price" => 150, "promo" => true],
    ["name" => "Lampe", "price" => 30, "promo" => false],
    ["name" => "Canapé", "price" => 499, "promo" => true],
];

$currency = "€";
$promo_label = "PROMO";
$expensive_limit = 100;
```

---

# Fichier `index.php`

Copiez-collez ce fichier :

```php
<?php

include 'products.php';
include 'product_model.php';

echo "<h2>Tous les produits</h2>";

foreach ($products as $product) {
    echo product_label($product, $currency, $promo_label) . "<br>";
}

echo "<h2>Produits chers</h2>";

foreach ($products as $product) {
    if (is_expensive($product, $expensive_limit)) {
        echo product_label($product, $currency, $promo_label) . "<br>";
    }
}
```

---

# Fichier `product_model.php`

Créez ce fichier vous-même.

Vous devez y écrire les fonctions suivantes.

## Signatures obligatoires

```php
function format_price($price, $currency) {}

function product_label($product, $currency, $promo_label) {}

function is_expensive($product, $expensive_limit) {}
```

---

# 1. Observer avant d’écrire

Avant de coder, répondez à ces questions :

1. Dans quel fichier les données sont-elles stockées ?
2. Dans quel fichier les fonctions doivent-elles être écrites ?
3. Pourquoi `index.php` peut-il appeler une fonction définie dans `product_model.php` ?
4. Pourquoi `format_price()` ne doit-elle pas essayer d’utiliser directement `$currency` sans le recevoir ?
5. Pourquoi `product_label()` doit-elle recevoir `$currency` et `$promo_label` en paramètre ?

---

# 2. Travail demandé

Vous devez écrire les trois fonctions dans `product_model.php`.

Interdiction d’utiliser :

* `global`

Chaque fonction doit recevoir explicitement ce dont elle a besoin.

---

# 3. Étape 1 — écrire `format_price()`

## Signature imposée

```php
function format_price($price, $currency) {}
```

## Travail

Cette fonction doit :

* recevoir un prix ;
* recevoir une devise ;
* retourner une chaîne contenant le prix suivi de la devise.

## Résultats attendus

* `50€`
* `150€`
* `499€`

---

# 4. Étape 2 — écrire `product_label()`

## Signature imposée

```php
function product_label($product, $currency, $promo_label) {}
```

## Travail

Cette fonction doit :

* recevoir un produit ;
* recevoir la devise ;
* recevoir le texte du label promo ;
* retourner une chaîne complète pour afficher le produit.

## Règles

Le label doit :

* afficher le nom ;
* afficher le prix formaté ;
* ajouter le label promo si le produit est en promo.

## Résultats attendus

* `Chaise - 50€`
* `Table - 150€ - PROMO`

## Consigne importante

Dans cette fonction, vous devez réutiliser :

```php
format_price(...)
```

---

# 5. Étape 3 — écrire `is_expensive()`

## Signature imposée

```php
function is_expensive($product, $expensive_limit) {}
```

## Travail

Cette fonction doit :

* recevoir un produit ;
* recevoir une limite ;
* retourner `true` si le prix est supérieur à la limite ;
* retourner `false` sinon.

## Pour une limite de `100`

Résultats attendus :

* chaise → `false`
* table → `true`
* lampe → `false`
* canapé → `true`

---

# 6. Étape 4 — tester avec `index.php`

Une fois vos fonctions écrites, exécutez `index.php`.

Vous devez obtenir deux sections :

## Section 1 — Tous les produits

Résultat attendu :

* `Chaise - 50€`
* `Table - 150€ - PROMO`
* `Lampe - 30€`
* `Canapé - 499€ - PROMO`

## Section 2 — Produits chers

Résultat attendu :

* `Table - 150€ - PROMO`
* `Canapé - 499€ - PROMO`

---

# 7. Étape 5 — ajouter une section “Produits en promo”

Ajoutez dans `index.php` une troisième section :

```php
<h2>Produits en promo</h2>
```

Dans cette section, affichez uniquement les produits dont `promo` vaut `true`.

## Consigne

Vous devez réutiliser :

```php
product_label(...)
```

Vous ne pouvez pas reconstruire l’affichage à la main.

## Résultat attendu

* `Table - 150€ - PROMO`
* `Canapé - 499€ - PROMO`

---

# 8. Étape 6 — changement de consigne

Le client change d’avis.

Il ne veut plus voir :

* `Table - 150€ - PROMO`

Il veut voir :

* `Table - 150€ (promotion)`

## Travail demandé

Modifiez votre code pour appliquer cette nouvelle règle.

## Question

Combien d’endroits avez-vous dû modifier ?

---

# 9. Étape 7 — nouvelle devise

Ajoutez une nouvelle section dans `index.php` pour afficher les produits chers avec une autre devise :

* ` EUR`

## Résultat attendu

* `Table - 150 EUR - PROMO`
* `Canapé - 499 EUR - PROMO`

## Question

Pourquoi ce changement est-il simple si la devise est passée en paramètre ?

---

# 10. Vérification de compréhension

Répondez en une ou deux phrases :

1. Pourquoi une fonction écrite dans `product_model.php` peut-elle être appelée dans `index.php` ?
2. Pourquoi `$currency` n’est-elle pas disponible automatiquement dans `format_price()` ?
3. Pourquoi `global` est-il une mauvaise solution ici ?
4. Pourquoi passer les données en paramètre rend-il le code plus clair ?
5. Quelle différence faites-vous entre :

   * réutiliser une fonction ;
   * réutiliser une variable extérieure ?

---

# 11. Contraintes

* `product_model.php` doit être entièrement écrit par vous
* pas de `global`
* chaque fonction reçoit ses données en paramètre
* pas de dépendance cachée
* pas de code dupliqué pour afficher un produit
* une fonction qui fabrique une valeur utilise `return`
* l’affichage final se fait dans `index.php`

---

# 12. Bonus

Ajoutez une quatrième fonction.

## Signature imposée

```php
function is_on_sale($product) {}
```

## Travail

Cette fonction doit :

* retourner `true` si le produit est en promo ;
* retourner `false` sinon.

Puis réécrivez la section “Produits en promo” en utilisant cette fonction.

---

# 13. Ce que l’exercice travaille vraiment

Cet exercice sert à comprendre que :

* une fonction peut être définie dans un fichier et utilisée dans un autre ;
* une fonction devient réutilisable après chargement avec `include` ;
* une variable extérieure ne traverse pas automatiquement le scope d’une fonction ;
* une bonne fonction annonce ses besoins dans ses paramètres ;
* centraliser une règle rend le code plus facile à modifier.
