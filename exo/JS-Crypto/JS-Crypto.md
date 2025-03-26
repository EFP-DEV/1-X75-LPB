# Exo JS-Crypto

## Introduction
Nous allons travailler sur les chaînes de caractères, dans le but de créer un programme basique de cryptographie.

Le but étant de manipuler des chaînes de caractères, l'utilisation des fonctions et propriétés des String en JavaScript doit se limiter à :
- length
- charAt()
- charCodeAt() // à partir de 8, en mode avancé

Vous ne pouvez donc pas utiliser:
* toLowerCase()
* split(),
* replace() / replaceAll(),
* les méthodes de tableau comme map, filter, reduce,
* les méthodes d'expressions régulières (match, test, etc.),

Respectez toutes les consignes à la lettre.

## Workspace
1) Créer un repository privé sur GitHub, nommez-le `js_crypto`
2) Télécharger le fichier `js_crypto.htm` depuis le GitHub du cours
3) Dans le même répertoire, créer un fichier JavaScript que vous appellerez `crypto_lib.js`
4) Adapter le fichier HTML pour qu'il charge le bon fichier .js
5) Charger **manuellement** le fichier HTML dans votre navigateur
6) Implémenter les fonctions demandées, dans `crypto_lib.js`

## Méthodologie
Le fichier `js_crypto.htm` contient des **tests unitaires** qui valideront votre programmation au fur et à mesure. Vous devez donc, à la fin, avoir géré toutes les erreurs affichées dans la console.

Les erreurs des tests "Avancés" sont secondaires, et doivent donc être traitées si vous voulez progresser dans le cours. Mais vous n'êtes pas obligés de les traiter pour valider l'exercice.

## Introduction au Développement Piloté par les Tests (TDD)

Le développement piloté par les tests (Test Driven Development, ou TDD) est une méthode de programmation qui consiste à écrire d'abord des tests automatiques pour définir le comportement attendu de votre code, puis à écrire le code nécessaire pour faire passer ces tests. Cette approche vous aide à concevoir des fonctions claires, à éviter les régressions et à améliorer la qualité globale de vos programmes.


### Pourquoi adopter le TDD ?

1. **Détection rapide des erreurs :**  
   Écrire des tests dès le départ permet de repérer immédiatement quand une modification du code casse une fonctionnalité existante.

2. **Documentation vivante :**  
   Les tests servent de documentation, montrant comment les fonctions doivent se comporter. Ils décrivent les cas d'utilisation, ce qui aide non seulement à maintenir le code mais aussi à apprendre comment il fonctionne.

3. **Confiance accrue dans le code :**  
   Chaque fois que vous modifiez votre code, exécuter les tests vous assure que les nouvelles modifications n'ont pas d'effets négatifs sur les fonctionnalités existantes.

4. **Amélioration du design :**  
   Le TDD encourage la réflexion sur le design de vos fonctions avant même de les implémenter. En définissant ce que chaque fonction doit faire via des tests, vous êtes incité à concevoir un code modulaire et bien structuré.

5. **Facilite la refactorisation :**  
   Avec une suite de tests solide, vous pouvez refactoriser votre code en toute confiance, sachant que les tests vérifieront que le comportement reste le même.


En résumé, le TDD est une approche puissante qui vous permet d'écrire du code fiable et maintenable dès le début. En vous appuyant sur des tests automatisés vous apprenez à penser en termes de comportements attendus, ce qui est une compétence essentielle pour tout développeur.

--- 

## Partie 0 : Validation de longueur de chaîne
Déclarer et implémenter une fonction `has_validated_length()` qui demande une entrée à l'utilisateur, calcule sa longueur (nombre de caractères qui la compose) et puis qui demande à l'utilisateur de confirmer le nombre de lettres de ce mot.

La fonction renvoie le booléen `true` si la longueur est validée par l'utilisateur, sinon elle renvoie `false`

Pour lire une entrée de l'utilisateur :
```javascript
let valeur_entree = prompt(message);
```

Pour demander une confirmation :
```javascript
confirm(message);
```

Ex : si le mot introduit est "Alan Turing", le message de confirmation sera
```
Votre entrée "Alan Turing" comporte 11 caractère(s)
```

--- 
## Partie 1 : Compteur de mots
Déclarer et implémenter une fonction `count_words(string_of_words)` qui prend en paramètre une phrase et qui retourne le nombre de mots dans cette phrase. Pour ce faire, on suppose que les mots de la phrase ne sont séparés que par des espaces et ne contiennent aucun caractère de ponctuation.

Ex :
```javascript
counter = count_words('Turing believes machines think');
console.log(counter) ; // affiche 4
```

--- 
## Partie 2 : Compteur de mots à délimiteur personnalisé
* Déclarer et implémenter une fonction `count_words_by(string_of_words, letter)`. 
* Elle est similaire à la fonction `count_words(string_of_words)` mais le 2e paramètre, optionnel, permet de préciser le séparateur des mots dans une phrase.
* Si le 2e paramètre n'est pas précisé, la fonction se comporte comme `count_words(string_of_words)`.

Ex :
```javascript
counter = count_words_by('Turing believes machines think');
console.log(counter) ; // affiche 4

counter = count_words_by('Turing believes machines think', ' ');
console.log(counter) ; // affiche 4

counter = count_words_by('Turing believes machines think','i');
console.log(counter) ; // affiche 5
```

