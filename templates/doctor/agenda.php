<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Planning de Consultations</h1>
            <p class="text-sm text-slate-500">Vue globale de vos dossiers médicaux</p>
        </div>
        <div class="flex items-center space-x-2 bg-white px-3 py-1.5 border border-slate-200 rounded-xl text-sm font-medium text-slate-600">
            <i class="fa-solid fa-calendar-days text-blue-600"></i>
            <span>Semaine en cours</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs font-bold uppercase border-b border-slate-200">
                        <th class="p-4">Horaire</th>
                        <th class="p-4">Patient</th>
                        <th class="p-4">Statut actuel</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <tr>
                        <td class="p-4 font-semibold text-slate-900">Lun 01/06 — 11:30</td>
                        <td class="p-4">Alice Martin</td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-800 border border-amber-200">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>En attente
                            </span>
                        </td>
                        <td class="p-4 text-right space-x-1">
                            <form action="/doctor/appointment/validate" method="POST" class="inline-block">
                                <input type="hidden" name="appointment_id" value="501">
                                <button type="submit" class="px-2.5 py-1 text-xs font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white rounded-md border border-emerald-200 transition cursor-pointer">Valider</button>
                            </form>
                            <form action="/doctor/appointment/cancel" method="POST" class="inline-block">
                                <input type="hidden" name="appointment_id" value="501">
                                <button type="submit" class="px-2.5 py-1 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-600 hover:text-white rounded-md border border-red-200 transition cursor-pointer">Annuler</button>
                            </form>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-4 font-semibold text-slate-900">Lun 01/06 — 14:00</td>
                        <td class="p-4">Marc Tournier</td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-800 border border-blue-200">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>Confirmé
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <button type="button" onclick="openConsultationModal('502', 'Marc Tournier')" class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs transition cursor-pointer">
                                <i class="fa-solid fa-notes-medical mr-1.5"></i>Lancer la Consultation
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="prescription-modal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100 animate-in fade-in zoom-in-95 duration-200">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-slate-900">Clôture de consultation : <span id="modal-patient-name" class="text-blue-600"></span></h3>
            <button type="button" onclick="closeConsultationModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        
        <form action="/doctor/appointment/complete" method="POST" class="space-y-4">
            <input type="hidden" id="modal-appointment-id" name="appointment_id" value="">
            
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Rédiger l'ordonnance médicale (Format textuel)</label>
                <textarea name="prescription_text" rows="6" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-hidden focus:ring-2 focus:ring-blue-500 font-mono text-sm" placeholder="Ex: — Paracétamol 1000mg : 1 comprimé toutes les 6 heures si douleur.&#10;— Repos strict pendant 3 jours."></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-2">
                <button type="button" onclick="closeConsultationModal()" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition cursor-pointer">Fermer</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs transition cursor-pointer">Passer à Statut::TERMINE</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openConsultationModal(id, patientName) {
        document.getElementById('modal-appointment-id').value = id;
        document.getElementById('modal-patient-name').innerText = patientName;
        document.getElementById('prescription-modal').classList.remove('hidden');
    }
    function closeConsultationModal() {
        document.getElementById('prescription-modal').classList.add('hidden');
    }
</script>