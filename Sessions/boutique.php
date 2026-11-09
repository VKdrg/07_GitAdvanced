<?php
session_start();
require_once __DIR__ . '/database.php';

// créer une session pour le panier
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'];
};

// ajouter un produit dans le panier
if (isset($_POST['ajouter']) && isset($_POST['id_produit'])) {
    $id = (int) $_POST['id_produit'];

    // chercher le produit dans la DB
    $stmt = $pdo->prepare(
        "SELECT id_produit, nom_produit, prix
        FROM Produits
        WHERE id_produit = ?"
    );
    $stmt->execute([$id]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);


    // vérifier si le produit existe
    if ($produit) {
        if (isset($_SESSION['panier'][$id])) {           // si il est déjà dans le panier
            $_SESSION['panier'][$id]['quantite']++;
        } else {                                          // sinon on le rajoute
            $_SESSION['panier'][$id] = [
                'nom' => $produit['nom'],
                'prix' => $produit['prix'],
                'quantite' => 1
            ];
        };
    }
    // else {
    //     echo 'Le produit n\'existe pas.';
    // };
    // code pas nécessaire pcq fetch(PDO::FETCH_ASSOC) retournera false si le produit n'existe pas
};

// diminuer la quantite du panier
if (isset($_POST['retirer'])) {     // verif que produit in panier
    $id = (int) $_POST['id_produit'];

    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite']--;

        // si qtt = 0, suppression de la ligne
        if ($_SESSION['panier'][$id]['quantite'] <= 0) {
            unset($_SESSION['panier'][$id]);
        }
    }
}

// supprimer le produit du panier
if (isset($_POST['supprimer'])) {
    $id = (int) $_POST['id_produit'];
    unset($_SESSION['panier'][$id]);
}

// supprimer tout le panier
if (isset($_POST['vider'])) {
    $_SESSION['panier'] = [];
}

// récupérer les produits de la DB
$produits = $pdo -> query(
    "SELECT * FROM Produits"
)->fetchAll(PDO::FETCH_ASSOC)

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>Boutique</h1>
        <?php foreach ($produits as $produit) : ?>
            <p><?= htmlspecialchars($produit['nom']) ?></p>
            <p><?= htmlspecialchars($produit['prix']) ?>€</p>

            <form method="POST">
                <input type="hidden" name="produit_id" value="<?= $produit['id_produit'] ?>">
                <button type="submit" name="ajouter">Ajouter</button>
            </form>
        <? endforeach ?>

        <h2>Panier</h2>
        <?php
        if(empty($_SESSION['panier'])): ?>
            <p>Le panier est vide.</p>
        <?php else: ?>
            <?php $totalPanier = 0 ?>
            <?php foreach($_SESSION['panier'] as $id => $produit): ?>
                <?php $totalProduit = $produit['prix'] * $produit['quantite']; // prix par ligne = prix produit * qtt
                $totalPanier += $totalProduit; ?> <!-- ajouter le ttl par ligne au ttl panier -->
            <?php endforeach ?>
        <?php endif ?>
    </body>
</html>