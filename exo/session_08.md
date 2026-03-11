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
* `Étape 2 - deux actions et total`
* `Étape 3 - micro-tracker complet`
* `Étape 4 - limites et boutons désactivés`

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
* la réinitialisation d’un tableau de bord simple ;
* la gestion d’une limite par action ;
* la désactivation d’un bouton selon l’état courant.

Chaque étape doit produire un résultat fonctionnel.

---

# Étape 1 — Un compteur simple

Le but est de faire réagir l’interface à un clic.

Vous créez une interface minimale avec une valeur affichée et un bouton qui permet d’augmenter cette valeur.

## Dans un fichier JavaScript lié à cette page

1. créez une variable qui stocke la valeur du compteur ;
2. récupérez l’élément qui affiche la valeur ;
3. récupérez le bouton ;
4. ajoutez un écouteur d’événement sur le bouton ;
5. à chaque clic :

   * augmentez la valeur ;
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

# Étape 2 — Deux actions et total

Vous passez maintenant à une interface un peu plus riche.

Vous allez gérer deux boutons qui modifient une même valeur totale.

## Dans votre fichier JavaScript

1. créez une variable pour stocker le total ;
2. récupérez l’élément qui affiche le total ;
3. récupérez les deux boutons ;
4. ajoutez un écouteur d’événement sur le bouton `Ajouter 1` ;
5. ajoutez un écouteur d’événement sur le bouton `Ajouter 5` ;
6. quand on clique sur un bouton :

   * modifiez la valeur du total ;
   * mettez à jour l’affichage.

## Contraintes

* n’utilisez pas de fonction déclarée séparément ;
* écrivez directement les traitements dans les écouteurs d’événement ;
* gardez un code lisible et cohérent.

## Résultat attendu

* `Ajouter 1` incrémente le total de `1` ;
* `Ajouter 5` incrémente le total de `5` ;
* la valeur affichée reste correcte après chaque clic.

## Commit attendu

Quand l’étape fonctionne, faites un commit.

---

# Étape 3 — Mini tableau de bord complet

Pour cette étape, **HTML est fourni** et ne **peut pas être modifié**.

Le JavaScript est entièrement à écrire par vous-même.

Vous devez construire un micro-tracker complet avec :

* trois compteurs indépendants ;
* un total ;
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
  <button id="btn-reset">Réinitialiser</button>
</section>
```

## Écrivez seul le JavaScript nécessaire pour

1. créer les variables d’état ;
2. récupérer les éléments HTML utiles ;
3. gérer les clics sur les trois boutons d’ajout ;
4. calculer et afficher le total ;
5. gérer le bouton de réinitialisation ;
6. garder une structure de code claire.

## Contraintes

* aucun JavaScript n’est fourni ;
* vous devez choisir vous-même les noms de variables ;
* le code doit rester lisible et cohérent ;
* le résultat doit être entièrement fonctionnel.

## Résultat attendu

* chaque bouton augmente uniquement son propre compteur ;
* le total correspond à la somme des trois valeurs ;
* le bouton `Réinitialiser` remet tout à zéro ;
* l’interface reste correcte après chaque action.

## Commit attendu

Quand l’étape fonctionne, faites un commit.

---

# Étape 4 — Limites par action et désactivation des boutons

Vous reprenez le micro-tracker de l’étape 3.

Cette fois, chaque action possède une **valeur maximale à atteindre**. Cette limite doit être visible dans l’interface.

Vous devez donc modifier le HTML existant pour faire apparaître, pour chaque action, la progression avec une valeur actuelle et une valeur maximale.

La nomenclature déjà en place doit être respectée. Vous ne changez pas les identifiants existants. Vous complétez seulement le HTML de manière cohérente avec la structure fournie.

## Contraintes

* vous devez modifier le HTML de l’étape 3 pour y faire apparaître les maximums ;
* vous devez respecter la nomenclature actuelle ;
* vous ne renommez pas les identifiants déjà fournis ;
* vous ne modifiez pas le sens des éléments existants ;
* le JavaScript doit rester lisible et cohérent ;
* le résultat doit être entièrement fonctionnel.

## Résultat attendu

* chaque bouton augmente uniquement son propre compteur ;
* chaque compteur affiche sa progression avec sa limite ;
* aucune valeur ne peut dépasser son maximum ;
* un bouton est désactivé quand son maximum est atteint ;
* le total correspond toujours à la somme des trois valeurs ;
* le bouton `Réinitialiser` remet tout à zéro et réactive les boutons ;
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

   * les valeurs ;
   * les actions ;
   * la mise à jour de l’affichage ?

5. Si je voulais refaire le même exercice avec un autre thème, mon code serait-il facile à adapter ?

6. Quelle est, selon moi, la principale limite de ma solution actuelle ?
