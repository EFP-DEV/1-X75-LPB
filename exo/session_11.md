# Session 11 — Blog Bootstrap, Git, `$_GET`, `include` et `require`

## Objectif

Dans cette séance, vous allez partir d’un template HTML existant et le faire évoluer progressivement vers un mini-site PHP plus souple et plus propre.

Le travail se fera en plusieurs étapes :

1. récupérer et préparer un template Bootstrap ;
2. créer plusieurs pages HTML cohérentes ;
3. relier ces pages avec un menu ;
4. identifier les parties répétées du site ;
5. utiliser PHP pour factoriser le code ;
6. utiliser `$_GET` pour charger dynamiquement le contenu principal.

L’objectif n’est pas seulement d’obtenir un site fonctionnel, mais aussi de comprendre **pourquoi** on quitte progressivement le HTML statique pour aller vers une structure plus **DRY** (*Don’t Repeat Yourself*).

---

## Compétences travaillées

- structurer un projet web ;
- utiliser Git et GitHub avec des commits propres ;
- manipuler un template Bootstrap existant ;
- créer plusieurs pages HTML cohérentes ;
- utiliser des liens entre pages ;
- découper une page en partiels ;
- comprendre `$_GET` ;
- utiliser `include` et `require` en PHP ;
- charger un contenu dynamiquement selon un paramètre d’URL.

---

## Consignes générales

Vous allez travailler dans un **repository Git**.

Contraintes minimales :

- créez un repository dédié à l’exercice ;
- faites des **commits réguliers** ;
- chaque commit doit correspondre à un état **propre, clair et fonctionnel** ;
- le message de commit doit décrire clairement ce qui a été fait.

Exemples de messages de commit :

- `Template de base du blog`
- `Création des pages individuelles`
- `Modification des titres de page`
- `Changement des cartes`
- `Création du menu`
- `Extraction des partiels`
- `Test de $_GET`
- `Assemblage des partiels avec include`
- `Chargement dynamique de la catégorie`
- `Gestion des catégories invalides`

---

# 1. Préparation du projet

Nous allons utiliser le template **Blog** des exemples Bootstrap.

Template de départ :

`https://getbootstrap.com/docs/5.1/examples/blog/`

## Travail demandé

1. Téléchargez l’archive des exemples Bootstrap.
2. Ouvrez le template **blog** dans votre navigateur.
3. Supprimez les exemples inutiles et ne gardez que ce qui est nécessaire au blog.
4. Modifiez le titre principal du blog (`Large`) à votre guise.
5. Créez sur GitHub un repository nommé `LPB-Blog`.
6. Ajoutez un fichier `readme.md`.
7. Copiez l’énoncé de l’exercice dans ce fichier `readme.md`.
8. Ouvrez le dossier du projet dans VS Code.
9. Copiez le template blog dans le repository.
10. Faites un commit avec le message :

