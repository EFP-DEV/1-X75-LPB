# Session 15 - Fonctions & Scope


# Objectif

> Comprendre à quoi servent les fonctions, comment les écrire correctement, et pourquoi le scope oblige à faire circuler les données explicitement.

---

# 1. Pourquoi on crée des fonctions

Quand on commence à écrire des scripts, on fait souvent tout à la suite :

```php
$prix = 50;
echo $prix . "€";

$prix = 120;
echo $prix . "€";

$prix = 30;
echo $prix . "€";
```

Cela fonctionne, mais il y a vite des problèmes :

* le code se répète
* le script devient long
* on modifie une chose à plusieurs endroits
* on finit par perdre la logique générale

Une fonction sert à regrouper une action précise dans un bloc réutilisable.

Autrement dit, une fonction permet de dire :

* je lui donne des données
* elle fait un traitement
* elle me renvoie un résultat

On peut résumer cela comme ceci :

> entrée → traitement → sortie

---

## Premier exemple

```php
function bonjour($nom) {
    return "Bonjour " . $nom;
}

echo bonjour("Bob");
```

Ici :

* `"Bob"` est la donnée d'entrée
* la fonction fabrique un texte
* elle retourne ce texte
* `echo` affiche le résultat

---

## Autre exemple très simple

```php
function carre($nombre) {
    return $nombre * $nombre;
}

echo carre(4); // 16
echo carre(7); // 49
```

La même logique peut être réutilisée autant de fois qu'on veut.

---

# 2. Une fonction ne sert pas seulement à éviter la répétition

Éviter la répétition est utile, mais ce n'est pas le plus important.

Une fonction sert aussi à clarifier le code.

Comparer :

```php
$prix = 50;
$prix_tva = $prix * 1.21;
echo $prix_tva;
```

et :

```php
function prix_tvac($prix) {
    return $prix * 1.21;
}

echo prix_tvac(50);
```

Dans le deuxième cas, on comprend plus vite l'intention.

La fonction donne un nom à l'action.

---

# 3. Syntaxe de base d'une fonction

Une fonction se déclare avec `function`, un nom, des paramètres éventuels, puis un bloc.

```php
function addition($a, $b) {
    return $a + $b;
}
```

Ensuite, on l'appelle :

```php
echo addition(2, 3); // 5
```

---

## Exemple décomposé

```php
function addition($a, $b) {
    $resultat = $a + $b;
    return $resultat;
}
```

Cette version fait la même chose, mais en plus explicite :

* on reçoit `$a`
* on reçoit `$b`
* on calcule `$resultat`
* on retourne `$resultat`

---

# 4. return et echo ne font pas la même chose

C'est une confusion très fréquente au début.

## 4.1. `echo` affiche

```php
echo "Bonjour";
```

Cela envoie du contenu à l'écran.

---

## 4.2. `return` renvoie une valeur

```php
function bonjour($nom) {
    return "Bonjour " . $nom;
}
```

Ici, la fonction ne décide pas quoi faire du résultat. Elle le renvoie.

---

## Comparaison directe

### Cas 1

```php
function bonjour($nom) {
    echo "Bonjour " . $nom;
}

bonjour("Bob");
```

Cela affiche directement.

Mais la fonction ne renvoie rien de réutilisable.

---

### Cas 2

```php
function bonjour($nom) {
    return "Bonjour " . $nom;
}

echo bonjour("Bob");
```

Cette version est plus souple.

Pourquoi ?

Parce qu'on peut :

```php
$message = bonjour("Bob");
echo $message;
```

ou encore :

```php
echo strtoupper(bonjour("Bob"));
```

Une fonction qui retourne une valeur est plus réutilisable qu'une fonction qui affiche directement.

---

## Règle pratique

En général :

* la fonction prépare ou calcule
* l'affichage se fait à l'extérieur

---

# 5. Les paramètres

Les paramètres sont les données que la fonction reçoit.

## Exemple

```php
function saluer($prenom) {
    return "Salut " . $prenom;
}

echo saluer("Lyna");
echo saluer("Paul");
```

La fonction est la même, mais les données changent.

---

## Avec plusieurs paramètres

```php
function presenter($prenom, $age) {
    return $prenom . " a " . $age . " ans";
}

echo presenter("Lyna", 4);
```

---

## Exemple utile

```php
function prix_tvac($prix, $taux) {
    return $prix * (1 + $taux);
}

echo prix_tvac(100, 0.21); // 121
```

---

# 6. Les paramètres optionnels

On peut donner une valeur par défaut à un paramètre.

```php
function bonjour($nom = "inconnu") {
    return "Bonjour " . $nom;
}

echo bonjour(); // Bonjour inconnu
echo bonjour("Bob"); // Bonjour Bob
```

