# Session 17 — Exercice

## Construire un Model générique en PHP avec PDO

---

## 1. Objectif

Dans cet exercice, vous allez construire le **Model** d’une architecture MVC simple.

Le but est de regrouper dans un seul fichier toutes les opérations de lecture et d’écriture vers la base de données.

À la fin de l’exercice, vous devez être capable de :

* comprendre le rôle du Model ;
* écrire des fonctions réutilisables pour interroger une base ;
* manipuler PDO proprement ;
* séparer les données de l’affichage.

---

## 2. Fichiers de référence

Avant de commencer, vous devez utiliser la base fournie dans les fichiers SQL suivants :

### Structure de la base

```text id="9mdoqk"
https://github.com/EFP-DEV/1-X75-Atelier/blob/main/assets/atelier_cms.sql
```

### Données de départ

```text id="bk7u8w"
https://github.com/EFP-DEV/1-X75-Atelier/blob/main/assets/atelier_cms_data.sql
```

### Fichier de test

```text id="8tb50x"
https://github.com/EFP-DEV/1-X75-LPB/blob/main/exo/session_16.php
```

Ces trois fichiers doivent servir de référence pendant tout l’exercice.

Vous ne devez pas inventer une autre structure.
Vous devez écrire votre code pour **la base réelle fournie**.

---

## 3. Travail demandé

Vous devez créer un fichier :

```text id="42g15c"
model.php
```

Dans ce fichier, vous devez implémenter les fonctions suivantes :

* `getAll`
* `getAllBy`
* `getOne`
* `getOneBy`
* `create`
* `update`
* `delete`
* `exists`

---

## 4. Rôle de chaque fonction

### `getAll($pdo, $table)`

Retourne toutes les lignes d’une table.

Exemple d’usage :

* récupérer tous les items ;
* récupérer tous les opérateurs ;
* récupérer tous les tags.

---

### `getAllBy($pdo, $table, $field, $value)`

Retourne toutes les lignes d’une table qui correspondent à une condition simple.

Exemple d’usage :

* récupérer toutes les collections d’un opérateur ;
* récupérer tous les items d’un opérateur ;
* récupérer tous les tags d’un opérateur.

---

### `getOne($pdo, $table, $id)`

Retourne une seule ligne à partir de son identifiant `id`.

Exemple d’usage :

* récupérer un item précis ;
* récupérer un opérateur précis ;
* récupérer une collection précise.

---

### `getOneBy($pdo, $table, $field, $value)`

Retourne une seule ligne à partir d’un champ simple.

Exemple d’usage :

* récupérer un opérateur par email ;
* récupérer un item par slug ;
* récupérer un tag par slug.

---

### `create($pdo, $table, $data)`

Insère une nouvelle ligne dans une table à partir d’un tableau associatif.

Exemple d’usage :

* créer un message ;
* créer une collection.

---

### `update($pdo, $table, $id, $data)`

Met à jour une ligne existante à partir de son `id`.

Exemple d’usage :

* modifier une collection ;
* modifier un message.

---

### `delete($pdo, $table, $id)`

Supprime une ligne à partir de son `id`.

Exemple d’usage :

* supprimer un message ;
* supprimer une collection.

---

### `exists($pdo, $table, $field, $value)`

Vérifie si une valeur existe déjà dans une table.

Exemple d’usage :

* vérifier si un email existe déjà ;
* vérifier si un slug existe déjà.

---

## 5. Contraintes obligatoires

Votre `model.php` doit respecter les règles suivantes.

### 5.1. Utiliser PDO

Toutes les requêtes doivent être exécutées avec PDO.

---

### 5.2. Préparer et exécuter correctement les requêtes

Les valeurs doivent être passées correctement dans les requêtes.

Par exemple :

* `id`
* `email`
* `slug`
* `operator_id`

ne doivent pas être écrits directement dans la requête SQL.

---

### 5.3. Retourner des résultats

Les fonctions doivent retourner une valeur exploitable.

Vous ne devez pas afficher directement le résultat dans le Model.

---

### 5.4. Ne produire aucune sortie HTML

Le fichier `model.php` ne doit contenir :

* ni `echo`
* ni HTML
* ni `print`
* ni message visuel

Le Model ne s’occupe pas d’affichage.

---

## 6. Comportement attendu

