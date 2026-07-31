<!-- Subview: Vue d'ensemble des Feuilles de temps Actives & Projets -->
<div class="flex-1 flex flex-col gap-6">

    <!-- Card 1: Feuille de Temps en cours & Semaines manquantes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Active Timesheet Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Feuille de temps en cours
                </h3>
                <span class="text-xs font-bold px-2.5 py-0.5 bg-amber-100 text-amber-800 rounded-md border border-amber-200">
                    Brouillon
                </span>
            </div>
            <div>
                <h4 class="text-base font-black text-crt-navy">Semaine 17</h4>
                <p class="text-xs text-slate-500 font-mono">Du 20/07/2026 au 24/07/2026</p>
            </div>
            <button 
                type="button"
                wire:click="$set('viewMode', 'saisie')"
                class="w-full bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs py-3 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2 cursor-pointer"
            >
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Remplir ma feuille
            </button>
        </div>

        <!-- Missing Timesheets Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
            <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Mes feuilles manquantes
            </h3>
            <div class="space-y-2.5">
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <div>
                        <span class="text-xs font-extrabold text-crt-navy bg-amber-100 text-amber-900 px-2 py-0.5 rounded mr-2 font-mono">Semaine 17</span>
                        <span class="text-xs text-slate-600 font-mono">20/07/2026 - 24/07/2026</span>
                    </div>
                    <button 
                        type="button"
                        wire:click="$set('viewMode', 'saisie')"
                        class="bg-white hover:bg-crt-cyan-light text-crt-navy border border-slate-300 font-extrabold text-xs px-3 py-1.5 rounded-lg transition cursor-pointer"
                    >
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg> 
                            Remplir
                        </span>
                    </button>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <div>
                        <span class="text-xs font-extrabold text-crt-navy bg-amber-100 text-amber-900 px-2 py-0.5 rounded mr-2 font-mono">Semaine 16</span>
                        <span class="text-xs text-slate-600 font-mono">13/07/2026 - 17/07/2026</span>
                    </div>
                    <button 
                        type="button"
                        wire:click="$set('viewMode', 'saisie')"
                        class="bg-white hover:bg-crt-cyan-light text-crt-navy border border-slate-300 font-extrabold text-xs px-3 py-1.5 rounded-lg transition cursor-pointer"
                    >
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg> 
                            Remplir
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Historique des Feuilles de Temps (Triees de la plus récente à la plus ancienne) -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-3 border-b border-slate-100">
            <div>
                <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Historique de mes feuilles de temps
                </h3>
                <p class="text-xs text-slate-500 font-medium mt-0.5">Suivez l'état de validation de vos feuilles de temps hebdomadaires.</p>
            </div>
            <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-lg border border-slate-200">
                5 semaines enregistrées
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100/80 text-slate-700 font-extrabold uppercase tracking-wider border-b border-slate-200">
                        <th class="p-3.5">Semaine & Période</th>
                        <th class="p-3.5 text-center">Heures Totales</th>
                        <th class="p-3.5 text-center">Statut</th>
                        <th class="p-3.5 text-center">Dernière mise à jour</th>
                        <th class="p-3.5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <!-- Semaine 17 (La plus récente - En cours / Brouillon) -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-extrabold text-crt-navy bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/30 font-mono">Semaine 17</span>
                                <span class="text-slate-600 font-mono font-semibold">20/07/2026 - 24/07/2026</span>
                            </div>
                        </td>
                        <td class="p-3.5 text-center font-mono font-extrabold text-crt-navy text-sm">37.5h</td>
                        <td class="p-3.5 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-amber-100 text-amber-900 border border-amber-300 inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Brouillon
                            </span>
                        </td>
                        <td class="p-3.5 text-center text-slate-500 font-mono text-[11px]">Aujourd'hui, 06:30</td>
                        <td class="p-3.5 text-right">
                            <button 
                                type="button"
                                wire:click="$set('viewMode', 'saisie')"
                                class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-[11px] px-3 py-1.5 rounded-lg transition cursor-pointer"
                            >
                                Éditer
                            </button>
                        </td>
                    </tr>

                    <!-- Semaine 16 (Soumise / En attente) -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-extrabold text-slate-700 bg-slate-100 px-2.5 py-0.5 rounded-md border border-slate-200 font-mono">Semaine 16</span>
                                <span class="text-slate-600 font-mono font-semibold">13/07/2026 - 17/07/2026</span>
                            </div>
                        </td>
                        <td class="p-3.5 text-center font-mono font-extrabold text-crt-navy text-sm">37.5h</td>
                        <td class="p-3.5 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-sky-100 text-sky-800 border border-sky-200">
                                En attente de revue
                            </span>
                        </td>
                        <td class="p-3.5 text-center text-slate-500 font-mono text-[11px]">25/07/2026</td>
                        <td class="p-3.5 text-right">
                            <button 
                                type="button"
                                wire:click="$set('viewMode', 'consultation')"
                                class="bg-slate-100 hover:bg-slate-200 text-crt-navy border border-slate-300 font-bold text-[11px] px-3 py-1.5 rounded-lg transition cursor-pointer"
                            >
                                Voir
                            </button>
                        </td>
                    </tr>

                    <!-- Semaine 15 (Validée / Approuvée) -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-extrabold text-slate-700 bg-slate-100 px-2.5 py-0.5 rounded-md border border-slate-200 font-mono">Semaine 15</span>
                                <span class="text-slate-600 font-mono font-semibold">06/07/2026 - 10/07/2026</span>
                            </div>
                        </td>
                        <td class="p-3.5 text-center font-mono font-extrabold text-crt-navy text-sm">37.5h</td>
                        <td class="p-3.5 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 inline-flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                Approuvée
                            </span>
                        </td>
                        <td class="p-3.5 text-center text-slate-500 font-mono text-[11px]">12/07/2026</td>
                        <td class="p-3.5 text-right">
                            <button 
                                type="button"
                                wire:click="$set('viewMode', 'consultation')"
                                class="bg-slate-100 hover:bg-slate-200 text-crt-navy border border-slate-300 font-bold text-[11px] px-3 py-1.5 rounded-lg transition cursor-pointer"
                            >
                                Voir
                            </button>
                        </td>
                    </tr>

                    <!-- Semaine 14 (Validée / Approuvée) -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-extrabold text-slate-700 bg-slate-100 px-2.5 py-0.5 rounded-md border border-slate-200 font-mono">Semaine 14</span>
                                <span class="text-slate-600 font-mono font-semibold">29/06/2026 - 03/07/2026</span>
                            </div>
                        </td>
                        <td class="p-3.5 text-center font-mono font-extrabold text-crt-navy text-sm">40.0h</td>
                        <td class="p-3.5 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 inline-flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                Approuvée
                            </span>
                        </td>
                        <td class="p-3.5 text-center text-slate-500 font-mono text-[11px]">05/07/2026</td>
                        <td class="p-3.5 text-right">
                            <button 
                                type="button"
                                wire:click="$set('viewMode', 'consultation')"
                                class="bg-slate-100 hover:bg-slate-200 text-crt-navy border border-slate-300 font-bold text-[11px] px-3 py-1.5 rounded-lg transition cursor-pointer"
                            >
                                Voir
                            </button>
                        </td>
                    </tr>

                    <!-- Semaine 13 (Rejetée / Renvoyée) -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-extrabold text-slate-700 bg-slate-100 px-2.5 py-0.5 rounded-md border border-slate-200 font-mono">Semaine 13</span>
                                <span class="text-slate-600 font-mono font-semibold">22/06/2026 - 26/06/2026</span>
                            </div>
                        </td>
                        <td class="p-3.5 text-center font-mono font-extrabold text-crt-navy text-sm">35.0h</td>
                        <td class="p-3.5 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-rose-100 text-rose-800 border border-rose-200">
                                Correction demandée
                            </span>
                        </td>
                        <td class="p-3.5 text-center text-slate-500 font-mono text-[11px]">28/06/2026</td>
                        <td class="p-3.5 text-right">
                            <button 
                                type="button"
                                wire:click="$set('viewMode', 'saisie')"
                                class="bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-300 font-extrabold text-[11px] px-3 py-1.5 rounded-lg transition cursor-pointer"
                            >
                                Corriger
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
