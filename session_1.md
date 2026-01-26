# Les tests

### [|{ ](#intro) 1. Introduction aux tests
### [|{ ](#operateurs) 2. Opérateurs de comparaison
### [|{ ](#composition) 3. Composition de tests
### [|{ ](#imbrication) 4. Tests imbriqués
### [|{ ](#booleens) 5. Variables booléennes
### [|{ ](#demorgan) 6. Lois de De Morgan

---

# <a name="intro"></a> Chapitre 1 : Introduction aux tests

## Algorithme de la vie quotidienne

Indiquer un chemin :

```
Allez tout droit jusqu'au prochain carrefour
Si la rue à droite est autorisée à la circulation Alors
    Tournez à droite
    Avancez
    Prenez la deuxième à gauche
Sinon
    Prenez la suivante à droite
    Avancez
    Prenez la première à droite
FinSi
```

## Définition

Un **test** (ou condition) est une comparaison composée de trois éléments :

1. Une valeur
2. Un opérateur de comparaison
3. Une autre valeur

Les valeurs peuvent être de n'importe quel type (numériques, caractères...), mais attention à la cohérence des types.

L'ensemble forme une **affirmation** qui, à un moment donné, est **VRAIE** ou **FAUSSE**.

---

# <a name="operateurs"></a> Chapitre 2 : Opérateurs de comparaison

## Liste des opérateurs

| Opérateur | Signification |
|-----------|---------------|
| `=` | égal à |
| `<>` | différent de |
| `<` | strictement plus petit que |
| `>` | strictement plus grand que |
| `=<` | plus petit ou égal à |
| `>=` | plus grand ou égal à |

## Comparaison de caractères

Les opérateurs s'appliquent aux caractères grâce au code ASCII :

| Expression | Résultat |
|------------|----------|
| `"t" < "w"` | VRAI |
| `"Maman" > "Papa"` | FAUX |
| `"maman" > "Papa"` | VRAI |

La comparaison se fait caractère par caractère selon leur code ASCII. Les minuscules (97-122) ont des codes supérieurs aux majuscules (65-90).

## Exemple avec entrées/sorties

```
Variable age en Entier

Début
    Ecrire "Entrez votre âge : "
    Lire age
    Si age >= 18 Alors
        Ecrire "Vous êtes majeur"
    Sinon
        Ecrire "Vous êtes mineur"
    FinSi
Fin
```

---

# <a name="composition"></a> Chapitre 3 : Composition de tests

## Opérateurs logiques

On peut lier plusieurs tests au moyen d'opérateurs logiques (booléens) :

**ET**, **OU**, **NON**, **XOR**

## ET (conjonction)

Pour que `Condition1 ET Condition2` soit VRAI, il faut que **les deux** conditions soient VRAIES.

Exemple : pour monter dans un manège, il faut avoir 18 ans **ET** mesurer plus de 1.60m.

| A | B | A ET B |
|---|---|--------|
| FAUX | FAUX | FAUX |
| FAUX | VRAI | FAUX |
| VRAI | FAUX | FAUX |
| VRAI | VRAI | **VRAI** |

## OU (disjonction)

Pour que `Condition1 OU Condition2` soit VRAI, il suffit que :
- Condition1 soit VRAIE, ou
- Condition2 soit VRAIE, ou
- Les deux soient VRAIES

| A | B | A OU B |
|---|---|--------|
| FAUX | FAUX | **FAUX** |
| FAUX | VRAI | VRAI |
| VRAI | FAUX | VRAI |
| VRAI | VRAI | VRAI |

## XOR (ou exclusif)

Pour que `Condition1 XOR Condition2` soit VRAI, il faut que **l'une ou l'autre** soit VRAIE, mais **pas les deux**.

| A | B | A XOR B |
|---|---|---------|
| FAUX | FAUX | FAUX |
| FAUX | VRAI | VRAI |
| VRAI | FAUX | VRAI |
| VRAI | VRAI | **FAUX** |

Exemple : menu du jour avec entrée XOR dessert (l'un ou l'autre, pas les deux).

## NON (négation)

`NON(Condition1)` inverse la valeur :
- VRAI si Condition1 est FAUX
- FAUX si Condition1 est VRAI

Pourquoi écrire `NON(Prix > 20)` alors que `Prix =< 20` fonctionne ? La réponse viendra avec De Morgan.

## Erreur classique

```
Si age < 10 ET age > 15 Alors
    // Gestion des enfants entre 10 et 15 ans ?
FinSi
```

Cette condition est **toujours fausse**. Aucun nombre ne peut être simultanément inférieur à 10 et supérieur à 15.

Correction :

```
Si age >= 10 ET age < 15 Alors
    // Enfants entre 10 et 15 ans (non compris)
FinSi
```

## Priorité des opérateurs

Dans une condition composée avec ET et OU, les parenthèses déterminent le résultat :

```
1 + 3 x 2 = 7
(1 + 3) x 2 = 8
```

Même principe :

```
A OU B ET C    // équivaut à : A OU (B ET C)
(A OU B) ET C  // résultat différent
```

Priorité : `NON` > `ET` > `OU`

---

# <a name="imbrication"></a> Chapitre 4 : Tests imbriqués

## Problème : état de l'eau

Un programme doit afficher l'état de l'eau selon sa température :
- Solide : =< 0°
- Liquide : > 0° et < 100°
- Gazeuse : >= 100°

## Première approche (trois tests indépendants)

