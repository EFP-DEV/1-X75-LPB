# Le Sel et l’Épice

## Introduction

Cette histoire n’est pas là pour décorer une leçon de programmation.

Elle est là pour rendre une idée de structure plus facile à voir.

Quand on commence à programmer, on apprend souvent des règles isolées :
créer des fonctions, éviter la duplication, bien nommer les choses, utiliser des paramètres, choisir le bon niveau d’abstraction.

Chaque règle peut s’expliquer séparément.
Mais, en pratique, elles ne le sont pas.

Elles sont les faces d’un même problème :
comment donner une forme aux actions répétées sans confondre ce qui est spécifique, ce qui est générique, et ce qui appartient à chaque niveau du code.

Cette histoire utilise le sel, le poivre et les épices pour rendre ces différences visibles.

Son but est de montrer, de manière concrète et mémorable :

- pourquoi une action répétée mérite un nom ;
- pourquoi un bon nom de fonction n’est pas seulement une étiquette, mais une promesse ;
- pourquoi certaines actions méritent des fonctions directes ;
- pourquoi d’autres cas exigent une fonction générique ;
- pourquoi un même résultat peut arriver par des interfaces différentes, et pourquoi cette différence compte ;
- pourquoi les détails d’implémentation ne doivent pas devenir automatiquement des règles d’appel ;
- pourquoi le code doit rester fidèle au niveau d’abstraction du problème qu’il exprime.

Autrement dit, c’est une histoire sur les fonctions, mais aussi sur la conception.

C’est une histoire sur la différence entre écrire du code qui fonctionne simplement et écrire du code qui dit vrai sur ce qu’il fait.

Les exemples sont simples à dessein.

L’idée n’est pas d’enseigner une logique de cuisine.

L’idée est de construire une intuition qui restera utile plus tard, quand les noms ne seront plus `salt()` et `spice($what)`, mais de vraies fonctions dans de vrais programmes.


# Partie I — La Table

## 1. L’homme qui fabriquait son propre sel

Il y avait une fois un homme qui fabriquait son propre sel chaque fois qu’il en avait besoin.

Pas du sel au sens littéral, peut-être, mais ce genre de petit travail répété que l’on reconstruit à la main chaque fois, parce que chaque occurrence semble trop insignifiante pour mériter un nom.

À chaque repas, la même nuisance. S’arrêter. Préparer. Mesurer. Revenir. Ajuster. Reprendre. Rien de difficile. Juste assez fastidieux pour gaspiller de l’attention, et assez fréquent pour mériter mieux.

Il travaillait ainsi :

