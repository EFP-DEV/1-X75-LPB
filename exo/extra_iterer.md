# Exercices extra — Cinéma (boucles + pièges)

Même esprit que ta feuille : **court, répétitif, avec micro-variations** pour rendre les boucles automatiques.

## Comment bien réussir ces exercices (méthode boucles)

### 1) Visualise la scène

« Je répète une action à la caisse / je parcours des sièges / je compte des clients… »

### 2) Dis clairement : **combien de fois** ?

* *N fois* (boucle compteur)
* *jusqu’à un mot / 0 / un code* (boucle “sentinelle”)
* *tant que c’est invalide* (boucle de validation)

### 3) Fais une mini-trace (obligatoire)

Écris 3–5 étapes :

* valeur de `i` (le compteur)
* valeur de `somme`, `max`, `nb`, etc.

### 4) Pièges classiques à surveiller

* **off-by-one** : `1..N` vs `0..N-1`
* oublier d’initialiser `somme = 0`, `max = ...`
* moyenne : `somme / nb` (et `nb` peut valoir 0)
* remettre les compteurs à zéro au mauvais moment
* `break` trop tôt / jamais

---

## Série 1 — Répéter un affichage (boucles compteur)

**Consigne générale :** afficher **exactement** ce qui est demandé, souvent **une ligne par affichage**.

### Exercice 1 — Imprimer des tickets

On lit un entier `n` (n ≥ 0).
Afficher `n` lignes contenant exactement :
`"ticket"`

Tests : `n=0`, `n=1`, `n=3`.

---

### Exercice 2 — Numéros de tickets

On lit `n` (n ≥ 1).
Afficher les nombres de `1` à `n`, **un par ligne**.

Piège : inclure `n`.
Tests : `n=1`, `n=2`, `n=5`.

---

### Exercice 3 — Compte à rebours avant séance

On lit `n` (n ≥ 0).
Afficher de `n` jusqu’à `0`, **un par ligne**.

Piège : si `n=0`, il faut afficher `0` une fois.
Tests : `n=0`, `n=1`, `n=3`.

---

### Exercice 4 — Tickets pairs seulement

On lit `n` (n ≥ 0).
Afficher tous les nombres **pairs** entre `0` et `n` **inclus**, un par ligne.

Tests : `n=0`, `n=1`, `n=6`.

---

## Série 2 — Sommes, compteurs, moyennes

### Exercice 5 — Total d’un achat (prix entiers)

On lit `n` (nombre d’articles), puis `n` prix entiers.
Afficher :
`"total = X"`
où `X` est la somme.

Piège : `n=0` ⇒ total = 0.
Tests : `n=0`, `n=1 (prix 7)`, `n=3 (2,5,1)`.

---

### Exercice 6 — Compter les mineurs dans un groupe

On lit `n`, puis `n` âges.
Afficher :
`"mineurs = X"`
où `X` = nombre d’âges **strictement < 18**.

Tests : âges autour de 18 → `17`, `18`, `19`.

---

### Exercice 7 — Trouver l’âge maximum

On lit `n` (n ≥ 1), puis `n` âges.
Afficher :
`"max = X"`

Piège : initialiser `max` avec le **premier** âge, pas 0 (sinon faux si âges négatifs — même si rare).
Tests : `n=1`, `n=3 (12, 64, 13)`.

---

### Exercice 8 — Moyenne des notes (sur 5)

On lit `n` (n ≥ 1), puis `n` notes (réels possibles).
Afficher :
`"moyenne = X"`
(affiche juste le résultat, pas besoin d’arrondir imposé).

Piège : somme en réel.
Tests : `n=1`, `n=2 (2 et 4)`, `n=3 (1.5, 2, 4)`.

---

## Série 3 — Boucles “sentinelle” (on s’arrête quand on lit une valeur)

### Exercice 9 — Total jusqu’à 0

