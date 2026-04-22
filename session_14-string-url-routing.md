# Session 14 — Introduction au mini-routeur

## 1. Objectif

Jusqu’ici, vous avez utilisé des URLs comme :

```text
index.php?page=world
```

Dans ce chapitre, on passe à une autre forme :

```text
/world
/products/show/12
```

Le but est de comprendre comment PHP peut lire une URL découpée en segments, en extraire des informations, puis décider quoi faire.

À la fin, vous devez comprendre :

* la différence entre chemin et paramètres
* ce qu’est un front controller
* le rôle simple de `url_rewrite`
* ce qu’est un segment d’URL
* comment une URL peut être lue comme une structure

---

## 2. Ce que vous connaissez déjà

Vous connaissez déjà des URLs comme :

```text
index.php?page=home
index.php?page=products
index.php?page=product&id=12
```

Ici, les informations sont transmises sous forme de paramètres :

* `page=product`
* `id=12`

PHP lit ces valeurs et décide quoi afficher.

C’est déjà une forme simple de routing.

---

## 3. Deux façons d’exprimer une demande

### Avec des paramètres

```text
index.php?page=products&action=show&id=12
```

Les informations sont transmises après `?`.

### Avec le chemin

```text
/products/show/12
```

Ici, l’information est placée directement dans le chemin.

Dans les deux cas, l’idée est la même : indiquer au programme quoi faire.
Ce qui change, c’est la forme.

---

## 4. Pourquoi utiliser des URLs comme `/products/show/12` ?

Comparez :

```text
index.php?page=products&action=show&id=12
/products/show/12
```

La seconde forme est souvent :

* plus lisible
* plus courte
* plus facile à mémoriser
* plus facile à organiser mentalement

Exemple :

```text
/products
/products/show/12
/users/edit/3
```

On voit immédiatement une structure.

---

## 5. Une URL peut être lue comme une consigne

Exemple :

```text
/products/show/12
```

On peut y lire :

* `products` : la ressource
* `show` : l’action
* `12` : l’élément concerné

Une URL ne sert donc pas seulement à localiser.
Elle peut aussi exprimer une structure.

---

## 6. Le front controller

Quand on visite :

```text
/products/show/12
```

on pourrait croire que le serveur ouvre un vrai dossier puis un vrai fichier.

Souvent, ce n’est pas le cas.

En pratique, plusieurs URLs différentes arrivent vers un seul fichier central :

```text
index.php
```

Ce fichier central s’appelle le **front controller**.

Son rôle :

* recevoir la requête
* lire l’URL
* décider quoi faire

---

## 7. Le rôle de `url_rewrite`

Pour afficher une URL comme :

```text
/products/show/12
```

tout en exécutant en réalité :

```text
index.php
```

on utilise une réécriture d’URL.

Il faut retenir ceci :

> `url_rewrite` envoie la requête vers `index.php`, puis PHP interprète l’URL.

Autrement dit, la réécriture ne fait pas le routing métier.
Elle redirige simplement toutes les demandes vers le même point d’entrée.

---

## 8. Exemple minimal de `.htaccess`

```apache
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^ index.php [L,QSA]
```

À comprendre :

* si l’URL ne correspond pas à un vrai fichier
* et ne correspond pas à un vrai dossier
* alors la requête est envoyée vers `index.php`

C’est tout ce qu’il faut retenir ici.

---

## 9. Ce que fait ensuite PHP

Une fois la requête arrivée dans `index.php`, le script doit :

* lire l’URL
* la nettoyer
* la découper
* comprendre sa structure
* choisir une réponse

C’est cela, la base du routing.

---

## 10. Les segments d’URL

Un segment est une partie d’URL séparée par `/`.

Exemple :

```text
/admin/products/edit/5
```

contient 4 segments :

1. `admin`
2. `products`
3. `edit`
4. `5`

Chaque segment ajoute une précision.

---

## 11. Combien de segments ?

En pratique :