Vos fonctions doivent respecter ce contrat :

* `getAll` retourne un tableau ;
* `getAllBy` retourne un tableau ;
* `getOne` retourne une ligne ou `false` ;
* `getOneBy` retourne une ligne ou `false` ;
* `create` retourne le nouvel identifiant ou `false` ;
* `update` retourne `true` ou `false` ;
* `delete` retourne `true` ou `false` ;
* `exists` retourne `true` ou `false`.

---

## 7. Comprendre la base avant de coder

Avant d’écrire votre Model, vous devez lire la structure SQL.

Cette étape est obligatoire.

Vous devez repérer :

* les noms des tables ;
* les noms des colonnes ;
* les clés primaires ;
* les clés étrangères ;
* les champs obligatoires ;
* les tables de liaison.

Vous devez également tenir compte des données réellement présentes dans le fichier d’insertion.

Le fichier de test repose sur ces données exactes.

---

## 8. Points d’attention sur cette base

Cette base impose plusieurs contraintes qu’il faut comprendre avant de coder.

### 8.1. Clé primaire

Les tables principales utilisent une clé primaire nommée :

```text id="uk20fo"
id
```

---

### 8.2. `theme` et `category`

Dans cette base, `theme` et `category` ne sont pas des tables séparées.

Ils sont représentés par des entrées dans la table `tag`.

Vous ne devez donc pas écrire un code qui attend des tables `theme` ou `category`.

---

### 8.3. Table `item`

La table `item` contient notamment :

* `operator_id`
* `category_tag_id`
* `theme_tag_id`
* `title`
* `slug`
* `description`
* `content`
* `avatar`

Vous devez respecter ces noms exacts.

---

### 8.4. Table `message`

La table `message` est minimale.

Elle contient seulement :

* `id`
* `operator_id`

Vous ne devez donc pas écrire un code qui suppose des colonnes comme :

* `name`
* `email`
* `subject`
* `content`

si elles ne sont pas présentes dans la structure fournie.

---

## 9. Progression conseillée

Travaillez dans cet ordre.

### Étape 1

Créer `model.php`.

### Étape 2

Écrire `getAll`.

### Étape 3

Écrire `getOne`.

### Étape 4

Écrire `getAllBy`.

### Étape 5

Écrire `getOneBy`.

### Étape 6

Écrire `exists`.

### Étape 7

Écrire `create`.

### Étape 8

Écrire `update`.

### Étape 9

Écrire `delete`.

### Étape 10

Tester l’ensemble avec le fichier fourni.

---

## 10. Vérification attendue

Vous devez utiliser le fichier suivant pour vérifier votre travail :

```text id="zq4szb"
https://github.com/EFP-DEV/1-X75-LPB/blob/main/exo/session_16.php
```

Le but est simple :

* importer la base ;
* écrire `model.php` ;
* exécuter le fichier de test ;
* corriger jusqu’à obtenir les résultats attendus.

Ce test a été conçu pour fonctionner avec :

* la structure SQL fournie ;
* les données SQL fournies ;
* les valeurs exactes de cette base.

---

## 11. Ce qu’il faut apprendre à travers cet exercice

Cet exercice ne sert pas seulement à écrire des fonctions.

Il sert à comprendre une logique d’architecture.

Vous devez retenir ceci :

* le **Model** gère les données ;
* le **Controller** décide quoi faire ;
* la **View** affiche le résultat.

La règle fondamentale est donc :

```text id="94rn46"
Aucune requête SQL en dehors du Model
```

Si cette règle est respectée :

* le code devient plus lisible ;
* les responsabilités sont mieux séparées ;
* les modifications sont plus simples ;
* le projet devient plus stable.

---

## 12. Critères d’évaluation

Votre travail sera considéré comme correct si :

* le fichier `model.php` existe ;
* les fonctions demandées sont présentes ;
* les fonctions utilisent PDO correctement ;
* le Model ne produit aucun affichage ;
* le code fonctionne avec la vraie base fournie ;
* le fichier de test peut vérifier votre travail.

---

## 13. Consigne finale

Vous ne devez pas chercher à produire un “grand framework”.

Vous devez produire un **Model simple, propre, fonctionnel, cohérent avec la base fournie**.

L’objectif n’est pas la sophistication.

L’objectif est la justesse.
