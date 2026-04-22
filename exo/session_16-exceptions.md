# Session 16 - Exercices — Exceptions en PHP

## Objectifs de la série

À la fin de cette série, vous devez être capable de :

- lire le flux d’exécution quand une exception est lancée ;
- remplacer un `return false` par une exception explicite ;
- distinguer une erreur d’entrée d’une opération impossible ;
- utiliser plusieurs blocs `catch` dans le bon ordre ;
- employer `finally` pour garantir un nettoyage ;
- traiter une liste complète sans arrêter tout le script ;
- factoriser l’affichage des erreurs avec une fonction `report()`.

## Conventions communes

Dans tous les exercices :

- utilisez `InvalidArgumentException` quand une donnée est absente, vide, mal typée ou hors domaine ;
- utilisez `RuntimeException` quand les données sont valides mais que l’opération ne peut pas aboutir ;
- donnez toujours un message clair à l’exception ;
- dans les exercices 8 et 10, une erreur locale ne doit pas arrêter le traitement global ;
- la fonction `report()` doit **retourner une chaîne**, pas faire directement un `echo`.

---

## Exercice 1 — Suivre le flux d’une exception

Ne modifiez pas ce code.

```php
function reciprocal($number)
{
    if ($number === 0) {
        throw new Exception('ZERO_NOT_ALLOWED');
    }

    return 1 / $number;
}

try {
    echo reciprocal(2);
    echo '<br>';
    echo reciprocal(0);
    echo '<br>';
    echo reciprocal(4);
} catch (Exception $e) {
    echo $e->getMessage();
}

echo '<br>END';
````

### À faire

1. Sans exécuter le code, écrire **exactement** ce qui s’affiche.
2. Indiquer à quel moment l’exécution quitte le bloc `try`.
3. Expliquer pourquoi le troisième appel à `reciprocal()` ne s’exécute pas.
4. Expliquer le rôle de `throw`, `try` et `catch`.

---

## Exercice 2 — Valider une note

Créer la fonction :

```php
function set_grade($grade)
```

### Règles

* la note doit être numérique ;
* la note doit être comprise entre `0` et `20` ;
* si la note est invalide, lancer `InvalidArgumentException` ;
* si la note est correcte, retourner la note.

### À faire

1. Écrire la fonction.
2. Prévoir des messages d’erreur différents selon le problème.
3. Tester avec les valeurs suivantes : `12`, `-3`, `25`, `'hello'`, `'18.5'`.
4. Utiliser une boucle et un `try/catch` pour tester **tous** les cas sans arrêter le script.

---

## Exercice 3 — Remplacer `return false` par une exception

Code de départ :

```php
function get_username($user)
{
    if (!isset($user['username'])) {
        return false;
    }

    if (trim($user['username']) === '') {
        return false;
    }

    return $user['username'];
}
```

### À faire

1. Réécrire la fonction pour qu’elle ne retourne plus jamais `false`.
2. Si `username` est absent, lancer `InvalidArgumentException`.
3. Si `username` est vide après `trim()`, lancer `InvalidArgumentException`.
4. Si tout est correct, retourner le username **nettoyé avec `trim()`**.
5. Dans le script principal, attraper l’erreur et afficher un message propre.

### Jeux de test à prévoir

* un tableau sans `username` ;
* un tableau avec `username => ''` ;
* un tableau avec `username => '   '` ;
* un tableau avec `username => ' alice '`.

---

## Exercice 4 — Distinguer erreur d’entrée et opération impossible

Créer la fonction :

```php
function withdraw($balance, $amount)
```

### Règles

* si `$balance` n’est pas numérique ou est négatif : `InvalidArgumentException`
* si `$amount` n’est pas numérique ou est inférieur ou égal à `0` : `InvalidArgumentException`
* si `$amount` est supérieur à `$balance` : `RuntimeException`
* sinon retourner le nouveau solde

### À faire

1. Écrire la fonction.
2. Prévoir deux blocs `catch` différents :

   * `InvalidArgumentException`
   * `RuntimeException`
3. Afficher un message différent selon le type d’erreur.
4. Tester avec plusieurs cas valides et invalides.

### Cas de test conseillés

* `(100, 30)`
* `(100, 150)`
* `(-10, 5)`
* `(100, 0)`
* `('abc', 10)`

---

## Exercice 5 — Comprendre l’ordre des `catch`

Reprendre l’exercice précédent.

### À faire

1. Ajouter un bloc :

```php
catch (Exception $e)
```

2. Le placer **après** les `catch` spécifiques.
3. Tester le script.
4. Expliquer pourquoi `InvalidArgumentException` et `RuntimeException` doivent être attrapées avant `Exception`.
5. Expliquer ce qui se passerait si `catch (Exception $e)` était placé en premier.

---

## Exercice 6 — Utiliser `finally` avec un fichier

Créer la fonction :

```php
function read_first_line($filepath)
```

### Règles

* si le chemin est vide : `InvalidArgumentException`
* si le fichier n’existe pas : `RuntimeException`
* si le fichier ne peut pas être ouvert : `RuntimeException`
* si le fichier est vide : `RuntimeException`
* sinon retourner sa première ligne

### Contraintes pédagogiques

* si un handle de fichier a été ouvert, il doit être fermé **dans un `finally`** ;
* le script principal doit aussi contenir un `try/catch/finally`.

### À faire

1. Écrire la fonction.
2. Dans la fonction, garantir la fermeture du fichier avec `finally`.
3. Dans le script principal, faire un `try/catch/finally`.
4. Dans le `finally` du script principal, afficher : `Lecture terminée`.
5. Tester avec :

   * un vrai chemin ;
   * un faux chemin ;
   * si possible, un fichier vide.

---

## Exercice 7 — Vérifier une inscription

Créer la fonction :

```php
function validate_registration($user)
```

### Données obligatoires

Le tableau `$user` doit contenir :

* `name`
* `email`
* `age`

### Contraintes

* `name` ne peut pas être vide après `trim()`
* `email` doit être valide
* `age` doit être un entier strictement positif

### Règles

* si une donnée est absente ou invalide, lancer `InvalidArgumentException`
* si tout est correct, retourner `true`

### À faire

1. Écrire la fonction.
2. Utiliser une vraie validation d’email (`filter_var`).
3. Tester plusieurs utilisateurs.
4. Gérer les erreurs avec `try/catch`.

### Données de test

```php
$users = [
    ['name' => 'Lina', 'email' => 'lina@mail.com', 'age' => 12],
    ['name' => '', 'email' => 'paul@mail.com', 'age' => 20],
    ['name' => 'Nora', 'email' => 'noramail.com', 'age' => 18],
    ['name' => 'Jules', 'email' => 'jules@mail.com', 'age' => -2],
    ['name' => 'Sara', 'email' => 'sara@mail.com'],
];
```

---

## Exercice 8 — Traiter une liste sans tout arrêter

On veut vérifier une liste de commandes.

Chaque commande doit contenir :

* `order_id`
* `amount`

Créer la fonction :

```php
function validate_order($order)
```

### Règles

* `order_id` doit exister
* `order_id` doit être un entier strictement positif
* `amount` doit être numérique
* `amount` doit être strictement supérieur à `0`
* sinon lancer `InvalidArgumentException`
* si tout est correct, retourner `true`

### À faire

1. Parcourir un tableau de commandes avec `foreach`.
2. Pour chaque commande, appeler `validate_order()`.
3. Si une commande est invalide, attraper l’exception, afficher l’erreur, puis continuer avec la suivante.
4. Le script ne doit pas s’arrêter à la première erreur.

### Données de test

```php
$orders = [
    ['order_id' => 101, 'amount' => 49.99],
    ['order_id' => 102, 'amount' => 0],
    ['order_id' => 103, 'amount' => -15],
    ['order_id' => 104, 'amount' => 'abc'],
    ['amount' => 120],
    ['order_id' => 105, 'amount' => 120],
];
```

---

## Exercice 9 — Créer une fonction `report()`

Créer la fonction :

```php
function report(Throwable $e, $context = null)
```

### Règles

La fonction doit **retourner une chaîne**.

* si l’erreur est un `InvalidArgumentException`, préfixer par `INPUT ERROR`
* si l’erreur est un `RuntimeException`, préfixer par `RUNTIME ERROR`
* sinon, préfixer par `GENERAL ERROR`
* si `$context` est fourni, l’ajouter dans le message
* inclure le message original de l’exception

### À faire

1. Écrire la fonction.
2. Retourner une chaîne réutilisable, par exemple :

   * `INPUT ERROR - order #102 - Amount must be greater than 0`
