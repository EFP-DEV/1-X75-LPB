# Session 10 — Exercice API - Pokedex

## Liste de Pokémon, HTML sémantique et gestion d’erreur

## Consigne générale

Vous allez réaliser ce travail dans un **repository Git**.

Contraintes minimales :

* créez un repository pour l’exercice ;
* faites **au moins un commit par étape** ;
* chaque commit doit correspondre à un état propre et fonctionnel ;
* le message de commit doit décrire clairement l’étape réalisée.

Exemples :

* `Étape 1 - structure html sémantique`
* `Étape 2 - bouton et zone de statut`
* `Étape 3 - requête api`
* `Étape 4 - affichage des pokemon`
* `Étape 5 - gestion d erreur`

Le but est de construire progressivement une page capable d’interroger une API publique et d’afficher les résultats de manière claire, structurée et robuste.

L’API à utiliser est **PokéAPI**. L’endpoint suivant renvoie une liste de 10 Pokémon, à partir du début de la collection : `https://pokeapi.co/api/v2/pokemon?limit=10&offset=0`. La réponse contient un tableau nommé `results`, et chaque entrée de ce tableau contient un `name` et une `url`. ([PokéAPI][1])

---

## Objectif général

Vous allez construire une interface qui permet, au clic sur un bouton, de charger une liste de Pokémon depuis une API distante et de l’afficher dans la page.

L’objectif est de réutiliser les notions déjà vues :

* structure HTML sémantique ;
* sélection d’éléments dans le DOM ;
* écoute d’un clic ;
* requête avec `fetch()` ;
* lecture d’une réponse JSON ;
* parcours d’un tableau avec `while` ;
* création d’éléments avec `createElement()` ;
* insertion dans le DOM avec `appendChild()` ;
* gestion d’erreur si la requête échoue.

---

## Contraintes générales

Votre travail doit respecter les contraintes suivantes :

* utiliser un vrai HTML sémantique ;
* utiliser `fetch()` pour interroger l’API ;
* utiliser `.then()` et `.json()` ;
* utiliser une boucle `while` pour parcourir les résultats ;
* créer les éléments HTML dynamiquement avec JavaScript ;
* insérer les résultats dans une vraie liste HTML ;
* gérer le cas où l’API ne répond pas ou répond mal ;
* informer clairement l’utilisateur de l’état du chargement.

Vous ne devez pas utiliser de framework ni de bibliothèque externe.

---

## Contraintes HTML

La page doit être structurée de manière logique et sémantique.

Vous devez utiliser au minimum :

* un `<main>` pour le contenu principal ;
* une `<section>` pour la zone de l’exercice ;
* un `<h1>` pour le titre principal ;
* un `<button>` pour déclencher le chargement ;
* une zone dédiée aux messages d’état ;
* une liste `<ul>` ou `<ol>` pour afficher les résultats.

Contraintes importantes :

* le bouton doit être un vrai `<button>` ;
* les résultats ne doivent pas être affichés dans une série de `<div>` sans structure ;
* la zone de message ne doit pas être confondue avec la liste ;
* le HTML doit rester compréhensible même avant le chargement des données.

---

## Contraintes d’accessibilité minimale

Vous devez prévoir une zone qui informe l’utilisateur de ce qui se passe.

Cette zone doit pouvoir annoncer :

* que le chargement commence ;
* que les données ont bien été chargées ;
* qu’une erreur s’est produite si la requête échoue.

Cette zone devra être conçue pour rester claire, visible et utile.

---

## Données à afficher

Pour chaque entrée affichée, vous devez montrer au minimum :

* le nom du Pokémon.

Vous pouvez enrichir l’affichage si vous le souhaitez, par exemple en ajoutant :

* l’URL de détail ;
* un lien cliquable vers cette URL.

L’endpoint fourni renvoie, pour chaque Pokémon de la liste, un objet avec `name` et `url`. ([PokéAPI][1])

---

## Étapes de réalisation

### Étape 1 — Préparer la structure HTML

Créez une page HTML avec une structure sémantique correcte.

Votre page doit contenir :

