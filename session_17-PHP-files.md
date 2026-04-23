# Session 17 - Lire un fichier, filtrer des données et produire un fichier

## Objectif

Comprendre comment un programme travaille avec un fichier, depuis sa localisation jusqu'à la production d'un nouveau fichier fiable.

L'enjeu n'est pas seulement de "lire un fichier", mais de comprendre toute la chaîne :

**entrée → lecture → compréhension → transformation → sortie**

---

## 1. Le modèle général : un fichier entre, un fichier sort

Dans beaucoup de programmes, on part d'une source, on applique un traitement, puis on produit un résultat.

C'est un pipeline simple :

**fichier source → lecture → analyse → transformation → écriture → fichier résultat**

Exemple :

* un fichier `.csv` contenant des produits ;
* on garde seulement ceux en stock ;
* on produit un nouveau fichier `.sql` ou `.json`.

Ce modèle est fondamental.
Avant même d'écrire du code, il faut savoir :

* d'où viennent les données ;
* sous quelle forme elles arrivent ;
* ce qu'on veut garder, modifier ou rejeter ;
* sous quelle forme on veut produire le résultat.

---

## 2. Qu'est-ce qu'un fichier

Un fichier est une suite d'octets stockée sur un support, identifiée par un nom et un chemin.

Pour un humain, un fichier peut être "un tableau", "un texte", "une image" ou "un document".
Pour un programme, ce n'est au départ qu'un contenu brut à interpréter.

Un dossier (répertoire) sert à organiser les fichiers.

Pour accéder à un fichier, un programme doit connaître son emplacement exact.

---

## 3. Données, structure, contrôle

Quand on travaille avec un fichier, il faut distinguer trois niveaux.

### Les données

C'est le contenu utile.

Exemples :

* des noms ;
* des dates ;
* des identifiants ;
* des prix ;
* des lignes de texte.

### La structure

C'est la manière dont les données sont organisées.

Exemples :

* une donnée par ligne ;
* plusieurs colonnes séparées par une virgule ;
* plusieurs colonnes séparées par une tabulation ;
* une structure hiérarchique en JSON.

### Le contrôle

C'est tout ce qui permet ou empêche le traitement correct.

Exemples :

* le chemin ;
* les permissions ;
* l'encodage ;
* les erreurs d'ouverture ;
* l'écriture simultanée par plusieurs processus.

Beaucoup d'erreurs viennent d'une confusion entre ces trois niveaux.

Exemple :

* les données sont bonnes ;
* mais le séparateur est mal interprété ;
* ou bien le fichier est correct, mais inaccessible ;
* ou bien le contenu est juste, mais mal encodé.

---

## 4. Chemins et localisation

Un programme accède à un fichier via un chemin.

Deux types principaux :

* **chemin relatif** : dépend du dossier courant
  Exemple : `data/file.tsv`

* **chemin absolu** : localisation complète dans le système
  Exemple : `/home/user/data/file.tsv`

Le chemin est souvent la première source d'erreur.

Un programme peut être correct, mais échouer simplement parce qu'il cherche le fichier au mauvais endroit.

Bon réflexe :

* vérifier où se trouve réellement le fichier ;
* vérifier depuis quel dossier le programme s'exécute ;
* ne pas supposer qu'un chemin est bon sans test.

---

## 5. Extension vs format réel

L'extension d'un fichier (`.txt`, `.csv`, `.json`, `.sql`) donne une indication, mais ne garantit rien.

Un fichier nommé `data.csv` peut :

* utiliser des points-virgules au lieu de virgules ;
* contenir des tabulations ;
* être mal encodé ;
* ne pas avoir d'en-tête ;
* ne pas respecter le format attendu.

Le vrai format dépend du contenu réel.

Bonne méthode :

1. observer le fichier ;
2. identifier sa structure réelle ;
3. seulement ensuite choisir comment le lire.

Il faut donc apprendre à ne pas faire confiance au nom seul.

---

## 6. Fichiers texte vs fichiers binaires

Tous les fichiers ne se lisent pas de la même manière.

### Fichiers texte

Ils sont destinés à être interprétés comme des caractères.

Exemples :

* `.txt`
* `.csv`
* `.tsv`
* `.json`
* `.sql`

On peut souvent les lire :

