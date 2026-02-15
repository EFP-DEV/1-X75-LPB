# Exercices extra — Cinéma (répétition + pièges)

Ces exercices sont faits pour **progresser même quand c’est difficile**.

Ils sont volontairement **courts** et **répétitifs** : on refait la même idée plusieurs fois, avec de petits changements.
L’objectif est de rendre les conditions **automatiques**, comme un réflexe.

## Comment bien réussir ces exercices (méthode)

### 1) Mets-toi en situation

Avant de coder, imagine la scène :

* « Je suis à la caisse du cinéma »
* « Je dois décider : accepté / refusé »
* « Je dois afficher un message exact »

Ça aide ton cerveau à comprendre **la logique** avant de penser au code.

### 2) Écris la règle en français simple

Avant l’algorithme, écris 1–2 lignes :

* « Si l’âge est < 12 → refusé. Sinon → accepté. »
  Ça évite de partir dans tous les sens.

### 3) Fais une mini-table de tests (obligatoire)

Pour chaque exercice, écris **au moins 3 tests** :

* la valeur **juste avant** la limite
* la valeur **exacte**
* la valeur **juste après**

Exemple (limite 12 ans) : `11`, `12`, `13`

➡️ Si tu fais ça, tu repères tout de suite les pièges (`<` vs `<=`, bornes incluses/exclues).

### 4) Commence par l’affichage exact

Ces exercices demandent un message **exact** (mots, accents, espaces).
Décide d’abord ce que tu dois afficher, puis écris la condition.

### 5) Une seule chose à la fois

Ne cherche pas à faire “intelligent”.
Fais simple :

* **Lire**
* **Tester**
* **Afficher**

### 6) Si tu bloques : fais un dessin de décision

Dessine une flèche :

* « condition ? »

  * oui → message A
  * non → message B

Ça transforme le problème en **choix binaire** clair.

### 7) Astuce anti-erreurs

Quand tu as une condition du type :

* “entre 18 et 24 inclus”

Tu peux la traduire en :

* `>= 18` **ET** `<= 24`

Et tu testes les bornes :

* `17`, `18`, `24`, `25`

---


## Série 3 — Mini-exercices sur les conditions

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

## Série 2 — Deux informations (ET / OU + pièges)

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

