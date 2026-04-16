# Session 15 - Mini routeur

---

# 1. Objectif

Dans ce chapitre, on apprend à lire une URL comme une structure.

Le but est de comprendre comment un script PHP peut découper une URL pour en extraire des informations utiles, puis décider quoi faire.

À la fin, vous devez comprendre comment obtenir à partir d’une URL :

- une zone éventuelle (`admin` ou front)
- une ressource
- une action
- un identifiant éventuel

---

# 2. Qu’est-ce qu’un routeur ?

Un routeur est un mécanisme qui lit une URL et décide à quelle logique elle correspond.

Exemple :

```text
/products/show/12
````

Cette URL peut être comprise comme :

* `products` : la ressource
* `show` : l’action
* `12` : l’identifiant

Le routeur sert donc à transformer une URL en consignes exploitables par le programme.

---

# 3. Pourquoi faire une simulation

Dans un vrai site, l’URL demandée vient du navigateur et du serveur.

Mais ici, on ne travaille pas encore avec :

* `$_SERVER`
* un serveur configuré
* des règles de réécriture
* un vrai système de contrôleurs

On travaille directement sur une liste d’URLs pour se concentrer sur la logique de base :

* lire
* nettoyer
* découper
* interpréter
* décider

---

# 4. Les types d’URLs à comprendre

Dans cet exercice, les URLs doivent représenter plusieurs parties du site.

## 4.1. Routes front-office

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

```text
/users/show/3
```

Ces URLs représentent la partie publique du site.

---

## 4.2. Routes d’administration

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

```text
/admin/users/edit/42
```

Ici, le premier segment `admin` indique qu’on est dans une zone spéciale du site.

---

# 5. Structure générale d’une URL

Une URL est d’abord une chaîne de caractères.

Exemple :

```text
/admin/products/edit/5
```

Cette chaîne peut être découpée en segments :

```text
admin
products
edit
5
```

Chaque segment peut avoir un rôle.

---

## 5.1. Cas d’une route front

```text
/products/show/12
```

Structure possible :

* ressource : `products`
* action : `show`
* id : `12`

---

## 5.2. Cas d’une route admin

```text
/admin/products/edit/5
```

Structure possible :

* zone : `admin`
* ressource : `products`
* action : `edit`
* id : `5`

---

# 6. Le travail à faire sur chaque URL

Le traitement d’une URL se fait toujours dans le même ordre.

## 6.1. Nettoyer

On commence par retirer ce qui ne nous intéresse pas.

Par exemple, si une URL contient des paramètres après `?`, on garde seulement le chemin principal.

Exemple :

```text
/products/show/12?sort=asc
```

devient :

```text
/products/show/12
```

---

## 6.2. Retirer les slashs inutiles

Avant de découper, on enlève les slashs au début et à la fin.

Exemple :

```text
/products/show/12/
```

devient :

```text
products/show/12
```

Cela évite de créer des segments vides inutiles.

---

## 6.3. Découper

Une fois l’URL préparée, on la découpe avec le séparateur `/`.

Exemple :

```text
products/show/12
```

devient :

```text
[products, show, 12]
```

Le résultat est un tableau de segments.

---

## 6.4. Interpréter

Une fois les segments obtenus, on leur donne un sens.

Selon le cas, on cherche à remplir des variables comme :

* `$controller`
* `$action`
* `$id`

Dans une version avec admin, on peut aussi distinguer une zone :

* `$area`
* `$controller`
* `$action`
* `$id`

---

# 7. Routes front et routes admin

Toutes les URLs n’ont pas exactement la même forme.

C’est un point important.

---

## 7.1. Route front simple

```text
/products/show/12
```

On peut comprendre :

* controller : `products`
* action : `show`
* id : `12`

---

## 7.2. Route admin

```text
/admin/products/edit/5
```

On peut comprendre :

* area : `admin`
* controller : `products`
* action : `edit`
* id : `5`

Ici, la présence de `admin` modifie la lecture de l’URL.

Le premier segment ne représente plus directement une ressource, mais une zone.

---

# 8. Les valeurs par défaut

Certaines URLs ne donnent pas toutes les informations.

Exemple :

```text
/
```

ou :

```text
/products
```

Dans ce cas, le programme peut compléter ce qui manque par convention.

Exemples :

* `/` peut représenter `home/index`
* `/products` peut représenter `products/index`
* `/admin` peut représenter une page d’accueil admin

Une valeur par défaut sert à donner un sens à une URL incomplète mais acceptable.

---

# 9. La logique finale

Une fois l’URL comprise, le programme peut appliquer une logique simple.

Exemples :

* afficher l’accueil
* afficher la liste des produits
* afficher le produit demandé
* afficher le formulaire d’édition d’un utilisateur
* renvoyer `404`

Le rôle du mini routeur est donc double :

1. comprendre l’URL
2. orienter le programme vers une réponse

---

# 10. La 404

Une URL peut être bien formée mais inconnue.

Exemple :

```text
/unknown/test
```

ou :

```text
/admin/ghost/delete/9
```

Dans ce cas, le routeur ne trouve pas de correspondance valable.

La réponse attendue est alors :

```text
404
```

Cela signifie que la route n’existe pas dans la logique prévue.

---

# 11. Cas particuliers à connaître

## 11.1. URL racine

```text
/
```

Elle ne contient pas de vrai segment utile.
Il faut donc lui donner une interprétation par défaut.

---

## 11.2. Slashs multiples

Exemple :

```text
//products//show//12//
```

Cette URL peut compliquer la lecture.
Il faut donc normaliser autant que possible avant d’interpréter.

---

## 11.3. ID invalide

Exemple :

```text
/products/show/abc
```

La structure ressemble à une route correcte, mais l’identifiant n’est peut-être pas valide.

Si une route attend un identifiant numérique, il faut le vérifier.

---

## 11.4. Trop de segments

Exemple :

```text
/products/show/12/extra
```

Si votre logique prévoit au maximum 3 segments côté front ou 4 côté admin, cette URL devient invalide.

---

# 12. Ce que vous devez retenir

Un mini routeur repose sur une idée simple :

* une URL est une chaîne
* on peut la nettoyer
* on peut la découper
* on peut attribuer un rôle à chaque segment
* on peut décider quoi faire à partir de cette structure

Exemples :

```text
/products/show/12
```

peut devenir :

* controller : `products`
* action : `show`
* id : `12`

et :

```text
/admin/users/edit/42
```

peut devenir :

* area : `admin`
* controller : `users`
* action : `edit`
* id : `42`

---

# 13. Vocabulaire utile

## URL

Adresse demandée.

## Segment

Morceau d’URL séparé par `/`.

## Route

Forme d’URL reconnue par l’application.

## Controller

Ressource ou zone logique traitée.

## Action

Opération demandée.

## ID

Identifiant d’un élément précis.

## 404

Réponse utilisée quand aucune route valable ne correspond.

---

# 14. Résumé

Le mini routeur sert à comprendre une URL.

Il ne travaille pas encore avec un vrai serveur.
Il ne charge pas encore de vrais contrôleurs.
Il ne fait qu’une chose essentielle :

> transformer une URL en structure logique

C’est cette mécanique de base que vous devez maîtriser pour faire l’exercice.
