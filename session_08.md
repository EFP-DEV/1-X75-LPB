# Session 8 — Introduction à la programmation événementielle, aux `event listeners` et au DOM

## Objectif de la séance

Dans cette séance, vous allez comprendre ce qui permet à une page web de **réagir aux actions de l’utilisateur**.

Jusqu’ici, on a surtout écrit du JavaScript qui exécute des instructions dans l’ordre.
Mais dans une interface, le programme ne fait pas tout d’un coup. Il **attend** qu’un événement se produise :

* un clic sur un bouton,
* une saisie dans un champ,
* un survol,
* un changement dans un formulaire,
* le chargement de la page.

C’est cela, la **programmation événementielle** :
le code s’exécute **en réponse à un événement**.

Pour les exercices de cette séance, vous avez seulement besoin de comprendre :

* ce qu’est un événement,
* ce qu’est un écouteur d’événement (`event listener`),
* comment JavaScript retrouve un élément HTML,
* comment modifier le contenu affiché dans la page,
* comment relier une action utilisateur à une mise à jour de l’interface.

Le DOM sera approfondi plus tard. Ici, on ne voit que l’essentiel pour rendre une interface interactive.

---

## 1. Une page HTML n’est pas seulement du texte

Quand le navigateur lit votre HTML, il construit une représentation interne de la page.
Cette représentation s’appelle le **DOM**.

DOM signifie **Document Object Model**.

On peut le voir comme une version JavaScript de la page HTML, organisée en éléments :

* un `<section>`
* un `<h1>`
* un `<p>`
* un `<button>`
* etc.

Chaque élément devient un objet que JavaScript peut :

* retrouver,
* lire,
* modifier,
* écouter.

Exemple :

```html
<p>Valeur : <strong id="count">0</strong></p>
<button id="btn-increment">Ajouter 1</button>
```

Ici, le navigateur crée notamment :

* un élément `strong` avec l’identifiant `count`
* un élément `button` avec l’identifiant `btn-increment`

Grâce à cela, JavaScript peut les manipuler.

---

## 2. Pourquoi on donne un `id` aux éléments

Pour agir sur un élément HTML en JavaScript, il faut pouvoir le retrouver.

L’un des moyens les plus simples est d’utiliser un `id`.

Exemple :

```html
<strong id="count">0</strong>
<button id="btn-increment">Ajouter 1</button>
```

Puis en JavaScript :

```js
let display = document.getElementById('count');
let action = document.getElementById('btn-increment');
```

### Ce que cela signifie

* `document` représente la page HTML
* `getElementById(...)` cherche un élément par son identifiant
* `display` contient l’élément qui affiche le nombre
* `action` contient le bouton

On ne récupère pas le texte directement.
On récupère **l’élément HTML lui-même**.

---

## 3. Qu’est-ce qu’un événement

Un **événement** est quelque chose qui se produit dans la page.

Exemples fréquents :

* `click` : l’utilisateur clique
* `input` : l’utilisateur tape dans un champ
* `change` : une valeur change
* `submit` : un formulaire est envoyé
* `keydown` : une touche du clavier est pressée

Dans vos exercices, l’événement principal est :

```js
'click'
```

Cela veut dire :
“quand l’utilisateur clique sur cet élément”.

---

## 4. Qu’est-ce qu’un `event listener`

Un `event listener` est un **écouteur d’événement**.

Il sert à dire au navigateur :

> “Surveille cet élément, et si tel événement se produit, exécute ce code.”

Syntaxe générale :

```js
element.addEventListener('click', action);
```

Décomposition :

* `element` : l’élément HTML à surveiller
* `addEventListener(...)` : ajoute un écouteur
* `'click'` : le type d’événement
* `action` : le code à exécuter quand l’événement se produit

Exemple :

```js
action.addEventListener('click', function () {
  count = count + 1;
  display.textContent = count;
});
```

Cela veut dire :

