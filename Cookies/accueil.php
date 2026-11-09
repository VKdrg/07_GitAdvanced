<?php
if (isset($_COOKIE['nom'])) {
    $nom = $_COOKIE['nom'];
}
else {
    $nom = '';
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenue sur notre site</h1>
    <p>Bonjour <?= htmlspecialchars($nom) ?></p>
    <p>Nous nous souvenons de vous</p>

    <?php if ($nom !== '') :?>
    <form action="delete_cookie.php" method="POST">
        <button type="submit">Supprimer les cookies</button>
    </form>

    <?php else: ?>
        <p>Bonjour visiteur, Quel est votre nom ?</p>
        <form action="save_cookie.php">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <button type="submit">Mémoriser mon nom</button>
        </form>

    <?php endif; ?>

</body>
</html>