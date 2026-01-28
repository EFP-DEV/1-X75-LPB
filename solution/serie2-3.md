Variable nombre en Entier
Debut
    Ecrire "Entrez un nombre :"
    Lire nombre
    Ecrire "Le carré de " & nombre & " est " & nombre * nombre
Fin


Variable nombre, resultat en Entier
Debut
    Ecrire "Entrez un nombre :"
    Lire nombre
    resultat <- nombre * nombre
    Ecrire "Le carré de " & nombre & " est " & resultat
Fin




2.3

Variable tacos_commandes, total en Entier
Variable prix_unitaire en Numerique


Debut
    prix_unitaire <- 8

    Ecrire "Combien de tacos ?"
    Lire tacos_commandes

    total <- tacos_commandes * prix_unitaire
    
    Ecrire "Total : " & total & "€"    
Fin


// Durée en minutes : 135
// 135 minutes = 2h 15min

Variable minutes en Entier
Variable heures_calculees, minutes_calculees En Entier;

Debut
    Ecrire "Durée en minutes : "
    Lire minutes

    heures_calculees <- (minutes / 60)
    minutes_calculees <- minutes - (heures_calculees * 60)

    Ecrire minutes & " minutes = " & heures_calculees & "h " & minutes_calculees & "min"
Fin




Exercice 3.1
Écrire un algorithme qui demande un nombre à l'utilisateur et l'informe 
si ce nombre est positif ou négatif (on ne traite pas le zéro).


Variable nombre en Numerique
Debut
    Ecrire "Entrer un nombre"
    Lire nombre

    Si nombre > 0 Alors
        Ecrire nombre & " est positif"
    Sinon
        Ecrire nombre & " est negatif"
    FinSi

Fin

Exercice 3.2
Écrire un algorithme qui demande deux nombres à l'utilisateur et l'informe si leur produit est négatif ou positif (on ignore le cas où le produit est nul).

Contrainte : on ne doit pas calculer le produit.


Variable n1, n2 en Numerique
Variable msg_positif, msg_negatif en Texte

Debut
    msg_positif <- "Positif"
    msg_negatif <- "Negatif"

    Ecrire "Entrer n1"
    Lire n1

    Ecrire "Entrer n2"
    Lire n2

    Si (n1 < 0 ET n2 < 0) OU (n1 > 0 ET n2 > 0) Alors
        Ecrire "Positif"
    Sinon 
        Ecrire msg_negatif
    FinSi
Fin
