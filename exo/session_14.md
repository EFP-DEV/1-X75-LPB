## **Exercice - Mini routeur**

---

### **Objectif**

Simuler un système de routing **sans serveur configuré**, en travaillant directement sur une liste d’URLs.

---

### **Consigne**

Créer un fichier `index.php` qui :

1. Définit un tableau d’URLs
2. Parcourt ces URLs
3. Pour chaque URL :

   * la nettoie
   * la découpe
   * extrait :

     ```php
     $controller;
     $action;
     $id;
     ```
4. Affiche le résultat
5. Applique une logique simple (messages ou 404)

---

### **Données de départ**

```php
$urls = [
    '/',
    '/products',
    '/products/list',
    '/products/show/12',
    '/products/show/999',
    '/products/edit/5',
    '/users',
    '/users/show/3',
    '/users/edit/42',
    '/unknown/test',
];
```

---

### **Traitement attendu**

Pour chaque URL :

```text
/products/show/12
→ Controller: products
→ Action: show
→ ID: 12
```

---

### **Étapes à implémenter**

#### 1. Boucle

```php
foreach ($urls as $url) {
    // traitement
}
```

---

#### 2. Nettoyage

```php
$url = explode('?', $url)[0];
```

---

#### 3. Découpage

```php
$parts = explode('/', trim($url, '/'));
```

---

#### 4. Assignation

```php
$controller = $parts[0] ?? 'home';
$action     = $parts[1] ?? 'index';
$id         = $parts[2] ?? null;
```

---

#### 5. Affichage

```php
echo "URL: $url\n";
echo "Controller: $controller\n";
echo "Action: $action\n";
echo "ID: " . ($id ?? 'null') . "\n\n";
```

---

### **Logique minimale**

Ajouter quelques cas :

```php
if ($controller === 'home' && $action === 'index') {
    echo "Homepage\n";
} elseif ($controller === 'products' && $action === 'index') {
    echo "Liste des produits\n";
} elseif ($controller === 'products' && $action === 'show' && $id) {
    echo "Produit $id\n";
} elseif ($controller === 'users' && $action === 'edit' && $id) {
    echo "Edition utilisateur $id\n";
} else {
    echo "404\n";
}
```

---

### **Contraintes**

* Ne pas utiliser :

  * `$_SERVER`
  * `parse_url()`
  * regex
* Utiliser uniquement :

  * `explode()`
  * `trim()`
  * tableaux PHP

---

### **Bonus (si terminé)**

1. Limiter à **3 segments maximum**
2. Vérifier que `$id` est numérique
3. Normaliser avec `strtolower()`
4. Ignorer les `/` en trop :

```php
// ex: //products//12//
```