```text
Template de base du blog
````

11. Faites un push.

---

# 2. Création des pages HTML

Vous allez maintenant produire plusieurs pages statiques à partir du template.

## Pages à créer

Le menu contient les catégories suivantes :

* World
* U.S.
* Technology
* Design
* Culture
* Business
* Politics
* Opinion
* Science
* Health
* Style
* Travel

Vous devez donc obtenir :

* 1 page d’accueil ;
* 12 pages de catégorie.

Cela fait **13 pages HTML** au total.

## Travail demandé

### 2.1 Créer les pages de catégorie

Pour chaque item du menu, créez une page qui ne contient que les **deux derniers articles** :

* `Another blog post`
* `New feature`

Faites un commit :

```text
Création des pages individuelles
```

### 2.2 Adapter les titres

Sur chaque page, remplacez les titres des deux articles par des titres cohérents avec la catégorie.

Exemples :

* page `World` : `World 1` et `World 2`
* page `U.S.` : `U.S. 1` et `U.S. 2`
* page `Technology` : `Technology 1` et `Technology 2`

Faites un commit :

```text
Modification des titres de page
```

### 2.3 Adapter les cartes

Sous le bloc noir du haut, deux cartes sont présentes dans le template.

Modifiez leur catégorie pour qu’elle corresponde à la page courante.

Exemple :

* sur la page `World`, les deux cartes affichent `World`
* sur la page `Science`, les deux cartes affichent `Science`

Faites un commit :

```text
Changement des cartes
```

### 2.4 Vérifier la cohérence des fichiers

Vous devez maintenant avoir :

* une convention de nommage cohérente ;
* des noms de fichiers simples ;
* pas de points dans le nom du fichier pour `U.S.`.

Exemple possible :

* `index.html`
* `world.html`
* `us.html`
* `technology.html`
* `design.html`

Quand tout est correct, faites un dernier commit :

```text
Fin de la création des pages individuelles
```

Puis faites un push.

---

# 3. Création du menu

Jusqu’ici, vos pages existent mais ne forment pas encore un vrai site navigable.

## Travail demandé

1. Ajoutez les liens nécessaires dans le menu des **13 pages**.
2. Testez tous les liens.
3. Vérifiez qu’aucun lien ne mène vers une page inexistante.
4. Faites un commit avec un message **clair et concis**.
5. Faites un push.

Exemple de message :

```text
Création du menu
```

---

# 4. DRY — Réduire la répétition

À ce stade, votre site fonctionne, mais il contient beaucoup de répétitions.

Si vous changez le nom du site ou un item du menu, vous devez modifier **13 fichiers**.
C’est long, pénible, et source d’erreurs.

Nous allons donc commencer à découper la page en **partiels**.

## Travail demandé

### 4.1 Identifier les parties communes

Repérez les parties répétées sur toutes les pages.

Exemples possibles :

* le `<head>`
* l’en-tête du site
* le menu
* le bloc hero
* les cartes
* la sidebar
* le footer
* les scripts de fin de page

### 4.2 Créer les fichiers partiels

Créez des fichiers HTML correspondant à ces zones communes.

Exemples de noms possibles :

* `partials/head.html`
* `partials/header.html`
* `partials/menu.html`
* `partials/footer.html`

Le nommage doit être clair et cohérent.

### 4.3 Copier le code dans les partiels

Copiez le code HTML concerné dans chaque fichier partiel.

Pourquoi **copier** d’abord ?

Parce que le site doit rester fonctionnel à chaque étape.
On ne casse pas le travail existant pour aller plus vite.

### 4.4 Commit et push

Faites un commit avec un message clair, puis un push.

Exemple :

```text
Extraction des partiels
```

---

# 5. HTTP GET et `$_GET`

Avant de dynamiser le blog, il faut comprendre comment PHP récupère les paramètres de l’URL.

## Travail demandé

Dans votre dossier de travail :

1. créez un fichier `test_get.php` ;
2. ajoutez une structure HTML minimale ;
3. dans le `<body>`, écrivez :

```php
<pre>
<?php
var_dump($_GET);
?>
</pre>
```

4. lancez le fichier via votre serveur local ;
5. testez les URL suivantes :

### Test 1

```text
?text=hello
```

### Test 2

```text
?text=hello&categorie=world
```

### Test 3

```text
?text=hello&categorie=world&key=value
```

## À observer

Pour chaque test, observez comment le contenu de `$_GET` change.

Vous devez comprendre que :

* `$_GET` est un tableau associatif ;
* chaque couple `clé=valeur` dans l’URL devient une entrée dans `$_GET`.

Exemple attendu :

```php
$_GET['categorie']
```

peut contenir :

```text
world
```

Faites un commit :

```text
Test de $_GET
```

Puis faites un push.

---

# 6. `include` et `require`

Vous allez maintenant assembler plusieurs fichiers dans une seule page PHP.

## Travail demandé

### 6.1 Créer un fichier d’assemblage

Créez un fichier nommé :

```text
test_partiels.php
```

Ce fichier ne doit pas forcément contenir un boilerplate complet si les partiels contiennent déjà les morceaux nécessaires.

### 6.2 Inclure les partiels avec `include`

Insérez vos partiels avec PHP :

```php
<?php include 'partials/header.html'; ?>
<?php include 'partials/menu.html'; ?>
<?php include 'partials/footer.html'; ?>
```

Testez le résultat dans le navigateur.

Faites un commit :

```text
Assemblage des partiels avec include
```

Puis faites un push.

### 6.3 Remplacer `include` par `require`

Remplacez ensuite vos `include` par `require` :

```php
<?php require 'partials/header.html'; ?>
<?php require 'partials/menu.html'; ?>
<?php require 'partials/footer.html'; ?>
```

Testez à nouveau.

Faites un commit :

```text
Assemblage des partiels avec require
```

Puis faites un push.

## Question importante

Quelle différence observez-vous entre `include` et `require` lorsqu’un fichier manque ?

---

# 7. Dynamiser le blog avec `$_GET`

Vous avez maintenant tous les éléments pour produire une page unique capable d’afficher plusieurs contenus selon l’URL.

## Objectif

Créer une page PHP qui charge dynamiquement le contenu principal selon une catégorie passée en paramètre.

Exemple d’URL :

```text
index.php?categorie=world
```

---

## Travail demandé

### 7.1 Déterminer un plan

Réfléchissez à une stratégie pour combiner :

* `$_GET`
* `include` ou `require`

afin de charger dynamiquement le contenu principal.

### 7.2 Adapter le menu

Le menu ne doit plus pointer vers 12 fichiers HTML différents.

Il doit maintenant utiliser des URLs du type :

```text
index.php?categorie=world
index.php?categorie=us
index.php?categorie=technology
```

### 7.3 Tester le site

Testez la navigation complète :

* page d’accueil ;
* pages de catégorie ;
* chargement correct du contenu.

Faites un commit :

```text
Chargement dynamique de la catégorie
```

Puis faites un push.

---

# 8. Cas limites à tester

Un site dynamique doit aussi gérer les cas problématiques.

## À tester

### 8.1 Aucun paramètre GET

Que se passe-t-il si l’URL est simplement :

```text
index.php
```

Donc sans paramètre `categorie` ?

Votre site doit rester fonctionnel.

Exemple de comportement possible :

* afficher la page d’accueil par défaut ;
* ou afficher une catégorie par défaut.

### 8.2 Paramètre GET invalide

Que se passe-t-il si l’utilisateur demande une catégorie inexistante ?

Exemple :

```text
index.php?categorie=training
```

Votre site ne doit pas planter.

Exemples de comportements possibles :

* afficher une page d’erreur simple ;
* afficher la page d’accueil ;
* afficher un message comme : `Catégorie inconnue`.

Faites un commit :

```text
Gestion des catégories invalides
```

Puis faites un push.

---

# 9. Conseils techniques

## Ne pas inclure directement une valeur brute de `$_GET`

Évitez ceci :

```php
include $_GET['categorie'] . '.html';
```

Pourquoi ?
Parce que c’est fragile et potentiellement dangereux.

Préférez une liste autorisée.

Exemple :

```php
<?php

