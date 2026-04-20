# Session 15 - Fonctions & Scope

## Objectif

> Comprendre à quoi servent les fonctions, comment les réutiliser dans un script ou entre plusieurs fichiers, et pourquoi les données doivent entrer explicitement dans les fonctions.

---

# 1. Pourquoi on crée des fonctions

Quand on débute, on voit souvent les fonctions comme un simple moyen d’éviter la répétition.

C’est vrai, mais ce n’est pas l’idée la plus importante.

Une boucle sert à répéter.

Une fonction sert à **nommer une action** et à **centraliser une règle**.

Exemple :

```php
echo "Chaise : " . 50 . "€<br>";
echo "Table : " . 120 . "€<br>";
echo "Lampe : " . 30 . "€<br>";
```

Ici, on pourrait dire :

> “On va mettre ça dans une boucle.”

Oui, mais ce n’est pas le vrai point.

Le vrai problème est que la règle :

```php
$prix . "€"
```

est écrite directement dans le code.

Si demain on veut afficher :

```php
50 EUR
```

ou :

```php
50.00 €
```

il faudra modifier plusieurs endroits.

Une fonction permet de définir cette règle une seule fois.

---

# 2. Premier exemple utile

```php
function format_price($price) {
    return $price . "€";
}
```

Puis :

```php
echo "Chaise : " . format_price(50) . "<br>";
echo "Table : " . format_price(120) . "<br>";
echo "Lampe : " . format_price(30) . "<br>";
```

Ici, la fonction ne répète pas.

Elle **porte une règle**.

Cette règle peut ensuite être utilisée partout dans le script.

---

# 3. Une fonction = entrée → traitement → sortie

Une fonction reçoit des données, fait quelque chose, puis renvoie un résultat.

```php
function bonjour($nom) {
    return "Bonjour " . $nom;
}

echo bonjour("Bob");
```

Ici :

* `"Bob"` est la donnée d’entrée
* la fonction construit un texte
* elle retourne ce texte
* `echo` affiche le résultat

---

# 4. Une fonction donne un nom à une action

Comparer :

```php
$prix = 100;
echo $prix * 1.21;
```

et :

```php
function prix_tvac($prix) {
    return $prix * 1.21;
}

echo prix_tvac(100);
```

Dans le deuxième cas, le code est plus clair.

La fonction ne fait pas seulement un calcul.

Elle donne un nom à l’intention.

---

# 5. Syntaxe de base

```php
function addition($a, $b) {
    return $a + $b;
}

echo addition(2, 3); // 5
```

Une fonction a généralement :

* un nom
* des paramètres
* un traitement
* un `return`

---

# 6. `return` et `echo`

Ils ne font pas la même chose.

## `echo`

```php
echo "Bonjour";
```

Affiche directement.

## `return`

```php
function bonjour($nom) {
    return "Bonjour " . $nom;
}
```

Renvoie une valeur.

---

# 7. Pourquoi `return` est plus souple

```php
function bonjour($nom) {
    return "Bonjour " . $nom;
}

echo bonjour("Bob");
```

Cette fonction peut aussi être réutilisée ainsi :

```php
$message = bonjour("Bob");
echo $message;
```

ou :

```php
echo strtoupper(bonjour("Bob"));
```

Règle pratique :

* la fonction prépare ou calcule
* l’affichage se fait à l’extérieur

---

# 8. Les paramètres

Les paramètres sont les données reçues par la fonction.

```php
function saluer($prenom) {
    return "Salut " . $prenom;
}

echo saluer("Lyna");
echo saluer("Paul");
```

Avec plusieurs paramètres :

```php
function presenter($prenom, $age) {
    return $prenom . " a " . $age . " ans";
}

echo presenter("Lyna", 4);
```

Avec une valeur par défaut :

```php
function badge($nom, $role = "visiteur") {
    return $nom . " - " . $role;
}

echo badge("Bob");
echo badge("Lyna", "admin");
```

---

# 9. Une fonction peut appeler une autre fonction

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

* `format_price()` gère le format du prix
* `product_label()` réutilise cette règle

On construit donc de petits blocs simples qui collaborent.

---

