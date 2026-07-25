<!-- VIEW 1: EMPLOYEES LIST VIEW (list.png) -->
<div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
    <div class="flex items-center gap-2 pb-3 border-b text-xs font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg> Filtres</span> de recherche</div>
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs font-semibold">
        <div>
            <label class="block text-slate-700 mb-1">Employé</label>
            <input type="text" wire:model.live="empFilterQuery" placeholder="Matricule, Nom, Prénom..." class="w-full text-xs border rounded-xl p-2 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition" />
        </div>
        <div>
            <label class="block text-slate-700 mb-1">Gestionnaire</label>
            <input type="text" wire:model.live="empFilterManager" placeholder="Gestionnaire..." class="w-full text-xs border rounded-xl p-2 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition" />
        </div>
        <div>
            <label class="block text-slate-700 mb-1">Probation</label>
            <select wire:model.live="empFilterProbation" class="w-full text-xs border rounded-xl p-2 bg-slate-50 focus:bg-white">
                <option value="all">-- Tous --</option>
                <option value="in_progress">1 heure restante</option>
            </select>
        </div>
        <div>
            <label class="block text-slate-700 mb-1">Statut</label>
            <select wire:model.live="empFilterStatus" class="w-full text-xs border rounded-xl p-2 bg-slate-50 focus:bg-white">
                <option value="all">Tous</option>
                <option value="active">Activé</option>
                <option value="disabled">Désactivé</option>
            </select>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
    <div class="flex justify-between items-center pb-4 border-b border-slate-100">
        <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Liste des employés
        </h3>
        <button wire:click="openNewEmployeeModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2.5 rounded-xl transition shadow-lg flex items-center gap-1.5 cursor-pointer">
            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4" />
            </svg>
            Nouvel employé
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[1000px] text-xs">
            <thead>
                <tr class="bg-slate-100 text-slate-700 uppercase font-extrabold">
                    <th class="p-3.5">Matricule</th>
                    <th class="p-3.5">Nom</th>
                    <th class="p-3.5">Prénom</th>
                    <th class="p-3.5">Rôle</th>
                    <th class="p-3.5">Gestionnaire</th>
                    <th class="p-3.5">Probation</th>
                    <th class="p-3.5 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-semibold">
                @foreach ($employees as $emp)
                    <tr class="hover:bg-crt-cyan-light/30 transition">
                        <td class="p-3.5 font-mono text-crt-navy font-bold">{{ $emp->matricule }}</td>
                        <td class="p-3.5 font-extrabold text-crt-navy">{{ $emp->nom }}</td>
                        <td class="p-3.5">{{ $emp->prenom }}</td>
                        <td class="p-3.5"><span class="bg-slate-100 border px-2 py-0.5 rounded text-[11px] font-bold">{{ $emp->role }}</span></td>
                        <td class="p-3.5 text-slate-600">{{ $emp->gestionnaire }}</td>
                        <td class="p-3.5"><span class="bg-crt-navy text-white text-[11px] font-bold px-3 py-1 rounded-full">{{ $emp->probation_status }}</span></td>
                        <td class="p-3.5">
                            <div class="flex items-center justify-center space-x-1.5">
                                <button wire:click="selectEmployee({{ $emp->id }})" title="Consulter la fiche détaillée" class="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <a href="/timesheets" title="Feuilles de temps de l'employé" class="p-1.5 text-crt-navy border border-crt-navy/30 bg-slate-100 hover:bg-crt-navy hover:text-white rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                                <button wire:click="showReportNotification('{{ $emp->prenom }}', '{{ $emp->nom }}')" title="Rapports de performance" class="p-1.5 text-amber-700 border border-amber-300 bg-amber-50 hover:bg-amber-600 hover:text-white rounded-lg transition cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </button>
                                <button wire:click="toggleAccountStatus({{ $emp->id }})" title="{{ $emp->account_status === 'Activé' ? 'Désactiver le compte' : 'Activer le compte' }}" class="p-1.5 text-slate-700 border border-slate-300 bg-slate-100 hover:bg-slate-700 hover:text-white rounded-lg transition cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                </button>
                                <button wire:click="showRoleNotification('{{ $emp->prenom }}', '{{ $emp->nom }}')" title="Attribuer un rôle ou gestionnaire" class="p-1.5 text-purple-700 border border-purple-300 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-lg transition cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- PAGINATION UNIFORMISÉE OPTION A (10 PAR PAGE) -->
    <div class="mt-4 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-semibold text-slate-600">
        <div class="text-slate-500">
            Montrant <strong class="text-slate-800 font-mono">{{ $employees->firstItem() ?? 0 }}</strong> à <strong class="text-slate-800 font-mono">{{ $employees->lastItem() ?? 0 }}</strong> de <strong class="text-slate-800 font-mono">{{ $employees->total() }}</strong> résultats
        </div>

        <div class="flex items-center space-x-1">
            @if ($employees->onFirstPage())
                <span class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 cursor-not-allowed">‹</span>
            @else
                <button wire:click="previousPage" class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-crt-navy font-bold shadow-2xs transition">‹</button>
            @endif

            @foreach (range(1, $employees->lastPage()) as $page)
                @if ($page == $employees->currentPage())
                    <span class="px-3 py-1 rounded-lg bg-crt-navy text-white font-extrabold shadow-xs">{{ $page }}</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold transition">{{ $page }}</button>
                @endif
            @endforeach

            @if ($employees->hasMorePages())
                <button wire:click="nextPage" class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-crt-navy font-bold shadow-2xs transition">›</button>
            @else
                <span class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 cursor-not-allowed">›</span>
            @endif
        </div>
    </div>
</div>