```php
$water = fetch_water();
$minerals = fetch_minerals();
$brine = mix($water, $minerals);
$heat = boil($brine);
$salt = crystallize($heat);

season($dish, $salt);
````

Puis le repas suivant arriva, et il recommença. Puis encore.

C’est ainsi que la duplication commence : non pas dans la grandeur, mais dans l’agacement.

## 2. L’homme du sel

Un soir, il rencontra un homme dont tout le métier était celui-ci : quand quelqu’un avait besoin de sel, il apportait du sel.

Il ne proposait pas d’options. Il n’ouvrait pas de catalogue. Il ne demandait pas si, par hasard, le poivre ferait l’affaire.

Il apportait du sel.

Au début, cela sembla excessif. Pourquoi appeler un homme pour quelque chose d’aussi simple ?

Puis le cuisinier remarqua une chose importante : la valeur n’était pas dans le sel. La valeur était dans le fait de n’avoir plus jamais à résoudre le problème du sel.

Il cessa donc de fabriquer son propre sel. Quand il fallait du sel, il appelait :

```php
salt();
```

Et la vie devint plus légère.

## 3. Quand un nom devient une promesse

Au début, l’homme du sel n’était qu’utile.

Puis il devint fiable.

Puis digne de confiance.

Et, après assez de confiance, son nom cessa de décrire un travailleur pour commencer à décrire une certitude.

Si l’on appelait `salt()`, le sel arrivait.

C’est à ce moment qu’une fonction cesse d’être une commodité pour devenir un contrat.

Une fonction vague dit : « quelque chose se passe ici ».

Une bonne fonction dit : « cette chose précise se passe ici ».

Un nom, lorsqu’il a été mérité, devient une promesse.

## 4. L’homme du poivre

Avec le temps, il y eut aussi un homme du poivre.

Lui aussi fut connu pour une seule chose.

Si l’on appelait :

```php
pepper();
```

le poivre arrivait.

Le monde avait désormais deux spécialistes de confiance.

Non parce que les épices seraient des objets mystiques du design logiciel, mais parce que ces deux besoins sont fréquents, stables, et toujours à portée de main.

Ils étaient devenus une part de la table elle-même.

---

# Partie II — Le monde au-delà de la table

## 5. Les limites de la spécialisation

Mais le monde, par impolitesse, refusa de s’arrêter au sel et au poivre.

Un jour, quelqu’un voulut du cumin. Un autre du paprika. Un autre de la coriandre. Un autre de la cannelle. Puis une épice obscure que personne n’avait jamais demandée auparavant, et que personne ne redemanderait sans doute avant des mois.

Il eût été absurde de créer un homme dédié et un nom dédié pour chaque épice susceptible de passer un jour par une cuisine.

Telle est la limite de la spécialisation.

Certaines choses méritent leur propre porte.

D’autres non.

## 6. La maison de toutes les épices

Alors apparut un autre service.

Non pas un spécialiste. Un système.

Son nom était :

```php
spice($what);
```

On appelait, on disait ce que l’on voulait, et cela était livré.

Pour les cas rares, c’était excellent.

Pour les demandes inhabituelles, c’était nécessaire.

Pour l’avenir ouvert de « quoi que l’on demande ensuite », c’était la bonne conception.

Le monde avait désormais les deux :

```php
salt();
pepper();
spice($what);
```

Et ce n’était pas une contradiction.

C’était une bonne architecture.

## 7. La table n’est pas un entrepôt

Un certain réformateur, qui prenait la généralité pour de la sagesse, regarda cet agencement et dit :

« Pourquoi garder `salt()` et `pepper()` ? `spice($what)` peut tout gérer. »

Techniquement, oui.

Pratiquement, non.

Car une table de restaurant n’est pas un entrepôt.

On met le sel et le poivre sur la table parce qu’ils sont l’interface commune.

On ne pose pas, à côté du pain, une armoire de cumin, de coriandre, de safran, de cannelle, et de toutes les épices que l’avenir pourra inventer.

Un bon design n’expose pas toutes les possibilités.

Il expose ce qui est commun, attendu, et proche de la main.

Le sel et le poivre restèrent donc sur la table.

Le reste passa par le service des épices.

## 8. La différence entre une porte et un guichet

Le réformateur insista :

« Mais quelle différence cela fait-il ? `spice('salt')` donne quand même du sel. »

« Oui, dit le cuisinier. Le même sel. Mais pas la même interface. »

```php
salt();
```

est une porte.

```php
spice('salt');
```

est un guichet.

Au guichet, il faut préciser ce que l’on veut.

À la porte, la demande est déjà portée par le nom.

Le résultat peut être identique.

Le contrat, lui, ne l’est pas.

---

## 9. L’apprenti pose l’antique question

Des années plus tard, un apprenti demanda à son maître :

« Maître, qu’est-ce qui est meilleur : `salt()` ou `spice('salt')` ? »

Le maître répondit, comme les maîtres le font souvent quand ils sont techniquement justes mais pas encore pédagogiquement utiles :

« Cela dépend du contexte. »

L’apprenti, qui espérait une récompense plus nette, demanda plus simplement :

« Le sel est-il différent ? »

Le maître répondit :

« Non. C’est le même sel. Souvent, `spice` envoie chercher `salt` derrière le mur. »

L’apprenti fronça les sourcils.

« Pourquoi fait-il cela ? »

Alors le maître commit une vieille erreur.

Il répondit depuis son souvenir plutôt que depuis le besoin de l’élève.

Il parla depuis l’histoire interne de la cuisine, là où les routes et les raccourcis avaient autrefois compté.

« C’est plus rapide », dit-il.

Le mot était vrai.

Il était aussi traître.

## 10. Le secret derrière le mur

L’apprenti avait maintenant reçu un détail d’implémentation et, comme beaucoup de débutants, il le prit pour une règle publique.

Il raisonna ainsi :

Si `spice('salt')` finit par appeler `salt()`, alors `salt()` est sûrement le meilleur choix dès que le sel est en jeu.

Le maître avait parlé de ce qui se passait derrière le mur.

L’apprenti avait entendu une règle sur ce qu’il fallait écrire dans la rue.

C’est un danger courant dans l’apprentissage :

un fait d’implémentation est pris pour un principe de conception.

## 11. L’apprenti applique la leçon trop tôt

Bientôt, il écrivit ceci :

```php
foreach($spices_for_paella as $spice){
    if($spice === 'salt'){
        salt();
    }
    else{
        spice($spice);
    }
}
```

Il croyait être prudent.

Il avait compris quelque chose de réel : dans une implémentation donnée, un chemin peut être plus court.

Ce qu’il n’avait pas compris, c’est où une telle connaissance a sa place.

Au début, le code eut simplement l’air intelligent.

Puis la Maison des Épices ajouta un registre à l’intérieur de `spice($what)` afin que le garde-manger puisse suivre ce qui avait été demandé.

Le cumin passait par le registre.

Le paprika passait par le registre.

La coriandre passait par le registre.

Le sel, non.

La boucle avait commencé à contourner le service même qu’elle prétendait utiliser.

## 12. Le niveau de l’histoire

Le maître regarda le code, puis le registre du garde-manger, et demanda :

« Quelle histoire cette boucle raconte-t-elle ? »

L’apprenti se tut.

Le maître montra la variable.

« Ici, c’est `$spice`, pas `$salt`. »

Puis il montra la boucle.

« Ce n’est pas une histoire sur une demande nommée à l’avance. C’est une histoire sur des noms d’épices qui arrivent comme des données. »

Et il expliqua :

Quand on se tient à l’extérieur du système et que l’on sait directement qu’il faut du sel, on appelle `salt()`.

Quand on se tient à l’extérieur du système et que l’on sait directement qu’il faut du poivre, on appelle `pepper()`.

Mais quand les noms d’épices arrivent par les données, on n’est plus dans le monde des appels directs nommés.

On est dans le monde du flux générique.

La bonne expression était donc celle-ci :

```php
foreach($spices_for_paella as $spice){
    spice($spice);
}
```

Parce qu’elle correspond à la forme du problème.

La leçon ne portait pas sur ce qui se passait dessous.

Elle portait sur le fait de rester fidèle au niveau de l’histoire que le code est en train de raconter.

---

## 13. La route qui convient au voyage

L’apprenti, encore un peu résistant, demanda :

« Mais si `spice('salt')` finit par atteindre `salt()`, pourquoi ne pas raccourcir le chemin ? »

Le maître répondit :

« Parce que je t’ai mal répondu. »

L’apprenti leva les yeux.

« Quand j’ai dit “plus rapide”, je parlais des entrailles de la cuisine, d’un ancien agencement derrière le mur. Toi, tu avais besoin d’une règle pour écrire du code, et je t’ai donné un souvenir à la place. »

Puis il le dit clairement :

Quand le besoin est connu directement, on utilise la fonction directe.

```php
salt();
pepper();
```

Quand le besoin arrive par les données, on utilise la fonction générique.

```php
foreach($spices_for_paella as $spice){
    spice($spice);
}
```

Puis il ajouta :

« Sinon, chaque boucle générique commence à collectionner des exceptions privées.

Aujourd’hui le sel. Demain le poivre. La semaine prochaine quelque autre épice favorite.

Bientôt, le code ne décrit plus les données qu’il traite.

Il se met à bavarder sur la manière dont la cuisine se trouve organisée cette saison. »

Et c’est ainsi que l’abstraction pourrit :

non pas d’un seul coup,

mais par petites exceptions qui flattent l’auteur et alourdissent le code.

## 14. La correction

L’apprenti effaça donc son habileté et écrivit :

```php
foreach($spices_for_paella as $spice){
    spice($spice);
}
```

À présent, la boucle disait exactement ce qu’elle faisait.

Le registre du garde-manger restait intact.

Le code ne se souciait plus de la manière dont la maison des épices exécutait chaque demande.

Si, demain, `spice()` cessait d’appeler `salt()` en interne, la boucle n’aurait pas besoin de changer.

Et cette fois, le maître acquiesça.

Non parce que c’était plus rapide.

Parce que c’était fidèle.

Fidèle au niveau d’abstraction.

Fidèle à la forme des données.

Fidèle au contrat que le code devait honorer.

## 15. Ce que l’apprenti écrivit dans son carnet

Ce soir-là, l’apprenti écrivit :

Une tâche répétée mérite un nom.

Un bon nom devient une promesse.

Certains besoins sont assez communs et assez stables pour mériter des fonctions directes.

D’autres sont assez variables pour mériter une fonction générique.

Un même résultat peut arriver par des interfaces différentes, et l’interface compte.

Quand le besoin est connu directement, on appelle la fonction directe.

Quand le besoin arrive par les données, on appelle la fonction générique.

Il ne faut pas laisser une connaissance privée de l’implémentation fuiter dans le code d’appel public.

Un fait sur la manière dont quelque chose est implémenté n’est pas automatiquement une règle sur la manière dont cela doit être utilisé.

Et, hors de la cuisine, c’est la même chose en programmation :

les aides spécifiques ont leur place là où l’action est nommée directement ;

les interfaces génériques ont leur place là où les actions arrivent comme des données.

Le même sel peut arriver par plusieurs routes.

La sagesse consiste à choisir celle qui convient au voyage.

