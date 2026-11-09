<?php
require_once __DIR__ . '/functions.php';

$clients = [];
$search = '';
$vehicles = [];

if (isset($_GET['nom']))    // isset : fonction native PHP qui vérifie si la variable existe et n'est pas nulle
{
    $search = trim($_GET('nom'));

    if ($search !== '') {
        $clients = searchClientsByName($pdo, $search);
    };
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Rechercher un client</h1>

    <form method="GET">
        <label for="nom">Nom du client</label>
        <input
            type="text"
            name="nom"
            id="nom"
            value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <h2>Résultat de la recherche</h2> <!-- // pour afficher le résultat du code -->
    <?php if (isset($_GET['nom']) && $search !== ''): ?>
        <?php if (!empty($clients)): ?>
            <?php foreach ($clients as $client): ?>
                <h3><?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?></h3>
                <h4>Véhicules du client</h4>
                <?php  ?>
                <!--application
                <?php foreach ($vehicles as $vehicle): ?>
                    <p><?= htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele'] . ' ' . $vehicle['immatriculation']) ?></p>
                <?php endforeach; ?> 
                -->
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>


</body>

</html>