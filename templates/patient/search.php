<?php

require_once __DIR__ . '/../../src/Controller/PatientController.php';

$controller = new PatientController();
$doctors = $controller->searchDoctors(); 

?> 

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>MedFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="max-w-6xl mx-auto p-6">

    <!-- SEARCH -->
    <form method="GET" class="mb-6 flex gap-3">

        <input type="text" name="doctor_name"
               placeholder="Nom du médecin"
               class="border p-2 rounded w-full">

        <select name="speciality" class="border p-2 rounded">
            <option value="">All</option>
            <option value="Cardiologie">Cardiologie</option>
            <option value="Dermatologie">Dermatologie</option>
            <option value="Pediatrie">Pediatrie</option>
        </select>

        <button class="bg-blue-600 text-white px-4 rounded">
            Search
        </button>

    </form>

    <!-- RESULTS -->
    <div class="space-y-4">

        <?php if (!empty($doctors)): ?>

            <?php foreach ($doctors as $doctor): ?>

                <div class="bg-white p-4 rounded shadow">

                    <h3>
                        <?= $doctor['prenom'] ?> <?= $doctor['nom'] ?>
                    </h3>

                    <p class="text-blue-600">
                        <?= $doctor['speciality'] ?>
                    </p>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p>Aucun médecin trouvé</p>

        <?php endif; ?>

    </div>

</div>

</body>
</html>