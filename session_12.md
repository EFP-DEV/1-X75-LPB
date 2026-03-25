# PHP-102 — Contrôleur, GET/POST, PDO


## Objectifs du cours

À la fin de cette leçon, vous devrez être capable de :

- comprendre le rôle du contrôleur dans une logique de programmation émergente ;
- distinguer les données envoyées en **GET** et en **POST** ;
- établir une connexion entre **PHP** et **MySQL** ;
- exécuter des requêtes avec **PDO** ;
- comprendre la différence entre requête directe et requête préparée.

---

# 1. Le contrôleur

## 1.1. Le contrôleur comme point de passage

Dans une logique de programmation émergente, le contrôleur n’est pas une pièce imposée par une architecture rigide.  
C’est simplement l’endroit où la requête arrive, où les données sont lues, puis où une décision est prise sur ce qu’il faut faire ensuite.

Le contrôleur sert donc à :

- recevoir une demande ;
- lire les données utiles ;
- décider du traitement à effectuer ;
- transmettre les données nécessaires à la suite du script.

## 1.2. Idée centrale

Le contrôleur n’est pas un objet théorique à respecter.  
C’est une fonction concrète dans le flux réel de la requête.

En pratique, il répond à des questions simples :

- qu’est-ce qui a été demandé ?
- quelles données ont été envoyées ?
- faut-il lire la base de données ?
- faut-il afficher quelque chose ?
- faut-il rediriger ?

## 1.3. À retenir

Le contrôleur est le point où l’on relie :

- la requête HTTP ;
- les données entrantes ;
- le traitement PHP ;
- la réponse produite.

---

# 2. GET et POST

## 2.1. Deux manières d’envoyer des données

Quand un navigateur communique avec un script PHP, les données peuvent être envoyées de différentes façons.  
Les deux cas les plus fréquents sont :

- **GET**
- **POST**

Ces deux méthodes ne répondent pas au même besoin.

## 2.2. GET

Les données envoyées en GET apparaissent dans l’URL.

Exemple :

```url
page.php?name=Sammy&age=30
````

En PHP :

```php
<?php
echo $_GET['name'];
```

## 2.3. Usage de GET

GET est adapté lorsque la donnée fait partie de la lecture de la page :

* filtre ;
* tri ;
* recherche ;
* pagination ;
* identifiant visible dans l’URL.

GET est utile quand l’URL doit pouvoir être :

* relue ;
* copiée ;
* partagée ;
* rejouée facilement.

## 2.4. POST

Les données envoyées en POST ne sont pas affichées directement dans l’URL.

En PHP :

```php
<?php
echo $_POST['name'];
```

## 2.5. Usage de POST

POST est adapté lorsque l’on envoie une information qui modifie quelque chose ou qui ne doit pas figurer dans l’URL.

Exemples fréquents :

* envoi d’un formulaire ;
* création d’une donnée ;
* modification d’une donnée ;
* transmission d’un contenu plus long.

## 2.6. Comparaison simple

| Méthode | Visible dans l’URL | Usage typique                               |
| ------- | -----------------: | ------------------------------------------- |
| GET     |                oui | lecture, filtre, recherche                  |
| POST    |                non | envoi de formulaire, création, modification |

## 2.7. À retenir

GET et POST ne sont pas des concepts abstraits.
Ce sont deux formes concrètes de transport de données dans une requête HTTP.

Le rôle du contrôleur est de savoir :

* où lire la donnée ;
* comment la récupérer ;
* quoi en faire.

---

# 3. PHP et MySQL

## 3.1. Pourquoi relier PHP à MySQL ?

Une application web doit souvent manipuler des données persistantes :

* utilisateurs ;
* articles ;
* messages ;
* produits ;
* catégories ;
* commandes.

PHP permet d’exécuter la logique du programme, et MySQL permet de stocker et relire les données.

## 3.2. Types d’actions fréquentes

Quand PHP communique avec une base de données, il effectue généralement quatre types d’actions :

* lire ;
* créer ;
* modifier ;
* supprimer.

Même si ces actions sont simples dans leur principe, elles demandent une interface claire avec la base.
C’est le rôle de PDO.

---

# 4. PDO

## 4.1. Définition

**PDO** signifie **PHP Data Objects**.

C’est une interface fournie par PHP pour communiquer avec différents systèmes de bases de données avec une API cohérente.

Exemples de bases compatibles :

* MySQL
* PostgreSQL
* SQLite

## 4.2. Pourquoi utiliser PDO ?

PDO permet :

* d’unifier la manière d’écrire le code d’accès aux données ;
* de séparer la connexion, la préparation, l’exécution et la lecture des résultats ;
* de rendre le code plus lisible et plus réutilisable.

## 4.3. Ce que PDO apporte

PDO est utile pour plusieurs raisons :

* interface commune ;
* code plus propre ;
* requêtes préparées ;
* meilleure gestion des erreurs ;
* récupération structurée des résultats.

## 4.4. Ce que PDO n’est pas

PDO n’est pas un ORM.

PDO reste une couche proche du SQL.
On écrit encore les requêtes soi-même.
On contrôle encore explicitement ce qui est envoyé à la base.

C’est justement ce qui en fait un bon outil d’apprentissage.

---

# 5. Se connecter à une base de données avec PDO

## 5.1. Le DSN

Pour se connecter avec PDO, on utilise un **DSN** (*Data Source Name*).

Le DSN décrit la connexion, par exemple :

* le type de base ;
* l’hôte ;
* le nom de la base ;
* le jeu de caractères.

## 5.2. Structure générale

```php
<?php
$pdo = new PDO($dsn, $username, $password, $options);
```

## 5.3. Exemple MySQL

```php
<?php

