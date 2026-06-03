<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Gestion de Clinique Médicale</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-md shadow-blue-200">
                        <i class="fa-solid fa-heart-pulse text-xl"></i>
                    </div>
                    <div>
                        <span class="text-xl font-black tracking-tight bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">MedFlow</span>
                        <span class="hidden sm:inline-block text-[10px] font-bold uppercase tracking-widest bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded ml-2 align-middle">v1.0</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    <label class="text-xs font-bold text-slate-400 uppercase hidden md:inline-block">Rôle Actuel (Démo) :</label>
                    <select id="role-simulator" onchange="switchRole(this.value)" class="bg-slate-100 border border-slate-200 rounded-xl px-3 py-1.5 text-xs font-bold text-slate-700 focus:outline-hidden focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="patient">Patient (Épic 1)</option>
                        <option value="doctor">Médecin (Épic 2)</option>
                        <option value="admin">Administrateur (Épic 3)</option>
                    </select>
                    
                    <span class="h-6 w-px bg-slate-200 mx-2"></span>
                    
                    <div class="flex items-center space-x-3">
                        <div id="user-badge" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm border border-blue-100">
                            PT
                        </div>
                        <button class="text-slate-400 hover:text-red-500 transition p-1" title="Déconnexion (Logique Middleware)">
                            <i class="fa-solid fa-right-from-bracket text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8">

        <div id="epic-patient" class="space-y-8 animate-fade-in">
            <div class="flex justify-between items-center border-b border-slate-200 pb-4">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Espace Patient</h1>
                    <p class="text-sm text-slate-500">Recherche, réservation instantanée et suivi des soins.</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xs border border-slate-200">
                <h2 class="text-base font-bold mb-4 text-slate-900 flex items-center">
                    <i class="fa-solid fa-magnifying-glass text-blue-600 mr-2"></i> Rechercher un professionnel de santé
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <i class="fa-solid fa-user-doctor absolute left-3 top-3.5 text-slate-400"></i>
                        <input type="text" id="search-name" placeholder="Nom du médecin... (ex: Dupont)" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-hidden focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-stethoscope absolute left-3 top-3.5 text-slate-400"></i>
                        <select id="search-specialty" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-hidden focus:ring-2 focus:ring-blue-500 text-sm appearance-none cursor-pointer">
                            <option value="">Toutes les spécialités</option>
                            <option value="Cardiologue">Cardiologue</option>
                            <option value="Généraliste">Généraliste</option>
                            <option value="Pédiatre">Pédiatre</option>
                        </select>
                    </div>
                    <button type="button" onclick="filterDoctors()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl px-6 py-2.5 transition duration-150 text-sm shadow-xs flex items-center justify-center cursor-pointer">
                        Filtrer les créneaux
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <div class="bg-white rounded-2xl shadow-xs border border-slate-200 overflow-hidden doctor-card" data-specialty="Cardiologue" data-name="dupont">
                    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-white to-slate-50/50">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl font-bold border border-blue-100">
                                <i class="fa-solid fa-user-md"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-slate-900">Dr. Jean Dupont</h3>
                                <p class="text-xs bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-full font-semibold inline-block mt-1">Cardiologue</p>
                            </div>
                        </div>
                        <div class="text-xs text-slate-400 font-medium">
                            <i class="fa-solid fa-location-dot mr-1"></i> Clinique MedFlow — Aile A
                        </div>
                    </div>
                    
                    <div class="p-6 bg-slate-50/50 border-t border-slate-100">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4"><i class="fa-regular fa-calendar-check mr-1.5 text-blue-500"></i>Créneaux libres pour cette semaine :</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            <div class="bg-white p-3 rounded-xl border border-slate-200 text-center space-y-2 shadow-2xs">
                                <span class="block text-xs font-bold text-slate-700 bg-slate-100 py-1 rounded-md mb-2">Lun 01 Juin</span>
                                <button onclick="openBookingModal('Dr. Jean Dupont', 'Lun 01 Juin à 09:00')" class="w-full text-xs bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-2 px-1 rounded-lg transition duration-150 cursor-pointer">09:00</button>
                                <button onclick="openBookingModal('Dr. Jean Dupont', 'Lun 01 Juin à 10:30')" class="w-full text-xs bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-2 px-1 rounded-lg transition duration-150 cursor-pointer">10:30</button>
                            </div>
                            <div class="bg-white p-3 rounded-xl border border-slate-200 text-center space-y-2 shadow-2xs">
                                <span class="block text-xs font-bold text-slate-700 bg-slate-100 py-1 rounded-md mb-2">Mar 02 Juin</span>
                                <button disabled class="w-full text-xs bg-slate-100 text-slate-400 line-through font-medium py-2 px-1 rounded-lg cursor-not-allowed" title="Créneau occupé">14:00</button>
                                <button onclick="openBookingModal('Dr. Jean Dupont', 'Mar 02 Juin à 15:30')" class="w-full text-xs bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-2 px-1 rounded-lg transition duration-150 cursor-pointer">15:30</button>
                            </div>
                            <div class="bg-white p-3 rounded-xl border border-slate-200 text-center space-y-2 shadow-2xs">
                                <span class="block text-xs font-bold text-slate-700 bg-slate-100 py-1 rounded-md mb-2">Mer 03 Juin</span>
                                <button onclick="openBookingModal('Dr. Jean Dupont', 'Mer 03 Juin à 11:00')" class="w-full text-xs bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-2 px-1 rounded-lg transition duration-150 cursor-pointer">11:00</button>
                                <button disabled class="w-full text-xs bg-slate-100 text-slate-400 line-through font-medium py-2 px-1 rounded-lg cursor-not-allowed">16:30</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xs border border-slate-200 overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-900"><i class="fa-solid fa-clock-history text-slate-400 mr-2"></i>Mes Consultations & Suivi</h3>
                    <span class="text-xs text-slate-500 font-medium">Historique synchronisé</span>
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="text-center p-2.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-xl min-w-[75px]">
                                <span class="block text-xs font-bold uppercase tracking-wider">Juin</span>
                                <span class="block text-lg font-black">04</span>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Dr. Jean Dupont</p>
                                <p class="text-xs text-slate-500">Créneau Réservé à 09:00 &bull; Cardiologie</p>
                            </div>
                        </div>
                        <div>
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>Statut::EN_ATTENTE
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="text-center p-2.5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl min-w-[75px]">
                                <span class="block text-xs font-bold uppercase tracking-wider">Mai</span>
                                <span class="block text-lg font-black">18</span>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Dr. Claire Robert</p>
                                <p class="text-xs text-slate-500">Consultation passée à 14:30 &bull; Généraliste</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 w-full sm:w-auto justify-between sm:justify-end">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Statut::TERMINE
                            </span>
                            <button onclick="downloadPrescriptionMock('Dr. Claire Robert', 'Paracétamol 1g - 3x/jour\nRepos 48h.')" class="inline-flex items-center text-xs font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-3 py-1.5 rounded-lg transition cursor-pointer">
                                <i class="fa-solid fa-arrow-down-long mr-1.5"></i> Ordonnance
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="epic-doctor" class="space-y-8 hidden animate-fade-in">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 pb-4">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Espace Cabinet Médical</h1>
                    <p class="text-sm text-slate-500">Vue hebdomadaire du planning et gestion stricte des consultations.</p>
                </div>
                <div class="text-xs bg-indigo-50 border border-indigo-200 text-indigo-700 px-3 py-1.5 rounded-xl font-bold">
                    <i class="fa-solid fa-user-md mr-1"></i> Mode Praticien Connecté
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xs border border-slate-200 overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 text-sm">Feuille de route & Statuts de la semaine</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase border-b border-slate-200 tracking-wider">
                                <th class="p-4">Date & Heure</th>
                                <th class="p-4">Nom du Patient</th>
                                <th class="p-4">État de la Demande</th>
                                <th class="p-4 text-right">Actions Restrictives (RBAC)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-semibold text-slate-900">Jeu 04 Juin — 09:00</td>
                                <td class="p-4 text-slate-600">Alice Martin</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>Statut::EN_ATTENTE
                                    </span>
                                </td>
                                <td class="p-4 text-right space-x-1 whitespace-nowrap">
                                    <button onclick="alert('Le rendez-vous passe au Statut::CONFIRME. Notification envoyée au patient.')" class="px-3 py-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white rounded-lg border border-emerald-200 transition cursor-pointer">Valider</button>
                                    <button onclick="alert('Le rendez-vous passe au Statut::ANNULE. Le créneau est instantanément libéré.')" class="px-3 py-1.5 text-xs font-bold text-red-700 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg border border-red-200 transition cursor-pointer">Annuler</button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-semibold text-slate-900">Jeu 04 Juin — 10:30</td>
                                <td class="p-4 text-slate-600">Thomas Dubois</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-200">
                                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>Statut::CONFIRME
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <button onclick="openPrescriptionModal('Thomas Dubois')" class="px-3 py-1.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs transition inline-flex items-center cursor-pointer">
                                        <i class="fa-solid fa-file-signature mr-1.5"></i> Clôturer / Consulter
                                    </button>
                                </td>
                            </tr>

                            <tr class="bg-slate-50/30 text-slate-400">
                                <td class="p-4 font-medium line-through">Jeu 04 Juin — 14:00</td>
                                <td class="p-4 line-through">Marc Tournier</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200">
                                        Statut::ANNULE
                                    </span>
                                </td>
                                <td class="p-4 text-right text-xs italic font-medium">Créneau libéré</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div id="epic-admin" class="space-y-8 hidden animate-fade-in">
            <div class="border-b border-slate-200 pb-4">
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Console d'Administration</h1>
                <p class="text-sm text-slate-500">Pilotage de l'activité globale, indicateurs de performance (KPI) et référentiel.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center space-x-4 shadow-2xs">
                    <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl border border-red-100">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Taux d'annulation global</p>
                        <p class="text-2xl font-black text-slate-900 mt-0.5">4.12 %</p>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center space-x-4 shadow-2xs">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl border border-emerald-100">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Consultations Clôturées</p>
                        <p class="text-2xl font-black text-slate-900 mt-0.5">342 / mois</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center space-x-4 shadow-2xs sm:col-span-2 md:col-span-1">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl border border-blue-100">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Praticiens Actifs (RBAC)</p>
                        <p class="text-2xl font-black text-slate-900 mt-0.5">14 Médecins</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs h-fit">
                    <h3 class="text-sm font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2 uppercase tracking-wide">
                        <i class="fa-solid fa-user-plus mr-2 text-blue-600"></i>Ajouter un Praticien
                    </h3>
                    <form onsubmit="alert('Médecin créé avec succès et associé à sa spécialité obligatoire.'); return false;" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nom complet du Praticien</label>
                            <input type="text" placeholder="Dr. Prénom Nom" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Adresse Email Professionnelle</label>
                            <input type="email" placeholder="nom@medflow.fr" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Spécialité Médicale (Obligatoire)</label>
                            <select required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-hidden cursor-pointer">
                                <option value="">Choisir un domaine...</option>
                                <option value="1">Cardiologue</option>
                                <option value="2">Généraliste</option>
                                <option value="3">Pédiatre</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2.5 rounded-xl transition shadow-xs cursor-pointer">
                            Enregistrer & Activer le Compte
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
                    <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-900 text-sm"><i class="fa-solid fa-tags text-slate-400 mr-2"></i>Gestion des Spécialités Hospitalières</h3>
                        <button onclick="alert('Ajout d\'une nouvelle spécialité au catalogue filtre.')" class="text-xs bg-blue-50 text-blue-600 hover:bg-blue-100 font-bold px-2.5 py-1.5 rounded-lg border border-blue-100 transition cursor-pointer">
                            + Nouvelle Spécialité
                        </button>
                    </div>
                    
                    <div class="divide-y divide-slate-100">
                        <div class="p-4 flex justify-between items-center hover:bg-slate-50/50 transition">
                            <div>
                                <p class="font-bold text-slate-900 text-sm">Cardiologue</p>
                                <p class="text-[11px] text-slate-400 uppercase font-semibold">Code: SPEC_CARDIO &bull; 4 Praticiens rattachés</p>
                            </div>
                            <button onclick="alert('Modification ou désactivation de l\'élément de référentiel.')" class="p-2 text-slate-400 hover:text-blue-600"><i class="fa-regular fa-pen-to-square"></i></button>
                        </div>
                        <div class="p-4 flex justify-between items-center hover:bg-slate-50/50 transition">
                            <div>
                                <p class="font-bold text-slate-900 text-sm">Généraliste</p>
                                <p class="text-[11px] text-slate-400 uppercase font-semibold">Code: SPEC_GEN &bull; 8 Praticiens rattachés</p>
                            </div>
                            <button class="p-2 text-slate-400 hover:text-blue-600"><i class="fa-regular fa-pen-to-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <div id="booking-modal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-slate-900">Confirmer la réservation ?</h3>
                <button onclick="closeBookingModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <p class="text-sm text-slate-500 mb-4">Vous vous apprêtez à réserver le créneau suivant auprès de la clinique :</p>
            <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl mb-4 text-sm">
                <p class="font-bold text-blue-900" id="modal-book-doctor"></p>
                <p class="text-blue-700 font-medium mt-0.5" id="modal-book-time"></p>
            </div>
            <div class="bg-slate-100 p-3 rounded-xl mb-4 text-xs text-slate-500">
                <i class="fa-solid fa-circle-info text-blue-500 mr-1.5"></i> Le statut initial du rendez-vous sera enregistré en base de données comme <span class="font-mono font-bold">Statut::EN_ATTENTE</span>.
            </div>
            <div class="flex justify-end space-x-2">
                <button onclick="closeBookingModal()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl cursor-pointer">Annuler</button>
                <button onclick="confirmBooking()" class="px-4 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-xs cursor-pointer">Confirmer la Demande</button>
            </div>
        </div>
    </div>

    <div id="prescription-modal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-slate-900">Clôturer la Consultation : <span id="presc-patient" class="text-blue-600"></span></h3>
                <button onclick="closePrescriptionModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <form onsubmit="submitPrescription(); return false;" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Rédiger l'ordonnance textuelle liée de manière sécurisée au dossier</label>
                    <textarea required rows="5" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-hidden focus:ring-2 focus:ring-blue-500 font-mono text-sm" placeholder="Ex: — Amoxicilline 500mg : 1 gélule 3 fois par jour au milieu des repas pendant 6 jours."></textarea>
                </div>
                <div class="bg-amber-50 border border-amber-200 p-3 rounded-xl text-xs text-amber-800">
                    <i class="fa-solid fa-triangle-exclamation mr-1.5"></i> **Règle de Typage Strict :** La soumission passera l'état de la consultation à <span class="font-mono font-bold">Statut::TERMINE</span> de manière irréversible.
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closePrescriptionModal()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl cursor-pointer">Retour</button>
                    <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs cursor-pointer">Archiver & Valider le Dossier</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-400 font-medium">
        &copy; 2026 MedFlow &bull; Projet de Fin de Brief &bull; Groupe de Travail Simplon.
    </footer>

    <script>
        // Gestion des rôles RBAC
        function switchRole(role) {
            document.getElementById('epic-patient').classList.add('hidden');
            document.getElementById('epic-doctor').classList.add('hidden');
            document.getElementById('epic-admin').classList.add('hidden');
            
            const badge = document.getElementById('user-badge');

            if(role === 'patient') {
                document.getElementById('epic-patient').classList.remove('hidden');
                badge.innerText = "PT";
                badge.className = "w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm border border-blue-100";
            } else if(role === 'doctor') {
                document.getElementById('epic-doctor').classList.remove('hidden');
                badge.innerText = "DR";
                badge.className = "w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm border border-indigo-100";
            } else if(role === 'admin') {
                document.getElementById('epic-admin').classList.remove('hidden');
                badge.innerText = "AD";
                badge.className = "w-9 h-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm border border-red-100";
            }
        }

        // Filtre dynamique de l'US 1.1
        function filterDoctors() {
            const nameValue = document.getElementById('search-name').value.toLowerCase();
            const specialtyValue = document.getElementById('search-specialty').value;
            const cards = document.querySelectorAll('.doctor-card');

            cards.forEach(card => {
                const cardName = card.getAttribute('data-name');
                const cardSpecialty = card.getAttribute('data-specialty');
                
                const matchesName = cardName.includes(nameValue);
                const matchesSpecialty = specialtyValue === "" || cardSpecialty === specialtyValue;

                if(matchesName && matchesSpecialty) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        }

        // Modals Réservation (US 1.2)
        function openBookingModal(doctor, time) {
            document.getElementById('modal-book-doctor').innerText = doctor;
            document.getElementById('modal-book-time').innerText = time;
            document.getElementById('booking-modal').classList.remove('hidden');
        }
        function closeBookingModal() {
            document.getElementById('booking-modal').classList.add('hidden');
        }
        function confirmBooking() {
            alert('Enregistrement en Base de Données effectué !\nStatut initial : Statut::EN_ATTENTE.\nLe créneau horaire est désormais marqué indisponible.');
            closeBookingModal();
        }

        // Modals Consultation (US 2.3)
        function openPrescriptionModal(patient) {
            document.getElementById('presc-patient').innerText = patient;
            document.getElementById('prescription-modal').classList.remove('hidden');
        }
        function closePrescriptionModal() {
            document.getElementById('prescription-modal').classList.add('hidden');
        }
        function submitPrescription() {
            alert('Félicitations !\nLe statut passe à Statut::TERMINE.\nL\'ordonnance est liée de manière sécurisée et archivée.');
            closePrescriptionModal();
        }

        // Téléchargement d'ordonnance simulé (US 1.3)
        function downloadPrescriptionMock(doctor, text) {
            alert("Téléchargement de l'ordonnance émise par " + doctor + " :\n\n" + text);
        }
    </script>
</body>
</html>