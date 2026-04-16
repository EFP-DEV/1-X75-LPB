# Session 15 - Exercice — Pourquoi les fonctions changent vraiment le code

## Contexte

On vous donne un script qui fonctionne, mais qui est mal construit.

Il affiche une liste de produits, mais il se répète beaucoup.

Votre travail n'est pas seulement de “faire des fonctions”.

Votre travail est de transformer un code lourd, fragile et répétitif en code plus propre, plus lisible et plus facile à modifier.

---

## Données de départ

```php
$products = [
    ["name" => "Chaise", "price" => 50, "promo" => false],
    ["name" => "Table", "price" => 150, "promo" => true],
    ["name" => "Lampe", "price" => 30, "promo" => false],
    ["name" => "Canapé", "price" => 499, "promo" => true],
];
```

---

# 1. Script de départ

Voici un script volontairement mauvais :

```php
echo "<h2>Tous les produits</h2>";

echo $products[0]["name"] . " - " . $products[0]["price"] . "€";
if ($products[0]["promo"]) {
    echo " - PROMO";
}
echo "<br>";

echo $products[1]["name"] . " - " . $products[1]["price"] . "€";
if ($products[1]["promo"]) {
    echo " - PROMO";
}
echo "<br>";

echo $products[2]["name"] . " - " . $products[2]["price"] . "€";
if ($products[2]["promo"]) {
    echo " - PROMO";
}
echo "<br>";

echo $products[3]["name"] . " - " . $products[3]["price"] . "€";
if ($products[3]["promo"]) {
    echo " - PROMO";
}
echo "<br>";
```

---

# 2. Observer le problème

Avant de modifier le code, observez-le.

## Questions

1. Quelles parties se répètent ?
2. Pourquoi ce code devient-il pénible si on a 30 produits au lieu de 4 ?
3. Si on veut changer l'affichage du prix, combien d'endroits faudra-t-il modifier ?
4. Si on veut réafficher les produits ailleurs dans la page, faudra-t-il recopier du code ?

But de cette étape : comprendre que le vrai problème n'est pas “écrire une fonction”, mais éviter de refaire la même chose partout.

---

# 3. Première amélioration — isoler l'affichage du prix

Créez une fonction :

```php
format_price($price)
```

Cette fonction reçoit un prix et retourne une chaîne comme :

```php
50€
150€
499€
```

## Exemples attendus

```php
echo format_price(50);
echo format_price(150);
echo format_price(499);
```

## Important

La fonction doit retourner une valeur avec `return`.

Elle ne doit pas faire `echo`.

---

# 4. Deuxième amélioration — isoler l'affichage d'un produit

Créez une fonction :

```php
product_label($product)
```

Cette fonction reçoit un tableau produit et retourne une chaîne.

## Règles

* elle affiche le nom
* elle affiche le prix formaté
* si le produit est en promo, elle ajoute ` - PROMO`

## Exemples attendus

```php
echo product_label($products[0]); // Chaise - 50€
echo product_label($products[1]); // Table - 150€ - PROMO
```

## Consigne importante

Vous devez utiliser `format_price()` dans `product_label()`.

But de cette étape : montrer qu'une fonction peut en utiliser une autre.

---

# 5. Troisième amélioration — afficher tous les produits proprement

Affichez maintenant tous les produits avec une boucle `foreach`.

Consigne : vous ne pouvez plus reconstruire l'affichage à la main dans la boucle.

Vous devez utiliser `product_label()`.

## Résultat attendu

```php
Chaise - 50€
Table - 150€ - PROMO
Lampe - 30€
Canapé - 499€ - PROMO
```

---

# 6. Quatrième amélioration — réutiliser au lieu de recopier

Sous la liste complète, affichez une deuxième section :

```php
<h2>Produits en promo</h2>
```

Dans cette section, affichez seulement les produits dont `promo` vaut `true`.

Vous pouvez d'abord faire cela avec un `if` dans la boucle.

Ensuite, créez une fonction :

```php
is_on_sale($product)
```

Cette fonction retourne :

* `true` si le produit est en promo
* `false` sinon

Puis réécrivez votre boucle en utilisant cette fonction.

---

# 7. Le moment important — changement de consigne

Maintenant, le client change d'avis.

Il ne veut plus voir :

```php
Table - 150€ - PROMO
```

Il veut voir :

```php
Table - 150€ (promotion)
```

## Travail demandé

Modifiez votre code pour appliquer cette nouvelle règle.

## Question

Combien de lignes avez-vous dû changer ?

But de cette étape : faire sentir concrètement l'intérêt des fonctions.

Quand le code est bien découpé, on change une règle à un seul endroit.

---

# 8. Contraintes

* pas de `global`
* chaque fonction reçoit ses données en paramètre
* pas de code dupliqué
* une fonction = un rôle précis
* une fonction qui fabrique une valeur doit utiliser `return`
* l'affichage final se fait à l'extérieur des fonctions

---

# 9. Ce que cet exercice travaille vraiment

Cet exercice apprend à :

* repérer les répétitions
* découper un problème
* centraliser une règle
* réutiliser du code
* faire collaborer plusieurs fonctions
* rendre un script plus facile à modifier
* comprendre qu'une fonction n'est pas juste un “bloc de code”, mais un outil de maintenance

---

# 10. Résultat attendu

À la fin, vous devez avoir un script :

* plus court
* plus lisible
* plus logique
* plus facile à modifier
* capable de réutiliser les mêmes règles à plusieurs endroits

---

# 11. Question finale

Répondez en une ou deux phrases :

1. Qu'est-ce que les fonctions vous ont évité ?
2. Qu'est-ce qu'elles vous ont permis de changer plus facilement ?