# 10. Les fonctions peuvent être réutilisées dans plusieurs fichiers

C’est un point important.

Une fonction définie dans un fichier peut être utilisée dans un autre fichier si ce fichier a été chargé avec `include` ou `require`.

## Exemple

```php
// functions.php
function format_price($price) {
    return $price . "€";
}
```

```php
// shop.php
include 'functions.php';

echo format_price(50);
```

```php
// promo.php
include 'functions.php';

echo format_price(499);
```

Ici, la fonction est disponible dans les deux fichiers.

Cela montre qu’une fonction n’est pas seulement un “bloc local”.

C’est aussi un outil de réutilisation à l’échelle du script chargé.

---

# 11. Le vrai point difficile : le scope

Voici la règle importante :

> Une fonction peut être appelée depuis n’importe quel endroit du script après son chargement, mais elle ne voit pas automatiquement les variables extérieures.

Autrement dit :

* les fonctions sont globalement appelables après déclaration ou inclusion
* les variables, elles, ne traversent pas automatiquement le scope des fonctions

---

# 12. Exemple de fonction disponible globalement

```php
// functions.php
function bonjour($nom) {
    return "Bonjour " . $nom;
}
```

```php
// index.php
include 'functions.php';

echo bonjour("Bob");
```

Cela fonctionne.

La fonction a été chargée dans le script.

---

# 13. Exemple de variable extérieure inaccessible

```php
$currency = "€";

function format_price($price) {
    return $price . $currency;
}
```

Cela ne fonctionne pas correctement.

Pourquoi ?

Parce que `$currency` existe dans le script, mais pas dans le scope local de la fonction.

La fonction ne prend pas automatiquement les variables qui l’entourent.

---

# 14. Le scope local et le scope global

Il faut distinguer deux espaces :

* le scope global du script
* le scope local de la fonction

Exemple :

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

# 15. La mauvaise solution : `global`

PHP permet ceci :

```php
$currency = "€";

function format_price($price) {
    global $currency;
    return $price . $currency;
}
```

Techniquement, cela marche.

Mais c’est une mauvaise habitude.

Pourquoi ?

* la fonction dépend d’une variable cachée
* son besoin n’apparaît pas dans ses paramètres
* elle devient plus fragile
* elle devient plus difficile à réutiliser

En lisant :

```php
format_price(50);
```

on ne voit pas qu’elle dépend aussi de `$currency`.

---

# 16. La bonne solution : passer les données en paramètre

```php
function format_price($price, $currency) {
    return $price . $currency;
}

echo format_price(50, "€");
```

Ici, tout est clair :

* la fonction a besoin d’un prix
* la fonction a besoin d’une devise
* on lui donne les deux explicitement

C’est cela qu’on veut.

---

# 17. Même logique avec un tableau

```php
$products = [
    ["name" => "Chaise", "price" => 50],
    ["name" => "Table", "price" => 150],
];
```

Exemple incorrect :

```php
function show_products() {
    foreach ($products as $product) {
        echo $product["name"] . "<br>";
    }
}
```

Pourquoi c’est incorrect ?

Parce que `$products` n’entre pas automatiquement dans la fonction.

Version correcte :

```php
function show_products($products) {
    foreach ($products as $product) {
        echo $product["name"] . "<br>";
    }
}
```

---

# 18. Application directe avec PDO

C’est ici que le scope devient très concret.

Supposons que vous avez ceci :

```php
include 'database.php';
```

Et que `database.php` crée un objet `$pdo`.

Dans le script principal, `$pdo` existe.

Mais dans une fonction, non.

## Exemple incorrect

```php
function getUsers() {
    return $pdo->query("SELECT * FROM user");
}
```

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

La fonction annonce clairement ce dont elle a besoin.

---

# 19. Résumé

Une bonne fonction :

* fait une action identifiable
* centralise une règle
* peut être réutilisée dans plusieurs endroits ou fichiers
* reçoit ses données en paramètre
* ne dépend pas de variables cachées
* retourne un résultat clair

Le point central de cette séance n’est donc pas seulement :

> “faire des fonctions”

Le point central est :

> centraliser une action, puis faire circuler les données explicitement
