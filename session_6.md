# Concepts JavaScript pour la génération d'un calendrier dynamique

Ce cours théorique couvre les concepts JavaScript essentiels pour implémenter un calendrier HTML dynamique.


## Table des matières

## [Manipulation du DOM avec document.write()](#1-manipulation-du-dom-avec-documentwrite)
## [Structures de contrôle](#2-structures-de-contrôle)
## [Fonctions et paramètres](#3-fonctions-et-paramètres)
## [Tableaux (Arrays)](#4-tableaux-arrays)
## [Objet Date](#5-objet-date)
## [Débordement de tableau et arithmétique modulaire](#6-débordement-de-tableau-et-arithmétique-modulaire)
## [Conditionnels et mise en forme CSS conditionnelle](#7-conditionnels-et-mise-en-forme-css-conditionnelle)
## [Séparation des préoccupations](#8-séparation-des-préoccupations)
## [Conclusion](#conclusion)

---

## 1. Manipulation du DOM avec document.write()

`document.write()` est une méthode permettant d'injecter du contenu HTML directement dans la page. Bien que considérée comme obsolète pour beaucoup d'applications modernes, elle reste utile pour comprendre les fondamentaux de la manipulation du DOM.

```javascript
document.write('<table><tr><td>Contenu</td></tr></table>');
```

## 2. Structures de contrôle

### Boucles

Les boucles permettent d'exécuter un bloc de code répétitivement:

```javascript
// Boucle while
while (condition) {
  // Code à répéter
}

// Boucle for
for (initialisation; condition; incrémentation) {
  // Code à répéter
}
```

Dans le contexte du calendrier, les boucles permettent de générer les jours du mois et de les organiser en lignes et colonnes.

## 3. Fonctions et paramètres

Les fonctions encapsulent la logique réutilisable:

```javascript
function print_table_month(max_days) {
  // Implémentation
}
```

L'utilisation de paramètres (`max_days`) permet de rendre la fonction flexible pour générer différents mois avec un nombre variable de jours.

## 4. Tableaux (Arrays)

Les tableaux stockent des collections ordonnées de données:

```javascript
let month_names = ["Janvier", "Février", "Mars", ...];
let month_max_days = [31, 28, 31, 30, ...];
```

Ils permettent d'organiser les données calendaires pour un accès facile par index.

## 5. Objet Date

L'objet `Date` fournit des méthodes pour manipuler les dates:

```javascript
let today = new Date();
let current_month = today.getMonth();
let current_day = today.getDay();
```

Cet objet est essentiel pour identifier et mettre en évidence le jour courant dans le calendrier.
Mais attention, il faut bien [RTFM](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date) pour comprendre les méthodes et propriétés disponibles.

## 6. Débordement de tableau et arithmétique modulaire

Pour construire un calendrier correctement formaté, il faut gérer:

- Le premier jour du mois
- La répartition des jours sur plusieurs semaines
- Les cellules vides en début/fin de mois

Cela implique de calculer les positions relatives dans la grille du calendrier.

## 7. Conditionnels et mise en forme CSS conditionnelle

## Signature de fonction et paramètres par défaut

La signature d'une fonction définit son interface d'utilisation - elle spécifie les paramètres que la fonction accepte et leur ordre. C'est un "contrat" entre la fonction et le code qui l'appelle.

### Signature de fonction comme contrat

```javascript
function print_table_month(max_days_in_month, dujour = 0) {
  // Implémentation
}
```

Cette signature établit que:

1. La fonction accepte deux paramètres
2. Le premier est obligatoire (`max_days_in_month`)
3. Le second est optionnel avec une valeur par défaut (`dujour = 0`)

### Paramètres par défaut et compatibilité descendante

L'utilisation de la valeur par défaut `dujour = 0` est cruciale pour maintenir la compatibilité avec le code existant (legacy). Cela permet:

```javascript
// Appel existant - reste fonctionnel
print_table_month(29);

// Nouvel appel - utilise la fonctionnalité étendue
print_table_month(31, 15); // 15 = jour courant à mettre en évidence
```

Sans valeur par défaut, les appels existants provoqueraient une erreur ou un comportement inattendu, car `dujour` serait `undefined`.

### Implémentation avec le paramètre supplémentaire

```javascript
function print_table_month(max_days_in_month, dujour = 0) {
    ...
    if (current_day === dujour) {
        // Appliquer une classe CSS spéciale
        cell_content = '<td class="today">' + day + '</td>';
    } else {
        cell_content = '<td>' + day + '</td>';
    }
    ...
}
```

### Utilisation contextuelle

Pour la partie 5 de l'exercice, on pourrait l'utiliser ainsi:

```javascript
// Générer tous les mois
for (let i = 0; i < month_names.length; i++) {
    ...

    let day_to_highlight = (i === current_month) ? current_day : 0;
    ...
    print_table_month(month_max_days[i], day_to_highlight);
}
```

Cette approche maintient l'intégrité du contrat tout en étendant les fonctionnalités, illustrant un principe fondamental de développement durable: les extensions de code ne doivent pas casser les fonctionnalités existantes.


## 8. Séparation des préoccupations

L'exercice démontre comment séparer:

- La logique de génération de données (calcul des jours)
- La présentation (création du HTML)
- La configuration (tableaux de noms et jours par mois)

Cette séparation améliore la maintenabilité et la lisibilité du code.

## Conclusion

La création d'un calendrier JavaScript dynamique intègre des concepts fondamentaux de programmation et des techniques spécifiques au développement web. L'encapsulation du code dans des fonctions, l'utilisation d'objets natifs comme `Date`, et l'application conditionnelle de styles démontrent une approche structurée pour générer des interfaces utilisateur dynamiques.
