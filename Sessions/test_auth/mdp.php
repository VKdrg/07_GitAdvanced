<?php
// Méthodes à NE PAS utiliser, pcq trop facile à craquer
    // encodage
    $mdp1 = "test123";

    $encode = base64_decode($mdp1);
    echo $encode; 

    $decode = base64_decode($mdp1);
    echo $decode;

    // chiffrement (réversible aussi)
    $mdp2 = "azerty";

// Méthode à utiliser : hash (bycrypt)

    $hash = password_hash($mdp2, PASSWORD_DEFAULT);
    echo $hash;

    $hashJohn = password_hash("azerty1234", PASSWORD_DEFAULT);
    $hashAlice = password_hash("azerty1234", PASSWORD_DEFAULT);
    var_dump($hashAlice === $hashJohn);     // returns false, pcq les mdp sont hash différement, et dcp une fois hashés ils sont différents
    echo $hashAlice;































?>