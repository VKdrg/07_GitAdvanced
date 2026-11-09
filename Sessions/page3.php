<?php
session_start();

//ajouter des élements
$_SESSION['theme'];
$_SESSION['panier'] = ['pomme' => 2, 'lait' => 1];

// retirer un élement
unset($_SESSION['panier']['pomme']);

//supprimer toutes les variables de la session
$_SESSION = [];         // retire le panier & ttes les autres données