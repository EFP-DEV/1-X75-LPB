# ALGO-101 - Cours d'algorithmique

# Les entrées / sorties

### [|{ ](#probleme) 1. Le problème
### [|{ ](#ecrire) 2. L'écriture
### [|{ ](#lire) 3. La lecture
### [|{ ](#dialogue) 4. Dialogue avec l'utilisateur

---

# <a name="probleme"></a> Chapitre 1 : Le problème

## Un programme isolé

Écrivons un programme pour calculer le carré d'un nombre :

```
Variable A en Numérique

Début
    A ← 12^2
Fin
```

Deux problèmes :

1. Si l'on veut le carré d'un autre nombre, il faut **réécrire le programme**
2. Le résultat est calculé par la machine, mais l'utilisateur **ne voit rien**

## La solution

Il existe des instructions pour permettre à la machine de **dialoguer** avec l'utilisateur :

- Des instructions pour que l'utilisateur **entre** des valeurs
- Des instructions pour que le programme **affiche** des résultats

---

# <a name="ecrire"></a> Chapitre 2 : L'écriture

## Principe

L'**écriture** permet au programme de communiquer des valeurs à l'utilisateur.

Périphériques de sortie : écran, imprimante, lecteur braille, haut-parleur...

## Syntaxe

```
Ecrire "Texte à afficher"
Ecrire variable
Ecrire "Texte : ", variable
```

## Exemples

```
Variable resultat en Numérique

Début
    resultat ← 12^2
    Ecrire resultat
Fin
```

Affiche : `144`

```
Variable resultat en Numérique

Début
    resultat ← 12^2
    Ecrire "Le carré de 12 est : ", resultat
Fin
```

Affiche : `Le carré de 12 est : 144`

## Concaténation

On peut combiner texte et variables :

```
Variable nom en Texte
Variable age en Entier

Début
    nom ← "Alice"
    age ← 25
    Ecrire nom, " a ", age, " ans"
Fin
```

Affiche : `Alice a 25 ans`

---

# <a name="lire"></a> Chapitre 3 : La lecture

## Principe

La **lecture** permet à l'utilisateur d'entrer des valeurs pour qu'elles soient utilisées par le programme.

Périphériques d'entrée : clavier, souris, microphone, caméra...

## Syntaxe

```
Lire variable
```

## Fonctionnement

Dès que le programme rencontre une instruction `Lire` :

1. L'exécution **s'interrompt**
2. Le programme **attend** la frappe d'une valeur au clavier
3. L'utilisateur tape une valeur et appuie sur **Entrée**
4. La valeur est **stockée** dans la variable
5. L'exécution **reprend**

## Exemple

```
Variable NomFamille en Texte

Début
    Ecrire "Entrez votre nom : "
    Lire NomFamille
Fin
```

Exécution :
```
Entrez votre nom : _
```
L'utilisateur tape `Dupont` puis Entrée.

La variable `NomFamille` contient maintenant `"Dupont"`.

---

# <a name="dialogue"></a> Chapitre 4 : Dialogue avec l'utilisateur

## Programme complet : le carré

```
Variable nombre en Numérique
Variable resultat en Numérique

Début
    Ecrire "Entrez un nombre : "
    Lire nombre
    resultat ← nombre^2
    Ecrire "Le carré de ", nombre, " est ", resultat
Fin
```

Exécution :
```
Entrez un nombre : 7
Le carré de 7 est 49
```

## Bonnes pratiques

### Toujours inviter l'utilisateur

```
// Mauvais : l'utilisateur ne sait pas quoi faire
Lire valeur

// Bon : message explicite
Ecrire "Entrez la valeur : "
Lire valeur
```

### Confirmer les entrées

```
Variable age en Entier

Début
    Ecrire "Entrez votre âge : "
    Lire age
    Ecrire "Vous avez ", age, " ans"
Fin
```

### Types et cohérence

La variable doit être du bon type pour recevoir la valeur :

```
Variable prix en Numérique
Variable nom en Texte

Début
    Ecrire "Entrez le prix : "
    Lire prix                      // L'utilisateur doit entrer un nombre
    
    Ecrire "Entrez le nom : "
    Lire nom                       // L'utilisateur peut entrer du texte
Fin
```

## Exemple : calcul de TVA

```
Variables prixHT, prixTTC en Numérique
Variable tauxTVA en Numérique

Début
    Ecrire "Entrez le prix HT : "
    Lire prixHT
    
    Ecrire "Entrez le taux de TVA (ex: 21) : "
    Lire tauxTVA
    
    prixTTC ← prixHT * (1 + tauxTVA / 100)
    
    Ecrire "Prix TTC : ", prixTTC
Fin
```

Exécution :
```
Entrez le prix HT : 100
Entrez le taux de TVA (ex: 21) : 21
Prix TTC : 121
```

## Exemple : conversion de température

```
Variables celsius, fahrenheit en Numérique

Début
    Ecrire "Température en Celsius : "
    Lire celsius
    
    fahrenheit ← celsius * 9 / 5 + 32
    
    Ecrire celsius, "°C = ", fahrenheit, "°F"
Fin
```

---

# Exercices

## Exercice 1 : Présentation

Écrire un algorithme qui demande le prénom et l'âge de l'utilisateur, puis affiche :
```
Bonjour [prénom], vous avez [âge] ans.
```

## Exercice 2 : Périmètre et aire

Écrire un algorithme qui demande le rayon d'un cercle et affiche son périmètre et son aire.

Formules :
- Périmètre = 2 × π × r
- Aire = π × r²

## Exercice 3 : Moyenne

Écrire un algorithme qui demande trois notes et affiche leur moyenne.

## Exercice 4 : Échange de valeurs

Écrire un algorithme qui demande deux valeurs A et B, les échange, puis affiche le résultat.

Exemple :
```
Entrez A : 5
Entrez B : 3
Après échange : A = 3, B = 5
```

## Exercice 5 : Durée en secondes

Écrire un algorithme qui demande une durée en secondes et l'affiche en heures, minutes et secondes.

Exemple :
```
Entrez une durée en secondes : 3725
3725 secondes = 1h 2min 5s
```

# [Chapitre 3 &laquo;](session_0_2.md) 