* ligne par ligne ;
* ou comme une grande chaîne de texte.

### Fichiers binaires

Ils ne sont pas destinés à être lus directement comme du texte.

Exemples :

* `.png`
* `.jpg`
* `.pdf`
* `.exe`

Ils contiennent aussi des octets, mais ces octets ne représentent pas directement du texte lisible.

Conséquence :

* un fichier texte se traite souvent avec une logique de lignes et de séparateurs ;
* un fichier binaire se traite comme un flux brut d'octets.

---

## 7. Lire un fichier

Lire un fichier suit toujours la même logique :

1. ouvrir le fichier ;
2. lire son contenu ;
3. fermer le fichier.

Il existe plusieurs stratégies.

### Lire tout d'un coup

Utile si :

* le fichier est petit ;
* on a besoin de tout le contenu immédiatement.

### Lire ligne par ligne

Utile si :

* les données sont organisées en lignes ;
* chaque ligne représente une entrée ;
* on veut traiter progressivement sans tout charger en mémoire.

### Lire par blocs

Utile pour :

* de gros fichiers ;
* certains traitements techniques ;
* certains fichiers binaires.

Dans beaucoup d'exercices pédagogiques, la lecture ligne par ligne est la plus adaptée.

---

## 8. Écrire un fichier

Écrire un fichier suit la même logique générale :

1. ouvrir ;
2. écrire ;
3. fermer.

Deux modes principaux doivent être distingués.

### Écriture avec remplacement

Le nouveau contenu remplace l'ancien.

C'est utile quand on veut produire un fichier propre, complet, reconstruit à chaque exécution.

### Écriture en ajout

Le nouveau contenu est ajouté à la fin.

C'est utile pour :

* un journal ;
* des logs ;
* une accumulation contrôlée d'entrées.

Un mauvais choix de mode peut :

* effacer un ancien contenu important ;
* ou au contraire ajouter des données alors qu'on voulait repartir de zéro.

---

## 9. Encodage et fins de ligne

Un fichier texte n'est pas seulement "du texte".
Il faut aussi savoir **comment** ce texte est stocké.

### Encodage

L'encodage définit la manière dont les caractères sont représentés dans le fichier.

Exemples :

* UTF-8
* ASCII

Si l'encodage est incorrect, on peut observer :

* des accents cassés ;
* des caractères illisibles ;
* des symboles inattendus ;
* des erreurs de lecture ou de comparaison.

### Fins de ligne

Les systèmes n'écrivent pas toujours les lignes de la même manière.

Exemples :

* `\n` sur Unix/Linux
* `\r\n` sur Windows

Un programme doit donc rester prudent lorsqu'il lit ou reconstruit des lignes.

---

## 10. Formats texte structurés

Certains fichiers texte suivent une structure simple et fréquente.

### CSV

Colonnes séparées par des virgules, ou parfois par des points-virgules selon le contexte.

### TSV

Colonnes séparées par des tabulations.

### JSON

Structure hiérarchique avec objets, tableaux, clés et valeurs.

### SQL

Suite d'instructions destinées à une base de données.

Notions importantes :

* **séparateur** : ce qui découpe les colonnes ;
* **ligne** : une entrée ;
* **en-tête** : noms de colonnes, souvent en première ligne.

Comprendre la structure avant de coder est indispensable.
Sinon, on risque de lire correctement un fichier… tout en interprétant faussement son contenu.

---

## 11. Permissions des fichiers

Un fichier peut exister, être au bon endroit, avoir le bon format, et pourtant rester inaccessible.

Pourquoi ?
À cause des permissions.

Trois permissions principales :

* **lecture (r)** : lire le fichier ;
* **écriture (w)** : modifier le fichier ;
* **exécution (x)** : exécuter le fichier.

Ces permissions peuvent varier selon :

* le propriétaire ;
* le groupe ;
* les autres utilisateurs.

Un échec d'accès ne signifie donc pas automatiquement que le fichier est absent.
Il peut être présent, mais non autorisé.

---

## 12. Fermeture garantie et gestion des erreurs

Ce problème relève du contrôle (section 3) : les données et la structure peuvent être parfaitement correctes, mais une erreur en cours d'opération suffit à produire un résultat corrompu.