* 1 segment peut suffire
* 2 segments couvrent déjà beaucoup de cas
* 3 segments suffisent souvent pour apprendre et pour construire un mini-routeur simple
* 4 segments apparaissent souvent avec une zone comme `admin`
* 5 segments existent, surtout dans des APIs ou des structures plus fines

Exemples :

```text
/products
/products/show
/products/show/12
/admin/products/edit/5
/api/users/42/orders/3
```

Règle simple :

> plus une URL est longue, plus elle doit être justifiée.

---

## 12. Une structure simple pour apprendre

Dans beaucoup de cas, cette structure suffit :

```text
/controller/action/id
```

Exemples :

```text
/products/list
/products/show/12
/users/edit/3
```

Elle est simple à lire, simple à découper, et très utile pour apprendre le routing.

---

## 13. Tous les segments n’ont pas toujours le même rôle

Comparez :

```text
/products/show/12
/admin/products/edit/5
```

Dans la première :

* ressource
* action
* id

Dans la seconde :

* zone
* ressource
* action
* id

La signification d’un segment dépend donc de sa position.

---

## 14. Chemin et paramètres ne jouent pas le même rôle

Exemple :

```text
/products/show/12?sort=asc
```

Ici :

* le chemin principal est `/products/show/12`
* le paramètre est `sort=asc`

En général :

* le chemin exprime la route principale
* les paramètres ajoutent des options

---

## 15. Front-office et administration

Toutes les routes ne décrivent pas la même zone.

### Front-office

```text
/
products
/products/show/12
```

### Administration

```text
/admin
/admin/products
/admin/products/edit/5
```

Le premier segment peut donc aussi indiquer une zone.

---

## 16. Valeurs par défaut

Certaines URLs ne donnent pas toutes les informations.

Exemples :

```text
/
/products
/admin
```

L’application peut compléter ce qui manque par convention :

* `/` → `home/index`
* `/products` → `products/index`
* `/admin` → accueil admin

Une URL peut donc être courte sans être invalide.

---

## 17. Route bien formée et route valide

Il faut distinguer deux choses.

Exemple :

```text
/products/show/999
```

Cette route peut être bien formée : sa structure est correcte.

Mais elle n’est pas forcément valide dans l’application : le produit `999` n’existe peut-être pas.

Donc :

* une route peut être correctement écrite
* sans correspondre à une ressource réelle

---

## 18. Ce qu’il vaut mieux éviter

Évitez :

* les URLs trop longues
* les noms incohérents
* les segments inutiles
* les structures qui changent sans logique

Moins bon :

```text
/doProductThing/12
/adminpanel2/manage_user_edit/42
```

Mieux :

```text
/products/show/12
/admin/users/edit/42
```

---

## 19. Observer des URLs réelles

Avant de coder, regardez les URLs de vrais sites.

Essayez d’identifier :

* le nombre de segments
* la présence ou non de `?`
* la présence d’un id
* la stabilité de la structure
* la différence entre front, admin, recherche, filtres

Exemples utiles à observer :

* page d’accueil
* page liste
* page détail
* page catégorie
* page recherche
* page admin

---

## 20. Ce que fera le mini-routeur

Dans l’exercice, vous ne travaillerez pas encore avec un vrai serveur configuré.

Vous allez simuler le travail du routeur à partir d’une liste d’URLs.

Pour chaque URL, le script devra :

* la lire
* la nettoyer
* la découper
* identifier les segments
* extraire les informations utiles
* reconnaître un cas connu ou produire une 404

---

## 21. Résumé

Jusqu’ici, vous utilisiez surtout des URLs comme :

```text
index.php?page=world
```

Vous allez maintenant travailler avec des formes comme :

```text
/world
/products/show/12
```

Pour cela, il faut retenir quatre idées :

* une URL peut exprimer une demande
* plusieurs URLs peuvent arriver vers un seul `index.php`
* `url_rewrite` sert à faire arriver la requête au bon point d’entrée
* PHP doit ensuite interpréter le chemin en segments

C’est exactement la logique du mini-routeur.
