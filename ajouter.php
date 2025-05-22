<?php

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['prenom']) || empty($_POST['nom'])) {
        die("Tous les champs sont obligatoires.");
    }

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];

    try {
        $stmt = $pdo->prepare("INSERT INTO contacts (prenom, nom) VALUES (?, ?)");
        $stmt->execute([$prenom, $nom]);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'insertion : " . $e->getMessage());
    }
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Ajouter un contact</h2>
        <form method="post">
            <input name="nom" placeholder="Nom" class="w-full mb-4 p-2 border rounded" required>
            <input name="prenom" placeholder="Prénom" class="w-full mb-4 p-2 border rounded" required>
            <input name="email" type="email" placeholder="Email" class="w-full mb-4 p-2 border rounded" required>
            <input name="telephone" placeholder="Téléphone" class="w-full mb-4 p-2 border rounded" required>
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ajouter</button>
        </form>
    </div>
</body>

</html>