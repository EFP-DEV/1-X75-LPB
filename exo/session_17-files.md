## Exercice — Lire un fichier TSV et produire un fichier SQL

### Objectif

Se rendre sur https://iso639-3.sil.org/ et telecharger le fichier "ISO 639-3 Code Set"  (`iso-639-3.tab`)

Vous devez lire le fichier, sélectionner uniquement les langues vivantes, puis écrire un nouveau fichier nommé `languages-iso693-3.sql`.

Le programme ne doit pas exécuter les requêtes SQL dans une base de données.

Il doit seulement transformer un fichier texte en un autre fichier texte.

---

## Ce qu’il faut comprendre avant de coder

Le fichier fourni est un fichier texte.

Les données sont organisées ligne par ligne.

Chaque ligne utile correspond à une langue.

Les colonnes sont séparées par des tabulations, pas par des virgules.

La première ligne est une ligne d’en-tête : elle contient les noms des colonnes et ne doit pas être transformée en SQL.

---

## Travail demandé

Votre programme doit :

1. ouvrir le fichier `iso-639-3.tab` ;
2. le lire ligne par ligne ;
3. ignorer la première ligne ;
4. découper chaque ligne avec le séparateur de tabulation ;
5. repérer si la langue est vivante ;
6. conserver uniquement les lignes correspondant à une langue vivante ;
7. transformer chaque ligne conservée en instruction SQL `INSERT` ;
8. écrire toutes les requêtes dans le fichier `languages.sql`.

---

## Colonnes utiles

Vous n’avez pas besoin de tout utiliser.

Pour cet exercice, retenez au minimum :

* le code de la langue ;
* le nom de la langue ;
* l’information qui indique si la langue est vivante.

Autrement dit, vous devez distinguer :

* les colonnes à garder pour le résultat ;
* la colonne qui sert à filtrer ;
* les colonnes à ignorer.

---

## Règle de sélection

Vous ne devez pas conserver toutes les lignes.

Vous devez garder uniquement les langues vivantes.

Donc, pour chaque ligne :

* si elle correspond à une langue vivante, vous la gardez ;
* sinon, vous l’ignorez.

---

## Format attendu dans le fichier SQL

Le fichier final `languages.sql` doit contenir une instruction `INSERT` par langue conservée.

Exemple de forme attendue :

```sql
INSERT INTO languages (code, name) VALUES ('aaa', 'Ghotuo');
```

Chaque requête doit être écrite sur sa propre ligne.

---

## Méthode conseillée

Commencez par ouvrir le fichier dans un éditeur de texte avant d’écrire du code.

Observez :

* si le fichier est lisible comme un texte ;
* si la première ligne contient les noms de colonnes ;
* si le séparateur est bien une tabulation.

Ensuite seulement, écrivez le programme.

Quand vous commencez à lire le fichier, testez d’abord une seule ligne pour vérifier que vous récupérez bien ce que vous attendez.

Puis appliquez le même traitement à toutes les lignes du fichier.

---

## Résultat final attendu

À la fin, vous devez obtenir un fichier `languages.sql` qui contient uniquement des requêtes `INSERT` correspondant aux langues vivantes du fichier source.

---

## Vérification

Quand le fichier est généré, ouvrez-le et vérifiez :

* que l’en-tête du fichier source n’apparaît pas ;
* que seules les langues vivantes sont présentes ;
* que chaque ligne est bien une instruction SQL ;
* que le fichier est cohérent et lisible.

Un programme n’est pas correct seulement parce qu’il s’exécute.

Il est correct si le fichier produit contient le bon résultat.

---

## Résumé logique de l’exercice

Vous devez être capable d’expliquer votre démarche ainsi :

J’observe le fichier.
Je repère l’en-tête et le séparateur.
Je lis le fichier ligne par ligne.
Je découpe chaque ligne en colonnes.
Je filtre les langues vivantes.
Je transforme les lignes gardées en requêtes SQL.
J’écris le résultat dans un nouveau fichier.
Je vérifie le fichier final.

---

## Quiz

### 1. Quelle est la première chose à faire avant de coder ?

Observer le fichier.

### 2. Pourquoi faut-il regarder le fichier dans un éditeur de texte ?

Pour comprendre sa structure réelle.

### 3. Quel est le séparateur des colonnes dans cet exercice ?

La tabulation.

### 4. À quoi sert la première ligne du fichier ?

À nommer les colonnes.

### 5. Pourquoi faut-il ignorer cette première ligne ?

Parce qu’elle ne représente pas une langue.

### 6. Que représente une ligne utile dans ce fichier ?

Une langue.

### 7. Pourquoi lire le fichier ligne par ligne ?

Parce que chaque ligne correspond à une entrée à traiter.

### 8. Faut-il conserver toutes les lignes ?

Non.

### 9. Quelle règle faut-il appliquer ?

Conserver uniquement les langues vivantes.

### 10. Que produit-on pour chaque ligne conservée ?

Une instruction `INSERT`.

### 11. Quel est le nom du fichier final ?

`languages.sql`

### 12. Le programme doit-il envoyer les requêtes dans une base de données ?

Non.

### 13. Quel est le rôle principal du programme ?

Transformer un fichier TSV en fichier SQL.

### 14. Pourquoi faut-il vérifier le fichier final ?

Pour s’assurer que le résultat est correct.

### 15. Quelle erreur méthodologique faut-il éviter ?

Coder avant d’avoir compris la structure du fichier.
