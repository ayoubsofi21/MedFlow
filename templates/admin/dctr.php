<?php
session_start();

// Données fictives pour la démonstration
$specialities = [
    (object)['id' => 1, 'libelle' => 'Cardiologue'],
    (object)['id' => 2, 'libelle' => 'Généraliste'],
    (object)['id' => 3, 'libelle' => 'Pédiatre']
];

$past_appointments = [
    (object)['id' => 101, 'doctor' => 'Dr. Yassine Aberkane', 'specialite' => 'Cardiologue', 'date' => '15 Mai 2026', 'heure' => '10:00', 'prescription' => true],
    (object)['id' => 102, 'doctor' => 'Dr. Amina Sbihi', 'specialite' => 'Généraliste', 'date' => '02 Avril 2026', 'heure' => '15:30', 'prescription' => true]
];

$future_appointments = [
    (object)['id' => 103, 'doctor' => 'Dr. Yassine Aberkane', 'specialite' => 'Cardiologue', 'date' => '12 Juin 2026', 'heure' => '14:30', 'statut' => 'CONFIRME'],
    (object)['id' => 104, 'doctor' => 'Dr. Karim Tazi', 'specialite' => 'Pédiatre', 'date' => '20 Juin 2026', 'heure' => '09:00', 'statut' => 'EN_ATTENTE']
];