Ouvrir un fichier peut échouer.
Lire peut échouer.
Écrire peut échouer.

Si une erreur survient et que le fichier n'est pas fermé correctement :

* le handle peut rester ouvert ;
* l'écriture peut être incomplète ;
* le résultat produit peut être corrompu.

### Le cas de PHP

En PHP, les fonctions fichier (`fopen`, `fgets`, `fwrite`) ne lancent pas d'exceptions. Elles retournent `false` en cas d'échec.

Cela signifie que `try/catch` seul ne suffit pas : il n'y a rien à attraper.

Le bon réflexe est double :

* **vérifier chaque retour** : si `fopen` retourne `false`, il ne faut pas tenter de lire ;
* **utiliser `try/finally`** : le bloc `finally` garantit que `fclose()` sera appelé quoi qu'il arrive dans le reste du code, même si on décide d'interrompre le traitement en cours de route.

`finally` ne sert pas ici à attraper une exception, mais à garantir la fermeture dans tous les cas de figure : sortie normale, `return` anticipé, ou exception levée ailleurs dans le code.

Sans ce mécanisme, "toujours fermer le fichier" reste un vœu, pas une garantie.

---

## 13. Accès concurrent

C'est aussi un problème de contrôle : le code est correct, les données sont valides, mais l'environnement d'exécution introduit un conflit.

Dans un exercice simple, un seul script travaille sur un fichier à la fois.

En contexte réel, ce n'est pas toujours le cas.

En PHP, chaque requête HTTP est indépendante.
Donc deux requêtes peuvent vouloir écrire dans le même fichier au même moment.

Conséquences possibles :

* contenu mélangé ;
* lignes coupées ;
* données corrompues ;
* résultat incohérent.

Le mode append ne suffit pas à résoudre ce problème.

Pour cela, on utilise un verrouillage, par exemple avec `flock()`.

Principe :

1. un processus verrouille le fichier ;
2. il écrit ;
3. il libère le verrou ;
4. les autres attendent leur tour.

À ce stade, il suffit de comprendre que le problème existe, et qu'il existe aussi un mécanisme simple pour le traiter.

---
## 14. Micro-scénarios d'échec à reconnaître

Chaque ligne relie un symptôme observable à une cause probable et au niveau concerné (cf. section 3).

