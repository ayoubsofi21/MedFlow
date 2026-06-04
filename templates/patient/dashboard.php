<head>
    <title>patient dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
</head>
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900">Mon Espace Santé</h1>
        <p class="text-sm text-slate-500">Suivi de vos consultations</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-100">
            <h3 class="font-bold text-slate-900">Historique des rendez-vous</h3>
        </div>
        <div class="divide-y divide-slate-100">
            <div class="p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div class="text-center p-2.5 bg-amber-50 text-amber-700 rounded-xl min-w-[70px]">
                        <span class="block text-xs font-bold uppercase">Juin</span>
                        <span class="block text-xl font-extrabold">03</span>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-900">Dr. Jean Dupont</p>
                        <p class="text-sm text-slate-500">Consultation à 14:30</p>
                    </div>
                </div>
                <div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">En attente de validation</span>
                </div>
            </div>

            <div class="p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div class="text-center p-2.5 bg-emerald-50 text-emerald-700 rounded-xl min-w-[70px]">
                        <span class="block text-xs font-bold uppercase">Mai</span>
                        <span class="block text-xl font-extrabold">20</span>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-900">Dr. Claire Robert</p>
                        <p class="text-sm text-slate-500">Généraliste • Consulté à 10:00</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4 w-full sm:w-auto justify-between sm:justify-end">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">Terminé</span>
                    <a href="/patient/prescription/download?id=45" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                        <i class="fa-solid fa-file-arrow-down mr-1.5"></i> Ordonnance
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>