---

## Exemple concret

```php
function badge($nom, $role = "visiteur") {
    return $nom . " - " . $role;
}

echo badge("Bob"); // Bob - visiteur
echo badge("Lyna", "admin"); // Lyna - admin
```

Cela permet de rendre une fonction plus flexible sans obliger à toujours tout préciser.

---

# 7. Une fonction peut appeler une autre fonction

C'est là que les fonctions deviennent vraiment utiles.

```php
function format_price($price) {
    return $price . "€";
}

function product_label($name, $price) {
    return $name . " - " . format_price($price);
}

echo product_label("Chaise", 50);
```

Ici :

* `format_price()` a un rôle précis
* `product_label()` réutilise ce travail

On commence à construire des petits blocs simples qui collaborent entre eux.

---

## Autre exemple

```php
function is_adult($age) {
    return $age >= 18;
}

function access_message($age) {
    if (is_adult($age)) {
        return "Accès autorisé";
    }

    return "Accès refusé";
}

echo access_message(20);
echo access_message(15);
```

---

# 8. Le scope : le vrai moment important

Jusqu'ici, tout semble simple.

Mais il y a une règle fondamentale à comprendre :

> Une variable créée hors d'une fonction n'existe pas automatiquement dans la fonction.

C'est cela, le scope.

---

## Exemple qui semble logique, mais qui ne fonctionne pas

```php
$nom = "Bob";

function test() {
    return $nom;
}

echo test();
```

Cela provoque une erreur ou un avertissement, parce que `$nom` n'existe pas dans le scope de la fonction.

---

## Pourquoi ?

Parce qu'il y a deux espaces différents :

* l'espace global du script
* l'espace local de la fonction

La fonction vit dans son propre espace.

---

## Exemple plus parlant

```php
$prenom = "Lyna";

function dire_bonjour() {
    $prenom = "Paul";
    return "Bonjour " . $prenom;
}

echo dire_bonjour(); // Bonjour Paul
echo $prenom; // Lyna
```

Les deux variables portent le même nom, mais ce ne sont pas les mêmes.

---

# 9. La mauvaise solution : `global`

PHP permet ceci :

```php
$nom = "Bob";

function test() {
    global $nom;
    return $nom;
}

echo test();
```

Techniquement, cela marche.

Mais pédagogiquement et architecturalement, c'est une mauvaise habitude.

Pourquoi ?

* la fonction dépend d'une variable cachée
* on ne voit pas ses besoins dans ses paramètres
* elle devient plus difficile à comprendre
* elle devient plus difficile à réutiliser
* elle devient plus fragile

---

## Problème concret

```php
$nom = "Bob";

function saluer() {
    global $nom;
    return "Bonjour " . $nom;
}
```

En lisant juste :

```php
saluer();
```

on ne sait pas que la fonction dépend de `$nom`.

Cette dépendance est cachée.

---

# 10. La bonne solution : passer les données en paramètre

```php
function test($nom) {
    return $nom;
}

echo test("Bob");
```

Ici, tout est clair :

* la fonction a besoin d'un nom
* ce besoin est visible
* la donnée entre explicitement

---

## Même logique avec une phrase complète

```php
function saluer($nom) {
    return "Bonjour " . $nom;
}

echo saluer("Bob");
echo saluer("Lyna");
echo saluer("Milo");
```

La fonction n'a besoin de rien d'autre que ce qu'on lui donne.

C'est exactement ce qu'on veut.

---

# 11. Une bonne fonction est explicite

Une bonne fonction :

* reçoit ce dont elle a besoin
* ne dépend pas d'éléments cachés
* fait une chose identifiable
* retourne un résultat clair

---

## Exemple clair

```php
function calcul_tva($prix, $taux) {
    return $prix * $taux;
}

function prix_tvac($prix, $taux) {
    return $prix + calcul_tva($prix, $taux);
}

echo prix_tvac(100, 0.21);
```

Chaque fonction a un rôle simple.

---

## Exemple moins clair

```php
$taux = 0.21;

function prix_tvac($prix) {
    global $taux;
    return $prix + ($prix * $taux);
}
```

Cela marche peut-être, mais la dépendance au taux est cachée.

---

# 12. Application directe avec PDO

C'est ici que le problème du scope devient très concret.

Supposons que vous avez ceci dans un fichier :

```php
include 'database.php';
```

Et que `database.php` contient un objet `$pdo`.

Dans le script principal, `$pdo` existe.

Mais dans une fonction, il n'existe pas automatiquement.

---

## Exemple incorrect

```php
function getUsers() {
    return $pdo->query("SELECT * FROM user");
}
```

