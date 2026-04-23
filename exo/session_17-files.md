## Exercice — Lire un fichier TSV et produire un fichier SQL

### Objectif

Se rendre sur https://iso639-3.sil.org/ et telecharger le code set ISO 639-3  (`iso-639-3.tab`)

Vous devez lire le fichier, sélectionner uniquement les langues vivantes, puis écrire un nouveau fichier nommé `languages-iso693-3.sql`.

Le programme ne doit pas exécuter les requêtes SQL dans une base de données.

Il doit seulement transformer un fichier texte en un autre fichier texte.

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

Le fichier final `languages.sql` doit contenir une instruction `INSERT` par langue conservée, pour la table:

```sql
CREATE TABLE IF NOT EXISTS languages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(3) NOT NULL,
    name VARCHAR(255) NOT NULL
);
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
