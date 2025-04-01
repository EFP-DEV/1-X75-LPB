# Exercice Final JavaScript

## Objectifs d'Apprentissage
- Pratiquer la manipulation de tableaux en JavaScript
- Implémenter des algorithmes courants
- Travailler avec différents types de données (chaînes, tableaux, nombres)
- Appliquer les concepts de programmation fonctionnelle

## Instructions
Chaque exercice contient une ébauche de fonction que vous devez compléter. Testez vos solutions en utilisant les exemples fournis.

---

## Exercice 1: Manipulation de Chaînes
**Tâche**: Créez une fonction qui extrait un caractère sur deux d'une chaîne.

**Exemple**: `"hello"` → `"hlo"`

```javascript
function mergeEveryTwoLetters(word) {
  // Votre code ici
}

// Test
console.log(mergeEveryTwoLetters("word")); // Devrait afficher: "wr"
```

## Exercice 2: Validation de Nombres
**Tâche**: Vérifiez si l'un des deux nombres est 42 ou si leur somme est 42.

**Exemple**: `has42OrSumIs42(40, 2)` → `true`

```javascript
function has42OrSumIs42(a, b) {
  // Votre code ici
}

// Test
console.log(has42OrSumIs42(42, 0)); // Devrait afficher: true
console.log(has42OrSumIs42(20, 22)); // Devrait afficher: true
console.log(has42OrSumIs42(10, 10)); // Devrait afficher: false
```

## Exercice 3: Comptage dans un Tableau
**Tâche**: Déterminez si un tableau contient plus de quatre zéros.

**Exemple**: `[1, 0, 2, 0, 0, 0, 0]` → `true`

```javascript
function moreThanFourZeros(n) {
  // Votre code ici
}

// Test
console.log(moreThanFourZeros([1, 0, 2, 0, 0, 0, 0])); // Devrait afficher: true
console.log(moreThanFourZeros([1, 0, 2, 0, 0, 0])); // Devrait afficher: false
```

## Exercice 4: Conversion de Température
**Tâche**: Convertissez la température de Celsius en Fahrenheit en utilisant la formule: F = C × (9/5) + 32

**Exemple**: `celsiusToFahrenheit(0)` → `32`

```javascript
function celsiusToFahrenheit(n) {
  // Votre code ici
}

// Test
console.log(celsiusToFahrenheit(18)); // Devrait afficher: 64.4
console.log(celsiusToFahrenheit(0)); // Devrait afficher: 32
```

## Exercice 5: Filtrage de Tableau
**Tâche**: Créez une fonction qui filtre un tableau pour ne renvoyer que les nombres positifs.

**Exemple**: `[2, -1, 5]` → `[2, 5]`

```javascript
function filterPositiveNumbers(arr) {
  // Votre code ici
}

// Test
console.log(filterPositiveNumbers([2, 3, -1, 5, 7, 9, 10, 15, 95])); // Devrait afficher: [2, 3, 5, 7, 9, 10, 15, 95]
```

## Exercice 6: Somme des Chiffres
**Tâche**: Calculez la somme de tous les chiffres d'un entier positif.

**Exemple**: `sumDigits(123)` → `6` (car 1 + 2 + 3 = 6)

```javascript
function sumDigits(n) {
  // Votre code ici
}

// Test
console.log(sumDigits(1235231)); // Somme de 1+2+3+5+2+3+1 = 17
```

## Exercice 7: Rotation de Tableau
**Tâche**: Faites tourner un tableau vers la gauche d'une position.
- Implémentez deux solutions: une utilisant shift()/push() et une sans ces méthodes.

**Exemple**: `[1, 2, 3, 4]` → `[2, 3, 4, 1]`

```javascript
function rotateLeft(arr) {
  // Solution avec shift() et push()
}

function rotateLeftAlternative(arr) {
  // Solution sans shift() et push()
}

// Test
console.log(rotateLeft([1, 2, 3, 4])); // Devrait afficher: [2, 3, 4, 1]
console.log(rotateLeftAlternative([1, 2, 3, 4])); // Devrait afficher: [2, 3, 4, 1]
```

## Exercice 8: Fusion de Tableaux
**Tâche**: Fusionnez deux tableaux en un nouveau tableau.

**Exemple**: `[1, 2]` et `[3, 4]` → `[1, 2, 3, 4]`

```javascript
function mergeArrays(arr1, arr2) {
  // Votre code ici
}

// Test
console.log(mergeArrays([1, 2, 3], [4, 5, 6])); // Devrait afficher: [1, 2, 3, 4, 5, 6]
```

## Exercice 9: Différence Symétrique
**Tâche**: Créez une fonction qui renvoie les éléments qui apparaissent dans l'un ou l'autre des deux tableaux, mais pas dans les deux (différence symétrique).

**Exemple**: `[1, 2, 3]` et `[2, 3, 4]` → `[1, 4]`

```javascript
function mergeExclusive(arr1, arr2) {
  // Votre code ici
}

// Test
console.log(mergeExclusive([1, 2, 3, 10, 5, 3, 14], [1, 4, 5, 6, 14])); // Devrait afficher: [2, 3, 10, 3, 4, 6]
```

## Exercice 10: Somme de Nombres dans une Chaîne
**Tâche**: Calculez la somme des nombres dans une chaîne délimitée par des virgules.

**Exemple**: `"1.5, 2.3, 3.1"` → `6.9`

```javascript
function sumNumbersInString(str) {
  // Votre code ici
}

// Test
console.log(sumNumbersInString("1.5, 2.3, 3.1, 4, 5.5, 6, 7, 8, 9, 10.9")); // Devrait afficher: 57.3
```

## Exercice 11: Extraction de Colonne de Tableau 2D
**Tâche**: Extrayez une colonne spécifique d'un tableau bidimensionnel.

**Exemple**: De `[["A", 1], ["B", 2]]` extraire la colonne 1 → `[1, 2]`

```javascript
function extractColumn(arr, n) {
  // Votre code ici
}

// Test
let data = [
  ["John", 120],
  ["Jane", 115],
  ["Thomas", 123],
  ["Mel", 112],
  ["Charley", 122]
];
console.log(extractColumn(data, 1)); // Devrait afficher: [120, 115, 123, 112, 122]
```

## Exercice 12: Conversion Binaire
**Tâche**: Convertissez une chaîne binaire en nombre décimal.

**Exemple**: `"1010"` → `10`

```javascript
function binaryToNumber(str) {
  // Votre code ici
}

// Test
console.log(binaryToNumber("11111111")); // Devrait afficher: 255
console.log(binaryToNumber("1010")); // Devrait afficher: 10
```

## Défiez-vous
Après avoir terminé ces exercices, essayez ces extensions:
1. Refactorisez vos solutions pour utiliser davantage de techniques de programmation fonctionnelle (map, filter, reduce)
2. Ajoutez la gestion des erreurs à chaque fonction
3. Optimisez vos solutions pour la performance
4. Écrivez des cas de test supplémentaires pour chaque fonction

## Soumission
Soumettez vos fonctions complétées avec une brève explication de votre approche pour chaque solution.
