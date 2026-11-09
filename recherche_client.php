<?php require_once __DIR__ . '/functions.php'; ?>

<?php foreach ($clients as $client): ?>
    <h2><?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?></h2>
    <h3>Vehicules de client</h3>
    <?php
    $vehicules = getVehiculesByClient($pdo, (int) $client['client_id']);
    ?>

    <?php if (!empty($vehicules)): ?>
        <?php foreach ($vehicules as $vehicule): ?>
            <p>
                <?= htmlspecialchars($vehicule['marque']) ?>
                <?= htmlspecialchars($vehicule['modele']) ?>
                - Immatriculation :
                <?= htmlspecialchars($vehicule['immatriculation']) ?>
            </p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Client ne possède pas de véhicule.</p>
    <?php endif; ?>
<?php endforeach; ?>