# Fondements théoriques des chaînes de caractères et tests unitaires 

--- 

## [Chaînes de caractères en JavaScript](#1-chaînes-de-caractères-en-javascript)
## [Algorithmes fondamentaux de traitement de chaînes](#2-algorithmes-fondamentaux-de-traitement-de-chaînes)
## [Bases théoriques de cryptographie](#3-bases-théoriques-de-cryptographie)
## [Test-Driven Development (TDD)](#4-test-driven-development-tdd)
## [Traitement spécifique des caractères](#5-traitement-spécifique-des-caractères)
## [Conclusion](#6-conclusion)

--- 

## 1. Chaînes de caractères en JavaScript

### Nature et caractéristiques fondamentales

Les chaînes de caractères (strings) en JavaScript sont des séquences de caractères Unicode représentées comme des objets primitifs. Elles présentent plusieurs caractéristiques essentielles :

- **Immutabilité** : Une fois créée, une chaîne ne peut être modifiée. Toute opération sur une chaîne produit une nouvelle chaîne.
- **Indexation** : Les caractères sont accessibles par index (base zéro), comme dans un tableau.
- **Type primitif avec méthodes** : Bien qu'étant un type primitif, JavaScript permet d'appeler des méthodes sur les chaînes grâce à l'auto-boxing.

### Propriétés et méthodes fondamentales

- **String.length** : Propriété qui renvoie le nombre de caractères dans la chaîne.
- **String.charAt(index)** : Méthode retournant le caractère à la position spécifiée.
- **String.charCodeAt(index)** : Renvoie le code Unicode du caractère à la position spécifiée (nombre entre 0 et 65535).
- **String.fromCharCode(code1, code2...)** : Méthode statique convertissant des valeurs Unicode en chaîne de caractères.

### Représentation des caractères en informatique

Dans l'exercice, la compréhension des codes ASCII/Unicode est cruciale :
- Les lettres minuscules 'a' à 'z' ont des codes de 97 à 122
- Les lettres majuscules 'A' à 'Z' ont des codes de 65 à 90
- Les chiffres '0' à '9' ont des codes de 48 à 57
- L'espace a le code 32

## 2. Algorithmes fondamentaux de traitement de chaînes

### Itération sur les caractères

La technique de base pour traiter une chaîne consiste à l'itérer caractère par caractère :

```javascript
function processString(str) {
    for (let i = 0; i < str.length; i++) {
        // Traitement du caractère à l'index i
    }
}
```

### Accumulation de résultats

Pattern fondamental pour transformer une chaîne :

```javascript
function transformString(str) {
    let result = "";
    for (let i = 0; i < str.length; i++) {
        // Ajouter le caractère transformé à result
    }
    return result;
}
```

### Comptage

Fondement du comptage d'occurrences dans une chaîne :

```javascript
function countOccurrences(str, target) {
    let count = 0;
    for (let i = 0; i < str.length; i++) {
        if (/* condition basée sur str[i] */) {
            count++;
        }
    }
    return count;
}
```

### Découpage et tokenisation

Principe de détection de séparateurs pour compter ou diviser les mots :

```javascript
function tokenize(str, delimiter) {
    // Algorithme identifiant les segments entre délimiteurs
}
```

## 3. Bases théoriques de cryptographie

### Chiffrement par substitution

Le chiffrement de César est un exemple classique de chiffrement par substitution :
- Chaque lettre est remplacée par une autre lettre située à un rang fixe plus loin dans l'alphabet
- C'est une transformation bijective entre l'ensemble des lettres
- La formule mathématique est : E(x) = (x + k) mod 26, où k est la clé de chiffrement

### Opérations modulaires

Le concept de modulo est essentiel en cryptographie :
- L'opération modulo (%) renvoie le reste d'une division euclidienne
- Pour le chiffrement de César : (code_caractère - code_base + décalage) % 26 + code_base
- Cette formule permet de gérer le "retour à l'alphabet" quand on dépasse 'z'

### Bijection et réversibilité

Un chiffrement doit être réversible :
- Toute fonction de chiffrement doit avoir une fonction de déchiffrement
- Pour le chiffrement de César, on déchiffre avec un décalage opposé ou complémentaire à 26

## 4. Test-Driven Development (TDD)

### Principes fondamentaux du TDD

Le TDD est une méthodologie de développement basée sur trois principes :
1. **Red** : Écrire un test qui échoue (définit le comportement attendu)
2. **Green** : Implémenter le code minimum pour faire passer le test
3. **Refactor** : Améliorer le code sans changer son comportement

### Types de tests unitaires

- **Tests positifs** : Vérifient que le code fonctionne dans les cas normaux d'utilisation
- **Tests négatifs** : Vérifient que le code gère correctement les erreurs ou cas limites
- **Tests de régression** : S'assurent que les modifications n'introduisent pas de bugs

### Assertions

Les assertions sont des expressions qui évaluent à vrai/faux :
- L'assertion vérifie qu'une condition est respectée
- Si l'assertion échoue, le test échoue
- En JavaScript, `console.assert()` est une implémentation simple d'assertion

### Organisation et hiérarchie des tests

Les tests bien structurés suivent une organisation logique :
- Regroupement par fonctionnalité ou unité testée
- Progression des tests simples vers les plus complexes
- Isolation des tests (un test ne dépend pas d'un autre)

## 5. Traitement spécifique des caractères

### Classification des caractères

Comprendre comment catégoriser les caractères est fondamental :
- Voyelles vs consonnes
- Majuscules vs minuscules
- Caractères alphabétiques vs numériques vs spéciaux

### Transformation de casse

La différence entre majuscules et minuscules est une valeur constante dans la table ASCII :
- La différence entre 'A' et 'a' est de 32
- Cette propriété peut être utilisée pour convertir entre majuscules et minuscules

## 6. Conclusion

Ces fondements théoriques constituent la base nécessaire pour résoudre les exercices de cryptographie proposés. Ils couvrent à la fois les aspects techniques (manipulation de chaînes, codes ASCII) et méthodologiques (TDD) essentiels au développement logiciel moderne.

La maîtrise de ces concepts permet non seulement de résoudre les exercices spécifiques, mais aussi de développer une compréhension plus profonde de la programmation, applicable dans de nombreux contextes au-delà de la cryptographie.