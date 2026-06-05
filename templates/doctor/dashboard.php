<?php


require_once "../../src/Middleware/AuthMiddleware.php";

AuthMiddleware::checkLogin();
AuthMiddleware::checkRole('DOCTOR');
session_start();
// Simulation de données pour la démo
$appointments = [
    (object)['id' => 1, 'patient' => 'Sophie Martin', 'heure' => '09:00', 'statut' => 'EN_ATTENTE', 'motif' => 'Consultation Générale'],
    (object)['id' => 2, 'patient' => 'Jean Dupont', 'heure' => '10:30', 'statut' => 'CONFIRME', 'motif' => 'Suivi Tension'],
    (object)['id' => 3, 'patient' => 'Marc Lévy', 'heure' => '14:00', 'statut' => 'TERMINE', 'motif' => 'Renouvellement'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediControl - Espace Médecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .status-pill-EN_ATTENTE { @apply bg-amber-50 text-amber-700 border-amber-100; }
        .status-pill-CONFIRME { @apply bg-indigo-50 text-indigo-700 border-indigo-100; }
        .status-pill-TERMINE { @apply bg-emerald-50 text-emerald-700 border-emerald-100; }
        .status-pill-ANNULE { @apply bg-rose-50 text-rose-700 border-rose-100; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-10">
        <div class="p-6 border-b border-slate-100 flex items-center gap-3">
            <div class="bg-indigo-600 text-white p-2 rounded-lg font-bold text-xl tracking-wider shadow-md shadow-indigo-200">M+</div>
            <div>
                <h1 class="font-bold text-slate-900 leading-tight">MediControl</h1>
                <span class="text-xs text-emerald-600 font-medium tracking-wide uppercase">Espace Docteur</span>
            </div>
        </div>
        
        <nav class="flex-1 p-4 space-y-1.5">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl bg-indigo-50 text-indigo-600 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                </svg>
                Mon Planning
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-600 hover:bg-slate-50 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                Mes Patients
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3 p-2 bg-slate-50 rounded-xl">
                <div class="w-9 h-9 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">DR</div>
                <div class="flex-1 overflow-hidden">
                    <h4 class="text-sm font-semibold text-slate-900 truncate">Dr. Aberkane</h4>
                    <p class="text-xs text-slate-500 truncate">Cardiologue</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 pl-64 min-h-screen flex flex-col">
        <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20">
            <h2 class="text-xl font-bold text-slate-800">Gestion des consultations</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-500 font-medium">Mardi, 2 Juin 2026</span>
               <a href="/MedFlow/public/auth/logout.php"
                class="text-sm font-medium text-rose-600 hover:text-rose-700">
                Logout
                </a>
            </div>
        </header>

        <div class="p-8 space-y-8 flex-1">
            <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 uppercase">Aujourd'hui</span>
                        <h3 class="text-3xl font-bold text-slate-900 mt-1">12</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 uppercase">En attente</span>
                        <h3 class="text-3xl font-bold text-amber-600 mt-1">4</h3>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 uppercase">Terminés (Mois)</span>
                        <h3 class="text-3xl font-bold text-emerald-600 mt-1">145</h3>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Rendez-vous du jour</h3>
                        <p class="text-xs text-slate-500">Gérez vos consultations et rédigez vos ordonnances.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 text-[11px] font-bold uppercase tracking-wider border-b">
                                <th class="py-4 px-6">Heure</th>
                                <th class="py-4 px-6">Patient</th>
                                <th class="py-4 px-6">Motif</th>
                                <th class="py-4 px-6">Statut</th>
                                <th class="py-4 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php foreach ($appointments as $app): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6 font-bold text-indigo-600"><?php echo $app->heure; ?></td>
                                <td class="py-4 px-6 font-semibold text-slate-900"><?php echo $app->patient; ?></td>
                                <td class="py-4 px-6 text-slate-500"><?php echo $app->motif; ?></td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo 'status-pill-'.$app->statut; ?>">
                                        <?php echo $app->statut; ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <?php if($app->statut === 'EN_ATTENTE'): ?>
                                        <button class="text-emerald-600 hover:text-emerald-700 font-bold text-xs uppercase">Valider</button>
                                        <button class="text-rose-600 hover:text-rose-700 font-bold text-xs uppercase">Annuler</button>
                                    <?php elseif($app->statut === 'CONFIRME'): ?>
                                        <button onclick="openPrescriptionModal('<?php echo $app->patient; ?>', <?php echo $app->id; ?>)" 
                                                class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-indigo-700 transition-colors">
                                            Terminer & Ordonnance
                                        </button>
                                    <?php else: ?>
                                        <span class="text-slate-400 text-xs italic">Aucune action</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <div id="prescriptionModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b bg-slate-50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-900">Clôturer la consultation</h3>
                <button onclick="closePrescriptionModal()" class="text-slate-400 hover:text-slate-600">&times;</button>
            </div>
            <form class="p-6 space-y-4">
                <input type="hidden" id="app_id">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Patient</label>
                    <input type="text" id="patient_name" readonly class="w-full bg-slate-100 border-none rounded-xl px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Ordonnance (Détails du traitement)</label>
                    <textarea placeholder="Saisissez les médicaments et la posologie..." 
                              rows="6" 
                              class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closePrescriptionModal()" class="px-4 py-2 text-slate-500 font-semibold">Annuler</button>
                    <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                        Enregistrer & Terminer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('prescriptionModal');
        
        function openPrescriptionModal(name, id) {
            document.getElementById('patient_name').value = name;
            document.getElementById('app_id').value = id;
            modal.classList.remove('opacity-0', 'pointer-events-none');
        }

        function closePrescriptionModal() {
            modal.classList.add('opacity-0', 'pointer-events-none');
        }
    </script>
</body>
</html>