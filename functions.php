<?php
require_once __DIR__ . '/database.php';

function getClients(PDO $pdo): array
{
    $sql = "SELECT * FROM clients";
    $stmt = $pdo->query($sql);          // stmt = statement
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchClientsByName(PDO $pdo, string $nom) : array
{
    $sql = "SELECT id_client, nom, prenom
            FROM clients
            WHERE nom = :nom";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => $nom]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$clients = getClients($pdo);

// $sql = "SELECT * FROM client";
// $stmt = $pdo -> query($sql);
// $clients = $stmt -> fetchAll(PDO::FETCH_ASSOC);


function getVehiculesByClient(PDO $pdo, int $client_id): array
{
    $sql = "SELECT vehicule_id, immatriculation, marque, modele
            FROM vehicules
            WHERE client_id = :client_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['client_id' => $client_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addClient(PDO $pdo, string $nom, string $prenom, string $email): int      // toutes les données qu'on va ajouter à la DB.     // la function retourne void
{
    $sql = "INSERT INTO clients (nom, prenom, email)
            VALUES (:nom, :prenom, :email)";
    $stmt = $pdo->prepare($sql);    // prépare la requête SQL
    $stmt -> execute([              // exécute la requête SQL
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email
    ]);

    return(int) $pdo->lastInsertId();
};

function addVehicle(PDO $pdo, int $client_id, string $marque, string $modele, string $immatriculation, int $mise_circu, int $kilometrage): void
{
    $sql = "INSERT INTO vehicles (client_id, marque, modele, immatriculation, mise_circu, kilometrage)
            VALUES (:client_id, :marque, :modele; :immatriculation, :mise_circu, :kilometrage)";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute([
        'client_id' => $client_id,
        'marque' => $marque,
        'modele' => $modele,
        'immatriculation' => $immatriculation,
        'mise_circu' => $mise_circu,
        'kilometrage' => $kilometrage
    ]);
};

?>