# ALGO-101
## Introduction à l’algorithmique


### [|{ ](#hummus) 1. Le houmous
### [|{ ](#sifr) 2. Les systèmes de numération
### [|{ ](#algo) 3. Introduction à l’algorithmique
### [|{ ](#variables) 4. Les variables

---

#  <a name="hummus"></a> Chapitre 1 : Le Houmous

## Objectifs du chapitre

- Comprendre ce qu’est un **algorithme** grâce à une recette concrète.
- Identifier les concepts de base de l’algorithmique en les appliquant à une situation quotidienne.
- Introduire naturellement les notions de **variables**, **instructions**, **conditions** et **boucles**.


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

Cette recette contient tous les éléments essentiels d'un algorithme :

| Élément du houmous | Élément algorithmique | Exemple concret |
|--------------------|-----------------------|-----------------|
| Ingrédients        | **Variables** (éléments à manipuler) | `pois_chiches`, `sel`, `citron` |
| Quantités          | **Valeurs des variables**            | `500g`, `1 citron`, `1 pincée` |
| Ustensiles         | **Outils de traitement**             | `robot`, `bol`, `réfrigérateur` |
| Instructions       | **Opérations ou traitements**        | `rincer()`, `mixer()`, `réserver()` |
| Conditions         | **Structures conditionnelles**       | `Si la pâte n’est pas lisse, continuer à mixer` |
| Répétitions        | **Boucles (structures itératives)** | `Tant que les pois chiches ne sont pas secs, égoutter` |

---

## Traduction de la recette en pseudo-code (algorithme)

Voici comment cette recette pourrait être écrite en **pseudo-code**, une façon simplifiée d'écrire un algorithme :

### Déclaration des variables :

```javascript
// Ingrédients avec typage et quantités
Gramme pois_chiche = 500;
CuillereSoupe puree_sesame = 5;
Fruit citron = 1;
Pincee sel = 1;
CuillereSoupe huile_olive = 3;

// Outils et conteneurs
Outil evier, presse_agrume, robot, refrigerateur;
Conteneur verre_a_jus, bol, bol_reserve;

// États possibles (énumération)
Enum Etat {
    SEC,
    HUMIDE,
    LISSE,
    GRUMELEUX,
    HOMOGENE,
    HETEROGENE
}

// Constantes temporelles
Constante HEURE_MANGER = "18:35";
```

### Instructions en pseudo-code :

#### Étape 1 : Rincer et égoutter les pois chiches

```javascript
// Méthode orientée objet pour les outils spécialisés
pois_chiche = evier.rincer(pois_chiche);

// Structure TantQue
TantQue (pois_chiche.etat != Etat.SEC)
    pois_chiche = evier.egoutter(pois_chiche);
FinTantQue
```

#### Étape 2 : Préparer les ingrédients dans le bol

```javascript
// Fonctions procédurales pour les opérations sur le bol
ajouter(bol, pois_chiche, 500);
ajouter(bol, puree_sesame, 5);

// Mélange de styles
verre_a_jus = presse_agrume.presser(citron, 1);
verser(bol, verre_a_jus);

ajouter(bol, sel, 1);
```

#### Étape 3 : Mixer jusqu'à obtenir une pâte lisse et homogène

```javascript
// Déclaration d'un objet structuré avec ses propriétés
// Déclaration d'un objet structuré avec ses propriétés
ObjetCulinaire pate = {
    texture: Etat.GRUMELEUX,
    consistance: Etat.HETEROGENE,
    gout: null
};

// Structure TantQue avec opérateurs logiques
TantQue (pate.texture != Etat.LISSE || pate.consistance != Etat.HOMOGENE)
    // Appel de méthode orientée objet
    pate = robot.mixer(bol);

    // Structure conditionnelle
    Si (pate.texture == Etat.LISSE && pate.consistance == Etat.HOMOGENE) Alors
        // Boucle TantQue numérique
        var i = 0;
        TantQue (i < 3)
            verser(bol, huile_olive, 1);
            pate = robot.mixer(bol);
            huile_olive = huile_olive - 1;
            i = i + 1;
        FinTantQue
    FinSi
FinTantQue
```

#### Étape 4 : Transvaser et réserver

```javascript
// Fonction procédurale
verser(bol_reserve, bol);

// Structure TantQue pour l'attente active
TantQue (heure_courante() != HEURE_MANGER)
    refrigerateur.reserver(bol_reserve);
FinTantQue
```

---

## Ce que cette analogie nous apprend

- Un **algorithme** ressemble beaucoup à une recette : il contient une liste précise d'étapes à suivre.
- Chaque ingrédient (**variable**) doit être clairement **identifié** et **préparé** avant de l’utiliser.
- Certaines actions (**instructions**) doivent être **répétées** (boucles) jusqu’à ce que la condition de fin soit atteinte.
- On vérifie régulièrement certaines **conditions** (tests) pour décider des étapes suivantes.


## Code final

```javascript
// Déclaration des variables d'ingrédients avec typage et quantités
Gramme pois_chiche = 500;
CuillereSoupe puree_sesame = 5;
Fruit citron = 1;
Pincee sel = 1;
CuillereSoupe huile_olive = 3;

// Outils et conteneurs
Outil evier, presse_agrume, robot, refrigerateur;
Conteneur verre_a_jus, bol, bol_reserve;

// États possibles (énumération)
Enum Etat {
    SEC,
    HUMIDE,
    LISSE,
    GRUMELEUX,
    HOMOGENE,
    HETEROGENE
}

// Constantes temporelles
Constante HEURE_MANGER = "12:00";

// ÉTAPE 1 : Rincer et égoutter les pois chiches
pois_chiche = evier.rincer(pois_chiche);

TantQue (pois_chiche.etat != Etat.SEC)
    pois_chiche = evier.egoutter(pois_chiche);
FinTantQue

// ÉTAPE 2 : Préparer les ingrédients dans le bol
ajouter(bol, pois_chiche, 500);
ajouter(bol, puree_sesame, 5);

verre_a_jus = presse_agrume.presser(citron, 1);
verser(bol, verre_a_jus);

ajouter(bol, sel, 1);

// ÉTAPE 3 : Mixer jusqu'à obtenir une pâte lisse et homogène
ObjetCulinaire pate = {
    texture: Etat.GRUMELEUX,
    consistance: Etat.HETEROGENE,
    gout: null
};

TantQue (pate.texture != Etat.LISSE || pate.consistance != Etat.HOMOGENE)
    pate = robot.mixer(bol);

    Si (pate.texture == Etat.LISSE && pate.consistance == Etat.HOMOGENE) Alors
        Variable i = 0;
        TantQue (i < 3)
            verser(bol, huile_olive, 1);
            pate = robot.mixer(bol);
            huile_olive = huile_olive - 1;
            i = i + 1;
        FinTantQue
    FinSi
FinTantQue

// ÉTAPE 4 : Transvaser et réserver
verser(bol_reserve, bol);

TantQue (heure_courante() != HEURE_MANGER)
    refrigerateur.reserver(bol_reserve);
FinTantQue
```
# [Chapitre 2 &raquo;](session_0_1.md)