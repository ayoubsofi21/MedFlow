<div class="space-y-8">
    <div class="border-b border-slate-200 pb-4">
        <h1 class="text-2xl font-bold text-slate-900">Administration MedFlow</h1>
        <p class="text-sm text-slate-500">Indicateurs de performance et gestion du référentiel d'accès (RBAC).</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center space-x-4 shadow-2xs">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">RDV Terminés / Médecin</p>
                <p class="text-2xl font-black text-slate-900 mt-0.5">84.6 %</p>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center space-x-4 shadow-2xs">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Taux global d'annulation</p>
                <p class="text-2xl font-black text-slate-900 mt-0.5">3.8 %</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center space-x-4 shadow-2xs">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Comptes praticiens actifs</p>
                <p class="text-2xl font-black text-slate-900 mt-0.5">18</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs h-fit">
            <h3 class="text-base font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">
                <i class="fa-solid fa-user-plus mr-2 text-blue-600"></i>Ajouter un Praticien
            </h3>
            
            <form action="/admin/doctor/create" method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nom Complet</label>
                    <input type="text" name="name" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Adresse Email</label>
                    <input type="email" name="email" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Spécialité Médicale</label>
                    <select name="specialty_id" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                        <option value="">Sélectionner un domaine</option>
                        <option value="1">Cardiologue</option>
                        <option value="2">Généraliste</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2.5 rounded-xl transition shadow-xs cursor-pointer">
                    Créer le compte médecin
                </button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-900 text-sm">Équipe Médicale Enregistrée</h3>
                <a href="/admin/specialties" class="text-xs text-blue-600 hover:underline font-medium">Gérer les spécialités <i class="fa-solid fa-arrow-right ml-1"></i></a>
            </div>
            
            <div class="divide-y divide-slate-100">
                <div class="p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Dr. Jean Dupont</p>
                        <p class="text-xs text-slate-500">Spécialité : <span class="text-blue-600 font-medium">Cardiologue</span> &bull; jp@medflow.org</p>
                    </div>
                    
                    <form action="/admin/doctor/toggle" method="POST">
                        <input type="hidden" name="doctor_id" value="1">
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-red-50 hover:text-red-700 hover:border-red-200 transition cursor-pointer">
                            <i class="fa-solid fa-circle-check mr-1"></i>Compte Actif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>