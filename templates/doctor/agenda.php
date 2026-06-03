<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../layout/header.php';
?>


<!-- <div id="epic-doctor" class="space-y-8 hidden animate-fade-in"> -->

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                Espace Cabinet Médical
            </h1>
            <p class="text-sm text-slate-500">
                Vue hebdomadaire du planning et gestion stricte des consultations.
            </p>
        </div>

        <div class="text-xs bg-indigo-50 border border-indigo-200 text-indigo-700 px-3 py-1.5 rounded-xl font-bold">
            <i class="fa-solid fa-user-md mr-1"></i> Mode Praticien Connecté
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-200 overflow-hidden">

        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-900 text-sm">
                Feuille de route & Statuts de la semaine
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase border-b border-slate-200 tracking-wider">
                        <th class="p-4">Date & Heure</th>
                        <th class="p-4">Nom du Patient</th>
                        <th class="p-4">État de la Demande</th>
                        <th class="p-4 text-right">Actions (RBAC)</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">

                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-4 font-semibold text-slate-900">Jeu 04 Juin — 09:00</td>
                        <td class="p-4 text-slate-600">Alice Martin</td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>
                                Statut::EN_ATTENTE
                            </span>
                        </td>
                        <td class="p-4 text-right space-x-1 whitespace-nowrap">
                            <button
                                onclick="alert('Rendez-vous confirmé. Notification envoyée.')"
                                class="px-3 py-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white rounded-lg border border-emerald-200 transition">
                                Valider
                            </button>

                            <button
                                onclick="alert('Rendez-vous annulé. Créneau libéré.')"
                                class="px-3 py-1.5 text-xs font-bold text-red-700 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg border border-red-200 transition">
                                Annuler
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-4 font-semibold text-slate-900">Jeu 04 Juin — 10:30</td>
                        <td class="p-4 text-slate-600">Thomas Dubois</td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-200">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                Statut::CONFIRME
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <button
                                onclick="openPrescriptionModal('Thomas Dubois')"
                                class="px-3 py-1.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs transition inline-flex items-center">
                                <i class="fa-solid fa-file-signature mr-1.5"></i>
                                Clôturer / Consulter
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="bg-slate-50/30 text-slate-400">
                        <td class="p-4 font-medium line-through">Jeu 04 Juin — 14:00</td>
                        <td class="p-4 line-through">Marc Tournier</td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200">
                                Statut::ANNULE
                            </span>
                        </td>
                        <td class="p-4 text-right text-xs italic font-medium">
                            Créneau libéré
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
<!-- </div> -->