--- 
## Partie 3: Compteur de voyelles
Déclarer et implémenter une fonction `count_vowels(string_of_words)` qui prend en paramètre une phrase et retourne le nombre de voyelles contenues dans cette phrase.

Cette fonction doit faire appel à une fonction `is_a_vowel(letter)`, que vous devez aussi déclarer et implémenter. Cette fonction prend en paramètre une lettre unique et renvoie `true` s'il s'agit d'une voyelle, sinon `false`.

Utiliser le tableau global `vowels` déjà présent dans votre fichier HTML

Ex :
```javascript
count_vowels('Turing believes machines think'); //renvoie 10
count_vowels('zrtpmlkjhgfdsqe'); //renvoie 1
count_vowels('oui'); //renvoie 3
count_vowels('lmpt'); //renvoie 0
```

--- 
## Partie 4: Compteur de consonnes
Déclarer et implémenter une fonction `count_consonants(string_of_words)` qui prend en paramètre une phrase et retourne le nombre de consonnes contenues dans cette phrase.

Pour rappel : les phrases ne contiennent que des lettres et des espaces et aucun signe de ponctuation.

Cette fonction ne peut pas parcourir votre chaîne de caractères, et doit s'écrire sur une seule ligne.

Ex :
```javascript
count_consonants('Turing lies with men'); //renvoie 11
```

--- 
## Partie 5: Suppression de caractère
Déclarer et implémenter une fonction `remove(string_of_words, caracter)` qui prend en paramètres une phrase et un caractère à supprimer dans cette phrase. La fonction retourne la phrase sans les occurrences du caractère à supprimer.

Ex :
```javascript
altered_string = remove('therefore machines do not think', 'e'));
console.log(altered_string); 
// affiche 'thrfor machins do not think'
```

--- 
## Partie 6: Suppression de caractères multiples
Déclarer et implémenter une fonction `remove_many(string_of_words, caracters)` qui prend en paramètres une phrase et une série de caractères à supprimer dans cette phrase. La fonction retourne la phrase sans les occurrences des caractères à supprimer.

Ex :
```javascript
remove_many('Therefore machines do not think', 'dumber'));
// renvoie 'Thfo achins o not think'

remove_many('Turing lies with men','good people read good books');
// renvoie 'Tuiniwithmn'
```

--- 
## Partie 7: Chiffrement César
Déclarer et implémenter une fonction `crypto(a_string, a_number)` qui prend en paramètre une chaîne de caractères et un nombre ; et retourne une version cryptée selon le principe suivant:

Le chiffre de César est une méthode de chiffrement très simple utilisée par Jules César dans ses correspondances secrètes.

Le texte chiffré s'obtient en remplaçant chaque lettre du texte clair original par une lettre à distance fixe, toujours du même côté, dans l'ordre de l'alphabet. Pour les dernières lettres (dans le cas d'un décalage à droite), on reprend au début.

### Exemple
Avec un décalage de 3 vers la droite, A est remplacé par D, B devient E, et ainsi jusqu'à W qui devient Z, puis X devient A etc. Il s'agit d'une permutation circulaire de l'alphabet.

<img src="../../assets/caesarCipher.png" alt="Caesar Cypher" width="600"/>




```javascript
to_crypt = 'it is possible to invent a single machine which can be used to compute any computable sequence';
crypted = crypto(to_crypt, 3);
console.log(crypted); 
// affiche 'lw lv srvvleoh wr lqyhqw d vlqjoh pdfklqh zklfk fdq eh xvhg wr frpsxwh dqb frpsxwdeoh vhtxhqfh'
```
Ecrire une fonction `caesar(a_char, a_number)` serait judicieux.
---

---

## Partie 8: Déchiffrement César
Déclarer et implémenter une fonction `decrypt(a_string, a_number)` qui prend en paramètre une chaîne de caractères et un nombre ; et retourne une version décryptée selon le principe précédemment exposé.

Ex :
```javascript
decrypt('te td azddtmwp ez tygpye l dtyrwp xlnstyp hstns nly mp fdpo ez nzxafep lyj nzxafelmwp dpbfpynp', 11);
// Renvoie 'it is possible to invent a single machine which can be used to compute any computable sequence'
```

Cette fonction s'écrit sur une seule ligne.
---

--- 
## Partie 9: Recherche de clé de chiffrement
Déclarer et implémenter une fonction `enigma(crypted_string)` qui prend en paramètre une chaîne de caractères cryptée avec le chiffrement César et qui vous aide à trouver la clé de chiffrement.

Cette fonction s'écrit en 3 lignes (sans compter les { } )

Quelle est la clé pour cette phrase :
```
Lzw akgdslwv esf vgwk fgl vwnwdgh sfq aflwddwulmsd hgowj. Al ak fwuwkksjq xgj zae lg tw aeewjkwv af sf wfnajgfewfl gx glzwj ewf, ozgkw lwuzfaimwk zw stkgjtk vmjafy lzw xajkl lowflq qwsjk gx zak daxw. Zw esq lzwf hwjzshk vg s dalldw jwkwsjuz gx zak gof sfv escw s nwjq xwo vakugnwjawk ozauz sjw hskkwv gf lg glzwj ewf. Xjge lzak hgafl gx nawo lzw kwsjuz xgj fwo lwuzfaimwk emkl tw jwysjvwv sk usjjawv gml tq lzw zmesf ugeemfalq sk s ozgdw, jslzwj lzsf tq afvanavmsdk
```