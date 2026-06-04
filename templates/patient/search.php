<div class="space-y-8">
    <div class="bg-white p-6 rounded-2xl shadow-xs border border-slate-200">
        <h2 class="text-xl font-bold mb-4 text-slate-900">Trouver un professionnel de santé</h2>
        <form action="/patient/search" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="relative">
                <i class="fa-solid fa-user-doctor absolute left-3 top-3.5 text-slate-400"></i>
                <input type="text" name="doctor_name" placeholder="Nom du médecin..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-hidden focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
            <div class="relative">
                <i class="fa-solid fa-stethoscope absolute left-3 top-3.5 text-slate-400"></i>
                <select name="specialty" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-hidden focus:ring-2 focus:ring-blue-500 text-sm appearance-none">
                    <option value="">Toutes les spécialités</option>
                    <option value="cardiologue">Cardiologue</option>
                    <option value="generaliste">Généraliste</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl px-6 py-2.5 transition duration-150 text-sm cursor-pointer">
                <i class="fa-solid fa-magnifying-glass mr-2"></i>Rechercher
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl font-bold">
                    <i class="fa-solid fa-user-md"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-slate-900">Dr. Jean Dupont</h3>
                    <p class="text-sm text-blue-600 font-medium">Cardiologue</p>
                </div>
            </div>
        </div>
        
        <div class="p-6 bg-slate-50/50 border-t border-slate-100">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Créneaux horaires disponibles</p>
            
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-3">
                <div class="bg-white p-3 rounded-xl border border-slate-200 text-center space-y-2">
                    <span class="block text-xs font-bold text-slate-600 bg-slate-100 py-1 rounded-md mb-2">Lundi 01/06</span>
                    
                    <form action="/appointment/book" method="POST">
                        <input type="hidden" name="slot_id" value="101">
                        <button type="submit" class="w-full text-xs bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold py-2 px-1 rounded-lg transition duration-150 cursor-pointer">
                            09:00
                        </button>
                    </form>

                    <form action="/appointment/book" method="POST">
                        <input type="hidden" name="slot_id" value="102">
                        <button type="submit" class="w-full text-xs bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold py-2 px-1 rounded-lg transition duration-150 cursor-pointer">
                            10:30
                        </button>
                    </form>

                    <button type="button" disabled class="w-full text-xs bg-slate-100 text-slate-400 line-through font-medium py-2 px-1 rounded-lg cursor-not-allowed">
                        14:00
                    </button>
                </div>

                </div>
        </div>
    </div>
</div>