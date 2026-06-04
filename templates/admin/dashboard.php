<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../../src/Repository/adminRepositories.php";


require_once __DIR__ . "/../../src/Middleware/AuthMiddleware.php";

// ALWAYS first security
// AuthMiddleware::checkLogin();
// AuthMiddleware::checkRole('ADMIN');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediControl - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-10">
        <div class="p-6 border-b border-slate-100 flex items-center gap-3">
            <div class="bg-indigo-600 text-white p-2 rounded-lg font-bold text-xl tracking-wider shadow-md shadow-indigo-200">
                M+
            </div>
            <div>
                <h1 class="font-bold text-slate-900 leading-tight">MediControl</h1>
                <span class="text-xs text-indigo-600 font-medium tracking-wide uppercase">Espace Admin</span>
            </div>
        </div>
        
        <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl bg-indigo-50 text-indigo-600 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
                Vue Globale
            </a>
            <a href="#medecins" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21.75c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                Gestion Médecins
            </a>
            <a href="#specialites" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 21l8.982-2.139M18 15.001a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM9.187 4.523 9 3l8.982 2.139M18 9a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                </svg>
                Spécialités
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3 p-2 bg-slate-50 rounded-xl">
                <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">
                    AD
                </div>
                <div class="flex-1 overflow-hidden">
                    <h4 class="text-sm font-semibold text-slate-900 truncate"><?php echo $_SESSION['name'] ; ?></h4>
                    <p class="text-xs text-slate-500 truncate"><?php echo $_SESSION['email'] ; ?></p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 pl-64 min-h-screen flex flex-col">
        
        <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-2">
                <h2 class="text-xl font-bold text-slate-800">Tableau de bord général</h2>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-500 font-medium"><?php echo todayDatemr() ?></span>
                <div class="w-px h-5 bg-slate-200"></div>
                <button class="text-sm font-medium text-rose-600 hover:text-rose-700 flex items-center gap-1.5">
                     <a href="/MedFlow/public/auth/logout.php"
                    class="text-sm font-medium text-rose-600 hover:text-rose-700">
                    Logout
                    </a>
                </button>
            </div>
        </header>

        <div class="p-8 space-y-8 flex-1">

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 tracking-wider uppercase">Rendez-vous Total</span>
                        <h3 class="text-3xl font-bold text-slate-900 mt-1"><?php echo count(getTotalRDVs()); ?></h3>
                    </div>
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 tracking-wider uppercase">Taux d'annulation</span>
                        <h3 class="text-3xl font-bold text-slate-900 mt-1"><?php echo ((count(getTotalCancels())/count(getTotalRDVs()))*100)-100; ?>%</h3>
                    </div>
                    <div class="p-3 bg-rose-50 text-rose-600 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 tracking-wider uppercase">Médecins Actifs</span>
                        <h3 class="text-3xl font-bold text-slate-900 mt-1"><?php echo getTotalDrsActifs()['total'] ; ?></h3>
                        <p class="text-xs text-slate-400 font-medium mt-1.5">Sur <?php echo empty(getWorkingSpecialities()) ? 0 : count(getWorkingSpecialities()) ; ?> spécialités</p>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 tracking-wider uppercase">Consultations Terminées</span>
                        <h3 class="text-3xl font-bold text-slate-900 mt-1"><?php echo countFinishedCons()['total'] ; ?></h3>
                        <p class="text-xs text-slate-400 font-medium mt-1.5">Dossiers sécurisés archivés</p>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <section id="medecins" class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900">Équipe des Médecins</h3>
                        <p class="text-xs text-slate-500">Créer, modifier, lier aux spécialités ou désactiver les comptes.</p>
                    </div>

                    <div class="p-6 bg-slate-50/70 border-b border-slate-100">
                        <h4 class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-4">Nouveau Profil Médecin</h4>
                        <form action="scripts/add_doctor_process.php" method="POST" class="space-y-4 max-w-md bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                         
                            <h3 class="text-base font-bold text-slate-900 mb-2">Ajouter un nouveau médecin</h3>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Nom</label>
                                <input type="text" name="nom" required placeholder="Ex: Tazi" 
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Prénom</label>
                                <input type="text" name="prenom" required placeholder="Ex: Karim" 
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Adresse Email</label>
                                <input type="email" name="email" required placeholder="Ex: k.tazi@clinic.ma" 
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Numéro RPPS</label>
                                <input type="text" name="numeroRPPS" required placeholder="Ex: 10101234567" 
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Spécialité</label>
                                <select name="specialite_id" required class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                                    <option value="">Sélectionner une spécialité...</option>
                                    <?php 
                                    $specialities = getAllSpecialities();
                                    if (!empty($specialities)):
                                        foreach ($specialities as $speciality): 
                                    ?>
                                            <option value="<?php echo $speciality->id; ?>">
                                                <?php echo htmlspecialchars($speciality->libelle); ?>
                                            </option>
                                    <?php 
                                        endforeach;
                                    endif; 
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-xl text-sm transition-colors mt-2 shadow-sm">
                                Enregistrer le médecin
                            </button>

                            <?php if (isset($_SESSION['error'])): ?>
                                <p class="text-xs text-rose-600 font-medium mt-2 pl-1">
                                    <?php 
                                    echo htmlspecialchars($_SESSION['error']);
                                    unset($_SESSION['error']);
                                    ?>
                                </p>
                            <?php endif; ?>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-slate-400 uppercase text-[11px] font-bold tracking-wider border-b border-slate-100">
                                    <th class="py-4 px-6">Médecin / Email</th>
                                    <th class="py-4 px-6">Spécialité</th>
                                    <th class="py-4 px-6">Statut Compte</th>
                                    <th class="py-4 px-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                    <?php 
                                    $medecins = getAllMedecins();

                                    if (!empty($medecins)): 
                                        foreach ($medecins as $medecin): 
                                            $doctorName = "Dr. " . $medecin->prenom . " " . $medecin->nom;
                                    ?>
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="py-4 px-6">
                                                    <div class="font-semibold text-slate-900"><?php echo htmlspecialchars($doctorName); ?></div>
                                                    <div class="text-xs text-slate-400"><?php echo htmlspecialchars($medecin->email); ?></div>
                                                </td>

                                                <td class="py-4 px-6">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                        <?php echo htmlspecialchars($medecin->specialite); ?>
                                                    </span>
                                                </td>

                                                <td class="py-4 px-6">
                                                    <?php if ($medecin->actif): ?>
                                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Actif
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                                            <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span> Inactif
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                    
                                                <td class="py-4 px-6 text-right space-x-3">
                                                    <button onclick="openEditModal(
                                                                '<?php echo $medecin->user_id; ?>',
                                                                '<?php echo $medecin->nom; ?>',
                                                                '<?php echo $medecin->prenom; ?>',
                                                                '<?php echo $medecin->email; ?>',
                                                                '<?php echo $medecin->numeroRPPS; ?>',
                                                                '<?php echo $medecin->specialite_id; ?>'
                                                            )" 
                                                            class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">
                                                        Modifier
                                                    </button>
                                                    
                                                    <?php 
                                                    if ($medecin->actif == 1) {
                                                        $texte_lien = "Désactiver";
                                                        $classe_couleur = "text-rose-600 hover:text-rose-900";
                                                    } else {
                                                        $texte_lien = "Activer";
                                                        $classe_couleur = "text-emerald-600 hover:text-emerald-900";
                                                    }
                                                    ?>

                                                    <a href="scripts/toggle_status.php?id=<?php echo $medecin->user_id; ?>" 
                                                       class="<?php echo $classe_couleur; ?> font-medium text-xs inline-block">
                                                        <?php echo $texte_lien; ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php 
                                        endforeach; 
                                    else: 
                                    ?>
                                        <tr>
                                            <td colspan="4" class="py-8 text-center text-sm text-slate-400 italic">
                                                Aucun médecin trouvé.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="specialites" class="bg-white rounded-2xl border border-slate-200 shadow-sm flex flex-col">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900">Spécialités</h3>
                        <p class="text-xs text-slate-500">Filtres de recherche patients.</p>
                    </div>
                    <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                        <form action="scripts/speciality_process.php" method="POST" class="flex flex-col gap-2">
                            <div class="flex gap-2">
                                <input type="text" 
                                       name="libelle" 
                                       placeholder="Nouvelle spécialité..." 
                                       required
                                       class="flex-1 bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 transition-colors">

                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-xl font-medium text-sm transition-colors">
                                    Ajouter
                                </button>
                            </div>

                            <?php if (isset($_SESSION['spec_error'])): ?>
                                <p class="text-xs text-rose-600 font-medium pl-1 mt-1">
                                    <?php 
                                    echo htmlspecialchars($_SESSION['spec_error']); 
                                    unset($_SESSION['spec_error']);
                                    ?>
                                </p>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="p-4 flex-1 overflow-y-auto max-h-[300px]">
                        <ul class="space-y-2">
                            <?php
                            $specialites = getAllSpecialities();
                            if (!empty($specialites)):
                                foreach ($specialites as $spec):
                            ?>
                                <li class="flex items-center justify-between p-3 bg-white border border-slate-100 rounded-xl">
                                    <span class="text-sm font-medium text-slate-800"><?php echo htmlspecialchars($spec->libelle); ?></span>
                                </li>
                            <?php
                                endforeach;
                            else:
                            ?>
                                <li class="text-sm text-slate-400 italic text-center py-4">Aucune spécialité trouvée.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </section>

            </div>
        </div>
    </main>
    <div id="editDoctorModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-200">
        
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl border border-slate-200 overflow-hidden transform scale-95 transition-transform duration-200" id="modalCard">
            
            <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Modifier le Profil Médecin</h3>
                    <p class="text-xs text-slate-500">Mettre à jour les informations d'authentification et de cabinet.</p>
                </div>
                <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 rounded-lg p-1 hover:bg-slate-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="scripts/modify_doctor_process.php" method="POST" class="p-6 space-y-4">
                <input type="hidden" name="user_id" id="editUserId">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nom</label>
                        <input type="text" name="nom" id="editNom" required
                            class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Prénom</label>
                        <input type="text" name="prenom" id="editPrenom" required
                            class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Spécialité Affectée</label>
                    <select name="specialite_id" id="editSpecialty" required class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="">Sélectionner une spécialité...</option>
                        <?php 
                        $specialites = getAllSpecialities();
                        if (!empty($specialites)):
                            foreach ($specialites as $spec): 
                        ?>
                            <option value="<?php echo $spec->id; ?>">
                                <?php echo htmlspecialchars($spec->libelle); ?>
                            </option>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Adresse Email de Connexion</label>
                    <input type="email" name="email" id="editEmail" required
                        class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 flex justify-between">
                        <span>Numéro RPPS</span>
                        <span class="text-[10px] text-slate-400 font-normal italic">Modifier uniquement si nécessaire</span>
                    </label>
                    <input type="text" name="numeroRPPS" id="editRPPS" required placeholder="Ex: 10101234567"
                        class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>

                <?php if (isset($_SESSION['edit_error'])): ?>
                    <div class="text-xs text-rose-600 font-semibold bg-rose-50 px-4 py-2.5 rounded-xl border border-rose-100 mt-2">
                        <?php 
                        echo htmlspecialchars($_SESSION['edit_error']);
                        unset($_SESSION['edit_error']);
                        ?>
                    </div>
                <?php endif; ?>
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-sm transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-sm transition-colors">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const modal = document.getElementById('editDoctorModal');
        const card  = document.getElementById('modalCard');
        function openEditModal(userId, nom, prenom, email, numeroRPPS, specialiteId) {
            document.getElementById('editUserId').value   = userId;
            document.getElementById('editNom').value      = nom;
            document.getElementById('editPrenom').value   = prenom;
            document.getElementById('editEmail').value    = email;
            document.getElementById('editRPPS').value     = numeroRPPS;
            document.getElementById('editSpecialty').value = specialiteId;
            modal.classList.remove('opacity-0', 'pointer-events-none');
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }
        function closeEditModal() {
            modal.classList.add('opacity-0', 'pointer-events-none');
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
        }
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeEditModal();
        });
    </script>
</body>
</html>