$dsn = 'mysql:host=localhost;dbname=shop;charset=utf8mb4';
$user = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO($dsn, $user, $password, $options);
```

## 5.4. Lecture de l’exemple

Dans cet exemple :

* on se connecte à une base MySQL ;
* la base s’appelle `shop` ;
* l’encodage choisi est `utf8mb4` ;
* les erreurs sont levées sous forme d’exceptions ;
* les résultats sont récupérés sous forme de tableaux associatifs.

## 5.5. Deux options importantes

### `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`

Cette option permet d’obtenir des erreurs claires si quelque chose échoue.

### `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`

Cette option permet d’obtenir les résultats avec des clés lisibles :

```php
$row['email']
```

au lieu de dépendre d’index numériques.

---

# 6. Faire une requête avec `query()`

## 6.1. Principe

La méthode `query()` permet d’exécuter directement une requête SQL.

Exemple :

```php
<?php

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

var_dump($rows);
```

## 6.2. Ce que retourne `query()`

`query()` ne retourne pas directement les lignes.
Elle retourne un objet de type **PDOStatement**.

Il faut ensuite lire les résultats avec :

* `fetch()` pour une ligne ;
* `fetchAll()` pour plusieurs lignes.

## 6.3. Quand utiliser `query()` ?

`query()` est adaptée quand la requête est fixe, sans valeur dynamique injectée dedans.

Exemple :

```php
<?php

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
```

## 6.4. Limite de `query()`

Dès qu’une requête dépend d’une valeur variable, on ne reste plus dans une requête fixe.
On passe alors à une autre méthode : la requête préparée.

---

# 7. Faire une requête préparée

## 7.1. Principe

Quand une requête contient une ou plusieurs valeurs variables, il faut préparer la requête avant de l’exécuter.

Cela découpe le travail en trois temps :

1. écrire la structure SQL ;
2. transmettre les valeurs ;
3. lire le résultat.

## 7.2. Les trois étapes

* `prepare()`
* `execute()`
* `fetch()` ou `fetchAll()`

## 7.3. Exemple simple

```php
<?php

$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'email' => $email
]);

$user = $stmt->fetch();
```

## 7.4. Exemple avec plusieurs valeurs

```php
<?php

$sql = "SELECT * FROM users WHERE username = :username AND status = :status";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $username,
    'status' => $status
]);

$user = $stmt->fetch();
```

## 7.5. Intérêt pédagogique

La requête préparée montre clairement qu’il y a deux niveaux distincts :

* la forme de la requête ;
* les valeurs envoyées à cette requête.

C’est une distinction fondamentale pour écrire un code propre.

---

# 8. Lire les résultats

## 8.1. `fetch()`

`fetch()` permet de récupérer une seule ligne.

```php
<?php

$stmt = $pdo->query("SELECT * FROM users");
$row = $stmt->fetch();

var_dump($row);
```

## 8.2. `fetchAll()`

`fetchAll()` permet de récupérer toutes les lignes.

```php
<?php

$stmt = $pdo->query("SELECT * FROM users");
$rows = $stmt->fetchAll();

var_dump($rows);
```

## 8.3. Choisir l’un ou l’autre

On utilise généralement :

* `fetch()` quand on attend un seul résultat ;
* `fetchAll()` quand on veut une liste complète.

---

# 9. Progression logique de la matière

L’ordre le plus clair pour introduire cette partie du cours est le suivant :

## 9.1. D’abord la requête HTTP

Avant de parler base de données, il faut comprendre :

* qu’une page reçoit une requête ;
* que cette requête peut contenir des données ;
* que PHP doit lire ces données.

## 9.2. Ensuite GET et POST

Une fois la requête comprise, on distingue les deux grands canaux d’entrée de données côté formulaire et URL.

## 9.3. Ensuite la connexion PDO

Une fois les données entrantes comprises, on introduit la connexion à la base.

## 9.4. Ensuite les requêtes fixes

On commence par `query()` pour montrer le mécanisme général :

* envoyer du SQL ;
* recevoir un `PDOStatement` ;
* lire les résultats.

## 9.5. Ensuite les requêtes avec variables

Enfin, on introduit `prepare()` et `execute()` pour passer à des cas réels où la requête dépend d’une donnée reçue.

---

# 10. Résumé de la leçon

* Le contrôleur est le point de passage entre la requête et le traitement.
* Les données peuvent arriver en **GET** ou en **POST**.
* PHP peut communiquer avec MySQL grâce à **PDO**.
* Le **DSN** décrit la connexion.
* `query()` sert à exécuter une requête fixe.
* `prepare()` et `execute()` servent à exécuter une requête contenant des valeurs variables.
* `fetch()` lit une ligne.
* `fetchAll()` lit plusieurs lignes.

---

# 11. Formule courte à retenir

```text
La requête arrive.
Le contrôleur lit les données.
PHP traite.
PDO parle à la base.
query() pour une requête fixe.
prepare() + execute() pour une requête variable.
fetch() lit une ligne.
fetchAll() lit plusieurs lignes.
```

