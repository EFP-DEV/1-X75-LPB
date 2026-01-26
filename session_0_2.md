# ALGO-101 - Cours d'algorithmique
# Les Variables

## C'est quoi une variable ?

Une boîte avec une étiquette.

```
sel <- 1
```

- `sel` → l'étiquette (le nom)
- `1` → ce qu'il y a dans la boîte (la valeur)
- `<-` → "reçoit" (affectation)

Pour accéder au contenu, on utilise l'étiquette.

---

## Déclarer une variable

Avant d'utiliser une variable, on la déclare (on crée la boîte).

```
Variable nom en Type
nom <- valeur
```

Exemple :
```
Variable age en Entier
age <- 25
```

On peut regrouper les déclarations de même type :
```
Variables prix_ht, taux_tva, prix_ttc en Décimal
```

---

## Types de valeurs

| Type | Exemple | Usage |
|------|---------|-------|
| Entier | `500` | quantités, compteurs, indices |
| Décimal | `18.5` | mesures, prix, pourcentages |
| Texte | `"Alice"` | mots, phrases, caractères |
| Booléen | `VRAI` / `FAUX` | états oui/non |

**Pourquoi plusieurs types numériques ?**

Économie de moyens. Un entier prend moins de mémoire qu'un décimal. Si on stocke un âge, un entier suffit. Pour un prix au centime près, on utilise un décimal.

> Chaque caractère a un équivalent numérique (tables ASCII et Unicode).
> Référence : [ascii-code.net](http://ascii-code.net/) | [unicode-table.com](https://unicode-table.com/)

---

## Affectation

Affecter = donner une valeur à une variable.

```
Variable age en Entier
age <- 33
```

On peut affecter la valeur d'une autre variable :
```
Variables age, copie_age en Entier
age <- 33
copie_age <- age
age <- copie_age + 5
```
Résultat : `age` vaut 38, `copie_age` vaut 33.

**Attention :** `<-` signifie "reçoit", pas "égale".
- En maths : `A = B` équivaut à `B = A`
- En algorithmique : `A <- B` et `B <- A` sont très différentes

---

## Texte vs Variable

```
Variables riri, fifi en Texte

riri <- "loulou"
fifi <- "riri"
```

Mais aussi

```
Variables riri, fifi en Texte

riri <- "loulou"
fifi <- riri
```

**Règle :** guillemets = texte littéral. Sans guillemets = référence à une variable.

<details>
  <summary><strong>Voir le secret</strong></summary>

```C
Variante 1: `fifi` contient le texte `"riri"` (4 caractères).
Variante 2: `fifi` contient `"loulou"` (la valeur de la variable `riri`).
```
</details>



---

## Expressions

Une expression est un ensemble de valeurs reliées par des opérateurs, qui produit une seule valeur.

```
age <- 7              // valeur simple
age <- 5 + 4          // expression : produit 9
age <- 123 - 45 + 8   // expression : produit 86
age <- base + 10      // expression avec variable
```

Dans une affectation :
- **À gauche** de `<-` : toujours un nom de variable
- **À droite** de `<-` : une expression (qui sera évaluée)

---

## Opérateurs

Un opérateur relie deux valeurs pour produire un résultat.

### Numériques

| Opérateur | Fonction | Exemple |
|-----------|----------|---------|
| `+` | addition | `5 + 3` → `8` |
| `-` | soustraction | `5 - 3` → `2` |
| `*` | multiplication | `5 * 3` → `15` |
| `/` | division | `6 / 3` → `2` |
| `^` | puissance | `2 ^ 3` → `8` |
| `()` | priorité | `(2 + 3) * 4` → `20` |

### Texte

| Opérateur | Fonction | Exemple |
|-----------|----------|---------|
| `&` | concaténation | `"Bon" & "jour"` → `"Bonjour"` |

### Booléens

| Opérateur | Fonction | Exemple |
|-----------|----------|---------|
| `ET` | et logique | `VRAI ET FAUX` → `FAUX` |
| `OU` | ou logique | `VRAI OU FAUX` → `VRAI` |
| `NON` | négation | `NON VRAI` → `FAUX` |
| `XOR` | ou exclusif | `VRAI XOR VRAI` → `FAUX` |

---

## Conventions de nommage

Les conventions de nommage sont **des conventions** : des habitudes partagées pour rendre le code plus lisible et cohérent. Il n’y a **pas de convention “supérieure”** : chacune a ses avantages selon le langage, l’équipe ou le projet.

**Règle essentielle :** on **choisit une convention** (selon le langage / le projet / l’équipe / les préférences) et on **s’y tient partout dans le même code**. Mélanger plusieurs styles dans une même base rend le code plus difficile à lire.

### Quelques conventions courrantes

| Convention | Exemple | Utilisé par |
|------------|---------|-------------|
| snake_case | `prix_ttc` | Python, Ruby, PHP (variables), SQL |
| camelCase | `prixTtc` | JavaScript, Java (variables), TypeScript |
| PascalCase | `PrixTtc` | C#, Java (classes), TypeScript (classes) |
| kebab-case | `prix-ttc` | CSS, HTML (attributs), URLs |
| SCREAMING_SNAKE | `PRIX_TTC` | Constantes (la plupart des langages) |



**Pourquoi `snake_case` est ma preference ?**

* séparateurs de mots **clairs** (`prix_total_ttc`) : les mots (et acronymes) restent lisibles et sans ambiguïté — ex. `montant_tva`, `prix_ht`, `prix_ttc`, `id_client` (contrairement à `prixTTC` / `prixTva` où les acronymes peuvent varier : `TTC`, `Ttc`, `TVA`, `Tva`).
* **jeu de caractères minimal** (minuscules + `_` + chiffres)
* sélection plus **pratique** dans les éditeurs (souvent plus facile qu’en camelCase)
* `_` n’est généralement **pas un opérateur**, contrairement à `-` (kebab-case), qui sert souvent à la soustraction en programmation.


**Règles universelles :**
- Pas d'espaces : `mon prix` ❌
- Ne commence pas par un chiffre : `3oranges` ❌
- Caractères autorisés : `a-z`, `A-Z`, `0-9`, `_`
- Nom descriptif : `x` ❌ → `quantite` ✓

**En pseudo-code**, on utilisera `snake_case` pour les variables.

---

## Résumé

```
Variable nom en Type
nom <- valeur
```

| Concept | Définition |
|---------|------------|
| Variable | Une boîte étiquetée qui contient une valeur |
| Type | Nature de la valeur (Entier, Décimal, Texte, Booléen) |
| Affectation | Donner une valeur avec `<-` |
| Expression | Combinaison de valeurs et opérateurs → une valeur |
| Opérateur | Symbole qui combine des valeurs (+, -, *, /, &, ET, OU...) |



[Exercice a remettre](exo/session_0_2.md)
---

### [Chapitre 2 &laquo;](session_0_1.md)  [&raquo; Chapitre 4](session_0_3.md)