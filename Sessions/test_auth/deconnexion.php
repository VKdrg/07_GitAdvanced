<?php
// réccupr la session en cours
    session_start();

// vider toutes les variables de la session (tableau associatif)
    $_SESSION = [];

// détruire la session côté serveur
    session_destroy();

// rediriger vers la page accueil (ici connexion)
    header('Location : connexion.php');

// finir le programme
    exit;   
?>