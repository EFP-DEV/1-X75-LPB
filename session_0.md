# Introduction à l’algorithmique

### [|{ ](#hummus) 1. Le houmous
### [|{ ](#sifr) 2. Les systèmes de numération
### [|{ ](#algo) 3. Introduction à l’algorithmique
### [|{ ](#variables) 4. Les variables

---

## Démo rapide en JavaScript


- **1. Âge en secondes** : demander l'âge en années, afficher l'âge en secondes
- **2. Mad libs** : demander un nom, un nombre, un animal et afficher : "NOM cache NOMBRE ANIMALs dans son frigo"
- **3. Année de naissance** : demander l'âge et afficher l'année de naissance

--- 
#  <a name="hummus"></a> Chapitre 1 : Le Houmous

## Objectifs du chapitre

- Comprendre ce qu’est un **algorithme** grâce à une recette concrète.
- Identifier les concepts de base de l’algorithmique en les appliquant à une situation quotidienne.
- Introduire naturellement les notions de **variables**, **instructions**, **conditions** et **boucles**.


---

Le **"âge en secondes"** a le meilleur ratio simplicité/impact : trois lignes, opérateurs visibles, résultat spectaculaire (genre 1 milliard+).

## Qu’est-ce qu’un algorithme ?

Un **algorithme** est une série précise d'instructions **simples**, **ordonnées** et **claires**, permettant de résoudre un problème ou d’accomplir une tâche déterminée.

**Exemple concret : la recette du houmous**

## Exemple : Recette du Houmous

Voici une recette simplifiée du houmous :

### Ingrédients :
- **500g** de pois chiches au naturel
- **5 cuillères à soupe** de purée de sésame
- **1 citron**
- **1 pincée** de sel
- **3 cuillères à soupe** d'huile d’olive

### Instructions :
1. Rincer les pois chiches sous l’eau froide, puis les égoutter.
2. Mettre les pois chiches dans un robot, ajouter la purée de sésame, le jus du citron et une pincée de sel.
3. Mixer jusqu’à obtenir une pâte lisse et homogène, puis ajouter progressivement l'huile d’olive en continuant à mixer.
4. Transvaser dans un récipient et réserver au frais avant de servir.

> Source : [CuisineAZ - Le vrai houmous](https://www.cuisineaz.com/recettes/le-vrai-houmous-3253.aspx)

---

## Analysons la recette comme un algorithme

### Ingrédients = Variables

```C
pois_chiches = 500
puree_sesame = 5
citron = 1
sel = 1
huile_olive = 3
```

Une variable stocke une valeur. C'est tout.

---

### Instructions = Étapes séquentielles

```C
rincer(pois_chiches)
egoutter(pois_chiches)
ajouter(bol, pois_chiches)
ajouter(bol, puree_sesame)
ajouter(bol, jus de citron)
ajouter(bol, sel)
mixer(bol)
```

Les instructions s'exécutent **de haut en bas**, une par une.

---

### Conditions = Décisions

```C
Si pate n'est pas lisse Alors
    mixer(bol)
FinSi
```

On teste quelque chose. Si c'est vrai, on exécute le bloc.

---

### Boucles = Répétitions

```C
TantQue pate n'est pas lisse
    mixer(bol)
FinTantQue
```

On répète **tant que la condition est vrai**

---

## Code complet

```C
// Variables
pois_chiches = 500
puree_sesame = 5
citron = 1
sel = 1
huile_olive = 3
pate_lisse = faux

// Préparation
rincer(pois_chiches)
egoutter(pois_chiches)

// Mélange
ajouter(bol, pois_chiches)
ajouter(bol, puree_sesame)
ajouter(bol, jus de citron)
ajouter(bol, sel)

// Mixage
TantQue pate_lisse == faux
    mixer(bol)
    Si texture est lisse Alors
        pate_lisse = vrai
    FinSi
FinTantQue

// Ajout huile (3 fois)
compteur = 0
TantQue compteur < 3
    ajouter(bol, 1 cuillère huile_olive)
    mixer(bol)
    compteur = compteur + 1
FinTantQue

// Fin
verser(bol_reserve, bol)
mettre_au_frais(bol_reserve)
```

---

## Résumé

| Concept | Ce que c'est |
|---------|--------------|
| Variable | Une boîte qui contient une valeur |
| Instruction | Une action à exécuter |
| Condition | Un choix (si... alors...) |
| Boucle | Une répétition (tant que...) |


## Exercice : Allez vous faire cuire un oeuf

Rédigez l'algorithme pour cuire un œuf (méthode au choix).

Identifiez :
- Les variables
- Les instructions
- Au moins une condition OU une boucle

---

### [Chapitre 2 &raquo;](session_0_1.md)