On lit des prix entiers **jusqu’à lire 0** (0 n’est pas compté).
Afficher :
`"total = X"`

Tests : `0` direct ; `5 0` ; `2 3 0`.

---

### Exercice 10 — Compter les entrées jusqu’à "stop"

On lit des mots (chaînes) un par un.
Tant que le mot n’est pas `"stop"`, on compte.
Afficher :
`"nb = X"`

Piège : `"stop"` n’est pas compté.
Tests : `stop` direct ; `a stop` ; `a b c stop`.

---

### Exercice 11 — Trouver le code promo 2026

On lit des entiers jusqu’à lire **2026**.
Afficher exactement :
`"promo ok"`

Piège : ne pas afficher avant de l’avoir lu.
Test : `2026` direct ; `1 2 2026`.

---

## Série 4 — Validation (répéter tant que c’est invalide)

### Exercice 12 — Heure valide (0..23)

On lit une heure `h`.
Tant que `h` n’est pas entre 0 et 23 inclus, afficher :
`"invalide"`
et relire `h`.
Quand c’est valide, afficher :
`"valide"`

Piège : boucle infinie si on ne relit pas.
Tests : `-1, 0` ; `24, 23` ; `10` direct.

---

### Exercice 13 — Minutes valides (0..59)

Même idée, avec `m` minutes (0..59).
Afficher `"invalide"` à chaque erreur, puis `"valide"` quand ok.

Tests : `60, 59` ; `-3, 0` ; `12`.

---

### Exercice 14 — Salle : places strictement positives

On lit `p` (places).
Tant que `p <= 0`, afficher `"erreur"` et relire.
Quand `p > 0`, afficher `"ok"`.

Tests : `0, 1` ; `-5, 10` ; `50`.

---

## Série 5 — Boucles + conditions (petits pièges)

### Exercice 15 — 3 essais pour le code promo

On donne **au maximum 3 essais** pour entrer le code `2026`.

* Si l’utilisateur entre `2026` dans les 3 essais : afficher `"promo ok"`.
* Sinon : afficher `"bloqué"`.

Piège : s’arrêter dès que c’est bon.
Tests : bon au 1er ; bon au 3e ; jamais bon.

---

### Exercice 16 — Compter les séances “matinée”

On lit `n`, puis `n` heures (0..23).
Compter combien sont **strictement < 12**.
Afficher :
`"matinées = X"`

Tests : `11`, `12`, `0`.

---

### Exercice 17 — Premier senior

On lit `n`, puis `n` âges.
Afficher `"trouvé"` dès qu’on rencontre un âge **>= 65**, sinon `"pas trouvé"`.

Piège : si on “trouve”, on peut arrêter la boucle.
Tests : senior en 1er ; senior au milieu ; aucun senior.

---

## Série 6 — Boucles imbriquées (grille / salle)

### Exercice 18 — Plan de salle (R lignes, C colonnes)

On lit `R` puis `C` (R ≥ 1, C ≥ 1).
Afficher un rectangle de `R` lignes, chaque ligne contient `C` fois le caractère `#` (sans espaces).

Exemple : R=2, C=4

```
####
####
```

Piège : bien revenir à la ligne à chaque rangée.

---

### Exercice 19 — Numérotation des sièges

On lit `R` et `C`.
Afficher `R` lignes. Sur la ligne `i` (de 1 à R), afficher :
`"rang i: C sièges"`

Exemple (R=3, C=5) :

* `rang 1: 5 sièges`
* `rang 2: 5 sièges`
* `rang 3: 5 sièges`

Piège : le compteur de rang commence à 1.

---

### Exercice 20 — Compter les sièges “VIP” (cases spéciales)

On lit `R` et `C`.
Un siège est VIP si **(rang + colonne)** est pair. (rang et colonne commencent à 1)
Compter combien de VIP dans la grille et afficher :
`"vip = X"`

Tests : petites grilles utiles : `1x1`, `1x2`, `2x2`, `2x3`.
