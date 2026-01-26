# Exercices : Les tests

## Série 4 : Conditions avancées

### Exercice 4.1
Écrire un algorithme équivalent (utilisant les lois de De Morgan) :
```
Si Tutu > Toto + 4 OU Tata = "OK" Alors
    Tutu ← Tutu + 1
Sinon
    Tutu ← Tutu – 1
FinSi
```

---

### Exercice 4.2
Écrire un algorithme qui demande l'heure et les minutes (on les suppose valides) et affiche l'heure une minute plus tard.

Exemple :
```
Heure : 21
Minutes : 32
Dans une minute, il sera 21h33
```

---

### Exercice 4.3
Écrire un algorithme qui demande une heure (h, m, s) et affiche l'heure une seconde plus tard.

Exemple :
```
Heure : 21
Minutes : 32
Secondes : 59
Dans une seconde, il sera 21h33m00s
```

---

### Exercice 4.4
Un magasin de photocopie facture :
- 0.20€ les 10 premières copies
- 0.10€ les 20 suivantes
- 0.05€ au-delà

Écrire un algorithme qui demande le nombre de photocopies et affiche le montant à payer.

---

### Exercice 4.5
Sur la planète K-Pax, le droit de vote obéit à des règles particulières :
- Les Draxx de plus de 35 ans ne peuvent pas voter
- Les Sklounst entre 18 et 35 ans ne peuvent pas voter
- Tous les autres (genre et âge confondus) peuvent voter

Écrire un algorithme qui demande l'âge et le genre d'un habitant, puis indique s'il peut voter.

**Piège** : Qui sont "les autres" ? Vous n'êtes pas sur Terre — le code doit fonctionner avec vos connaissances limitées de K-Pax.

---

### Exercice 4.6
Sur K-Pax, les élections suivent ces règles :
- Plus de 50% au premier tour → élu
- Second tour : uniquement les candidats ayant obtenu au moins 12.5%

Écrire un algorithme qui saisit les scores (%) de 4 candidats et analyse **uniquement** le résultat du candidat n°1.

Afficher s'il est :
- Élu
- Battu
- En ballottage favorable (participe au second tour, en tête ou à égalité)
- En ballottage défavorable

---

### Exercice 4.7
Une compagnie d'assurance auto propose quatre tarifs (du moins au plus cher) : Bleu, Vert, Orange, Rouge.

**Règles :**

| Conducteur | Aucun accident | 1 accident | 2 accidents | 3+ accidents |
|------------|----------------|------------|-------------|--------------|
| < 35 ans ET permis < 2 ans | Rouge | Refusé | Refusé | Refusé |
| < 35 ans ET permis ≥ 2 ans | Orange | Rouge | Refusé | Refusé |
| ≥ 35 ans ET permis < 2 ans | Orange | Rouge | Refusé | Refusé |
| ≥ 35 ans ET permis ≥ 2 ans | Vert | Orange | Rouge | Refusé |

**Bonus fidélité** : client depuis plus d'un an → tarif immédiatement inférieur (si accepté).

Écrire l'algorithme qui saisit les données et affiche le tarif.

---

### Exercice 4.8
Écrire un algorithme qui demande un jour, un mois et une année, puis indique si la date est valide.

Rappels :
- Février : 28 jours (29 si année bissextile)
- Année bissextile : divisible par 4, sauf si divisible par 100, sauf si divisible par 400

Utiliser l'opérateur `MOD` (modulo) pour tester la divisibilité.