* on surveille le bouton `action`
* si l’utilisateur clique dessus
* alors on exécute la fonction fournie

---

## 5. Le rôle de la fonction dans un événement

Quand on écrit :

```js
action.addEventListener('click', function () {
  count = count + 1;
  display.textContent = count;
});
```

la fonction contient les instructions à exécuter **au moment du clic**.

C’est très important :
on ne veut pas exécuter ce code tout de suite au chargement de la page.
On veut l’exécuter **plus tard**, quand l’événement arrive.

La fonction sert donc de **réponse à l’événement**.

On peut écrire cette réponse de deux façons.

### Forme directe

```js
action.addEventListener('click', function () {
  count = count + 1;
  display.textContent = count;
});
```

### Forme avec fonction nommée

```js
function increment() {
  count = count + 1;
  display.textContent = count;
}

action.addEventListener('click', increment);
```

Dans les deux cas, le principe est le même :

* l’utilisateur clique,
* la fonction s’exécute,
* l’interface change.

---

## 6. Modifier l’interface avec `textContent`

Une fois qu’on a retrouvé un élément HTML, on peut changer son contenu texte.

Exemple :

```js
display.textContent = count;
```

`textContent` permet de définir le texte contenu dans l’élément.

Si `count` vaut `4`, alors :

```js
display.textContent = count;
```

affichera `4` dans l’élément.

C’est ce qui permet de **mettre à jour visuellement la page**.

Sans cela, la variable changerait en mémoire, mais l’utilisateur ne verrait rien.

---

## 7. La chaîne complète d’une interface interactive

Dans vos exercices, il faut bien voir la logique complète :

1. une variable stocke une valeur,
2. un élément HTML affiche cette valeur,
3. un bouton est surveillé,
4. un clic déclenche du code,
5. ce code modifie la variable,
6. l’interface est mise à jour.

Exemple :

```js
let count = 0;

let display = document.getElementById('count');
let action = document.getElementById('btn-increment');

action.addEventListener('click', function () {
  count = count + 1;
  display.textContent = count;
});
```

Lecture du code :

* `count` commence à `0`
* `display` correspond à la zone d’affichage
* `action` correspond au bouton
* quand on clique sur le bouton :

  * `count` augmente
  * le texte affiché est remplacé par la nouvelle valeur

---

## 8. Différence entre l’état et l’affichage

Dans une interface, il faut distinguer deux choses :

### L’état

C’est ce que le programme mémorise.

Exemple :

```js
let count = 0;
```

### L’affichage

C’est ce que l’utilisateur voit dans la page.

Exemple :

```js
display.textContent = count;
```

L’état est dans les variables JavaScript.
L’affichage est dans le HTML mis à jour par JavaScript.

Cette distinction est fondamentale.

Une erreur fréquente consiste à croire que changer le texte dans la page suffit.
En réalité, il faut aussi garder une valeur correcte dans les variables.

---

## 9. Pourquoi introduire des fonctions

Dans l’étape 2, vous utilisez deux fonctions :

```js
function updateUI() {
  display.textContent = count;
}

function increment() {
  count = count + 1;
  updateUI();
}
```

Cela permet de mieux organiser le code.

### `updateUI()`

Cette fonction s’occupe uniquement de l’affichage.

### `increment()`

Cette fonction s’occupe de la logique métier ici : augmenter la valeur.

Cette séparation est utile parce qu’elle évite de mélanger tous les rôles dans un seul bloc.

Au lieu de tout écrire dans le `click`, on distribue les responsabilités :

* une fonction change les données,
* une fonction met à jour l’interface.

C’est une première étape vers un code plus clair et plus facile à modifier.

---

## 10. Un événement peut déclencher autre chose qu’un simple compteur

Dans les étapes suivantes, vous ne gérez plus un seul nombre.

Vous devez parfois :

