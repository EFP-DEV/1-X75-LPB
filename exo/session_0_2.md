# Exercices : Les Variables

## Exercice 1.1
Quelles seront les valeurs des variables après exécution ?
```C
Variables prix, livraison en Entier

Début
    prix ← 1
    livraison ← prix + 3
    prix ← 3
Fin
```
[Solution](solution/1.1.md)

---

## Exercice 1.2
Quelles seront les valeurs des variables après exécution ?
```C
Variables pommes, oranges, total en Entier

Début
    pommes ← 5
    oranges ← 3
    total ← pommes + oranges
    pommes ← 2
    total ← oranges – pommes
Fin
```

---

## Exercice 1.3
Quelles seront les valeurs des variables après exécution ?
```C
Variables score, bonus en Entier

Début
    score ← 5
    bonus ← score + 4
    score ← score + 1
    bonus ← score – 4
Fin
```

---

## Exercice 1.4
Quelles seront les valeurs des variables après exécution ?
```C
Variables cafe, lait, tasse en Entier

Début
    cafe ← 3
    lait ← 10
    tasse ← cafe + lait
    lait ← cafe + lait
    cafe ← tasse
Fin
```

---

## Exercice 1.5
Quelles seront les valeurs des variables après exécution ?
```C
Variables mon_age, ton_age en Entier

Début
    mon_age ← 5
    ton_age ← 219
    mon_age ← ton_age
    ton_age ← mon_age
Fin
```

Que s'est-il passé ?

---

## Exercice 1.6
Alice et Bob veulent échanger leurs places dans la file. Écrire un algorithme permettant d'échanger les valeurs de `place_alice` et `place_bob`.

```C
Variables place_alice, place_bob en Entier

Début
    place_alice ← 1
    place_bob ← 23
Fin

// a la fin, place_alice vaut 23, place_bob vaut 1
```

Le programme doit aussi fonctionner avec d'autres types de valeurs:

```C
Variables place_alice, place_bob en Entier

Début
    place_alice ← "first"
    place_bob ← "last"
Fin

// a la fin, place_alice vaut last, place_bob vaut first
```
---

## Exercice 1.7
Un stagiaire a écrit cet algorithme. Il contient une erreur, laquelle ?
```C
Variables nom, prenom, complet en Texte

Début
    nom ← "Dupont"
    prenom ← "Jean"
    complet ← prenom + nom
Fin
```