$pages = [
    'world' => 'contents/world.html',
    'us' => 'contents/us.html',
    'technology' => 'contents/technology.html',
    'design' => 'contents/design.html',
    'culture' => 'contents/culture.html',
    'business' => 'contents/business.html',
    'politics' => 'contents/politics.html',
    'opinion' => 'contents/opinion.html',
    'science' => 'contents/science.html',
    'health' => 'contents/health.html',
    'style' => 'contents/style.html',
    'travel' => 'contents/travel.html',
];

$categorie = $_GET['categorie'] ?? 'home';

if ($categorie === 'home') {
    require 'contents/home.html';
} elseif (isset($pages[$categorie])) {
    require $pages[$categorie];
} else {
    echo '<p>Catégorie inconnue.</p>';
}
```

---

# 10. Structure possible du projet

Voici un exemple d’organisation de fichiers :

```text
LPB-Blog/
├── readme.md
├── index.php
├── test_get.php
├── test_partiels.php
├── css/
├── js/
├── partials/
│   ├── head.html
│   ├── header.html
│   ├── menu.php
│   ├── footer.html
├── contents/
│   ├── home.html
│   ├── world.html
│   ├── us.html
│   ├── technology.html
│   ├── design.html
│   ├── culture.html
│   ├── business.html
│   ├── politics.html
│   ├── opinion.html
│   ├── science.html
│   ├── health.html
│   ├── style.html
│   └── travel.html
```

---

# 11. Ce qui est attendu à la fin

À la fin de la séance, vous devez avoir :

* un repository GitHub propre ;
* un historique de commits clair ;
* un blog Bootstrap fonctionnel ;
* une navigation entre catégories ;
* des partiels extraits ;
* un test de `$_GET` ;
* un test de `include` puis `require` ;
* une page PHP centrale capable de charger un contenu selon l’URL ;
* une gestion minimale des cas invalides.

---

# 12. Critères de réussite

Le travail sera considéré comme réussi si :

* le projet fonctionne localement ;
* les liens du menu sont corrects ;
* les catégories affichent le bon contenu ;
* les partiels sont correctement utilisés ;
* `$_GET` est compris et exploité ;
* le code reste lisible et cohérent ;
* les commits sont propres et pertinents ;
* les cas invalides sont gérés sans casser le site.

---

# 13. Travail à remettre

Vous devez rendre :

1. l’URL du repository GitHub ;
2. un projet fonctionnel ;
3. un historique de commits cohérent ;
4. un `readme.md` contenant l’énoncé.

---

# 14. Rappel méthodologique

Travaillez progressivement.

À chaque étape :

1. faites une petite modification ;
2. testez ;
3. corrigez si nécessaire ;
4. commit ;
5. push.

Ne passez pas à l’étape suivante tant que l’étape courante n’est pas propre et fonctionnelle.

