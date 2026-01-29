## Exercices — Série 4 : IF avancés

### Exercice 4.1 — +1 minute 

**But**
Écrire un algorithme qui lit une heure et des minutes (valeurs supposées valides), puis affiche l’heure exacte **une minute plus tard**.

**Données à lire**

* `h` : heure (0 à 23)
* `m` : minutes (0 à 59)

**Résultat attendu**
Afficher une phrase du type :
`Dans une minute, il sera h heure(s) m`

**Exemple**
Entrée : `21` puis `32`
Sortie : `Dans une minute, il sera 21 heure(s) 33`

---

### Exercice 4.2 — +1 seconde (heure, minutes, secondes)

**But**
Lire une heure complète (heures, minutes, secondes) et afficher l’heure **une seconde plus tard**.

**Données à lire**

* `h` : heure
* `m` : minutes
* `s` : secondes
  (On les suppose valides.)

**Résultat attendu**
Afficher une phrase du type :
`Dans une seconde, il sera h heure(s), m minute(s) et s seconde(s)`

**Exemple**
Entrée : `21`, `32`, `8`
Sortie : `Dans une seconde, il sera 21 heure(s), 32 minute(s) et 9 seconde(s)`

---

### Exercice 4.3 — Facture de photocopies (tarifs par tranches)

**But**
Un magasin facture les photocopies selon une tarification par tranches. Écrire un algorithme qui demande le nombre de photocopies et affiche le montant total.

**Tarifs**

* 0,20 € pour chacune des **10 premières** photocopies
* 0,10 € pour chacune des **20 suivantes**
* 0,05 € pour toutes les photocopies **au-delà**

**Données à lire**

* `n` : nombre de photocopies

**Résultat attendu**
Afficher la facture correspondante (montant en euros).

---

### Exercice 4.4 — Droit de vote sur K-Pax (genre + âge)

**But**
Sur K-Pax, les règles de vote ne ressemblent pas à celles de la Terre. Écrire un algorithme qui lit l’âge et le genre d’un habitant, puis annonce s’il peut voter.

**Règles**

* Les **Draxx** de plus de **1835 ans** ne peuvent pas voter.
* Les **Sklounst** entre **18 et 35 ans** ne peuvent pas voter.
* **Tous les autres** couples (genre, âge) peuvent voter.

**Données à lire**

* `age` : âge de l’habitant
* `genre` : chaîne de caractères (exemples : `"Draxx"`, `"Sklounst"`, ou autre)

**Résultat attendu**
Afficher clairement :

* soit “peut voter”
* soit “ne peut pas voter”

---

### Exercice 4.5 — Élection à 4 candidats (analyse du candidat n°1)

**But**
Écrire un algorithme qui lit les scores du premier tour (en %) de 4 candidats, puis établit **uniquement** la situation du **candidat n°1**.

**Règles électorales**

* Si un candidat obtient **strictement plus de 50%**, il est élu au premier tour.
* Sinon, un second tour est organisé.
* Pour participer au second tour, un candidat doit avoir obtenu **au moins 12,5%** au premier tour.

**Données à lire**

* `s1`, `s2`, `s3`, `s4` : scores en pourcentage

**Résultats possibles pour le candidat 1**
Afficher une seule phrase parmi :

* “élu”
* “battu”
* “ballottage favorable”
* “ballottage défavorable”

**Définition (ballottage favorable)**
Le ballottage est favorable si le candidat 1 participe au second tour en étant **arrivé en tête**, y compris **en cas d’égalité** avec un ou plusieurs candidats.

---

### Exercice 4.6 — Assurance auto (tarifs par profil + bonus fidélité)

**But**
Une assurance propose des tarifs identifiés par couleur, du moins au plus cher : **bleu, vert, orange, rouge**.
Écrire un algorithme qui saisit les informations d’un conducteur, puis affiche :

* soit la **couleur du tarif**
* soit “refusé” si l’assurance refuse de couvrir le client.

**Données à saisir**

* `age` : âge du conducteur
* `permis` : nombre d’années depuis l’obtention du permis
* `accidents` : nombre d’accidents responsables
* `anciennete` : nombre d’années dans la compagnie

**Règles (décision principale)**

1. Conducteur **< 35 ans** ET permis **< 2 ans** :

* tarif **rouge** si **0 accident**, sinon **refusé**

2. Conducteur **< 35 ans** ET permis **≥ 2 ans**, OU conducteur **≥ 35 ans** ET permis **< 2 ans** :

* tarif **orange** si **0 accident**
* tarif **rouge** si **1 accident**
* sinon **refusé**

3. Conducteur **≥ 35 ans** ET permis **≥ 2 ans** :

* tarif **vert** si **0 accident**
* tarif **orange** si **1 accident**
* tarif **rouge** si **2 accidents**
* sinon **refusé**

**Bonus fidélité**
Si le conducteur est **accepté** et qu’il est dans la compagnie depuis **plus d’un an**, alors il obtient un contrat **d’une couleur immédiatement plus avantageuse**.

---

### Exercice 4.7 — Vérifier une date valide (jour/mois/année)

**But**
Écrire un algorithme qui lit un jour, un mois et une année, puis indique si la date est **valide**.

**Données à lire**

* `j` : jour
* `m` : mois
* `a` : année

**Résultat attendu**
Afficher :

* “date valide” ou “date invalide”

**Rappels**

* Les mois ont 30 ou 31 jours, sauf février.
* Février a 28 jours, **29** si l’année est **bissextile**.
* Une année est bissextile si :

  * elle est divisible par 4,
  * sauf si elle est divisible par 100,
  * mais elle redevient bissextile si elle est divisible par 400.

**Outil autorisé**
Pour tester la divisibilité : le pseudo-opérateur `dp` :
`A dp B` vaut VRAI si A est divisible par B.
