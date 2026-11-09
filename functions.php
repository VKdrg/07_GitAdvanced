<?php
require_once __DIR__ . '/database.php';

function getClients(PDO $pdo): array
{
    $sql = "SELECT * FROM clients";
    $stmt = $pdo->query($sql);          // stmt = statement
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchClientsByName(PDO $pdo, string $nom)
{                            // mange des pates <3
    echo(int) $pdo->lastInsertId();
};

function addVehicle(PDO $pdo, int $client_id, string $marque, string $modele, string $immatriculation, int $mise_circu, int $kilometrage): void
{
    $sql = "INSERT INTO vehicles (client_id, marque, modele, immatriculation, mise_circu, kilometrage)
            VALUES (:client_id, :marque, :modele; :immatriculation, :mise_circu, :kilometrage)";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute([                              //      ཐི ₍^.ˬˬ.^₎ ཋྀ
        'client_id' => $client_id,
        'marque' => $marque,
        'modele' => $modele,
        'immatriculation' => $immatriculation,
        'mise_circu' => $mise_circu,
        'kilometrage' => $kilometrage
    ]);
};

?>