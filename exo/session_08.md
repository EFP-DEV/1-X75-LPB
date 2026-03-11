# Session 8 — Exercice Micro-Tracker

## Consigne générale

Vous allez réaliser ce travail dans un **repository Git**.

Contraintes minimales :

* créez un repository pour l’exercice ;
* faites **au moins un commit par étape** ;
* chaque commit doit correspondre à un état propre et fonctionnel ;
* le message de commit doit décrire clairement l’étape réalisée.

Exemples :

* `Étape 1 - compteur simple`
* `Étape 2 - compteur structuré`
* `Étape 3 - deux actions et total`
* `Étape 4 - micro-tracker complet`

Le but est de construire progressivement une interface interactive, tout en gardant une trace claire de votre progression.

---

## Objectif général

Vous allez construire, en quatre étapes progressives, un **micro-tracker d’actions quotidiennes**.

Vous devrez pratiquer :

* la liaison entre HTML et JavaScript ;
* la réaction à un clic ;
* la mise à jour de l’interface ;
* l’organisation du code ;
* la gestion de plusieurs compteurs ;
* le calcul d’un total ;
* l’affichage d’un message dynamique ;
* la réinitialisation d’un tableau de bord simple.

Chaque étape doit produire un résultat fonctionnel.

---

# Étape 1 — Un compteur simple

Le but est de faire réagir l’interface à un clic.

Vous créez une interface minimale avec une valeur affichée et un bouton qui permet d’augmenter cette valeur.

**Dans un fichier JavaScript lié à cette page :**

1. créez une variable qui stocke la valeur du compteur ;
2. récupérez l’élément qui affiche la valeur ;
3. récupérez le bouton ;
4. ajoutez un écouteur d’événement sur le bouton ;
5. à chaque clic :

   * augmentez la valeur,
   * mettez à jour l’affichage.

## Contraintes

* n’utilisez pas de fonction déclarée séparément ;
* écrivez directement le traitement dans l’écouteur d’événement ;
* utilisez seulement les notions déjà vues.

## Résultat attendu

* la page affiche `0` au départ ;
* chaque clic ajoute `1` ;
* la valeur affichée reste correcte après chaque clic.

## Commit attendu

Quand l’étape fonctionne, faites un commit.

---

# Étape 2 — Compteur structuré

Vous reprenez la même interface, le meme code HTML, mais vous organisez votre code de manière plus claire.

**Dans votre fichier JavaScript :**

1. gardez une variable pour l’état du compteur ;
2. récupérez l’affichage et le bouton ;
3. créez une fonction `updateUI()` qui met à jour l’affichage ;
4. créez une fonction `increment()` qui augmente la valeur puis appelle `updateUI()` ;
5. reliez le bouton à la fonction `increment()`.

## Contraintes

* le code doit être découpé en fonctions ;
* l’affichage doit être mis à jour par une fonction dédiée ;
* le comportement final doit rester le même qu’à l’étape 1.

## Résultat attendu

* le compteur fonctionne comme avant ;
* le code est mieux organisé ;
* chaque rôle est séparé clairement.

## Commit attendu

Quand l’étape fonctionne, faites un commit.

---

# Étape 3 — Deux actions, total, message

Vous passez maintenant à une interface plus riche.

Vous allez gérer :

* deux boutons ;
* deux compteurs distincts ;
* un total ;
* un message dynamique.

**Dans votre fichier JavaScript :**

1. créez deux variables d’état ;
2. récupérez tous les éléments utiles du HTML ;
3. créez une fonction `updateUI()` qui :

   * met à jour les deux compteurs,
   * calcule le total,
   * affiche le total,
   * affiche un message selon la progression ;
4. créez une fonction pour le bouton `Ajouter 1` ;
5. créez une fonction pour le bouton `Ajouter 5` ;
6. reliez chaque bouton à la bonne fonction.

## Exemple de logique possible pour le message

Vous pouvez choisir vos propres règles. Par exemple :

* total = `0` → message de départ ;
* total inférieur à `10` → message d’encouragement ;
* total à partir de `10` → objectif atteint.

## Résultat attendu

* `Ajouter 1` modifie seulement le premier compteur ;
* `Ajouter 5` modifie seulement le second compteur ;
* le total est recalculé automatiquement ;
* le message change selon l’état courant.

## Commit attendu

Quand l’étape fonctionne, faites un commit.

---

# Étape 4 — Mini tableau de bord complet

Pour cette étape, **HTML est fourni** et ne **peut pas etre modifié**.
Le JavaScript est entièrement à écrire par vous-même.

Vous devez construire un micro-tracker complet avec :

* trois compteurs indépendants ;
* un total ;
* un message dynamique ;
* un bouton de réinitialisation.

## HTML fourni

```html
<section aria-labelledby="tracker-title">
  <h1 id="tracker-title">Micro-Tracker</h1>

  <article>
    <h2>Soleil</h2>
    <p>Minutes : <strong id="sun-value">0</strong></p>
    <button id="btn-sun">+1</button>
  </article>

  <article>
    <h2>Eau</h2>
    <p>Verres : <strong id="water-value">0</strong></p>
    <button id="btn-water">+1</button>
  </article>

  <article>
    <h2>Pause</h2>
    <p>Moments : <strong id="break-value">0</strong></p>
    <button id="btn-break">+1</button>
  </article>

  <p>Total : <strong id="total-value">0</strong></p>
  <p id="goal-message" role="status" aria-live="polite"></p>

  <button id="btn-reset">Réinitialiser</button>
</section>
```

**Écrivez seul le JavaScript nécessaire pour :**

1. créer les variables d’état ;
2. récupérer les éléments HTML utiles ;
3. gérer les clics sur les trois boutons d’ajout ;
4. calculer et afficher le total ;
5. afficher un message dynamique selon la progression ;
6. gérer le bouton de réinitialisation ;
7. garder une structure de code claire.

## Contraintes

* aucun JavaScript n’est fourni ;
* vous devez choisir vous-même les noms de variables et de fonctions ;
* le code doit rester lisible et cohérent ;
* le résultat doit être entièrement fonctionnel.

## Résultat attendu

* chaque bouton augmente uniquement son propre compteur ;
* le total correspond à la somme des trois valeurs ;
* le message évolue selon la progression ;
* le bouton `Réinitialiser` remet tout à zéro ;
* l’interface reste correcte après chaque action.

## Commit attendu

Quand l’étape fonctionne, faites un commit.

---

# Résultat final attendu

À la fin du travail, votre repository doit contenir :

* une progression claire en quatre étapes ;
* au moins un commit propre par étape ;
* une interface HTML sémantique et lisible ;
* des interactions JavaScript fonctionnelles ;
* un mini tableau de bord interactif complet.

---

# Questions de réflexion

À la fin de l’exercice, répondez par écrit aux questions suivantes :

1. Si je devais gérer 10 ou 30 actions au lieu de 3, mon code resterait-il aussi simple ?

2. Quelles parties de mon code deviennent répétitives quand j’ajoute de nouveaux boutons ou de nouveaux compteurs ?

3. Est-ce que je pourrais ajouter une nouvelle action facilement, ou devrais-je modifier beaucoup de lignes ?

4. Est-ce que mon code sépare bien :

   * les valeurs,
   * les actions,
   * la mise à jour de l’affichage ?

5. Si je voulais refaire le même exercice avec un autre thème, mon code serait-il facile à adapter ?

6. Quelle est, selon moi, la principale limite de ma solution actuelle ?
