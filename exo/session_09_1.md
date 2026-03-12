## Jeu d’exploration — Se déplacer dans le DOM

Avant de passer à l’exercice principal, vous allez faire un petit jeu d’exploration.

Le but n’est pas encore de construire une interface complète.
Le but est d’apprendre à **vous repérer dans le DOM** :

* retrouver un élément précis ;
* chercher dans une zone ;
* remonter vers un parent ;
* récupérer plusieurs éléments ;
* parcourir une liste d’éléments.

Vous allez utiliser un document HTML générique, sémantique, et tester des instructions dans la console.

Travaillez d’abord **sans fichier JavaScript** : ouvrez la page, ouvrez la console du navigateur, puis testez les consignes une par une.

---

### Règle du jeu

À chaque étape, vous devez :

1. écrire l’instruction demandée dans la console ;
2. observer ce que le navigateur renvoie ;
3. vérifier si vous avez trouvé le bon élément.

Le but est de comprendre **comment on se déplace dans l’arbre du DOM**.

---

## Étape 1 — Retrouver un élément précis avec `getElementById()`

Commencez par ce que vous connaissez déjà.

Dans la console, retrouvez :

* le grand titre de la page ;
* la section `zone-1` ;
* le total.

Instructions attendues :

```js
document.getElementById('page-title')
document.getElementById('zone-1')
document.getElementById('total')
```

But : repartir d’un point connu.

---

## Étape 2 — Retrouver les mêmes éléments avec `querySelector()`

Refaites la même recherche, mais autrement.

Retrouvez :

* le titre de la page ;
* la section `zone-1` ;
* le total.

Instructions attendues :

```js
document.querySelector('#page-title')
document.querySelector('#zone-1')
document.querySelector('#total')
```

But : voir que `querySelector()` peut aussi chercher par identifiant.

---

## Étape 3 — Chercher par balise et par classe

Retrouvez maintenant :

* le premier `h2` ;
* la première carte ;
* la première valeur ;
* le bouton spécial.

Exemples d’instructions à tester :

```js
document.querySelector('h2')
document.querySelector('.card')
document.querySelector('.value')
document.querySelector('.special')
```

Question à se poser :
pourquoi `querySelector()` ne renvoie-t-il qu’un seul élément ?

---

## Étape 4 — Chercher dans une zone précise

Récupérez d’abord la section `zone-2` :

```js
let zone2 = document.querySelector('#zone-2');
```

Puis cherchez seulement à l’intérieur de cette zone :

* le titre `h3` ;
* la valeur ;
* le bouton.

Exemples :

```js
zone2.querySelector('h3')
zone2.querySelector('.value')
zone2.querySelector('.btn')
```

But : comprendre qu’on peut chercher **dans un sous-arbre**, pas seulement dans tout le document.

---

## Étape 5 — Remonter dans l’arbre avec `closest()`

Récupérez le bouton spécial :

```js
let specialButton = document.querySelector('.special');
```

Puis remontez :

* jusqu’à son `article` ;
* jusqu’à sa `section` ;
* jusqu’au `main`.

Exemples :

```js
specialButton.closest('article')
specialButton.closest('section')
specialButton.closest('main')
```

But : comprendre que l’on peut partir d’un élément précis et remonter vers son parent logique.

---

## Étape 6 — Chercher plusieurs éléments avec `querySelectorAll()`

Retrouvez maintenant :

* toutes les cartes ;
* tous les boutons ;
* toutes les valeurs.

Exemples :

```js
document.querySelectorAll('.card')
document.querySelectorAll('.btn')
document.querySelectorAll('.value')
```

Puis vérifiez combien il y en a :

```js
let buttons = document.querySelectorAll('.btn');
buttons.length
```

Et regardez quelques positions :

```js
buttons[0]
buttons[1]
buttons[2]
```

But : comprendre qu’on récupère une collection d’éléments, pas un seul élément.

---

## Étape 7 — Lire une NodeList avec une boucle `while`

Ajoutez maintenant un fichier `sandbox-dom.js` relié à la page.

Dans ce fichier, écrivez un premier script qui affiche le texte de tous les boutons dans la console.

```js
let buttons = document.querySelectorAll('.btn');

let i = 0;

while (i < buttons.length) {
  console.log(buttons[i].textContent);
  i = i + 1;
}
```

Puis faites la même chose avec les titres des cartes.

Consigne :

* récupérez toutes les `.card` ;
* parcourez-les avec `while` ;
* pour chaque carte, affichez le texte du `h3`.

---

## Étape 8 — Associer plusieurs recherches

Écrivez un script qui :

* récupère toutes les cartes ;
* parcourt les cartes avec `while` ;
* cherche, dans chaque carte :

  * son titre ;
  * sa valeur ;
* affiche les deux dans la console.

But : combiner `querySelectorAll()`, `while` et `querySelector()` sur un sous-ensemble du DOM.

---

## Étape 9 — Comprendre la logique d’un clic

Ajoutez ensuite ce script :

```js
document.addEventListener('click', function (e) {
  if (e.target.classList.contains('btn')) {
    let card = e.target.closest('article');
    let title = card.querySelector('h3');
    console.log('Clic dans :', title.textContent);
  }
});
```

Testez la page :

* cliquez sur chaque bouton ;
* observez la console.

But : comprendre la logique suivante :

1. un clic se produit ;
2. on regarde ce qui a été cliqué ;
3. on remonte jusqu’au composant ;
4. on lit une information dans ce composant.

C’est exactement la mécanique qui sera réutilisée dans l’exercice.

---

## Défi final

Quand tout fonctionne, essayez ces petits défis :

1. Afficher dans la console le nombre total de cartes.
2. Afficher le texte du titre de la deuxième carte.
3. Retrouver la section à laquelle appartient le bouton spécial.
4. Afficher tous les titres de cartes avec une boucle `while`.
5. Cliquer sur un bouton et afficher la valeur contenue dans la même carte.

---

## Ce que vous devez retenir avant l’exercice

À la fin de ce jeu d’exploration, vous devez être capable de :

* retrouver un élément précis ;
* chercher dans une zone ;
* remonter vers un parent ;
* récupérer plusieurs éléments ;
* parcourir une NodeList ;
* utiliser la structure HTML pour retrouver le bon composant.

Vous êtes alors prêt à écrire un JavaScript qui **s’adapte à la structure du HTML**, au lieu de dépendre d’une liste d’identifiants écrits à la main.
