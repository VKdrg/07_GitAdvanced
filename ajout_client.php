<?php require_once __DIR__ . '/functions.php'; ?>

<?php $message = ''; ?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {              // si la methode de requête au serveur est bien POST ($_SERVER['REQUEST_METHOD'] = [] pcq tableau associatif)
    # vérifier que les champs sont pas vide
        $nom = trim($_POST['nom'] ?? '');                       // retire les espaces, vérifie si le résultat est pas une chaîne vide  ?? '' = "OU chaine vide"
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');

        $client_id = (int) ($_POST['client_id']); // $_POST['name_in_db']
        $marque = trim($_POST['marque'] ?? '');
        $modele = trim($_POST['modele'] ?? '');
        $immatriculation = trim($_POST['immatriculation'] ?? '');
        $mise_circu = (int) ($_POST['mise_circu'] ?? 0);
        $kilometrage = (int) ($_POST['kilometrage'] ?? -1);     // interdire les valeurs négatives ?

    # vérifier que les données sont correctes (pas des chaines vides ou 0)
        if ($nom !== '' &&
            $prenom !== '' &&
            $email !== '' &&
            $marque !== '' &&
            $modele !== '' &&
            $immatriculation !== '' &&
            $mise_circu > 0 &&
            $kilometrage >= 0
        ) {                                                     // appeller les fonctions (déjà écrites) et leur passer les variables
            $client_id = addClient($pdo, $nom, $prenom, $email);
            addVehicle($pdo, $client_id, $marque, $modele, $immatriculation, $mise_circu, $kilometrage);
        }
        else {
            $message = "Veuillez compléter tous les champs.";
        }
} 
?>

<?php if ($message !== ''): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST">
    <h2>Informations Client</h2>             //            ▶︎ •၊၊||၊|။|||| |    
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required>

    <h2>Informations Véhicule</h2>
    <label for="marque">Marque du véhicule</label>
    <input type="text" id="marque" name="marque" required>

    <label for="modele">Modèle</label>
    <input type="text" id="modele" name="modele" required>

    <label for="immatriculation">Immatriculation</label>
    <input type="text" id="immatriculation" name="immatriculation" required>

    <label for="mise_circu">Date de mise en circulation</label>
    <input type="number" id="mise_circu" name="mise_circu" min="1900" required>

    <label for="kilometrage">Kilométrage actuel</label>
    <input type="number" id="kilometrage" name="kilometrage" min="0" required>

    <button type="submit">Enregistrer</button>
</form>