# Session 16 - Exceptions en PHP

## Objectif

Comprendre à quoi servent les exceptions, comment utiliser `throw`, `try`, `catch`, et comment lire une hiérarchie d’exceptions pour attraper le bon problème au bon endroit.

---

## 1. Pourquoi introduire les exceptions

Jusqu’ici, les étudiants ont surtout vu ce schéma :

```php
$result = faire_quelque_chose();

if ($result === false) {
    // gérer l'échec
}
```

Cela marche, mais il y a une limite : le code normal et le code d’erreur se mélangent partout.

On finit avec :

* beaucoup de `if`
* des `return false` à répétition
* des messages dispersés
* des erreurs importantes traitées comme de simples cas ordinaires

Une exception sert à dire :

> “Le programme ne peut pas continuer normalement ici.
> Je lance un problème.
> Quelqu’un plus haut décidera comment le traiter.”

Autrement dit :

* la fonction détecte le problème
* elle le **signale**
* le code appelant **décide quoi faire**

C’est exactement ce que tu as commencé à montrer avec `is_hashable()`, `safe_hash()` et `save_hash()`.

---

## 2. Définition simple

Une exception est un objet lancé avec `throw`.
PHP cherche alors un `catch` compatible.
S’il n’en trouve pas dans la fonction courante, l’exception remonte la pile d’appel.
Si elle atteint le scope global sans être attrapée, le script s’arrête. ([PHP][1])

---

## 3. Les trois mots-clés à connaître

### `throw`

`throw` sert à lancer une exception.

```php
throw new Exception('Quelque chose ne va pas.');
```

### `try`

`try` contient le code qu’on tente d’exécuter.

```php
try {
    // code risqué
}
```

### `catch`

`catch` récupère une exception d’un type donné.

```php
catch (Exception $e) {
    echo $e->getMessage();
}
```

En PHP, chaque `try` doit avoir au moins un `catch` ou un `finally`. PHP permet aussi plusieurs `catch`, et le premier type compatible rencontré est celui qui traite l’exception. ([PHP][1])

---

## 4. Exemple minimal

```php
function divide($a, $b)
{
    if ($b === 0) {
        throw new InvalidArgumentException('Division par zéro interdite.');
    }

    return $a / $b;
}

try {
    echo divide(10, 2);
    echo divide(10, 0);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}
```

Ici, `divide()` ne décide pas comment afficher l’erreur.
Elle se contente de la signaler.
C’est le `catch` qui décide.

C’est une séparation des responsabilités :

* la fonction métier détecte
* le code appelant réagit

---

## 5. Pourquoi ce n’est pas juste un “return false”

### Avec `return false`

```php
function safe_hash($operator)
{
    if (empty(trim($operator['password']))) {
        return false;
    }

    return password_hash($operator['password'], PASSWORD_DEFAULT);
}
```

Problème : `false` peut vouloir dire beaucoup de choses.

* mot de passe vide
* échec du hash
* donnée invalide
* bug
* autre chose

### Avec une exception

```php
function safe_hash($operator)
{
    if (empty(trim($operator['password']))) {
        throw new InvalidArgumentException('PASSWORD_EMPTY');
    }

    $hash = password_hash($operator['password'], PASSWORD_DEFAULT);

    if ($hash === false) {
        throw new RuntimeException('HASH_FAILED');
    }

    return $hash;
}
```

Ici, l’échec a un sens précis.

* `InvalidArgumentException` : l’entrée est mauvaise
* `RuntimeException` : le problème apparaît pendant l’exécution

Le code devient plus lisible, plus strict, et plus facile à centraliser.

---

## 6. Hiérarchie des exceptions

En PHP, tout ce qui peut être lancé passe par `Throwable`.
Sous `Throwable`, on trouve notamment `Exception` et `Error`.
Les exceptions utilisateur étendent `Exception`, pas `Throwable` directement. `RuntimeException` étend `Exception`. `InvalidArgumentException` étend `LogicException`. `PDOException` étend `RuntimeException`. ([PHP][2])

Schéma simplifié :

```text
Throwable
├── Error
└── Exception
    ├── LogicException
    │   └── InvalidArgumentException
    └── RuntimeException
        └── PDOException
```

Ce qu’il faut retenir pédagogiquement :

* on attrape du **spécifique** avant du **général**
* plus on descend, plus le type est précis
* `catch (Exception $e)` attrape beaucoup
* `catch (Throwable $e)` attrape encore plus large

---

## 7. Ordre des `catch`

L’ordre compte.

