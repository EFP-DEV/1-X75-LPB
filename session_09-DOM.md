# Session 9 — Parcourir le DOM comme un arbre

## Objectif de la séance

Lors de la séance précédente, vous avez appris à :

* réagir à un clic
* récupérer un élément HTML
* modifier le texte affiché
* mettre à jour une interface simple

Nous utilisions surtout :

```js
document.getElementById(...)
```

Cette méthode est simple et très utile pour débuter.

Mais elle présente une limite importante :
elle suppose que **nous connaissons chaque élément individuellement**.

Dans une vraie interface, ce n’est pas toujours le cas.

---

# 1. Le DOM est une structure en arbre

Quand le navigateur lit votre HTML, il ne voit pas simplement une suite de lignes.

Il construit une **structure hiérarchique**.

Par exemple :

```html
<section>
  <article>
    <button>+1</button>
  </article>
</section>
```

Devient dans le DOM :

```
section
 └─ article
     └─ button
```

Chaque élément possède :

* un **parent**
* éventuellement des **enfants**
* des **éléments voisins**

On peut donc :

* descendre dans l’arbre
* remonter dans l’arbre
* chercher des éléments similaires

C’est ce qui permet d’écrire un code **plus générique**.

---

# 2. Limite de l’approche précédente

Dans la session 8, votre code ressemblait souvent à ceci :

```js
let sun = 0;
let water = 0;

let btnSun = document.getElementById('btn-sun');
let btnWater = document.getElementById('btn-water');
```

Chaque élément était récupéré **un par un**.

Si on ajoute un nouveau compteur, il faut :

* ajouter du HTML
* ajouter une variable
* ajouter un event listener
* ajouter du code pour mettre à jour l’interface

Le programme ne s’adapte pas automatiquement.

Le problème n’est pas JavaScript.
Le problème est **la manière dont on utilise le DOM**.

---

# 3. Une autre approche : travailler avec la structure

Au lieu de dire :

> “Donne-moi **ce bouton précis**”

On peut dire :

> “Donne-moi **tous les boutons de ce type**”

ou

> “Je sais sur quel bouton on a cliqué, trouve-moi **le composant auquel il appartient**.”

Cette approche repose sur trois outils fondamentaux :

* `querySelector()`
* `querySelectorAll()`
* `closest()`

---

# 4. `querySelector()` — chercher un élément

`querySelector()` permet de chercher **un élément dans le DOM** avec un sélecteur CSS.

Exemple :

```js
document.querySelector('button')
```

Renvoie **le premier bouton** trouvé.

On peut aussi chercher par classe :

```js
document.querySelector('.btn')
```

Ou par identifiant :

```js
document.querySelector('#zone-1')
```

Contrairement à `getElementById`, cette méthode utilise **les mêmes règles que CSS**.

---

# 5. Chercher à l’intérieur d’un élément

On peut aussi limiter la recherche à une partie du DOM.

Exemple :

```js
let zone = document.querySelector('#zone-2');

zone.querySelector('.btn');
```

JavaScript cherche seulement **dans cette zone**.

Cela permet de travailler **par composant**.

---

# 6. `closest()` — remonter dans l’arbre

Si on connaît un élément, on peut chercher **son parent logique**.

Exemple :

```js
let btn = document.querySelector('.btn');
btn.closest('article');
```

JavaScript remonte dans l’arbre jusqu’à trouver un `article`.

On peut donc dire :

> “Ce bouton appartient à quel composant ?”

C’est extrêmement utile pour gérer les interfaces.

---

# 7. `querySelectorAll()` — chercher plusieurs éléments

`querySelectorAll()` permet de récupérer **tous les éléments correspondant à un sélecteur**.

```js
let buttons = document.querySelectorAll('.btn');
```

Cette instruction renvoie une **NodeList**.

Une NodeList ressemble à un tableau :

```
buttons[0]
buttons[1]
buttons[2]
```

Elle possède aussi une propriété :

```
buttons.length
```

qui indique combien d’éléments ont été trouvés.

---

# 8. Parcourir une liste d’éléments

Une fois qu’on possède plusieurs éléments, on peut les parcourir.

Dans ce cours, nous utilisons une **boucle while**.

Exemple :

```js
let buttons = document.querySelectorAll('.btn');

let i = 0;

while (i < buttons.length) {
  console.log(buttons[i].textContent);
  i = i + 1;
}
```

Cette boucle lit chaque bouton dans l’ordre.

---

# 9. Délégation d’événement

Dans la séance précédente, nous avions plusieurs écouteurs :

```js
btn1.addEventListener(...)
btn2.addEventListener(...)
btn3.addEventListener(...)
```

Mais il existe une autre technique.

On peut écouter **tous les clics sur la page** :

```js
let dash = document.getElementById('dashboard);
dash.addEventListener('click', function(e) {
  console.log(e.target);
});
```

L’objet `e` contient l’élément réellement cliqué.

```
e.target
```

On peut alors vérifier ce qui a été cliqué.

Par exemple :

```js
if (e.target.classList.contains('btn')) {

}
```

Puis utiliser `closest()` pour retrouver le composant concerné.

Cette technique s’appelle **la délégation d’événement**.

Elle permet de gérer **beaucoup d’éléments avec un seul écouteur**.

---

# Ce que vous savez maintenant

À la fin de cette séance vous devez comprendre :

* que le DOM est une structure en arbre
* comment chercher un élément
* comment chercher plusieurs éléments
* comment remonter vers un parent
* comment parcourir une liste d’éléments
* comment utiliser un seul event listener