3. Réutiliser cette fonction dans l’exercice 8.
4. Réutiliser cette fonction dans l’exercice 10.

---

## Exercice 10 — Mini application complète

On veut traiter une liste d’étudiants pour calculer leur moyenne.

Chaque étudiant contient :

* `student_id`
* `name`
* `grades`

### Données

```php
$students = [
    ['student_id' => 1, 'name' => 'Anna', 'grades' => [12, 15, 18]],
    ['student_id' => 2, 'name' => 'Tom', 'grades' => []],
    ['student_id' => 3, 'name' => '', 'grades' => [10, 11]],
    ['student_id' => 4, 'name' => 'Mila', 'grades' => [14, 'oops', 16]],
    ['student_id' => 5, 'name' => 'Leo', 'grades' => '15,16'],
];
```

### Fonctions à écrire

```php
function validate_student($student)
function calculate_average($grades)
function report(Throwable $e, $context = null)
```

### Règles

#### `validate_student($student)`

* `student_id` doit exister
* `student_id` doit être un entier strictement positif
* `name` ne peut pas être vide après `trim()`
* `grades` doit exister et être un tableau

Sinon : `InvalidArgumentException`

#### `calculate_average($grades)`

* si le tableau est vide : `RuntimeException`
* si une note n’est pas numérique : `InvalidArgumentException`
* si une note est hors de l’intervalle `0` à `20` : `InvalidArgumentException`
* sinon retourner la moyenne

### À faire

1. Parcourir les étudiants avec une boucle.
2. Pour chaque étudiant :

   * valider l’étudiant ;
   * calculer sa moyenne.
3. Si une erreur arrive sur un étudiant, l’attraper, l’afficher avec `report()`, puis continuer.
4. Le traitement global doit aller jusqu’au bout.
5. Prévoir plusieurs `catch` :

   * `InvalidArgumentException`
   * `RuntimeException`
   * `Exception`

### Résultat attendu

À la fin, le script doit afficher :

* les étudiants valides avec leur moyenne ;
* les étudiants invalides avec un message cohérent produit par `report()` ;
* un traitement complet de toute la liste, sans arrêt prématuré.