```php
try {
    // ...
}
catch (PDOException $e) {
    // erreur base de données
}
catch (InvalidArgumentException $e) {
    // donnée invalide
}
catch (Exception $e) {
    // tout le reste
}
```

Si on met `catch (Exception $e)` avant `catch (PDOException $e)`, alors le `PDOException` sera déjà absorbé par le catch général. PHP prend le premier `catch` compatible. ([PHP][1])

---

## 8. Ce qu’on attrape où

Dans ton exemple, la logique est bonne :

* `get_operators($conn)` peut provoquer un problème PDO
* `is_hashable($operator)` peut lancer une erreur de validation
* `safe_hash()` peut lancer une erreur système
* `save_hash()` peut lancer une erreur métier ou runtime

Donc :

* les fonctions **bas niveau** détectent et `throw`
* la boucle principale **oriente le traitement**
* une fonction `report()` **centralise l’affichage**

C’est une très bonne introduction, parce qu’elle montre que l’exception n’est pas magique : elle remplace un chaos de conditions dispersées par une circulation claire des erreurs.

---

## 9. `finally`

Un bloc `finally` s’exécute toujours après le `try` et les `catch`, qu’il y ait eu une exception ou non. Il est utile pour terminer proprement une opération, libérer une ressource, fermer un fichier, afficher un bilan, etc. ([PHP][1])

Exemple :

```php
try {
    echo "Traitement";
} catch (Exception $e) {
    echo "Erreur";
} finally {
    echo "Fin du bloc";
}
```

---

## 10. Règles simples à donner aux étudiants

1. Une fonction ne doit pas afficher l’erreur si son rôle est de traiter une donnée.
   Elle doit souvent `throw`.

2. On `catch` là où on sait quoi faire.

3. On attrape du plus précis au plus large.

4. On n’utilise pas `Exception` pour tout sans réfléchir.

5. Une exception n’est pas un `echo` amélioré.
   C’est un mécanisme de circulation d’erreur.

6. Une donnée invalide n’est pas la même chose qu’une panne d’exécution.

7. `PDOException` vient de PDO ; on évite de lancer soi-même un `PDOException` personnalisé. Le manuel PHP le déconseille explicitement. ([PHP][3])

---

## 11. Différence utile pour eux

### `InvalidArgumentException`

À utiliser quand on reçoit une donnée qui ne respecte pas le contrat de la fonction.

Exemple :

```php
if (empty(trim($operator['password']))) {
    throw new InvalidArgumentException('PASSWORD_EMPTY');
}
```

### `RuntimeException`

À utiliser quand le contrat était acceptable au départ, mais que l’exécution réelle échoue.

Exemple :

```php
if (!password_verify($operator['password'], $storedPassword)) {
    throw new RuntimeException('PASSWORD_SAVE_VERIFICATION_FAILED');
}
```

### `PDOException`

À attraper quand PDO remonte un problème SQL, connexion, préparation, exécution, etc. ([PHP][3])

---

## 12. Exemple pédagogique propre

```php
try {
    $operators = get_operators($conn);

    foreach ($operators as $operator) {
        try {
            is_hashable($operator);
            $hashedPassword = safe_hash($operator);
            save_hash($conn, $operator, $hashedPassword);
            printf('<br>User %d OK', $operator['operator_id']);
        }
        catch (InvalidArgumentException $e) {
            report($e, $operator);
        }
        catch (RuntimeException $e) {
            report($e, $operator);
        }
        catch (PDOException $e) {
            report($e, $operator);
        }
        catch (Exception $e) {
            report($e, $operator);
        }
    }
}
catch (PDOException $e) {
    printf('<br>Lecture initiale impossible : %s', $e->getMessage());
    die();
}
```

Ce qu’il faut leur faire voir :

* une erreur sur **un opérateur** ne doit pas forcément arrêter tout le traitement
* une erreur sur la **lecture initiale** bloque tout
* la place du `try/catch` change le comportement global du script

Ça, pédagogiquement, est central.

---

## 13. Erreurs classiques à signaler en cours

* lancer `Exception` partout sans nuance
* attraper trop tôt
* attraper trop large
* continuer silencieusement après un vrai problème
* mélanger `printf`, `return false`, `throw`, `die()` sans logique cohérente
* croire qu’une exception remplace toute validation
* mettre le `catch` général avant les `catch` spécifiques

---

## 14. Résumé à retenir

Une exception sert à sortir un problème du flux normal.
`throw` lance le problème.
`try` encadre le code risqué.
`catch` récupère le problème.
La hiérarchie permet de distinguer les types d’erreurs.
Le bon réflexe n’est pas “attraper partout”, mais “attraper là où une décision est possible”.
