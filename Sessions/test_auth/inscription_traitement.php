<?php 
require_once __DIR__ . 'database.php';

// réccup users' data
    $name = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

// vérifier les informations saisies
    if ($name === '' || $email === '' || $password === '') {    // si un des champs est vide, on s'arrête
        exit('Tous les champs sont obligatoires.');
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {            // vérifier que l'email est au bon format
        exit('Adresse email invalide.');
    }
    if (strlen($password) < 10) {                               // vérifier que la longueur du pwd est au moins de 10
        exit('Mot de passe trop court.');
    }

// hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

// éxecuter dans la DB
    try {                                                       // ajouter les data du user dans la DB
        $sql = "INSERT INTO Users(username, email, password)
                VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $name,
            'email' => $email,
            'password' => $hash
        ]);
        echo 'Account successfully created.';
    } catch (PDOException $e) {                                 // gérer les erreurs
        if ($e->getCode() === '23000') {                        // 23000 = email already in use in DB -- Integrity Violation
            echo 'Cette adresse email est déjà utilisée.';
        }
        else {                                                  // lancer une exception pr voir l'erreur peut être traitée ailleurs
            throw $e;
        }
    }
?>