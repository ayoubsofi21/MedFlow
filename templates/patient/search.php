<?php

require_once __DIR__ . '/../../src/Controller/PatientController.php';

$controller = new PatientController();
$doctors = $controller->searchDoctors();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>MedFlow - Search</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-slate-100">

<div class="max-w-6xl mx-auto p-6">

    <!-- 🔵 SEARCH FORM -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">

        <h2 class="text-xl font-bold mb-4">
            Trouver un médecin
        </h2>

        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- search name -->
            <div class="relative">
                <i class="fa fa-user-doctor absolute left-3 top-3 text-gray-400"></i>
                <input type="text"
                       name="doctor_name"
                       placeholder="Nom du médecin"
                       class="w-full pl-10 py-2 border rounded-xl bg-slate-50">
            </div>

            <!-- speciality -->
            <div class="relative">
                <i class="fa fa-stethoscope absolute left-3 top-3 text-gray-400"></i>
                <select name="speciality"
                        class="w-full pl-10 py-2 border rounded-xl bg-slate-50">
                    <option value="">Toutes les spécialités</option>
                    <option value="cardiologue">Cardiologue</option>
                    <option value="generaliste">Généraliste</option>
                </select>
            </div>

            <!-- button -->
            <button class="bg-blue-600 text-white rounded-xl px-4 py-2 hover:bg-blue-700">
                <i class="fa fa-search mr-2"></i> Rechercher
            </button>

        </form>
    </div>

    <!-- 🟢 DOCTORS LIST -->
    <div class="space-y-6">

        <?php foreach ($doctors as $doctor): ?>

            <div class="bg-white rounded-2xl shadow p-6">

                <!-- doctor info -->
                <div class="flex items-center gap-4 mb-4">

                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fa fa-user-md text-blue-600"></i>
                    </div>

                    <div>
                        <h3 class="font-bold text-lg">
                            <?= $doctor['name'] ?>
                        </h3>

                        <p class="text-sm text-blue-600">
                            <?= $doctor['speciality'] ?>
                        </p>
                    </div>

                </div>

                <!-- slots (static for now) -->
                <div class="grid grid-cols-3 md:grid-cols-6 gap-2">

                    <button class="bg-blue-50 text-blue-600 py-2 rounded-lg text-sm hover:bg-blue-600 hover:text-white">
                        09:00
                    </button>

                    <button class="bg-blue-50 text-blue-600 py-2 rounded-lg text-sm hover:bg-blue-600 hover:text-white">
                        10:30
                    </button>

                    <button class="bg-slate-200 text-slate-400 py-2 rounded-lg text-sm line-through cursor-not-allowed">
                        14:00
                    </button>

                </div>

                <!-- book button -->
                <form method="POST" action="/appointment/book" class="mt-4">

                    <input type="hidden" name="doctor_id" value="<?= $doctor['id'] ?>">
                    <input type="hidden" name="date" value="2026-06-01 09:00:00">

                    <button class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700">
                        Réserver
                    </button>

                </form>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>