# Exercices — Exceptions en PHP

## Exercice 1 — Lire le flux d’une exception

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
```

### À faire

1. Dire exactement ce qui s’affiche.
2. Expliquer pourquoi le troisième appel ne s’exécute pas.
3. Expliquer le rôle de `throw`, `try` et `catch`.

---

## Exercice 2 — Interdire une note invalide

Créer la fonction :

```php
function set_grade($grade)
```

### Règles

* une note doit être numérique
* une note doit être comprise entre `0` et `20`
* sinon la fonction doit lancer une exception
* si la note est correcte, la fonction retourne la note

### À faire

1. Écrire la fonction.
2. Tester avec plusieurs valeurs : `12`, `-3`, `25`, `'hello'`.
3. Gérer les erreurs avec `try/catch`.

---

## Exercice 3 — Remplacer `return false` par `throw`

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

1. Réécrire la fonction pour ne plus retourner `false`.
2. Si `username` est absent ou vide, lancer `InvalidArgumentException`.
3. Dans le script principal, attraper l’erreur et afficher un message propre.

---

## Exercice 4 — Deux types d’erreurs différents

Créer la fonction :

```php
function calculate_discount($price, $percent)
```

### Règles

* si `$price` n’est pas numérique ou est négatif : `InvalidArgumentException`
* si `$percent` n’est pas numérique : `InvalidArgumentException`
* si `$percent` est inférieur à `0` ou supérieur à `100` : `RuntimeException`
* sinon retourner le prix remisé

### À faire

1. Écrire la fonction.
2. Prévoir deux `catch` différents.
3. Afficher un message différent selon le type d’exception.

---

## Exercice 5 — Comprendre l’ordre des catch

Reprendre l’exercice précédent.

### À faire

1. Ajouter un bloc :

```php
catch (Exception $e)
```

2. Le placer après les `catch` spécifiques.
3. Tester.
4. Expliquer pourquoi il faut attraper d’abord `InvalidArgumentException` et `RuntimeException`, puis `Exception`.

---

## Exercice 6 — `finally` avec un fichier

Créer la fonction :

```php
function read_first_line($filepath)
```

### Règles

* si le chemin est vide : `InvalidArgumentException`
* si le fichier n’existe pas : `RuntimeException`
* sinon ouvrir le fichier et retourner sa première ligne

### À faire

1. Écrire la fonction.
2. Dans le script principal, faire un `try/catch/finally`.
3. Dans `finally`, afficher : `Lecture terminée`.
4. Tester avec un vrai chemin et un faux chemin.

---

## Exercice 7 — Vérifier une inscription

Créer la fonction :

```php
function validate_registration($user)
```

### Règles

Le tableau `$user` doit contenir :

* `name`
* `email`
* `age`

Contraintes :

* `name` ne peut pas être vide
* `email` doit contenir `@`
* `age` doit être un entier positif

### À faire

1. Si une donnée est absente ou invalide, lancer `InvalidArgumentException`.
2. Si tout est correct, retourner `true`.
3. Tester avec plusieurs utilisateurs.
4. Gérer les erreurs avec `try/catch`.

### Données de test

```php
$users = [
    ['name' => 'Lina', 'email' => 'lina@mail.com', 'age' => 12],
    ['name' => '', 'email' => 'paul@mail.com', 'age' => 20],
    ['name' => 'Nora', 'email' => 'noramail.com', 'age' => 18],
    ['name' => 'Jules', 'email' => 'jules@mail.com', 'age' => -2],
];
```

---

## Exercice 8 — Traiter une liste sans tout arrêter

On veut vérifier une liste de commandes.

Chaque commande contient :

* `order_id`
* `amount`

Créer la fonction :

```php
function validate_order($order)
```

### Règles

* `order_id` doit exister
* `amount` doit être numérique
* `amount` doit être strictement supérieur à `0`

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
    ['order_id' => 105, 'amount' => 120],
];
```

---

## Exercice 9 — Créer une fonction `report()`

Créer la fonction :

```php
function report(Throwable $e, $context = null)
```

### À faire

1. Si l’erreur est un `InvalidArgumentException`, afficher `INPUT ERROR`.
2. Si l’erreur est un `RuntimeException`, afficher `RUNTIME ERROR`.
3. Si l’erreur est une autre `Exception`, afficher `GENERAL ERROR`.
4. Si `$context` est fourni, l’ajouter dans le message.
5. Réutiliser cette fonction dans un ou deux exercices précédents.

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
* `name` ne peut pas être vide
* `grades` doit exister et être un tableau

Sinon : `InvalidArgumentException`

#### `calculate_average($grades)`

* si le tableau est vide : `RuntimeException`
* si une note n’est pas numérique : `InvalidArgumentException`
* sinon retourner la moyenne

### À faire

1. Parcourir les étudiants.
2. Pour chaque étudiant :

   * valider l’étudiant
   * calculer sa moyenne
3. Si une erreur arrive sur un étudiant, l’attraper, l’afficher avec `report()`, puis continuer.
4. Le traitement global doit continuer jusqu’au bout.
5. Prévoir plusieurs `catch` :

   * `InvalidArgumentException`
   * `RuntimeException`
   * `Exception`