```
Variable temperature en Entier

Début
    Ecrire "Entrez la température de l'eau : "
    Lire temperature
    
    Si temperature =< 0 Alors
        Ecrire "C'est de la glace"
    FinSi
    
    Si temperature > 0 ET temperature < 100 Alors
        Ecrire "C'est du liquide"
    FinSi
    
    Si temperature >= 100 Alors
        Ecrire "C'est de la vapeur"
    FinSi
Fin
```

Problèmes : trois conditions évaluées, dont une composée.

## Deuxième approche (tests imbriqués)

```
Variable temperature en Entier

Début
    Ecrire "Entrez la température de l'eau : "
    Lire temperature
    
    Si temperature =< 0 Alors
        Ecrire "C'est de la glace"
    Sinon
        Si temperature < 100 Alors
            Ecrire "C'est du liquide"
        Sinon
            Ecrire "C'est de la vapeur"
        FinSi
    FinSi
Fin
```

## Avantages de l'imbrication

- Deux conditions simples au lieu de trois (dont une composée)
- Performance : si température =< 0, on affiche et on sort immédiatement
- Plus lisible et maintenable

## Analogie : l'aiguillage de train

Une structure SI est comparable à un aiguillage ferroviaire :

```
         ┌─── [Condition VRAIE] ───→ Instructions 1
Entrée ──┤
         └─── [Condition FAUSSE] ──→ Instructions 2
                                            │
                                            ↓
                                         FinSi
```

Pour deux voies, un aiguillage suffit. Pour trois voies (solide, liquide, gazeux), il faut deux aiguillages imbriqués :

```
              ┌─── [=< 0] ────→ "glace"
Température ──┤
              └─── [> 0] ──┬── [< 100] ──→ "liquide"
                           │
                           └── [>= 100] ─→ "vapeur"
```

## Structure SinonSi

Pour éviter l'indentation excessive :

```C
Variable temperature en Entier

Début
    Ecrire "Entrez la température de l'eau : "
    Lire temperature
    
    Si temperature =< 0 Alors
        Ecrire "C'est de la glace"
    SinonSi temperature < 100 Alors
        Ecrire "C'est du liquide"
    Sinon
        Ecrire "C'est de la vapeur"
    FinSi
Fin
```

---

# <a name="booleens"></a> Chapitre 5 : Variables booléennes

## Principe

Une expression conditionnelle a une valeur (VRAI ou FAUX) à un moment donné. Cette valeur peut être stockée dans une variable.

## Exemple : eau avec variables booléennes

```C
Variable temperature en Entier
Variables moins_de_zero, moins_de_100 en Booléen

Début
    Ecrire "Entrez la température de l'eau : "
    Lire temperature
    
    moins_de_zero ← temperature =< 0
    moins_de_100 ← temperature < 100
    
    Si moins_de_zero Alors
        Ecrire "C'est de la glace"
    SinonSi moins_de_100 Alors
        Ecrire "C'est du liquide"
    Sinon
        Ecrire "C'est de la vapeur"
    FinSi
Fin
```

## Intérêts

- Lisibilité : le nom de la variable décrit la condition
- Réutilisation : une condition complexe calculée une seule fois
- Débogage : on peut afficher la valeur intermédiaire

## Exercice : opérateurs booléens

```C
Variables A, B, C, D, E en Booléen
Variable X en Entier

Début
    Lire X
    A ← X < 2
    B ← X > 12
    C ← X < 6
    D ← (A ET B) OU C
    E ← A ET (B OU C)
    Ecrire D, E
Fin
```

Si X vaut 3, que valent D et E ?

<details>
<summary><strong>Solution</strong></summary>

```C
X = 3
A = (3 < 2)  = FAUX
B = (3 > 12) = FAUX
C = (3 < 6)  = VRAI

D = (FAUX ET FAUX) OU VRAI = FAUX OU VRAI = VRAI
E = FAUX ET (FAUX OU VRAI) = FAUX ET VRAI = FAUX
```

Les parenthèses changent le résultat : D = VRAI, E = FAUX.

</details>

---

# <a name="demorgan"></a> Extra : Lois de De Morgan

## Énoncé

Les lois de De Morgan permettent de transformer des expressions logiques :

```C
NON(A ET B) = NON(A) OU NON(B)
NON(A OU B) = NON(A) ET NON(B)
```

## Application

Ces deux structures sont équivalentes :

```
Si A ET B Alors          │    Si NON(A) OU NON(B) Alors
    Instructions 1       │        Instructions 2
Sinon                    │    Sinon
    Instructions 2       │        Instructions 1
FinSi                    │    FinSi
```

## Utilité pratique

Simplifier des conditions négatives :

```
// Difficile à lire
Si NON(age >= 18 ET permis = VRAI) Alors
    Ecrire "Accès refusé"
FinSi

// Équivalent, plus clair
Si age < 18 OU permis = FAUX Alors
    Ecrire "Accès refusé"
FinSi
```

Inverser la logique d'un test :

```
// Original
Si fichier_existe ET droits_lecture Alors
    ouvrir_fichier()
Sinon
    afficher_erreur()
FinSi

// Avec De Morgan (logique inversée)
Si NON(fichier_existe) OU NON(droits_lecture) Alors
    afficher_erreur()
Sinon
    ouvrir_fichier()
FinSi
```

---


[Exercice a remettre](exo/session_1.md)
---


# [&laquo; Chapitre 1](session_1.md) | [Chapitre 3 &raquo;](session_3.md)