# Session 14 — Introduction au mini-routeur

---

# 1. Objectif

Jusqu’ici, vous avez utilisé des URLs comme :

```text
index.php?page=world
````

Dans ce chapitre, on va comprendre une autre forme d’URL :

```text
/world
```

Puis :

```text
/products/show/12
```

Le but est de comprendre comment un script PHP peut lire une URL découpée en segments, en extraire des informations, puis décider quoi faire.

À la fin de ce chapitre, vous devez comprendre :

* la différence entre paramètres et chemin
* ce qu’est un front controller
* le rôle très simple de `url_rewrite`
* ce qu’est un segment d’URL
* comment une URL peut être interprétée comme une structure
* pourquoi cette logique prépare l’exercice du mini-routeur

---

# 2. Ce que vous connaissez déjà

Vous connaissez déjà des URLs comme :

```text
index.php?page=home
```

ou :

```text
index.php?page=products
```

ou encore :

```text
index.php?page=product&id=12
```

Dans ce modèle, les informations sont transmises sous forme de paramètres.

Exemple :

```text
index.php?page=product&id=12
```

contient :

* `page=product`
* `id=12`

Le script PHP lit ces valeurs et décide quoi afficher.

Cette logique est déjà une forme simple de routing.

---

# 3. Deux façons de transmettre une demande

Une application web peut exprimer une demande de deux grandes façons.

## 3.1. Avec des paramètres

Exemple :

```text
index.php?page=products&action=show&id=12
```

Ici, l’information est transmise après `?`.

On parle de paramètres.

---

## 3.2. Avec le chemin

Exemple :

```text
/products/show/12
```

Ici, l’information est placée directement dans le chemin de l’URL.

Dans les deux cas, l’idée est la même :

> dire au programme ce que l’on veut

La différence est surtout une différence de forme.

---

# 4. Pourquoi utiliser des URLs comme /products/show/12 ?

Comparez :

```text
index.php?page=products&action=show&id=12
```

et :

```text
/products/show/12
```

La deuxième forme est souvent :

* plus courte visuellement
* plus lisible
* plus facile à mémoriser
* plus facile à repérer comme structure

Elle permet aussi de voir plus clairement l’organisation logique du site.

Exemple :

```text
/products
/products/show/12
/users/edit/3
```

On voit tout de suite une logique commune.

---

# 5. Une URL n’est pas qu’une adresse

Une URL peut être lue comme une structure.

Exemple :

```text
/products/show/12
```

On peut déjà y voir :

* `products` : ce dont on parle
* `show` : ce que l’on veut faire
* `12` : l’élément concerné

Autrement dit, une URL peut être comprise comme une petite consigne.

C’est exactement ce que fera plus tard le mini-routeur.

---

# 6. Le front controller

Quand on visite une URL comme :

```text
/products/show/12
```

on pourrait croire que le serveur ouvre un vrai dossier `products`, puis un vrai fichier `show`.

Mais dans beaucoup de sites, ce n’est pas ce qui se passe.

En réalité, plusieurs URLs différentes peuvent toutes être envoyées vers un seul fichier central :

```text
index.php
```

Ce fichier central s’appelle souvent le **front controller**.

Son rôle est simple :

* recevoir la demande
* lire l’URL
* décider quoi faire

---

# 7. url_rewrite : le rôle de l’artefact technique

Pour afficher une belle URL comme :

```text
/products/show/12
```

tout en exécutant en réalité :

```text
index.php
```

on utilise souvent une réécriture d’URL.

Cette réécriture est un mécanisme technique du serveur.

Elle ne fait pas le routing à votre place.

Elle sert simplement à faire arriver plusieurs URLs vers le même point d’entrée.

Il faut retenir ceci :

> `url_rewrite` envoie la requête vers `index.php`, puis PHP interprète l’URL

---

# 8. Exemple minimal de .htaccess

Voici une forme simple de front controller avec réécriture :

```apache
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^ index.php [L,QSA]
```

Ce qu’il faut comprendre :

* si l’URL demandée ne correspond pas à un vrai fichier
* et ne correspond pas à un vrai dossier
* alors la requête est envoyée vers `index.php`

C’est tout ce qu’il faut retenir ici.

On ne détaille pas davantage dans ce chapitre.

---

# 9. Ce que fait réellement le script PHP

Une fois la requête arrivée dans `index.php`, le travail du script commence.

Le script doit alors :

* lire l’URL
* la nettoyer
* la découper
* comprendre sa structure
* choisir une réponse

C’est cela, la base du routing.

---

# 10. Observer des URLs sur de vrais sites

Avant de coder, il est utile de regarder comment les URLs sont construites dans la réalité.

Quand vous naviguez sur différents sites, regardez les adresses.

Essayez d’identifier :

* combien de segments elles contiennent
* si elles utilisent `?`
* si elles ont un identifiant
* si elles contiennent des mots lisibles
* si elles ont une structure stable

Exemples de types d’URLs à observer :

* page d’accueil
* page liste
* page détail
* page catégorie
* page de recherche
* page avec filtres

---

# 11. Ce qu’il faut remarquer en observant

En observant plusieurs sites, on voit vite que les URLs ne sont pas construites au hasard.

On remarque souvent que :

* la page d’accueil est très courte
* une liste a souvent 1 ou 2 segments
* une page détail ajoute souvent un identifiant ou un mot-clé
* les filtres utilisent souvent des paramètres après `?`
* les zones techniques ont parfois des segments spécifiques comme `admin` ou `api`

Exemples :

```text
/products
```

```text
/products/show/12
```

```text
/search?q=chair
```

```text
/admin/products/edit/5
```

---

# 12. Qu’est-ce qu’un segment ?

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

# 13. Une URL doit rester simple

Une bonne URL doit rester lisible.

En pratique :

* 1 segment peut suffire pour une section simple
* 2 segments suffisent souvent pour ressource + action
* 3 segments suffisent très souvent
* 4 segments apparaissent quand on ajoute une zone comme `admin`
* 5 segments peuvent exister, surtout en API ou en structure REST
* au-delà, il faut se demander si l’URL n’est pas trop lourde

Exemples courts :

```text
/products
```

```text
/products/show
```

```text
/products/show/12
```

```text
/admin/products/edit/5
```

```text
/api/users/42/orders/3
```

---

# 14. Trois segments suffisent souvent

Dans beaucoup de cas simples, une structure comme celle-ci suffit :

```text
/controller/action/id
```

Exemples :

```text
/products/list
```

```text
/products/show/12
```

```text
/users/edit/3
```

Cette structure est très utile pour apprendre, car elle est facile à lire et facile à traiter en PHP.

---

# 15. Quand il faut plus de segments

On ajoute des segments quand on ajoute du contexte.

Exemple :

```text
/admin/products/edit/5
```

Ici, `admin` ajoute une zone.

Autre exemple :

```text
/api/users/42/orders/3
```

Ici, l’URL exprime une relation plus précise.

Mais il faut garder une règle simple :

> plus une URL est longue, plus elle doit être justifiée

---

# 16. Tous les segments n’ont pas toujours le même rôle

La signification d’un segment dépend de sa position.

Comparez :

```text
/products/show/12
```

et :

```text
/admin/products/edit/5
```

Dans la première :

* segment 1 : ressource
* segment 2 : action
* segment 3 : id

Dans la seconde :

* segment 1 : zone
* segment 2 : ressource
* segment 3 : action
* segment 4 : id

Une URL ne se lit donc pas seulement morceau par morceau.

Elle se lit comme une structure ordonnée.

---

# 17. Ce qu’on met généralement dans une URL

Une URL contient souvent tout ou partie de ces éléments :

* une zone éventuelle
  exemple : `admin`, `api`

* une ressource
  exemple : `products`, `users`, `orders`

* une action éventuelle
  exemple : `show`, `edit`, `list`

* un identifiant éventuel
  exemple : `12`, `42`, `3`

Exemples :

```text
/products
```

```text
/products/show/12
```

```text
/admin/users/edit/42
```

---

# 18. Chemin et paramètres ne jouent pas le même rôle

Il faut distinguer deux parties possibles d’une URL.

## 18.1. Le chemin

Exemple :

```text
/products/show/12
```

Le chemin sert souvent à exprimer la structure principale.

---

## 18.2. Les paramètres

Exemple :

```text
/products/show/12?sort=asc
```

Ici, le chemin principal est :

```text
/products/show/12
```

et le paramètre est :

```text
sort=asc
```

En général :

* le chemin exprime la route principale
* les paramètres ajoutent des détails ou des options

---

# 19. Routes front et routes admin

Toutes les URLs ne décrivent pas la même zone du site.

## 19.1. Front-office

Exemples :

```text
/
```

```text
/products
```

```text
/products/show/12
```

Ces routes représentent la partie publique du site.

---

## 19.2. Administration

Exemples :

```text
/admin
```

```text
/admin/products
```

```text
/admin/products/edit/5
```

Ici, le premier segment indique que l’on entre dans une autre zone.

---

# 20. Les valeurs par défaut

Certaines URLs ne donnent pas toutes les informations.

Exemple :

```text
/
```

ou :

```text
/products
```

Dans ce cas, l’application peut compléter ce qui manque grâce à une convention.

Exemples possibles :

* `/` peut correspondre à `home/index`
* `/products` peut correspondre à `products/index`
* `/admin` peut correspondre à une page d’accueil admin

Une URL peut donc être incomplète sans être invalide.

---

# 21. Routes bien formées et routes valides

Il faut distinguer deux choses.

## 21.1. Une route bien formée

Exemple :

```text
/products/show/999
```

Cette URL a une structure correcte.

---

## 21.2. Une route valide dans l’application

Même si la structure est correcte, cela ne garantit pas que la donnée existe réellement.

Exemple :

```text
/products/show/999
```

peut être bien formée, mais il n’existe peut-être aucun produit `999`.

Autrement dit :

* une route peut être bien écrite
* sans pour autant correspondre à une ressource réelle

---

# 22. Ce qu’il vaut mieux éviter

Il vaut mieux éviter :

* des URLs trop longues
* des structures qui changent sans règle
* des noms incohérents
* des segments inutiles
* des formes difficiles à relire

Moins bon :

```text
/doProductThing/12
```

```text
/adminpanel2/manage_user_edit/42
```

Mieux :

```text
/products/show/12
```

```text
/admin/users/edit/42
```

---

# 23. Ce que le mini-routeur devra faire

Dans l’exercice, vous n’allez pas encore utiliser un vrai serveur configuré.

Vous allez simuler le travail du routeur à partir d’une liste d’URLs.

Pour chaque URL, le script devra :

* la lire
* la nettoyer
* la découper
* identifier ses segments
* comprendre sa structure
* extraire les éléments utiles
* décider si la route correspond à un cas connu ou à une 404

---

# 24. Résumé

Jusqu’ici, vous utilisiez des URLs comme :

```text
index.php?page=world
```

Vous allez maintenant travailler avec des URLs comme :

```text
/world
```

ou :

```text
/products/show/12
```

Pour cela, il faut comprendre quatre idées simples :

* une URL peut transmettre une demande
* plusieurs belles URLs peuvent en réalité passer par `index.php`
* `url_rewrite` sert seulement à faire arriver la requête au bon point d’entrée
* le script PHP doit ensuite interpréter le chemin en segments

Le mini-routeur repose exactement sur cette logique.
