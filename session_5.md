# PROG-101 — Du pseudo-code au code

## 1. Pourquoi l'algorithmique d'abord ?

Le code est une traduction. L'algorithme est l'idée.

Apprendre un langage sans comprendre la logique, c'est apprendre des mots sans savoir construire une phrase. Le pseudo-code permet de :

- Se concentrer sur la **logique** sans se soucier de la syntaxe
- Résoudre le problème **avant** de l'implémenter
- Passer facilement d'un langage à l'autre (la logique reste identique)

---
## 2. Du pseudo-code au code réel

### Le problème : échanger deux valeurs

Deux variables `a` et `b`. On veut inverser leurs valeurs.

### En pseudo-code

```
Variables a, b, temp En Entier
Début
    a ← 5
    b ← 2
    temp ← a
    a ← b
    b ← temp
Fin
```

Trace d'exécution :
| Étape | a | b | temp |
|-------|---|---|------|
| init | 5 | 2 | - |
| temp ← a | 5 | 2 | 5 |
| a ← b | 2 | 2 | 5 |
| b ← temp | 2 | 5 | 5 |

### En JavaScript — Traduction directe

```js
var a, b, temp;
a = 5;
b = 2;
temp = a;
a = b;
b = temp;
```

### En PHP — Traduction directe

```php
<?php
$a = 5;
$b = 2;
$temp = $a;
$a = $b;
$b = $temp;
?>
```

### Mais les langages ont leurs spécificités

L'algorithme avec variable temporaire est **universel** — il fonctionne dans tout langage. Mais chaque langage a ses idiomes.

**JavaScript (ES6+) — Destructuring assignment :**

```js
let a = 5;
let b = 2;
[a, b] = [b, a];
```

**PHP (7.1+) — Symmetric array destructuring :**

```php
<?php
$a = 5;
$b = 2;
[$a, $b] = [$b, $a];
?>
```

Une ligne. Pas de variable temporaire. Même résultat.

### Pourquoi apprendre l'algorithme alors ?

1. **Comprendre** — Le destructuring cache la mécanique, mais elle existe toujours
2. **Universalité** — L'algo fonctionne partout, le destructuring non (C, Java, etc.)
3. **Choix éclairé** — Connaître l'algo permet de choisir la bonne solution selon le contexte
4. **Debugging** — Quand ça casse, il faut comprendre ce qui se passe vraiment

L'algorithme est le **pourquoi**. Le langage est le **comment**.

---

### Observations

| Aspect | Pseudo-code | JavaScript | PHP |
|--------|-------------|------------|-----|
| Déclaration | `Variables ... En Type` | `var x;` | implicite |
| Affectation | `←` | `=` | `=` |
| Préfixe variable | aucun | aucun | `$` |
| Fin d'instruction | retour ligne | `;` | `;` |

La logique est **identique**. Seule la syntaxe change.

---

## 3. JavaScript — Le langage

### Origine

- Créé en 1995 par Netscape
- Un des 3 piliers du web : HTML (structure), CSS (style), JS (comportement)
- Interprété par le navigateur

### Où écrire du JavaScript ?

| Méthode | Usage |
|---------|-------|
| Console du navigateur | Test rapide, apprentissage |
| Balise `<script>` dans le HTML | Code spécifique à une page |
| Fichier `.js` externe | Code réutilisable, production |
| Attributs HTML (`onclick`, etc.) | À éviter (mélange structure/logique) |

### Accéder à la console

1. Ouvrir le navigateur
2. `F12` ou `Ctrl+Shift+I` (Windows/Linux) / `Cmd+Option+I` (Mac)
3. Onglet **Console**

### Méthodes de sortie

| Méthode | Destination | Usage |
|---------|-------------|-------|
| `console.log()` | Console | Debug, apprentissage |
| `alert()` | Fenêtre popup | Pédagogie uniquement |
| `document.write()` | Page HTML | À éviter |
| `innerHTML` | Élément HTML | Manipulation DOM |

---

## 4. Syntaxe de base

### Variables

```js
var x = 5;      // ancienne syntaxe (éviter)
let y = 10;     // variable modifiable
const z = 15;   // constante (non réassignable)
```

### Types de données

```js
let entier = 42;           // Number
let decimal = 3.14;        // Number (pas de distinction int/float)
let texte = "hello";       // String
let vide = "";             // String vide
let booleen = true;        // Boolean
let rien = null;           // Null (absence intentionnelle)
let indefini;              // undefined (pas de valeur assignée)
```

### Opérateurs

```js
// Arithmétiques
+  -  *  /  %  **

// Comparaison
==   // égalité (avec conversion de type)
===  // égalité stricte (sans conversion) ← TOUJOURS UTILISER
!=   // différent
!==  // différent strict
>  <  >=  <=

// Logiques
&&   // ET
||   // OU
!    // NON
```

### Égalité : == vs ===

```js
5 == "5"    // true  — JS convertit le string en number
5 === "5"   // false — types différents

0 == false  // true
0 === false // false
```

**Règle : toujours utiliser `===` et `!==`**

---

## 5. Entrées/Sorties (contexte pédagogique)

> ⚠️ `alert()`, `prompt()` et `confirm()` bloquent l'exécution et sont obsolètes en production. On les utilise ici uniquement pour apprendre les concepts d'I/O sans manipuler le DOM.

### alert() — Afficher un message

```js
alert("Hello");
```

### prompt() — Demander une saisie

```js
let nom = prompt("Votre nom ?");
// retourne un string ou null (si annulé)
```

### confirm() — Demander une confirmation

```js
let ok = confirm("Continuer ?");
// retourne true ou false
```

### Conversion de type

`prompt()` retourne toujours un **string**. Pour un nombre :

```js
let age = prompt("Âge ?");       // "25" (string)
let ageNum = Number(age);        // 25 (number)

// ou en une ligne
let age = Number(prompt("Âge ?"));
```

---

## 6. Structures de contrôle

### Condition (if)

```js
let age = 18;

if (age >= 18) {
    console.log("Majeur");
} else {
    console.log("Mineur");
}
```

### Condition multiple (else if)

```js
let note = 75;

if (note >= 90) {
    console.log("A");
} else if (note >= 80) {
    console.log("B");
} else if (note >= 70) {
    console.log("C");
} else {
    console.log("Échec");
}
```

### Boucle while

```js
let i = 0;
while (i < 5) {
    console.log(i);
    i++;
}
```

### Boucle for

```js
for (let i = 0; i < 5; i++) {
    console.log(i);
}
```

---

## Ressources

- [MDN JavaScript](https://developer.mozilla.org/fr/docs/Web/JavaScript)
- [W3Schools JS Tutorial](https://www.w3schools.com/js/)