<?php
session_start();

require_once __DIR__ . "/../../src/Middleware/AuthMiddleware.php";

AuthMiddleware::checkLogin();
AuthMiddleware::checkRole('MEDECIN');

/* =========================
   USER
========================= */
$doctorName = $_SESSION['user_name'] ?? 'Docteur';

/* =========================
   STATUS ENUM
========================= */
class StatutRendezVous {
    const EN_ATTENTE = 'EN_ATTENTE';
    const CONFIRME   = 'CONFIRME';
    const ANNULE     = 'ANNULE';
    const TERMINE    = 'TERMINE';
}

/* =========================
   SIMULATED DB (SESSION for persistence)
========================= */
if (!isset($_SESSION['appointments'])) {
    $_SESSION['appointments'] = [
        (object)['id'=>1,'patient'=>'Sophie Martin','heure'=>'09:00','jour'=>'2026-06-02','statut'=>StatutRendezVous::EN_ATTENTE,'motif'=>'Consultation Générale'],
        (object)['id'=>2,'patient'=>'Jean Dupont','heure'=>'10:30','jour'=>'2026-06-02','statut'=>StatutRendezVous::CONFIRME,'motif'=>'Suivi Tension'],
        (object)['id'=>3,'patient'=>'Marc Lévy','heure'=>'14:00','jour'=>'2026-06-03','statut'=>StatutRendezVous::EN_ATTENTE,'motif'=>'Renouvellement'],
    ];
}

$appointments = &$_SESSION['appointments'];

/* =========================
   ACTIONS (US 2.2 + 2.3)
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($appointments as &$app) {

        // VALIDATE
        if (isset($_POST['validate_id']) && (int)$_POST['validate_id'] === $app->id) {
            if ($app->statut === StatutRendezVous::EN_ATTENTE) {
                $app->statut = StatutRendezVous::CONFIRME;
            }
        }

        // CANCEL
        if (isset($_POST['cancel_id']) && (int)$_POST['cancel_id'] === $app->id) {
            if ($app->statut === StatutRendezVous::EN_ATTENTE) {
                $app->statut = StatutRendezVous::ANNULE;
            }
        }

        // FINISH + PRESCRIPTION
        if (isset($_POST['finish_id']) && (int)$_POST['finish_id'] === $app->id) {
            if ($app->statut === StatutRendezVous::CONFIRME) {
                $app->statut = StatutRendezVous::TERMINE;
                $app->prescription = $_POST['prescription'] ?? '';
            }
        }
    }
    unset($app);
}

/* =========================
   HELPERS
========================= */
function statusClass($status) {
    return match ($status) {
        'EN_ATTENTE' => 'bg-amber-50 text-amber-700 border-amber-200',
        'CONFIRME'   => 'bg-indigo-50 text-indigo-700 border-indigo-200',
        'TERMINE'    => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'ANNULE'     => 'bg-rose-50 text-rose-700 border-rose-200',
        default      => 'bg-slate-50 text-slate-600 border-slate-200',
    };
}

