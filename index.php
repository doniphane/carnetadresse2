<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Carnet d'adresses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Carnet d'adresses</h1>
        <a href="ajouter.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter un contact</a>
        <table class="w-full mt-6 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Nom</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Téléphone</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM contacts ORDER BY id DESC");
                foreach ($stmt as $row): ?>
                    <tr class="border-t">
                        <td class="p-2"><?= htmlspecialchars($row['prenom'] ?? '') ?></td>
                        <td class="p-2"><?= htmlspecialchars($row['nom'] ?? '') ?></td>
                        <td class="p-2"><?= htmlspecialchars($row['email'] ?? '') ?></td>
                        <td class="p-2"><?= htmlspecialchars($row['telephone'] ?? '') ?></td>

                        <td class="p-2">
                            <a href="modifier.php?id=<?= $row['id'] ?>" class="text-yellow-500 hover:underline">Modifier</a>
                            |
                            <a href="supprimer.php?id=<?= $row['id'] ?>" class="text-red-500 hover:underline"
                                onclick="return confirm('Confirmer la suppression ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>