* modifier plusieurs variables,
* recalculer un total,
* mettre à jour plusieurs éléments HTML,
* afficher un message différent selon la situation,
* réinitialiser tout l’état.

Cela reste pourtant le même principe :

* un événement arrive,
* une fonction s’exécute,
* l’état change,
* l’interface se met à jour.

Exemple de logique possible :

* clic sur `+1` → augmente `count1`
* clic sur `+5` → augmente `count5`
* recalcul du total
* affichage d’un message selon le total atteint

La page devient plus riche, mais le mécanisme reste identique.

---

## 11. Un même programme peut écouter plusieurs boutons

Rien n’empêche d’avoir plusieurs écouteurs dans une même page.

Exemple :

```js
btnAdd1.addEventListener('click', addOne);
btnAdd5.addEventListener('click', addFive);
btnReset.addEventListener('click', resetAll);
```

Chaque bouton peut avoir son propre comportement.

Cela permet de construire un mini tableau de bord avec plusieurs actions possibles.

Dans vos exercices, c’est exactement ce qui se passe :

* un bouton pour une action,
* un autre bouton pour une autre action,
* parfois un bouton de remise à zéro.

---

## 12. Le message dynamique : une interface qui parle

Dans certaines étapes, vous ajoutez un message comme :

```html
<p id="message" role="status" aria-live="polite"></p>
```

Puis en JavaScript :

```js
message.textContent = 'Objectif atteint';
```

Ce texte n’est pas figé dans le HTML.
Il change selon l’état du programme.

C’est un exemple simple d’interface dynamique.

L’intérêt n’est pas seulement visuel.
Avec `role="status"` et `aria-live="polite"`, le changement peut aussi être annoncé par certaines technologies d’assistance.

Cela rend l’interface plus accessible.

---

## 13. Pourquoi placer le script au bon moment

Pour récupérer un élément avec :

```js
document.getElementById(...)
```

il faut que cet élément existe déjà dans la page.

Si le script s’exécute trop tôt, JavaScript peut chercher un élément qui n’a pas encore été chargé.

Dans vos exercices simples, on suppose généralement que le script est placé **après le HTML**, ou chargé correctement.

L’idée à retenir ici est seulement la suivante :

JavaScript ne peut manipuler que des éléments que le navigateur connaît déjà.

---

## 14. Ce qu’il faut retenir pour les exercices

Pour réussir cette séance, il faut surtout maîtriser ce schéma :

### 1. Récupérer les éléments HTML

```js
let display = document.getElementById('count');
let action = document.getElementById('btn-increment');
```

### 2. Stocker l’état dans des variables

```js
let count = 0;
```

### 3. Écouter une action utilisateur

```js
action.addEventListener('click', increment);
```

### 4. Modifier les variables

```js
count = count + 1;
```

### 5. Mettre à jour l’affichage

```js
display.textContent = count;
```

---

## 15. Résumé minimal

La programmation événementielle consiste à écrire du code qui s’exécute **quand quelque chose se passe**.

Le DOM est la représentation de la page HTML que JavaScript peut manipuler.

`document.getElementById(...)` permet de récupérer un élément.

`addEventListener(...)` permet d’écouter un événement comme un clic.

Une fonction liée à un événement sert à définir la réaction du programme.

`textContent` permet de modifier ce qui est affiché dans la page.

Dans vos exercices, tout repose sur cette logique :

* l’utilisateur clique,
* JavaScript réagit,
* les données changent,
* l’interface se met à jour.

---

## 16. Pour la suite

Dans cette séance, on utilise le DOM de manière très simple :

* récupérer un élément,
* écouter un clic,
* changer un texte.

Plus tard, on ira plus loin avec :

* la navigation dans le DOM,
* la création d’éléments,
* les attributs,
* les classes CSS,
* la délégation d’événements,
* les formulaires plus complexes.

Ici, le but est seulement de comprendre le socle nécessaire pour construire vos premiers composants interactifs.