| Symptôme | Cause probable | Niveau |
|---|---|---|
| Le programme ne trouve pas le fichier | Mauvais chemin, mauvais dossier courant, faute dans le nom | Contrôle |
| Le fichier s'ouvre, mais on ne lit rien | Fichier vide, ou `fopen` en mode écriture au lieu de lecture | Contrôle |
| Tout est lu sur une seule ligne | Fin de ligne inattendue (`\r\n` vs `\n`), fichier produit sur un autre système | Contrôle |
| Les accents sont cassés | Mauvais encodage (UTF-8 lu comme ISO-8859-1 ou inversement) | Contrôle |
| Les colonnes sont décalées | Mauvais séparateur (tabulation prise pour virgule, ou inversement) | Structure |
| Une colonne contient des données d'une autre | Guillemets ou virgules dans les valeurs, mal gérés par le découpage | Structure |
| Le fichier SQL généré contient l'en-tête du fichier source | Première ligne non ignorée | Données |
| Le fichier résultat existe mais est vide | `fopen` en mode `w` exécuté, mais rien écrit (erreur silencieuse, filtre trop strict) | Contrôle |
| Le fichier résultat est incomplet | Erreur pendant l'écriture, fichier non fermé correctement | Contrôle |
| Le contenu final est incohérent ou mélangé | Plusieurs écritures simultanées, absence de verrouillage | Contrôle |
| Permission refusée | Le fichier existe mais les droits sont insuffisants | Contrôle |
| Le SQL produit provoque une erreur à l'exécution | Apostrophe dans une valeur non échappée (ex : `VALUES ('Hawai'i')`) | Données |

Le bon réflexe n'est pas de mémoriser une syntaxe, mais d'apprendre à diagnostiquer.

---

## 15. Bonnes pratiques

* Observer le fichier avant de coder.
* Ne pas se fier uniquement à l'extension.
* Identifier séparément les données, la structure et les contraintes de contrôle.
* Utiliser `try/catch/finally` pour les opérations fichier.
* Séparer la lecture, le traitement et l'écriture.
* Vérifier le fichier produit après exécution.
* Penser aux permissions et au chemin avant d'accuser le code.
* Garder en tête qu'un fichier peut être correct mais mal interprété.

---

## 16. Idée centrale

Travailler avec des fichiers suit presque toujours la même chaîne :

**localiser → ouvrir → lire → comprendre la structure → sélectionner ou transformer → écrire → fermer proprement**

La syntaxe change selon le langage.
La logique, elle, reste la même.

Ce qu'il faut maîtriser, ce n'est pas seulement "comment ouvrir un fichier", mais tout le raisonnement qui permet de passer d'une source brute à un résultat fiable.

---

# Annexe — Observer un fichier avec un éditeur hexadécimal

## Pourquoi un éditeur hexadécimal

Un éditeur de texte affiche le contenu lisible d'un fichier, mais masque tout le reste : séparateurs invisibles, fins de ligne, encodage. Un éditeur hexadécimal montre chaque octet tel qu'il est stocké. C'est l'outil qui permet de voir ce qu'un éditeur de texte cache.

Un outil en ligne comme [hexed.it](https://hexed.it/) suffit. Il n'y a rien à installer.

---

## Quoi regarder

Trois choses à vérifier systématiquement avant de coder.

### 1. L'encodage (les premiers octets)

Certains fichiers commencent par une séquence spéciale appelée BOM (Byte Order Mark). Elle indique l'encodage utilisé.

| Premiers octets | Encodage |
|---|---|
| `EF BB BF` | UTF-8 avec BOM |
| `FF FE` | UTF-16 Little Endian |
| `FE FF` | UTF-16 Big Endian |
| Aucun marqueur | UTF-8 sans BOM (cas le plus courant) |

Si le fichier commence directement par le contenu (pas de BOM) et que tous les octets restent dans la plage `00`–`7F`, le fichier est en ASCII pur, ce qui est aussi du UTF-8 valide.

Si des octets dépassent `7F`, il faut déterminer s'ils forment des séquences UTF-8 valides (par exemple `C3 A9` pour `é`) ou s'il s'agit d'un encodage mono-octet comme ISO-8859-1 (où `é` serait un seul octet `E9`).

### 2. Le séparateur de colonnes

Dans un fichier tabulaire, les colonnes sont séparées par un caractère invisible.

| Octet | Caractère |
|---|---|
| `09` | Tabulation (TSV) |
| `2C` | Virgule `,` (CSV) |
| `3B` | Point-virgule `;` (CSV variante) |

Un éditeur de texte peut afficher un espace là où il y a une tabulation. L'éditeur hexadécimal lève le doute.

### 3. Les fins de ligne

| Séquence | Système |
|---|---|
| `0A` | LF — Unix, Linux, macOS |
| `0D 0A` | CR+LF — Windows |

Si on voit `0A` seul en fin de ligne : LF. Si on voit `0D` suivi de `0A` : CR+LF.

---

## Exemple concret : `iso-639-3.tab`

En ouvrant ce fichier dans hexed.it, on observe :

* **Premiers octets** : `49 64 09 50 61 72 74` — le fichier commence directement par `Id` (le nom de la première colonne). Pas de BOM. L'encodage est UTF-8 sans BOM.
* **Séparateur** : les octets `09` apparaissent entre chaque champ. C'est bien une tabulation.
* **Fins de ligne** : chaque ligne se termine par `0A` seul. C'est du LF, sans `0D`. Pas de `\r\n` à gérer.
* **Plage des octets** : tous les octets visibles restent dans `00`–`7F`. Le fichier est en ASCII pur.

Conclusion avant de coder :

* séparateur : `\t` ;
* fin de ligne : `\n` ;
* encodage : ASCII / UTF-8 ;
* pas de cas particulier à prévoir.

---

## Résumé

Avant de traiter un fichier, ouvrir les premiers octets dans un éditeur hexadécimal permet de répondre à trois questions en quelques secondes :

1. Quel est l'encodage ?
2. Quel est le séparateur ?
3. Quelles sont les fins de ligne ?

Ces trois réponses relèvent du contrôle (cf. section 3 de la leçon). Les ignorer, c'est risquer un programme qui tourne mais qui produit un résultat faux.
