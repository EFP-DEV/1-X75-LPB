# Exercices : Les boucles

## Exercice 5.1
*(10 min)*

Écrire un algorithme qui demande à l'utilisateur un nombre compris entre 1 et 3, jusqu'à ce que la réponse convienne.

**Contrainte DRY** : l'algorithme doit pouvoir fonctionner de 3 à 5 en ne changeant les valeurs qu'à **un seul endroit**.

---

## Exercice 5.2
*(10 min)*

Écrire un algorithme qui demande un nombre compris entre 10 et 20, jusqu'à ce que la réponse convienne.

En cas de réponse incorrecte :
- Si > 20 : afficher "Plus petit !"
- Si < 10 : afficher "Plus grand !"

**Contrainte DRY** : mêmes bornes paramétrables qu'en 5.1.

---

## Exercice 5.3
*(30 min)*

Écrire un algorithme qui demande un nombre de départ, puis affiche ce nombre et les dix suivants.

Exemple pour 18 :
```
18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28
```

**Contrainte DRY** : afficher les 100 nombres suivants en ne changeant qu'une seule valeur.

---

## Exercice 5.4

Écrire un algorithme qui demande un nombre et affiche sa table de multiplication.

Exemple pour 7 :
```
Table de 7 :
7 x 1 = 7
7 x 2 = 14
7 x 3 = 21
7 x 4 = 28
7 x 5 = 35
7 x 6 = 42
7 x 7 = 49
7 x 8 = 56
7 x 9 = 63
7 x 10 = 70
```

---

## Exercice 5.5

Écrire un algorithme qui demande un nombre N et affiche la somme des entiers de 1 à N.

Exemple pour 5 : afficher uniquement `15` (car 1+2+3+4+5 = 15).

---

## Exercice 5.6

Écrire un algorithme qui demande un nombre N et affiche sa factorielle (N!).

Rappel : 8! = 1 × 2 × 3 × 4 × 5 × 6 × 7 × 8 = 40320

Afficher uniquement le résultat final.

---

## Exercice 5.7

Écrire un algorithme qui demande à l'utilisateur d'entrer 20 nombres successifs, puis affiche le plus grand.

```
Entrez le nombre numéro 1 : 12
Entrez le nombre numéro 2 : 14
Entrez le nombre numéro 3 : 1835
Entrez le nombre numéro 4 : 22
...
Entrez le nombre numéro 20 : 6
Le plus grand de ces nombres est : 1835
```

---

## Exercice 5.8

Reprendre l'exercice 5.7, mais le nombre de saisies n'est pas connu à l'avance.

La saisie s'arrête quand l'utilisateur entre 0.

---

## Exercice 5.9

Simuler une caisse de magasin.

1. Saisir les prix des articles (entiers, en euros). Terminer par 0.
2. Afficher le total.
3. Demander le montant donné par le client.
4. Vérifier que le montant est suffisant.
5. Afficher la monnaie à rendre en coupures de 10 €, 5 € et 1 €.

Exemple : total 24 €, client donne 50 €.
```
10 € 10 € 5 € 1 €
```