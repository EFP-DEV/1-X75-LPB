# Rendu Côté Serveur avec PHP (SSR)

## Introduction
Cette leçon présente la transformation progressive d'un site statique HTML en une application PHP dynamique utilisant le rendu côté serveur (SSR). Nous suivrons les modifications étape par étape pour comprendre l'évolution vers une architecture modulaire.

## Modifications par Étapes

### 1. Changer l'Extension en .php
```
index.html → index.php
```

**Pourquoi?** L'extension `.php` indique au serveur web que le fichier contient du code PHP à exécuter côté serveur avant de renvoyer le HTML au navigateur. Sans cette extension, le code PHP serait affiché comme du texte brut au lieu d'être interprété.

### 2. Dynamiser le Copyright
```php
<!-- Avant -->
<p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>

<!-- Après -->
<p class="m-0 text-center text-white">Copyright &copy; Your Website <?php echo date('Y'); ?></p>
```

Cette modification:
- Introduit les balises `<?php ?>` qui délimitent le code PHP
- Utilise la fonction `date('Y')` pour générer l'année courante
- Utilise `echo` pour afficher le résultat dans le HTML

### 3. Création de Pages Supplémentaires par Copie
```
Copie: index.php → about.php
Modification: Suppression du catalogue, ajout de <h1>About Us</h1>
Mise à jour: Menu pour ajouter l'item "About" 

Copie: about.php → contact.php
Modification: Contenu pour la page contact
Mise à jour: Menu pour ajouter l'item "Contact" 
```

**Problème identifié:** La duplication de code rend les modifications futures fastidieuses et sujettes aux erreurs.

### 4. Création de Partiels - Première Approche
```
Création: _partials/navbar.html
Contenu: Le code complet du menu de navigation
Modification: Remplacer le HTML du menu par <?php include '_partials/navbar.html'; ?>
```

Cette approche résout partiellement le problème en isolant la navigation, mais le reste du code reste dupliqué.

### 5. Isolation des Différences - Approche Améliorée
```
Création: pages/about.html avec uniquement <h1>About Us</h1>
Création: pages/contact.html avec uniquement le contenu spécifique
Création: pages/home.html avec le contenu original du catalogue
```

### 6. Implémentation d'un Routeur Simple
```php
<section class="py-5">
    <?php
    // var_dump($_GET); 
    $page = 'home';
    if(array_key_exists('page', $_GET)){
        $page = $_GET['page'];
    }
    include 'pages/' . $page . '.html';
    ?>
</section>
```

Cette modification:
- Utilise la superglobale `$_GET` pour accéder aux paramètres d'URL
- Affiche ces paramètres avec `var_dump()` pour le débogage
- Établit une page par défaut avec `$page = 'home'`
- Charge dynamiquement le contenu basé sur le paramètre `?page=xxx`

## Structure de Fichiers Finale

```
projet/
├── index.php           # Fichier principal unique
├── _partials/
│   └── navbar.html     # Menu de navigation
├── pages/
│   ├── home.html       # Contenu du catalogue
│   ├── about.html      # Page À propos
│   └── contact.html    # Page Contact
├── css/
├── js/
└── assets/
```

## Considérations de Sécurité

Le code suivant présente une vulnérabilité:

```php
include 'pages/' . $page . '.html';
```

Un attaquant pourrait potentiellement accéder à des fichiers sensibles en manipulant le paramètre `page`. Une solution plus sûre serait:

```php
$allowed_pages = ['home', 'about', 'contact'];
$page = in_array($page, $allowed_pages) ? $page : 'home';
include 'pages/' . $page . '.html';
```

## Avantages du SSR PHP

1. **Réduction du code dupliqué**: Une seule structure HTML principale
2. **Maintenance simplifiée**: Les modifications des éléments communs se font à un seul endroit
3. **Séparation des préoccupations**: Structure (index.php), navigation (_partials) et contenu (pages)
4. **Routage simplifié**: Une seule URL avec des paramètres différents (`index.php?page=about`)
5. **Évolutivité**: Base pour l'ajout futur de fonctionnalités dynamiques