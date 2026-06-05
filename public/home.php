
<?php
 require '../templates/layout/header.php'; 
?>
<!DOCTYPE html>
<html lang="fr" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Gestion Clinique & Rendez-vous</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="flex flex-col min-h-screen text-slate-800 antialiased">

    <header class="relative overflow-hidden bg-white pt-16 pb-20 lg:pt-24 lg:pb-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 mb-4 border border-indigo-100/50">
                        <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span> Solution Santé connectée
                    </span>
                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-950 sm:text-5xl md:text-6xl leading-tight">
                        Votre santé, <br>
                        <span class="text-indigo-600">uniquement sur rendez-vous.</span>
                    </h1>
                    <p class="mt-4 text-base text-slate-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl leading-relaxed">
                        Planifiez vos consultations en quelques clics avec nos spécialistes, accédez à vos ordonnances sécurisées et gérez le suivi de votre santé en toute simplicité.
                    </p>
                    
                    <div class="mt-8 sm:max-w-lg sm:mx-auto lg:mx-0 flex flex-col sm:flex-row gap-4">
                        <a href="prendre-rdv.php" class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3.5 rounded-xl shadow-lg shadow-indigo-100 transition-all text-center">
                            Prendre rendez-vous
                        </a>
                        <a href="login.php?role=medecin" class="flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-semibold px-6 py-3.5 rounded-xl transition-colors text-center">
                            Portail Médecins
                        </a>
                    </div>
                </div>

                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 flex justify-center">
                    <div class="relative w-full max-w-md bg-gradient-to-tr from-indigo-100 to-emerald-50 rounded-3xl p-8 shadow-2xl border border-white">
                        <div class="bg-white rounded-2xl p-4 shadow-xl border border-slate-100 mb-4 transform -translate-x-4 rotate-1 max-w-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Prochain RDV</span>
                            </div>
                            <p class="text-sm font-semibold text-slate-900 mt-1">Demain à 10h30</p>
                            <p class="text-xs text-slate-400">Dr. Amina Benjelloun (Cardiologue)</p>
                        </div>

                        <div class="bg-white rounded-2xl p-5 shadow-xl border border-slate-100 transform translate-x-4 -rotate-1">
                            <h4 class="text-sm font-bold text-slate-900 mb-3">Spécialités disponibles</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center text-xs p-2 bg-slate-50 rounded-lg">
                                    <span class="font-medium text-slate-700">Cardiologie</span>
                                    <span class="text-indigo-600 font-semibold">Dispo</span>
                                </div>
                                <div class="flex justify-between items-center text-xs p-2 bg-slate-50 rounded-lg">
                                    <span class="font-medium text-slate-700">Pédiatrie</span>
                                    <span class="text-indigo-600 font-semibold">Dispo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <section id="stats" class="bg-slate-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-3xl font-extrabold text-indigo-400">15+</div>
                    <div class="text-sm text-slate-400 mt-1">Médecins Spécialistes</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-emerald-400">100%</div>
                    <div class="text-sm text-slate-400 mt-1">Ordonnances Sécurisées</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-indigo-400">24/7</div>
                    <div class="text-sm text-slate-400 mt-1">Prise de RDV en ligne</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-emerald-400">0</div>
                    <div class="text-sm text-slate-400 mt-1">Frais de dossier</div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-20 lg:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Une gestion simplifiée pour tous</h2>
                <p class="mt-4 text-lg text-slate-500">Que vous soyez un patient à la recherche d'un créneau ou un praticien gérant vos consultations.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-bold mb-5">
                        📅
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Créneaux en temps réel</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Visualisez instantanément les disponibilités de vos médecins et réservez l'heure exacte qui convient à votre emploi du temps.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold mb-5">
                        📄
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Ordonnances Numériques</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Retrouvez vos prescriptions textuelles directement sur votre espace personnel sécurisé juste après votre consultation terminée.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-bold mb-5">
                        🛡️
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Espace Praticien Dédié</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Les médecins peuvent configurer l'activation de leur profil, suivre leur tableau de bord et modifier le statut des consultations (Confirmé, Terminé).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-auto bg-white border-t border-slate-200 py-8 text-center text-sm text-slate-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xs">
                    M
                </div>
                <span class="font-bold text-slate-700">MedFlow</span>
            </div>
            <p>&copy; 2026 MedFlow. Tous droits réservés. Projet Application Clinique Médicale.</p>
        </div>
    </footer>

</body>
</html>