* un contenu principal ;
* un titre clair ;
* un bouton de chargement ;
* une zone de statut ;
* une liste vide destinée à recevoir les résultats.

À cette étape, aucun appel API n’est encore demandé.

Commit attendu :
`Étape 1 - structure html sémantique`

---

### Étape 2 — Préparer les sélections JavaScript

Dans votre script :

* sélectionnez le bouton ;
* sélectionnez la zone de statut ;
* sélectionnez la liste de résultats.

Ajoutez un écouteur d’événement sur le bouton.

Au clic, vous pouvez dans un premier temps simplement afficher un message de test dans la console ou dans la zone de statut.

Commit attendu :
`Étape 2 - sélection du dom et clic`

---

### Étape 3 — Interroger l’API

Au clic sur le bouton :

* lancez une requête avec `fetch()` vers l’URL PokéAPI donnée ;
* récupérez la réponse ;
* vérifiez qu’elle est exploitable ;
* convertissez-la en JSON.

À ce stade, vous pouvez vérifier les données reçues dans la console avant de les afficher.

Commit attendu :
`Étape 3 - requête api pokemon`

---

### Étape 4 — Générer la liste dynamiquement

Une fois les données reçues :

* repérez le tableau utile dans la réponse JSON ;
* utilisez le tableau `results` ;
* parcourez ce tableau avec une boucle `while` ;
* créez un élément de liste pour chaque résultat ;
* insérez dans chaque élément le nom du Pokémon ;
* ajoutez chaque élément dans la liste HTML prévue.

La liste doit être construite uniquement via le DOM.

Commit attendu :
`Étape 4 - affichage dynamique des pokemon`

---

### Étape 5 — Gérer le rechargement proprement

Avant chaque nouvelle requête :

* videz la liste précédente ;
* remettez à jour la zone de statut.

L’utilisateur ne doit pas obtenir un affichage qui s’accumule de manière confuse si le bouton est cliqué plusieurs fois.

Commit attendu :
`Étape 5 - nettoyage avant rechargement`

---

### Étape 6 — Gérer les erreurs

Vous devez maintenant traiter explicitement le cas où l’API ne répond pas correctement.

Votre interface doit réagir proprement si :

* le serveur est inaccessible ;
* l’URL est erronée ;
* la requête échoue ;
* la réponse ne peut pas être exploitée normalement.

Dans ce cas :

* aucun contenu cassé ne doit apparaître ;
* la liste doit rester propre ;
* un message clair doit informer l’utilisateur qu’un problème est survenu.

L’objectif n’est pas seulement d’éviter un plantage technique, mais de produire une interface compréhensible même quand la source externe tombe en panne.

Commit attendu :
`Étape 6 - gestion d erreur`

---

## Comportement attendu

Quand l’utilisateur clique sur le bouton :

* un message indique que le chargement commence ;
* les anciens résultats sont supprimés ;
* la requête est envoyée ;
* si tout se passe bien, les nouveaux résultats sont ajoutés dans la liste ;
* un message indique que le chargement est terminé ;
* si la requête échoue, un message d’erreur clair est affiché.

---

## Ce qui sera évalué

On observera particulièrement :

* la qualité de la structure HTML ;
* le respect du balisage sémantique ;
* la séparation claire entre commande, message et résultats ;
* la bonne utilisation de `fetch()` ;
* la capacité à parcourir les données avec `while` ;
* la création correcte des éléments du DOM ;
* la qualité de la gestion d’erreur ;
* la lisibilité du code.

---

## Attendu minimal

Le travail est considéré comme fonctionnel si :

* la page contient une structure HTML sémantique correcte ;
* le bouton déclenche bien une requête ;
* les résultats sont affichés dans une vraie liste HTML ;
* un message de chargement est visible ;
* un message d’erreur apparaît en cas d’échec.

---

## Question de réflexion

À la fin de l’exercice, répondez brièvement par écrit à la question suivante :

> Quand une interface dépend d’une API externe, qu’est-ce qui dépend encore de nous, et qu’est-ce qui ne dépend plus de nous ?


[1]: https://pokeapi.co/api/v2/pokemon?limit=10&offset=0 "pokeapi.co"
