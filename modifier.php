<?php require 'db.php'; ?>
<?php
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
    echo "Contact introuvable.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("UPDATE contacts SET prenom = ?, nom = ?, email = ?, telephone = ? WHERE id = ?");
    $stmt->execute([$prenom, $nom, $email, $telephone, $id]);

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Modifier un contact</h2>
        <form method="post">
            <input name="prenom" value="<?= htmlspecialchars($contact['prenom'] ?? '') ?>" class="w-full mb-4 p-2 border rounded" placeholder="Prénom" required>
            <input name="nom" value="<?= htmlspecialchars($contact['nom'] ?? '') ?>" class="w-full mb-4 p-2 border rounded" placeholder="Nom" required>
            <input name="email" type="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>" class="w-full mb-4 p-2 border rounded" placeholder="Email" required>
            <input name="telephone" value="<?= htmlspecialchars($contact['telephone'] ?? '') ?>" class="w-full mb-4 p-2 border rounded" placeholder="Téléphone" required>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</button>
        </form>
    </div>
</body>
</html>
