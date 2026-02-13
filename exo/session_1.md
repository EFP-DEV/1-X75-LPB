# Exercices : Les tests

## Série 3 : Conditions simples

### Exercice 3.1
Écrire un algorithme qui demande un nombre à l'utilisateur et l'informe si ce nombre est positif ou négatif (on ne traite pas le zéro).

---

### Exercice 3.2
Écrire un algorithme qui demande deux nombres à l'utilisateur et l'informe si leur produit est négatif ou positif (on ignore le cas où le produit est nul).

**Contrainte** : on ne doit pas calculer le produit.

---

### Exercice 3.3
Écrire un algorithme qui demande trois noms à l'utilisateur et l'informe s'ils sont triés dans l'ordre alphabétique ou non.

Les noms identiques sont considérés comme triés.

---

### Exercice 3.4
Reprendre l'exercice 3.1 en incluant le traitement du cas où le nombre vaut zéro.

---

### Exercice 3.5
Reprendre l'exercice 3.2 en incluant le traitement du cas où le produit peut être nul.

**Contrainte** : on ne doit toujours pas calculer le produit.

---

### Exercice 3.6
Un club de sport classe ses jeunes membres par catégorie :

| Catégorie | Âge |
|-----------|-----|
| Poussin | 6-7 ans |
| Pupille | 8-9 ans |
| Minime | 10-11 ans |
| Cadet | 12 ans et + |

Écrire un algorithme qui demande l'âge d'un enfant et affiche sa catégorie.

Questions (APRES ECRITURE DU PROGRAMME):
- Peut-on concevoir plusieurs algorithmes équivalents ?
- Peut-on l'ecrire sans composition ?
- Que faire si l'enfant a moins de 6 ans ?
- Combien de modification si les tranches deviennent

| Catégorie | Âge |
|-----------|-----|
| Poussin | 6-8 ans |
| Pupille | 9-11 ans |
| Minime | 12-14 ans |
| Cadet | 15 ans et + |

Si la reponse est "plus que 1 par categorie", reecrire le code

EXO BONUS (Partie 1)
---

### Exercice 3.7
Écrire un algorithme qui demande l'âge d'un utilisateur et indique s'il peut conduire (18 ans ou plus) ou non.

---

### Exercice 3.8
Écrire un algorithme qui demande une note sur 20 et affiche :
- "Échec" si la note est inférieure à 10
- "Réussite" sinon

---

### Exercice 3.9
Écrire un algorithme qui demande la température extérieure et affiche :
- "Glacial" si température ≤ 0
- "Froid" si température entre 1 et 10
- "Agréable" si température entre 11 et 25
- "Chaud" si température > 25

---

### Exercice 3.10
Un cinéma applique un tarif réduit pour les moins de 14 ans et les 65 ans et plus. Écrire un algorithme qui demande l'âge du client et affiche "Tarif réduit" ou "Plein tarif".

---

### Exercice 3.11
Écrire un algorithme qui demande un numéro de mois (1-12) et affiche la saison correspondante :
- Hiver : 12, 1, 2
- Printemps : 3, 4, 5
- Été : 6, 7, 8
- Automne : 9, 10, 11


# Exo Bonus (Partie 2)

## Série — Cinéma : mini‑exercices sur les conditions

**Consigne générale (valable pour tous les exercices)**
Pour chaque exercice, écrire un algorithme (ou un programme) qui :

1. lit les données demandées,
2. applique la règle,
3. affiche **exactement** le message demandé.

> Conseil : pour chaque exercice, tester systématiquement **la valeur juste avant**, **la valeur exacte**, **la valeur juste après**.

---

### Exercice 1 — Majeur ou mineur

On demande l’âge d’un client.
Afficher :

* `"mineur"` si l’âge est **strictement inférieur** à 18,
* `"majeur"` sinon.

---

### Exercice 2 — Film interdit aux moins de 12 ans

On demande l’âge d’un client qui veut entrer voir un film interdit aux moins de 12 ans.
Afficher :

* `"refusé"` si l’âge est **strictement inférieur** à 12,
* `"accepté"` sinon.

---

### Exercice 3 — Remise de groupe

On demande le nombre de billets achetés.
Afficher :

* `"remise"` si le client achète **au moins** 5 billets,
* `"pas de remise"` sinon.

---

### Exercice 4 — Séance du matin

On demande l’heure de début d’une séance (entre 0 et 23).
Afficher :

* `"matinée"` si l’heure est **strictement inférieure** à 12,
* `"normale"` sinon.

---

### Exercice 5 — Code promotionnel exact

On demande un code promotionnel (un entier).
Afficher :

* `"promo ok"` si le code vaut **exactement** 2026,
* `"promo non"` sinon.

---

### Exercice 6 — La séance a déjà commencé ?

On demande le nombre de minutes avant le début de la séance.
Ce nombre peut être **négatif** (si la séance a déjà commencé).
Afficher :

