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
* 
### Règles commerciales — Tarifs d’assurance auto (couleurs)

L’assurance propose quatre niveaux de tarif, du plus avantageux au plus cher : **bleu**, **vert**, **orange**, **rouge**.
Selon le profil du conducteur, la demande est **acceptée** avec une couleur, ou **refusée**.

#### 1) Profil “jeune conducteur débutant”

Si le conducteur a **moins de 35 ans** et son permis date de **moins de 2 ans** :

* il est **assuré au tarif rouge** uniquement s’il n’a **aucun accident responsable** ;
* sinon, le dossier est **refusé**.

#### 2) Profil “intermédiaire”

Si le conducteur est :

* soit **moins de 35 ans** avec un permis de **2 ans ou plus**,
* soit **35 ans ou plus** avec un permis de **moins de 2 ans**,

alors :

* **0 accident responsable** → **tarif orange**
* **1 accident responsable** → **tarif rouge**
* **au-delà** → **refusé**

#### 3) Profil “expérimenté”

Si le conducteur a **35 ans ou plus** et un permis de **2 ans ou plus** :

* **0 accident responsable** → **tarif vert**
* **1 accident responsable** → **tarif orange**
* **2 accidents responsables** → **tarif rouge**
* **au-delà** → **refusé**

---

### Avantage fidélité

Si le dossier est **accepté** et que le conducteur est client depuis **plus d’un an**, il bénéficie d’un **tarif immédiatement plus avantageux** (une couleur au-dessus : rouge → orange → vert → bleu), sans pouvoir dépasser le **bleu**.

