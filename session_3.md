# Les boucles

## Le problème

Un programme demande une réponse O (Oui) ou N (Non). L'utilisateur tape Z.

```C
Variable reponse en Caractère
Début
    Ecrire "Voulez-vous un café ? (O/N)"
    Lire reponse
    Si reponse <> "O" ET reponse <> "N" Alors
        Ecrire "Saisie erronée. Recommencez"
        Lire reponse
    FinSi
Fin
```

Ça fonctionne si l'utilisateur se trompe **une seule fois**.

Deux erreurs ? Il faut un deuxième `Si`. Trois erreurs ? Un troisième. On peut empiler des centaines de `Si` et produire un algorithme d'une lourdeur affreuse.

---

## TantQue

La boucle répète un bloc d'instructions tant qu'une condition est vraie.

```C
TantQue booléen
    Instructions
FinTantQue
```

Le booléen est évalué **avant** chaque itération. Si faux dès le départ, le bloc n'est jamais exécuté.

---

## Première tentative

```C
Variable reponse en Caractère
Début
    Ecrire "Voulez-vous un café ? (O/N)"
    TantQue reponse <> "O" ET reponse <> "N"
        Lire reponse
    FinTantQue
Fin
```

**Erreur** : `reponse` n'a pas de valeur avant l'entrée dans la boucle. On teste une variable non affectée.

---

## Solution 1 : Double lecture

Lire une première fois **avant** la boucle.

```C
Variable reponse en Caractère
Début
    Ecrire "Voulez-vous un café ? (O/N)"
    Lire reponse
    TantQue reponse <> "O" ET reponse <> "N"
        Ecrire "Vous devez répondre par O ou N. Recommencez"
        Lire reponse
    FinTantQue
    Ecrire "Saisie acceptée"
Fin
```

Si la première saisie est correcte, la boucle n'est jamais exécutée.

---

## Solution 2 : Pré-affectation

Affecter une valeur par défaut qui **force** l'entrée dans la boucle.

```C
Variable reponse en Caractère
Début
    reponse <- "X"
    Ecrire "Voulez-vous un café ? (O/N)"
    TantQue reponse <> "O" ET reponse <> "N"
        Lire reponse
        Si reponse <> "O" ET reponse <> "N" Alors
            Ecrire "Saisie erronée, recommencez"
        FinSi
    FinTantQue
Fin
```

L'entrée dans la boucle est garantie. La lecture est unique.

---

## Comparaison

| Double lecture | Pré-affectation |
|----------------|-----------------|
| Boucle exécutée uniquement en cas d'erreur | Entrée forcée, au moins une exécution |
| Instruction `Lire` dupliquée | Instruction `Lire` unique |
| Plus de code = plus de bugs | Moins de code = moins de bugs |

---

## Boucle infinie

Une boucle dont le booléen ne devient **jamais** faux.

```C
compteur <- 1
TantQue compteur > 0
    Ecrire compteur
    compteur <- compteur + 1
FinTantQue
```

Le programme tourne indéfiniment jusqu'à interruption forcée.

**Règle** : toute boucle doit contenir une instruction qui modifie la condition de sortie.

---

## Compteur

Patron classique : répéter N fois.

```C
Variable i en Entier
Début
    i <- 0
    TantQue i < 5
        Ecrire i
        i <- i + 1
    FinTantQue
Fin
```

Affiche : 0, 1, 2, 3, 4 (5 itérations).

---

## Accumulateur

Patron classique : calculer une somme.

```C
Variables i, somme en Entier
Début
    i <- 1
    somme <- 0
    TantQue i <= 10
        somme <- somme + i
        i <- i + 1
    FinTantQue
    Ecrire somme
Fin
```

Résultat : 55 (somme des entiers de 1 à 10).

---

## Résumé

| Concept | Description |
|---------|-------------|
| `TantQue` | Répète tant que la condition est vraie |
| Condition évaluée avant | Si fausse au départ, 0 itération |
| Variable initialisée | Toujours affecter avant de tester |
| Condition de sortie | Doit pouvoir devenir fausse |
| Compteur | `i <- i + 1` pour compter les itérations |
| Accumulateur | `somme <- somme + valeur` pour cumuler |