* `"séance commencée"` si le nombre de minutes est **inférieur ou égal** à 0,
* `"pas encore"` sinon.

---

### Exercice 7 — Catégorie du spectateur

On demande l’âge d’un client.
Afficher :

* `"enfant"` si l’âge est **inférieur ou égal** à 13,
* `"adulte"` si l’âge est compris entre **14 et 64 inclus**,
* `"senior"` si l’âge est **supérieur ou égal** à 65.

*(Attention aux limites 13/14 et 64/65.)*

---

### Exercice 8 — Taille de la salle

On demande le nombre de places d’une salle.
Afficher :

* `"petite"` si le nombre de places est **inférieur ou égal** à 50,
* `"moyenne"` si le nombre de places est compris entre **51 et 150 inclus**,
* `"grande"` si le nombre de places est **strictement supérieur** à 150.

---

### Exercice 9 — Confort de la salle (température)

On demande la température dans la salle (en °C).
Afficher :

* `"trop froid"` si la température est **strictement inférieure** à 18,
* `"confort"` si elle est comprise entre **18 et 24 inclus**,
* `"trop chaud"` si elle est **strictement supérieure** à 24.

---

### Exercice 10 — Avis du spectateur (note sur 5)

On demande une note sur 5 (nombre réel possible).
Afficher :

* `"mauvais"` si la note est **strictement inférieure** à 2,
* `"bien"` si la note est comprise entre **2 inclus** et **4 exclu**,
* `"excellent"` si la note est **supérieure ou égale** à 4.

*(Attention : 4.0 doit être “excellent”, pas “bien”.)*

---

### Exercice 11 — Moment de la journée

On demande une heure (0..23).
Afficher :

* `"matin"` si l’heure est **strictement inférieure** à 12,
* `"après-midi"` si l’heure est comprise entre **12 inclus** et **18 exclu**,
* `"soir"` si l’heure est **supérieure ou égale** à 18.

---

### Exercice 12 — Longueur de la file d’attente

On demande le nombre de personnes dans la file (entier).
Afficher :

* `"aucune attente"` si le nombre vaut **0**,
* `"attente courte"` si le nombre est compris entre **1 et 5 inclus**,
* `"attente longue"` si le nombre est **strictement supérieur** à 5.

---

## Série 2 — Deux informations (AND / OR + pièges)

### Exercice 13 — Tarif : enfant, étudiant ou standard

On demande :

* l’âge du client,
* s’il possède une carte étudiant (`"oui"` ou `"non"`).

Afficher :

* `"enfant"` si l’âge est **strictement inférieur** à 14,
* sinon `"étudiant"` si l’âge est compris entre **14 et 25 inclus** **ET** que la carte étudiant vaut `"oui"`,
* sinon `"standard"`.

*(Attention : si le client a 13 ans et une carte étudiant, il reste “enfant”.)*

---

### Exercice 14 — Promotion “senior le matin”

On demande :

* l’âge du client,
* l’heure de la séance (0..23).

Afficher :

* `"promo"` si le client a **65 ans ou plus** **ET** si la séance commence **avant 12h**,
* `"pas promo"` sinon.

---

### Exercice 15 — Film “-16” avec accompagnateur

On demande :

* l’âge du client,
* s’il est accompagné par un adulte (`"oui"` ou `"non"`).

Règle d’entrée :

* le client est accepté s’il a **16 ans ou plus**,
* sinon il est accepté s’il a **au moins 12 ans** **ET** s’il est accompagné,
* sinon il est refusé.

Afficher `"accepté"` ou `"refusé"`.

*(Piège : 12 accompagné = accepté ; 11 accompagné = refusé.)*

---

### Exercice 16 — Séance 3D : refus, 3D ou 2D

On demande :

* l’âge du client,
* s’il a des lunettes 3D (`"oui"` / `"non"`).

Afficher :

* `"refusé"` si l’âge est **strictement inférieur** à 6,
* sinon `"3D"` si le client a des lunettes 3D,
* sinon `"2D"`.

---

### Exercice 17 — Vérification d’un horaire

On demande une heure `h` et des minutes `m`.
Afficher :

* `"valide"` si `h` est entre **0 et 23 inclus** **ET** si `m` est entre **0 et 59 inclus**,
* `"invalide"` sinon.

---

### Exercice 18 — Séance complète, sauf VIP

On demande :

* le nombre de places restantes (entier),
* si le client est VIP (`"oui"` / `"non"`).

Afficher :

* `"accès"` si le nombre de places restantes est **strictement supérieur** à 0,
* `"accès vip"` si le nombre de places restantes vaut **0** et si le client est VIP,
* `"complet"` si le nombre de places restantes vaut **0** et si le client n’est pas VIP,
* `"erreur"` si le nombre de places restantes est **négatif**.

