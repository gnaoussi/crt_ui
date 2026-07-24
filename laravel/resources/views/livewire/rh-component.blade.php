<div x-data x-effect="document.body.classList.toggle('overflow-hidden', $wire.isNewEmployeeModalOpen || $wire.isEditEmployeeModalOpen || $wire.isEditManagerModalOpen || $wire.isEditHoursModalOpen || $wire.isEditSiteModalOpen)" class="p-6 space-y-6 max-w-[1600px] mx-auto w-full">

    @if ($selectedEmployeeId === null)
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
                <button wire:click="openNewEmployeeModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2.5 rounded-xl transition shadow-lg flex items-center gap-1.5">
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
                                        <button wire:click="selectEmployee({{ $emp->id }})" title="Consulter la fiche détaillée" class="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition">
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
                                        <button wire:click="showReportNotification('{{ $emp->prenom }}', '{{ $emp->nom }}')" title="Rapports de performance" class="p-1.5 text-amber-700 border border-amber-300 bg-amber-50 hover:bg-amber-600 hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </button>
                                        <button wire:click="toggleAccountStatus({{ $emp->id }})" title="{{ $emp->account_status === 'Activé' ? 'Désactiver le compte' : 'Activer le compte' }}" class="p-1.5 text-slate-700 border border-slate-300 bg-slate-100 hover:bg-slate-700 hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                        <button wire:click="showRoleNotification('{{ $emp->prenom }}', '{{ $emp->nom }}')" title="Attribuer un rôle ou gestionnaire" class="p-1.5 text-purple-700 border border-purple-300 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-lg transition">
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
    @else
        <!-- VIEW 2: EMPLOYEE DETAIL VIEW (employe_view_section_information.png & employe_view_section_historique.png) -->
        <div class="space-y-6">
            {{-- 1. Header Card (Harmonisé 1-à-1 avec la vue Détail Année Financière) --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
                    <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                        <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Fiche Employé — {{ $selectedEmployee->prenom }} {{ $selectedEmployee->nom }}
                    </h3>

                    <div class="flex items-center gap-3">
                        <button 
                            wire:click="backToList"
                            class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-md cursor-pointer"
                        >
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Retour aux employés
                        </button>
                        <button 
                            wire:click="openEditEmployeeModal"
                            class="bg-crt-cyan hover:bg-crt-cyan-dark text-crt-navy font-extrabold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-md cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Modifier l'employé
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs font-semibold">
                    <div>
                        <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Matricule</span>
                        <p class="font-mono text-crt-navy text-xs font-extrabold">{{ $selectedEmployee->matricule }}</p>
                    </div>
                    <div>
                        <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Gestionnaire</span>
                        <p class="text-slate-800 text-xs font-extrabold">{{ $selectedEmployee->gestionnaire ?? 'Admin Plateforme GCS' }}</p>
                    </div>
                    <div>
                        <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Statut du compte</span>
                        @if($selectedEmployee->account_status === 'Activé')
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 inline-flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                Actif
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                Inactif
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 2. 4 Stat KPI Cards (Harmonisés 1-à-1) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <h4 class="text-2xl font-black text-crt-navy font-mono">{{ $selectedEmployee->weekly_hours }} h</h4>
                        <span class="text-xs font-bold text-slate-500">Heures / Semaine</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-crt-cyan-light border border-crt-cyan/30 text-crt-navy flex items-center justify-center">
                        <svg class="w-5 h-5 text-crt-cyan font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-black text-amber-700">{{ $selectedEmployee->probation_status }}</h4>
                        <span class="text-xs font-bold text-slate-500">Statut Probation</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-black text-emerald-700 font-mono">{{ $selectedEmployee->hire_date }}</h4>
                        <span class="text-xs font-bold text-slate-500">Date d'embauche</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-black text-slate-700">{{ $selectedEmployee->role }}</h4>
                        <span class="text-xs font-bold text-slate-500">Rôle / Groupe</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- 3. Navigation par Onglets (Harmonisé 1-à-1) --}}
            <div class="flex justify-between items-center bg-white p-2 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex space-x-2 text-xs font-extrabold">
                    <button wire:click="setTab('information')" class="px-4 py-2.5 rounded-xl transition cursor-pointer {{ $employeeActiveTab === 'information' ? 'bg-crt-navy text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' }}"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg> Informations de l'employé</span></button>
                    <button wire:click="setTab('historiques')" class="px-4 py-2.5 rounded-xl transition cursor-pointer {{ $employeeActiveTab === 'historiques' ? 'bg-crt-navy text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' }}"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg> Historiques</span></button>
                </div>
            </div>

            @if ($employeeActiveTab === 'information')
                <!-- TAB 1: INFORMATIONS DE L'EMPLOYÉ -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                        <h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg> Informations de l'employé</span></h3>
                        <button wire:click="openEditEmployeeModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2 rounded-xl transition shadow-sm flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Modifier
                        </button>
                    </div>

                    <div class="space-y-6 text-xs font-semibold">
                        <div class="space-y-3">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">IDENTITÉ</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                <div><span class="block text-slate-500 text-[11px]">Matricule</span><span class="text-crt-navy font-bold font-mono">{{ $selectedEmployee->matricule }}</span></div>
                                <div><span class="block text-slate-500 text-[11px]">Nom</span><span class="text-crt-navy font-extrabold">{{ $selectedEmployee->nom }}</span></div>
                                <div><span class="block text-slate-500 text-[11px]">Prénom</span><span class="text-crt-navy font-extrabold">{{ $selectedEmployee->prenom }}</span></div>
                                <div><span class="block text-slate-500 text-[11px]"><span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Date de naissance</span></span><span class="text-slate-700">{{ $selectedEmployee->dob }}</span></div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">CONTACTS</h4>
                            <div><span class="block text-slate-500 text-[11px]"><span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> E-mail</span></span><span class="text-crt-cyan-dark font-bold font-mono">{{ $selectedEmployee->email }}</span></div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">STATUT PROFESSIONNEL</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div><span class="block text-slate-500 text-[11px]"><span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Groupes</span></span><span class="bg-slate-100 border px-2 py-0.5 rounded text-[11px] font-bold">{{ $selectedEmployee->role }}</span></div>
                                <div><span class="block text-slate-500 text-[11px]">Statut du compte</span><span class="text-emerald-600 font-extrabold">{{ $selectedEmployee->account_status }}</span></div>
                                <div><span class="block text-slate-500 text-[11px]">Visibilité/Rapport</span><span class="text-slate-700 font-bold">{{ $selectedEmployee->visibility_report }}</span></div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">ORGANISATION</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div><span class="block text-slate-500 text-[11px]">Gestionnaire</span><span class="text-crt-navy font-bold">{{ $selectedEmployee->gestionnaire }}</span></div>
                                <div><span class="block text-slate-500 text-[11px]">Rôle</span><span class="text-slate-700 font-medium">Gestionnaire ({{ $selectedEmployee->is_manager ? 'Oui' : 'Non' }})</span></div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">AUTRES & EMBAUCHE</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div><span class="block text-slate-500 text-[11px]">Heures/semaine</span><span class="text-crt-navy font-extrabold font-mono">{{ $selectedEmployee->weekly_hours }} h</span></div>
                                <div><span class="block text-slate-500 text-[11px]"><span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Date d'embauche</span></span><span class="text-slate-700 font-mono">{{ $selectedEmployee->hire_date }}</span></div>
                                <div><span class="block text-slate-500 text-[11px]">Statut de probation</span><span class="text-amber-700 font-bold bg-amber-50 border border-amber-200 px-2 py-0.5 rounded text-[11px]">En cours ({{ $selectedEmployee->probation_status }})</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- TAB 2: HISTORIQUES -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                            <h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Historique des heures par semaine</span></h3>
                            <button wire:click="openEditHoursModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Modifier l'heure
                            </button>
                        </div>
                        <table class="w-full text-left text-xs border-collapse">
                            <thead><tr class="bg-slate-100 text-slate-700 font-extrabold uppercase"><th class="p-3">NOMBRE D'HEURE</th><th class="p-3">DATE DE DÉBUT</th><th class="p-3">DATE DE FIN</th></tr></thead>
                            <tbody class="divide-y divide-slate-100 font-mono">
                                @foreach ($selectedEmployee->hoursHistories as $h)
                                    <tr><td class="p-3 font-extrabold text-crt-navy">{{ $h->hours }}h</td><td class="p-3 text-slate-600">{{ $h->start_date }}</td><td class="p-3 text-slate-400">{{ $h->end_date }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                            <h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Historique des gestionnaires</span></h3>
                            <button wire:click="openEditManagerModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Modifier le gestionnaire
                            </button>
                        </div>
                        <table class="w-full text-left text-xs border-collapse">
                            <thead><tr class="bg-slate-100 text-slate-700 font-extrabold uppercase"><th class="p-3">GESTIONNAIRE</th><th class="p-3">DATE DE DÉBUT</th><th class="p-3">DATE DE FIN</th></tr></thead>
                            <tbody class="divide-y divide-slate-100 font-medium">
                                @foreach ($selectedEmployee->managerHistories as $m)
                                    <tr><td class="p-3 font-extrabold text-crt-navy">{{ $m->manager }}</td><td class="p-3 text-slate-600 font-mono">{{ $m->start_date }}</td><td class="p-3 text-slate-400 font-mono">{{ $m->end_date }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                            <h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg> Historique des affectations aux sites</span></h3>
                            <button wire:click="openEditSiteModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Affecter à un site
                            </button>
                        </div>
                        <table class="w-full text-left text-xs border-collapse">
                            <thead><tr class="bg-slate-100 text-slate-700 font-extrabold uppercase"><th class="p-3">NOM DU SITE</th><th class="p-3">ADRESSE</th><th class="p-3">DATE DE DÉBUT</th><th class="p-3">DATE DE FIN</th><th class="p-3">STATUT</th></tr></thead>
                            <tbody class="divide-y divide-slate-100 font-medium">
                                @foreach ($selectedEmployee->siteHistories as $s)
                                    <tr><td class="p-3 font-extrabold text-crt-navy">{{ $s->site_name }}</td><td class="p-3 text-slate-600">{{ $s->address }}</td><td class="p-3 text-slate-600 font-mono">{{ $s->start_date }}</td><td class="p-3 text-slate-600 font-mono">{{ $s->end_date }}</td><td class="p-3"><span class="px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800 border">{{ $s->status }}</span></td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- 1. MODALE: Création Nouvel Employé (new_employe_modal.png) -->
    @if ($isNewEmployeeModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Nouvel employé
                        </h3>
                        <button wire:click="$set('isNewEmployeeModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="handleCreateEmployee" class="space-y-6 text-xs">
                        <div class="space-y-3">
                            <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-6 0h6" /></svg> Informations personnelles</span></h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Nom *</label>
                                    <input type="text" required wire:model="newEmpForm.nom" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Prénom *</label>
                                    <input type="text" required wire:model="newEmpForm.prenom" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Date de naissance *</label>
                                    <input type="text" placeholder="ex: 07-21" wire:model="newEmpForm.dob" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">E-mail *</label>
                                    <input type="email" required placeholder="employe@exemple.com" wire:model="newEmpForm.email" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> Informations professionnelles</span></h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Matricule ID Unique</label>
                                    <input type="text" wire:model="newEmpForm.matricule" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Date d'embauche *</label>
                                    <input type="date" wire:model="newEmpForm.hireDate" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Nombre d'heures / semaine *</label>
                                    <input type="number" step="0.5" wire:model="newEmpForm.weeklyHours" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Gestionnaire assigné *</label>
                                    <select wire:model="newEmpForm.gestionnaire" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                        <option value="Admin Plateforme GCS">Admin Plateforme GCS</option>
                                        <option value="Fabrice DENOU">Fabrice DENOU</option>
                                        <option value="Mitch Richmond">Mitch Richmond</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg> Site de travail</span></h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Site d'affectation *</label>
                                    <select wire:model="newEmpForm.site" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                        @foreach ($sites as $s)
                                            <option value="{{ $s->name }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Date de début *</label>
                                    <input type="date" wire:model="newEmpForm.startDate" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">👤 Rôles et permissions</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Définir comme gestionnaire ?</label>
                                    <select wire:model="newEmpForm.isManager" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                        <option value="Non">Non</option>
                                        <option value="Oui">Oui</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Groupe d'accès *</label>
                                    <select wire:model="newEmpForm.accessGroup" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-bold text-crt-navy">
                                        <option value="ADMINISTRATEUR">ADMINISTRATEUR</option>
                                        <option value="MANAGER">MANAGER</option>
                                        <option value="EMPLOYE">EMPLOYÉ</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                            <button type="button" wire:click="$set('isNewEmployeeModalOpen', false)" class="px-4 py-2.5 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                            <button type="submit" class="px-5 py-2.5 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4" /></svg> Créer</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    <!-- 2. MODALE: Mise à jour des informations de l'employé (employe_edit.png) -->
    @if ($isEditEmployeeModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Mise à jour des informations de l'employé
                        </h3>
                        <button wire:click="$set('isEditEmployeeModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="handleSaveEmployeeUpdate" class="space-y-5 text-xs">
                        <div class="space-y-3">
                            <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-6 0h6" /></svg> Informations personnelles</span></h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Nom *</label>
                                    <input type="text" required wire:model="editEmpForm.nom" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Prénom *</label>
                                    <input type="text" required wire:model="editEmpForm.prenom" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Date de naissance *</label>
                                    <input type="text" wire:model="editEmpForm.dob" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">E-mail *</label>
                                    <input type="email" required wire:model="editEmpForm.email" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> Informations professionnelles</span></h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Matricule ID Unique</label>
                                    <input type="text" wire:model="editEmpForm.matricule" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Date d'embauche *</label>
                                    <input type="date" wire:model="editEmpForm.hireDate" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">👤 Rôles et permissions</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Définir comme gestionnaire ?</label>
                                    <select wire:model="editEmpForm.isManager" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                        <option value="Non">Non</option>
                                        <option value="Oui">Oui</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Groupe d'accès *</label>
                                    <select wire:model="editEmpForm.accessGroup" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-bold text-crt-navy">
                                        <option value="ADMINISTRATEUR">ADMINISTRATEUR</option>
                                        <option value="MANAGER">MANAGER</option>
                                        <option value="EMPLOYE">EMPLOYÉ</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block font-bold text-slate-700 mb-1">Définir comme visible dans les rapports ?</label>
                                    <select wire:model="editEmpForm.visibilityReport" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                        <option value="Oui">Oui</option>
                                        <option value="Non">Non</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                            <button type="button" wire:click="$set('isEditEmployeeModalOpen', false)" class="px-4 py-2.5 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                            <button type="submit" class="px-5 py-2.5 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg> Modifier</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    <!-- 3. MODALE: Modifier le gestionnaire (modifier_gestionnaire_dans_historique.png) -->
    @if ($isEditManagerModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-fade-in">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Modifier le gestionnaire
                        </h3>
                        <button wire:click="$set('isEditManagerModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form novalidate wire:submit.prevent="handleSaveManagerChange" class="space-y-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nouveau gestionnaire *</label>
                            <select wire:model="editManagerForm.newManager" class="w-full font-semibold border @error('editManagerForm.newManager') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-slate-50 focus:bg-white @enderror rounded-xl p-2.5">
                                <option value="Admin Plateforme GCS">Admin Plateforme GCS</option>
                                <option value="Fabrice DENOU">Fabrice DENOU</option>
                                <option value="Mitch Richmond">Mitch Richmond</option>
                                <option value="---">Aucun (---)</option>
                            </select>
                            @error('editManagerForm.newManager')
                                <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Date de debut du nouveau gestionnaire *</label>
                            <div class="relative">
                                <input type="datetime-local" wire:model="editManagerForm.startDate" class="w-full font-semibold border @error('editManagerForm.startDate') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-crt-cyan-light @enderror rounded-xl p-2.5 text-crt-navy font-mono cursor-pointer pr-10" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-crt-cyan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            @error('editManagerForm.startDate')
                                <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                            <button type="button" wire:click="$set('isEditManagerModalOpen', false)" class="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                            <button type="submit" class="px-5 py-2 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Sauvegarder</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    <!-- 4. MODALE: Modifier l'heure (modifier_nombre_d_heure_par_semaine_dans_historique.png) -->
    @if ($isEditHoursModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-fade-in">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Modifier l'heure
                        </h3>
                        <button wire:click="$set('isEditHoursModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form novalidate wire:submit.prevent="handleSaveHoursChange" class="space-y-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nouvelle Heure *</label>
                            <input type="number" step="0.5" wire:model="editHoursForm.newHours" class="w-full font-semibold border @error('editHoursForm.newHours') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-slate-50 focus:bg-white @enderror rounded-xl p-2.5 font-mono" />
                            @error('editHoursForm.newHours')
                                <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Date de debut de la nouvelle heure *</label>
                            <div class="relative">
                                <input type="datetime-local" wire:model="editHoursForm.startDate" class="w-full font-semibold border @error('editHoursForm.startDate') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-crt-cyan-light @enderror rounded-xl p-2.5 text-crt-navy font-mono cursor-pointer pr-10" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-crt-cyan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            @error('editHoursForm.startDate')
                                <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                            <button type="button" wire:click="$set('isEditHoursModalOpen', false)" class="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                            <button type="submit" class="px-5 py-2 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4" /></svg> Créer</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    <!-- 5. MODALE: Affectation un site (modifier_site_dans_historique.png) -->
    @if ($isEditSiteModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-fade-in">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Affectation un site
                        </h3>
                        <button wire:click="$set('isEditSiteModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form novalidate wire:submit.prevent="handleSaveSiteAffectation" class="space-y-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nouveau site *</label>
                            <select wire:model="editSiteForm.newSiteName" class="w-full font-semibold border @error('editSiteForm.newSiteName') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-slate-50 focus:bg-white @enderror rounded-xl p-2.5">
                                @foreach ($sites as $site)
                                    <option value="{{ $site->name }}">{{ $site->name }}</option>
                                @endforeach
                            </select>
                            @error('editSiteForm.newSiteName')
                                <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Date de début *</label>
                            <div class="relative">
                                <input type="date" wire:model="editSiteForm.startDate" class="w-full font-semibold border @error('editSiteForm.startDate') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-crt-cyan-light @enderror rounded-xl p-2.5 text-crt-navy font-mono cursor-pointer pr-10" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-crt-cyan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            @error('editSiteForm.startDate')
                                <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Date de fin</label>
                            <div class="relative">
                                <input type="date" placeholder="Optionnel (ex: 2026-12-31)" wire:model="editSiteForm.endDate" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono cursor-pointer pr-10" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-crt-cyan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                            <button type="button" wire:click="$set('isEditSiteModalOpen', false)" class="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                            <button type="submit" class="px-5 py-2 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Sauvegarder</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif
</div>
