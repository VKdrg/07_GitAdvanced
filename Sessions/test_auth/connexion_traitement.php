<?php
session_start();
require_once __DIR__ . '/database.php';


// réccupérer les données du formulaire de connection
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';                   // ptet trim() mais pas sûr

// vérifier que les champs sont remplis
    if ($email === '' || $password === '') {
        exit('Tous les champs sont obligatoires.');
    }

// comparer avec les données de la DB
    $sql = "SELECT id, username, email, password
            FROM Users
            WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'email' => $email
    ]);
    $user = $stmt->fetch();                                 // réccupérer ce qui match

// vérifier si l'utilisateur existe
    if (!$user) {                                           // si !user = fetch() returns false
        exit('Utilisateur introuvable.');
    }

// vérifier le mot de passe
    if (!password_verify($password, $user['password'])) {
        exit('Mot de passe incorrect.');                    // exit si la vérif du mdp échoue || vérif = comparer la valeur pwd de la DB avec la valeur saisie dans le form
    }

// regénérer l'id de la session après vérif mdp 
    session_regenerate_id(true);                            // permet de retrouver la session pour co ultérieure, uniquement si auth est successful

// enregistrer l'utilisateur dans la session
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['name'];

// confirmer la session (message de bienvenue au user)
    echo 'Bienvenue ' . htmlspecialchars($user['name']);
?>