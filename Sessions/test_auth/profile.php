<?php
// page user profile, accessible uniquement dans la session
session_start();

// vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['id'])) {              // si le user n'est pas connecté, redirection vers la connection
        header('Location : connexion.php');
        exit;
    }
?>

<h1>Bienvenue <?= htmlspecialchars($_SESSION['name']) ?></h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor iste impedit laborum placeat voluptatum mollitia eos quis minus eligendi commodi?</p>
<a href="deconnexion.php">Se déconnecter</a>