$slots = [
    '09:00', '09:45', '10:30', '11:15', '14:00', '14:45', '15:30', '16:15'
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediControl - Espace Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

    <!-- Sidebar unique au patient -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-10">
        <div class="p-6 border-b border-slate-100 flex items-center gap-3">
            <div class="bg-indigo-600 text-white p-2 rounded-lg font-bold text-xl tracking-wider shadow-md shadow-indigo-200">M+</div>
            <div>
                <h1 class="font-bold text-slate-900 leading-tight">MediControl</h1>
                <span class="text-xs text-indigo-600 font-medium tracking-wide uppercase">Mon Espace Santé</span>
            </div>
        </div>
        
        <nav class="flex-1 p-4 space-y-1.5">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl bg-indigo-50 text-indigo-600 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
                Tableau de bord
            </a>
            <a href="#prendre-rdv" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-600 hover:bg-slate-50 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Prendre Rendez-vous
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3 p-2 bg-slate-50 rounded-xl">
                <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">PT</div>
                <div class="flex-1 overflow-hidden">
                    <h4 class="text-sm font-semibold text-slate-900 truncate">Mehdi Bennani</h4>
                    <p class="text-xs text-slate-500 truncate">mehdi@email.ma</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 pl-64 min-h-screen flex flex-col">
        <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20">
            <h2 class="text-xl font-bold text-slate-800">Mon Espace Patient</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-500 font-medium">Jeudi, 4 Juin 2026</span>
                <button class="text-sm font-medium text-rose-600 hover:text-rose-700">Déconnexion</button>
            </div>
        </header>

        <div class="p-8 space-y-8 flex-1">

            <!-- Section 1 : Moteur de Recherche de Médecins (US 1.1 & US 1.2) -->
            <section id="prendre-rdv" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Trouver un médecin</h3>
                    <p class="text-xs text-slate-500">Recherchez un praticien et réservez instantanément un créneau libre.</p>
                </div>

                <!-- Formulaire de filtrage (US 1.1) -->
                <form class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Nom du médecin (ex: Aberkane)..." class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                        <span class="absolute left-3.5 top-3.5 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                    </div>
                    <div>
                        <select class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                            <option value="">Toutes les spécialités...</option>
                            <?php foreach ($specialities as $spec): ?>
                                <option value="<?php echo $spec->id; ?>"><?php echo htmlspecialchars($spec->libelle); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-sm transition-colors shadow-sm">
                        Rechercher
                    </button>
                </form>

                <!-- Zone d'affichage des résultats et calendrier de créneaux (US 1.1) -->
                <div class="border border-slate-100 rounded-xl p-4 bg-slate-50/50 space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">DA</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Dr. Yassine Aberkane</h4>
                                <span class="text-xs bg-blue-50 text-blue-700 font-medium px-2 py-0.5 rounded-full border border-blue-100">Cardiologue</span>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Créneaux pour demain (Vendredi 5 Juin)</span>
                    </div>

                    <!-- Grille de créneaux (US 1.2) -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 gap-2">
                        <?php foreach($slots as $index => $slot): ?>
                            <!-- Simulation : Les 2 premiers créneaux sont déjà pris, les autres sont libres -->
                            <?php if($index < 2): ?>
                                <button type="button" disabled class="bg-slate-100 text-slate-400 text-xs font-bold py-2.5 rounded-xl cursor-not-allowed border border-slate-200 line-through">
                                    <?php echo $slot; ?>
                                </button>
                            <?php else: ?>
                                <button type="button" onclick="confirmAppointment('Dr. Yassine Aberkane', '<?php echo $slot; ?>')" 
                                        class="bg-white border border-slate-200 text-slate-700 text-xs font-bold py-2.5 rounded-xl hover:border-indigo-600 hover:text-indigo-600 transition-all text-center shadow-sm">
                                    <?php echo $slot; ?>
                                </button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- Section 2 : Tableau de bord des rendez-vous (US 1.3) -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <!-- Rendez-vous à venir -->
                <section class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900">Mes consultations programmées</h3>
                        <p class="text-xs text-slate-500">Suivi du statut de vos demandes de rendez-vous.</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <?php foreach($future_appointments as $app): ?>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-slate-50/60 rounded-xl border border-slate-100 gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="bg-white p-3 rounded-xl border text-center min-w-[70px]">
                                        <p class="text-xs font-bold text-indigo-600 uppercase"><?php echo explode(' ', $app->date)[1]; ?></p>
                                        <p class="text-lg font-extrabold text-slate-900 leading-tight"><?php echo explode(' ', $app->date)[0]; ?></p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900"><?php echo $app->doctor; ?></h4>
                                        <p class="text-xs text-slate-500"><?php echo $app->specialite; ?> &bull; <?php echo $app->heure; ?></p>
                                    </div>
                                </div>
                                <div>
                                    <?php if($app->statut === 'CONFIRME'): ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Confirmé
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> En attente
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- Historique et Ordonnances -->
                <section class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900">Historique & Ordonnances</h3>
                        <p class="text-xs text-slate-500">Consultez vos anciennes visites et vos prescriptions.</p>
                    </div>
                    <div class="p-6 space-y-4 flex-1">
                        <?php foreach($past_appointments as $past): ?>
                            <div class="p-4 bg-white border border-slate-100 rounded-xl space-y-3 shadow-sm">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900"><?php echo $past->doctor; ?></h4>
                                    <p class="text-[11px] text-slate-400"><?php echo $past->date; ?> &bull; <?php echo $past->heure; ?></p>
                                </div>
                                <button type="button" class="w-full flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-xs font-bold text-indigo-600 py-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Télécharger l'ordonnance
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <!-- Modale de Confirmation de Réservation (US 1.2) -->
    <div id="bookingModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden p-6 space-y-4">
            <h3 class="text-base font-bold text-slate-900">Confirmer la demande de rendez-vous ?</h3>
            <p class="text-sm text-slate-500">
                Vous êtes sur le point de bloquer le créneau de <span id="modal-time" class="font-bold text-indigo-600"></span> avec <span id="modal-doc" class="font-bold text-slate-800"></span>.
            </p>
            <p class="text-xs text-amber-600 bg-amber-50 px-3 py-2 rounded-lg border border-amber-100">
                Le rendez-vous sera enregistré avec le statut <strong>En attente</strong> jusqu'à la validation du médecin.
            </p>
            <div class="flex justify-end gap-3 pt-2">
                <button onclick="closeBookingModal()" class="px-4 py-2 text-sm font-semibold text-slate-500">Annuler</button>
                <button type="button" onclick="submitBooking()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-5 py-2 rounded-xl shadow-md shadow-indigo-100">
                    Confirmer la réservation
                </button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('bookingModal');
        
        function confirmAppointment(doctorName, timeSlot) {
            document.getElementById('modal-doc').innerText = doctorName;
            document.getElementById('modal-time').innerText = timeSlot;
            modal.classList.remove('opacity-0', 'pointer-events-none');
        }

        function closeBookingModal() {
            modal.classList.add('opacity-0', 'pointer-events-none');
        }

        function submitBooking() {
            // Ici l'envoi du formulaire ou la requête Ajax
            alert('Réservation enregistrée ! Statut initial : EN_ATTENTE.');
            closeBookingModal();
        }
    </script>
</body>
</html>