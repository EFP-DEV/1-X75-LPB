# Exercice : construire d’abord le routeur pour le front‑end

Nous allons commencer par un routeur simple, sans gestion de **base path**. La logique basique sera placée dans `app/router.php`, puis utilisée par `public/index.php`. La prise en compte du **base path** viendra dans un second temps.

---

## 1. Créer `app/router.php` (version front‑end)

### 1.0. Encapsuler la logique du routeur

```php
<?php
// app/router.php

/**
 * Lance le routeur frontal de l’application.
 */
function runRouter()
{
    // Le reste des étapes suit ci‑dessous...
}
```

- **But** : pouvoir appeler tout le routeur depuis l’extérieur via `runRouter()`.  
- **Vérification** : aucun code ne doit s’exécuter avant l’appel à `runRouter()`.

---

### 1.1. Définir le chemin de l’application

```php
    // 1. Chemin vers l’application
    define('APP_PATH', __DIR__);
```

- **But** : obtenir dynamiquement le chemin absolu vers `app/`.  
- **Vérification** : `var_dump(APP_PATH)` (à l’intérieur de `runRouter`) doit afficher `/chemin/vers/projet/app`.  
- **Erreur possible** : permissions non‑lues → vérifier `chmod`.

---

### 1.2. Lire l’URI et la méthode HTTP

```php
    // 2. Lecture de l’URI et de la méthode
    $rawUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = strtolower($_SERVER['REQUEST_METHOD']);
```

- **But** : isoler le chemin sans la query string (`?foo=bar`) et normaliser la méthode (`get`, `post`).  
- **Piège** : certains serveurs réécrivent `REQUEST_URI` ; toujours tester en local et en production.

---

### 1.3. Segmenter l’URI

```php
    // 3. Segmenter l’URI
    $uri   = trim($rawUri, '/');
    $parts = $uri === '' ? [] : explode('/', $uri);
```

- **But** : transformer `/items/42/edit` en `['items','42','edit']`.  
- **Piège** : slashes redondants (`//`) créent segments vides ; on peut filtrer si nécessaire.

---

### 1.4. Sélectionner et charger le contrôleur

```php
    // 4. Choisir le contrôleur
    $firstPart = array_shift($parts);
    if ($firstPart !== null && $firstPart !== '') {
        // on garde uniquement les lettres/chiffres, pas de ../
        $name = preg_match('/^[a-z0-9]+$/i', $firstPart) ? $firstPart : 'home';
    } else {
        $name = 'home';
    }

    $controllerFile = APP_PATH . "/controllers/{$name}.php";
    if (!is_readable($controllerFile)) {
        http_response_code(404);
        exit('404 Not Found');
    }

    require $controllerFile;
```

- **But** :  
  1. Déterminer le contrôleur (`home` par défaut).  
  2. Charger le fichier ou renvoyer un 404.  
- **Piège** : injection de chemin (`..`) → valider `$name` (pas de `.` ni `/`).

---

### 1.5. Gérer la pagination « slug/page/n » (GET uniquement)

```php
    // 5. Pagination après slug (GET seulement)
    if ($method !== 'post'
        && count($parts) >= 3
        && $parts[1] === 'page'
        && is_numeric($parts[2])
    ) {
        $action = 'show';
        $slug   = array_shift($parts);
        array_shift($parts);          // enlève 'page'
        $page   = (int) array_shift($parts);
        call_user_func($action, $slug, $page);
        exit;
    }
```

- **But** : traiter `/tag/mon-slug/page/2` en appelant `show('mon-slug', 2)`.  
- **Piège** : déclenchement en POST non souhaité – on filtre sur `$method`.

---

### 1.6. Déterminer et appeler l’action

```php
    // 6. Déterminer l’action
    $first = $parts[0] ?? null;

    if ($method === 'post') {
        if ($first !== null && function_exists($first)) {
            $action = array_shift($parts);
        } else {
            $action = 'submit';
        }
    } else {
        if ($first !== null && function_exists($first)) {
            $action = array_shift($parts);
        } elseif ($first !== null) {
            $action = 'show';
        } else {
            $action = 'index';
        }
    }

    // 7. Vérifier l’existence de la fonction
    if (!function_exists($action)) {
        http_response_code(404);
        exit("404 Action « {$action} » non trouvée");
    }

    // 8. Appeler la fonction avec les paramètres restants
    call_user_func_array($action, $parts);
}
```

- **But** :  
  1. Choisir `submit()` en POST par défaut, ou une action existante.  
  2. En GET, appeler `index()`, `show()`, ou une action personnalisée.  
  3. Vérifier l’existence et exécuter l’action.  
- **Piège** : nombre d’arguments incorrect → prévoir des valeurs par défaut dans les signatures.

---

## 2. Adapter `public/index.php`

```php
<?php
// public/index.php

// Version front‑end, sans basePath
require __DIR__ . '/../app/router.php';
runRouter();  // lance le routeur défini dans app/router.php
```

- **But** : démarrer le routeur frontal sans base path.  
- **À venir** : on ajoutera plus tard un paramètre `$basePath` pour l’entrée admin.
