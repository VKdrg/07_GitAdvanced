<?php
// réccupérer le nom envoyé par le formulaire (pas de vérifs)
    $nom = trim($_POST['nom'] ?? '');

// vérifier que nom !== ''
    if ($nom === '') {
        exit('Nom invalide.');
    }

// créer un cookie
    setcookie(
        'nom',
        $nom,
        time() + (7 * 24 * 60 * 60),
        '/'
    );

// rediriger vers la page d'accueil
    header('Location : accueil.php');
    exit;
?>