Cela ne fonctionne pas, car `$pdo` n'est pas connu dans la fonction.

---

## Version correcte

```php
function getUsers($pdo) {
    return $pdo->query("SELECT * FROM user");
}
```

Puis :

```php
$result = getUsers($pdo);
```

Ici, on injecte la dépendance.

La fonction dit clairement ce qu'elle attend pour fonctionner.

---

## Même logique avec une autre requête

```php
function getProductById($pdo, $id) {
    return $pdo->query("SELECT * FROM product WHERE id = " . $id);
}
```

Le point important ici n'est pas encore la sécurité SQL. Le point important est le scope :

* la fonction a besoin de `$pdo`
* la fonction a besoin de `$id`
* on lui donne les deux explicitement

---

# 13. Résumé intermédiaire

À ce stade, il faut retenir trois idées simples :

1. Une fonction sert à isoler une action.
2. Une fonction reçoit ses données par paramètres.
3. Une fonction ne voit pas automatiquement les variables extérieures.

---

# 14. Exemples progressifs

## 14.1. Exemple 1 — transformer une donnée

```php
function upper($text) {
    return strtoupper($text);
}

echo upper("bonjour");
```

---

## 14.2. Exemple 2 — faire un calcul

```php
function multiply($a, $b) {
    return $a * $b;
}

echo multiply(4, 5);
```

---

## 14.3. Exemple 3 — fabriquer une phrase

```php
function user_label($name, $age) {
    return $name . " (" . $age . " ans)";
}

echo user_label("Lyna", 4);
```

---

## 14.4. Exemple 4 — réutiliser une autre fonction

```php
function euro($price) {
    return $price . "€";
}

function product_card($name, $price) {
    return $name . " - " . euro($price);
}

echo product_card("Lampe", 30);
```

---

## 14.5. Exemple 5 — booléen

```php
function is_major($age) {
    return $age >= 18;
}

var_dump(is_major(20)); // true
var_dump(is_major(12)); // false
```

---

## 14.6. Exemple 6 — dépendance explicite

```php
function findAllProducts($pdo) {
    return $pdo->query("SELECT * FROM product");
}
```

---

# 15. Exercice 1 — Premières fonctions utiles

## Contexte

Vous avez un tableau de produits :

```php
$products = [
    ["name" => "Chaise", "price" => 50],
    ["name" => "Table", "price" => 150],
    ["name" => "Lampe", "price" => 30],
];
```

---

## But général

Découper le travail en petites fonctions simples.

Vous allez créer plusieurs fonctions qui collaborent entre elles.

---

## Étape 1 — formater un prix

Créer une fonction :

```php
format_price($price)
```

Exemples attendus :

```php
echo format_price(50);  // 50€
echo format_price(150); // 150€
echo format_price(30);  // 30€
```

---

## Étape 2 — créer un label produit

Créer une fonction :

```php
product_label($product)
```

Elle doit retourner une chaîne comme :

```php
Chaise - 50€
Table - 150€
Lampe - 30€
```

Exemple d'utilisation :

```php
echo product_label($products[0]);
```

Consigne importante : utiliser `format_price()` dans cette fonction.

---

## Étape 3 — afficher tous les produits

Afficher tous les produits avec une boucle :

```php
foreach ($products as $product) {
    echo product_label($product) . "<br>";
}
```

Résultat attendu à l'écran :

```php
Chaise - 50€
Table - 150€
Lampe - 30€
```

---

## Étape 4 — détecter les produits chers

Créer une fonction :

```php
is_expensive($product)
```

Règle :

* retourne `true` si le prix est supérieur à 100
* retourne `false` sinon

Exemples :

```php
var_dump(is_expensive(["name" => "Chaise", "price" => 50]));  // false
var_dump(is_expensive(["name" => "Table", "price" => 150]));  // true
```

---

## Étape 5 — afficher seulement les produits chers

Utiliser une boucle et la fonction `is_expensive()` pour afficher uniquement les produits dont le prix est supérieur à 100.

Résultat attendu :

```php
Table - 150€
```

---

# 16. Contraintes de l'exercice

* pas de `global`
* chaque fonction reçoit ses données en paramètre
* pas de code dupliqué
* une fonction = un rôle précis

---

# 17. Ce que l'exercice travaille vraiment

Cet exercice ne sert pas seulement à "faire des fonctions".

Il sert à apprendre à :

* découper un problème
* nommer les actions
* faire circuler les données proprement
* faire collaborer plusieurs fonctions
* comprendre concrètement le scope

---

# 18. Résultat attendu

À la fin, on veut un script :

* plus lisible
* mieux découpé
* sans dépendances cachées
* où chaque fonction a une responsabilité claire
