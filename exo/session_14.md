## Exercice - Mini routeur

### Objectif

Simuler un système de routing simple en PHP, sans configuration serveur, à partir d'une liste d'URLs.

---

### Consigne

Créer un fichier `index.php` qui analyse plusieurs URLs et en extrait trois informations :

* le contrôleur
* l'action
* l'identifiant éventuel

Pour chaque URL, le script doit :

* nettoyer l'adresse
* la découper en segments
* récupérer les informations utiles
* afficher le résultat
* décider si la route existe ou non

---

### Données de départ

```php
$urls = [
    '/',
    '/home',
    '/home/index',

    '/products',
    '/products/index',
    '/products/list',
    '/products/show/12',
    '/products/show/999',
    '/products/show/abc',
    '/products/edit/5',
    '/products/delete/8',
    '/products/create',

    '/users',
    '/users/index',
    '/users/show/3',
    '/users/show',
    '/users/edit/42',
    '/users/delete/7',
    '/users/create',

    '/admin',
    '/admin/index',
    '/admin/dashboard',
    '/admin/products',
    '/admin/users',

    '/orders',
    '/orders/list',
    '/orders/show/15',

    '/blog',
    '/blog/show/4',
    '/blog/edit/2',

    '/unknown',
    '/unknown/test',
    '/nothing/here/123',

    '//products//show//12//',
    '/products/show/12/',
    '/products/show/12?sort=asc',
    '/users/edit/42?debug=true',

    '/PRODUCTS/SHOW/12',
    '/Users/Edit/5',

    '/products/show',
    '/products//edit',
    '/products/show/12/extra',
    '/users/edit/42/now',
];
```

---

### Résultat attendu

Pour chaque URL, le script doit afficher les éléments trouvés.

Exemple :

```text
/products/show/12
Controller: products
Action: show
ID: 12
```

---

### Travail demandé

1. Parcourir le tableau `$urls`
2. Nettoyer chaque URL si nécessaire
3. Découper l'URL en parties
4. Déterminer :

   * le controller
   * l'action
   * l'id
5. Prévoir des valeurs par défaut quand certains segments sont absents
6. Afficher le résultat pour chaque URL
7. Ajouter une logique simple pour reconnaître certaines routes et afficher `404` pour les autres

---

### Logique à prévoir

Votre script doit reconnaître quelques cas simples, par exemple :

* page d'accueil
* liste des produits
* détail d'un produit
* édition d'un utilisateur

Toute URL non prévue doit afficher :

```text
404
```

---

### Contraintes

Ne pas utiliser :

* `$_SERVER`
* `parse_url()`
* les expressions régulières

Utiliser uniquement des outils simples vus en cours, par exemple :

* `explode()`
* `trim()`
* les tableaux PHP
* les structures conditionnelles

---

### Indications

Réfléchir à ces questions avant de coder :

* Que devient `/` après nettoyage ?
* Que se passe-t-il si l'URL ne contient qu'un seul segment ?
* Que faire si l'id est absent ?
* Quelle valeur par défaut donner au controller et à l'action ?
* Comment distinguer une route valide d'une route inconnue ?

---

### Bonus

Si l'exercice principal est terminé :

1. limiter l'analyse à 3 segments maximum
2. vérifier que l'id est numérique
3. normaliser les segments en minuscules
4. gérer les URLs avec des `/` en trop

Exemple :

```text
//products//show//12//
```

---

### Attendu final

Un seul fichier `index.php` capable de parcourir toutes les URLs du tableau et d'afficher, pour chacune :

* les segments extraits
* les valeurs retenues
* le résultat du routage
