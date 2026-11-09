<?php

// 2 façons de supprimer: 
// - soit juste son nom
// - soit toute la session


// supprimer le nom enregistré
    // session_start();
    // setcookie(
    //     'nom',                                           // la clé
    //     '',                                              // vider la variable "nom"
    //     time() -3600,                                    // set la date d'expiration dans le passé
    //     '/'                                              // route de redirection aka accueil.php
    // );
    // header("Location : accueil.php");                    // redirection
    // exit;                                                // sortie du script

// supprimer les données côté serveur
    session_start();                                        // récup la session en cours
    $_SESSION = [];                                         // "vider" la session
    if (ini_get('session.use_cookies')) {                   // si la session utilise des cookies
        $params = session_get_cookie_params();              // réccupérer les coolies de la session
        setcookie(session_name(), '', [     
            'expires' => time() - 86400,                    // expiration des cookies 24h ago
            'path' => $params['path'],                      // path d'accès aux cookies
            'domain' => $params['domain'],                  // domaine auquel le cookie appartient
            'secure' => $params['secure'],                  // sécurité de la connexion (http / https)
            'httponly' => $params['httponly'],              // si JS peut accéder aux cookies
            'samesite' => $params['samesite'] ?? 'Lax'      // si les sites peuvent échanger des cookies entre eux
        ]);
    }
    session_destroy();                                      // mettre fin à la sessions

?>