function e($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MediControl - Médecin</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-10">

    <div class="p-6 border-b flex items-center gap-3">
        <div class="bg-indigo-600 text-white p-2 rounded-lg font-bold text-xl">M+</div>
        <div>
            <h1 class="font-bold">MediControl</h1>
            <span class="text-xs text-emerald-600 uppercase">Espace Docteur</span>
        </div>
    </div>

    <div class="p-4 border-t mt-auto">
        <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-xl">
            <div class="w-9 h-9 bg-emerald-600 text-white flex items-center justify-center rounded-full font-bold">
                <?= e($doctorName[0] ?? 'D') ?>
            </div>
            <div>
                <h4 class="text-sm font-semibold"><?= e($doctorName) ?></h4>
                <p class="text-xs text-slate-500">Médecin</p>
            </div>
        </div>
    </div>

</aside>

<!-- MAIN -->
<main class="flex-1 pl-64 min-h-screen flex flex-col">

<header class="h-16 bg-white border-b px-8 flex justify-between items-center sticky top-0 z-20">
    <h2 class="text-xl font-bold">Gestion des consultations</h2>
    <a href="/MedFlow/public/auth/logout.php" class="text-rose-600 text-sm font-medium">Logout</a>
</header>

<div class="p-8 space-y-8">

<!-- CARDS -->
<section class="grid md:grid-cols-3 gap-5">

    <div class="bg-white p-6 rounded-2xl border">
        <span class="text-xs text-slate-500 uppercase">Aujourd'hui</span>
        <h3 class="text-3xl font-bold">
            <?= count(array_filter($appointments, fn($a) => $a->jour === '2026-06-02')) ?>
        </h3>
    </div>

    <div class="bg-white p-6 rounded-2xl border">
        <span class="text-xs text-slate-500 uppercase">En attente</span>
        <h3 class="text-3xl font-bold text-amber-600">
            <?= count(array_filter($appointments, fn($a) => $a->statut === StatutRendezVous::EN_ATTENTE)) ?>
        </h3>
    </div>

    <div class="bg-white p-6 rounded-2xl border">
        <span class="text-xs text-slate-500 uppercase">Terminés</span>
        <h3 class="text-3xl font-bold text-emerald-600">
            <?= count(array_filter($appointments, fn($a) => $a->statut === StatutRendezVous::TERMINE)) ?>
        </h3>
    </div>

</section>

<!-- TABLE -->
<section class="bg-white rounded-2xl border overflow-hidden">

<div class="p-6 border-b">
    <h3 class="text-lg font-bold">Rendez-vous</h3>
</div>

<table class="w-full text-left">

<thead class="bg-slate-50 text-xs uppercase text-slate-500">
<tr>
    <th class="p-4">Heure</th>
    <th class="p-4">Patient</th>
    <th class="p-4">Motif</th>
    <th class="p-4">Statut</th>
    <th class="p-4 text-right">Actions</th>
</tr>
</thead>

<tbody>

<?php foreach ($appointments as $app): ?>
<tr class="border-t hover:bg-slate-50">

    <td class="p-4 font-semibold text-indigo-600"><?= e($app->heure) ?></td>
    <td class="p-4"><?= e($app->patient) ?></td>
    <td class="p-4 text-slate-500"><?= e($app->motif) ?></td>

    <td class="p-4">
        <span class="px-3 py-1 text-xs rounded-full border <?= statusClass($app->statut) ?>">
            <?= e($app->statut) ?>
        </span>
    </td>

    <td class="p-4 text-right space-x-2">

        <?php if ($app->statut === StatutRendezVous::EN_ATTENTE): ?>

            <form method="POST" class="inline">
                <input type="hidden" name="validate_id" value="<?= $app->id ?>">
                <button class="text-green-600 text-xs font-bold">Valider</button>
            </form>

            <form method="POST" class="inline">
                <input type="hidden" name="cancel_id" value="<?= $app->id ?>">
                <button class="text-red-600 text-xs font-bold">Annuler</button>
            </form>

        <?php elseif ($app->statut === StatutRendezVous::CONFIRME): ?>

            <button
                onclick="openModal('<?= e($app->patient) ?>', <?= $app->id ?>)"
                class="bg-indigo-600 text-white px-3 py-1 rounded-lg text-xs font-bold">
                Terminer
            </button>

        <?php else: ?>
            <span class="text-xs text-slate-400">-</span>
        <?php endif; ?>

    </td>

</tr>
<?php endforeach; ?>

</tbody>
</table>

</section>

</div>
</main>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center">

<div class="bg-white w-full max-w-lg rounded-2xl p-6">

<h3 class="font-bold mb-4">Clôturer consultation</h3>

<form method="POST">

    <input type="hidden" name="finish_id" id="finish_id">

    <input id="patient_name" class="w-full mb-4 p-2 bg-slate-100 rounded" readonly>

    <textarea name="prescription" class="w-full border p-3 rounded" rows="5" required></textarea>

    <div class="flex justify-end gap-3 mt-4">
        <button type="button" onclick="closeModal()" class="text-slate-500">Annuler</button>
        <button class="bg-emerald-600 text-white px-4 py-2 rounded">Terminer</button>
    </div>

</form>

</div>
</div>

<script>
function openModal(name, id) {
    document.getElementById("patient_name").value = name;
    document.getElementById("finish_id").value = id;

    document.getElementById("modal").classList.remove("hidden");
    document.getElementById("modal").classList.add("flex");
}

function closeModal() {
    document.getElementById("modal").classList.add("hidden");
    document.getElementById("modal").classList.remove("flex");
}
</script>

</body>
</html>