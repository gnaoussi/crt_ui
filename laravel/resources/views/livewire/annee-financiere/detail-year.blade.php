<div class="space-y-6">
    {{-- Back Button --}}
    <div>
        <button 
            wire:click="backToList" 
            class="text-xs font-bold text-slate-600 bg-white border border-slate-200 px-3.5 py-2 rounded-xl hover:bg-slate-50 transition flex items-center gap-1.5 cursor-pointer shadow-xs"
        >
            <svg class="w-4 h-4 text-crt-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à l'historique des années financières
        </button>
    </div>

    {{-- Detail Banner --}}
    <div class="bg-gradient-to-r from-crt-navy via-slate-900 to-crt-navy rounded-2xl p-6 text-white shadow-lg border border-slate-800">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 text-crt-cyan text-xs font-extrabold tracking-wider uppercase mb-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Fiche Année Financière
                </div>
                <h2 class="text-2xl font-black text-white font-mono">
                    {{ $selectedAnnee['startDate'] }} — {{ $selectedAnnee['endDate'] }}
                </h2>
                <p class="text-xs text-slate-300 mt-1">
                    Premier jour : <span class="font-bold text-white">{{ $selectedAnnee['firstDay'] }}</span> | Plafond Banque de Temps : <span class="font-bold text-white">{{ $selectedAnnee['timeBankCeiling'] }}</span>
                </p>
            </div>
            <div>
                @if($selectedAnnee['isActive'])
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-black bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 inline-flex items-center gap-1.5 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Exercice Actif
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-800 text-slate-400 border border-slate-700">
                        Exercice Inactif
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- 4 Stat KPI Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <h4 class="text-2xl font-black text-crt-navy font-mono">{{ $selectedAnnee['weeksCount'] ?? 53 }}</h4>
                <span class="text-xs font-bold text-slate-500">Total semaines</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-crt-cyan-light border border-crt-cyan/30 text-crt-navy flex items-center justify-center">
                <svg class="w-5 h-5 text-crt-cyan font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <h4 class="text-2xl font-black text-emerald-700 font-mono">{{ $selectedAnnee['openWeeks'] ?? 4 }}</h4>
                <span class="text-xs font-bold text-slate-500">Semaines ouvertes</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <h4 class="text-2xl font-black text-rose-700 font-mono">{{ $selectedAnnee['closedWeeks'] ?? 0 }}</h4>
                <span class="text-xs font-bold text-slate-500">Semaines fermées</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <h4 class="text-2xl font-black text-slate-700 font-mono">{{ $selectedAnnee['inactiveWeeks'] ?? 49 }}</h4>
                <span class="text-xs font-bold text-slate-500">Semaines inactives</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Weeks Section --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs space-y-6">
        {{-- Section Title & Filters --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Semaines de l'année financière
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Gérez l'ouverture, la fermeture et le statut de paie de chaque semaine</p>
            </div>

            <div class="flex flex-wrap items-center gap-2 text-xs font-extrabold">
                <span class="text-slate-500">État :</span>
                <select 
                    wire:model.live="weekStatusFilter"
                    class="border border-slate-200 rounded-xl px-3 py-1.5 bg-slate-50 text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 cursor-pointer"
                >
                    <option value="Tous">Tous</option>
                    <option value="Ouvertes">Ouvertes</option>
                    <option value="Fermées">Fermées</option>
                    <option value="Inactive">Inactive</option>
                </select>
                @if($weekStatusFilter !== 'Tous')
                    <button 
                        wire:click="$set('weekStatusFilter', 'Tous')"
                        class="bg-white border border-slate-300 text-slate-600 hover:bg-slate-50 font-bold px-3 py-1.5 rounded-xl transition cursor-pointer"
                    >
                        Réinitialiser
                    </button>
                @endif
            </div>
        </div>

        {{-- Weeks Table & Pagination --}}
        @php
            $filteredWeeks = collect($weeksList)->filter(fn($w) => $weekStatusFilter === 'Tous' || $w['status'] === $weekStatusFilter);
            $totalWeeks = $filteredWeeks->count();
            $totalPages = ceil($totalWeeks / $weeksPerPage) ?: 1;
            $paginatedWeeks = $filteredWeeks->slice(($weeksCurrentPage - 1) * $weeksPerPage, $weeksPerPage);
        @endphp

        <div class="space-y-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[850px]">
                    <thead>
                        <tr class="bg-slate-100/80 text-slate-700 border-b border-slate-200 text-xs uppercase tracking-wider font-extrabold">
                            <th class="p-3.5">SEMAINE</th>
                            <th class="p-3.5">DÉBUT</th>
                            <th class="p-3.5">FIN</th>
                            <th class="p-3.5">ÉTAT</th>
                            <th class="p-3.5">PAIE</th>
                            <th class="p-3.5 text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @foreach($paginatedWeeks as $week)
                            <tr class="hover:bg-crt-cyan-light/30 transition">
                                <td class="p-3.5 flex items-center gap-3">
                                    <span class="w-7 h-7 rounded-full bg-crt-cyan-light text-crt-navy font-bold flex items-center justify-center text-xs shrink-0 font-mono">
                                        {{ $week['id'] }}
                                    </span>
                                    <div>
                                        <h4 class="font-extrabold text-crt-navy">{{ $week['name'] }}</h4>
                                        <p class="text-slate-400 text-[11px] font-mono">{{ $week['dateRange'] }}</p>
                                    </div>
                                </td>
                                <td class="p-3.5 font-semibold text-slate-700 font-mono">
                                    {{ $week['startDate'] }}
                                </td>
                                <td class="p-3.5 font-semibold text-slate-700 font-mono">
                                    {{ $week['endDate'] }}
                                </td>
                                <td class="p-3.5">
                                    @if($week['status'] === 'Ouvertes')
                                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 inline-flex items-center gap-1">
                                            <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                                            Ouvertes
                                        </span>
                                    @elseif($week['status'] === 'Fermées')
                                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200 inline-flex items-center gap-1">
                                            <svg class="w-3 h-3 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                            Fermées
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-500 border border-slate-200 inline-flex items-center gap-1">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700 border border-slate-200 inline-flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        {{ $week['payStatus'] }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        {{-- 🔒 Action 1: Toggle Fermer / Ouvrir --}}
                                        @if($week['status'] === 'Fermées')
                                            <button 
                                                wire:click="toggleWeekStatus({{ $week['id'] }}, 'Ouvertes')"
                                                class="p-1.5 text-emerald-600 bg-emerald-50 hover:bg-emerald-600 hover:text-white border border-emerald-200 rounded-lg transition cursor-pointer"
                                                title="Ouvrir la semaine"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                </svg>
                                            </button>
                                        @else
                                            <button 
                                                wire:click="toggleWeekStatus({{ $week['id'] }}, 'Fermées')"
                                                class="p-1.5 text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white border border-rose-200 rounded-lg transition cursor-pointer"
                                                title="Fermer la semaine"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </button>
                                        @endif

                                        {{-- 🚫 Action 2: Toggle Activer / Désactiver --}}
                                        @if($week['status'] === 'Inactive')
                                            <button 
                                                wire:click="toggleWeekStatus({{ $week['id'] }}, 'Ouvertes')"
                                                class="p-1.5 text-emerald-600 bg-emerald-50 hover:bg-emerald-600 hover:text-white border border-emerald-200 rounded-lg transition cursor-pointer"
                                                title="Activer la semaine"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        @else
                                            <button 
                                                wire:click="toggleWeekStatus({{ $week['id'] }}, 'Inactive')"
                                                class="p-1.5 text-slate-600 bg-slate-100 hover:bg-slate-700 hover:text-white border border-slate-200 rounded-lg transition cursor-pointer"
                                                title="Désactiver la semaine"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            </button>
                                        @endif

                                        {{-- 📅 Action 3: Marquer comme Semaine de paie --}}
                                        <button 
                                            wire:click="togglePayStatus({{ $week['id'] }})"
                                            class="p-1.5 rounded-lg transition cursor-pointer border {{ $week['payStatus'] === 'Paie validée' ? 'text-amber-800 bg-amber-100 hover:bg-amber-200 border-amber-300' : 'text-amber-600 bg-amber-50 hover:bg-amber-500 hover:text-white border-amber-200' }}"
                                            title="Marquer comme semaine de paie"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </button>

                                        {{-- 🔄 Action 4: Journal de la semaine --}}
                                        <button 
                                            class="p-1.5 text-crt-cyan bg-crt-cyan-light hover:bg-crt-cyan hover:text-white border border-crt-cyan/30 rounded-lg transition cursor-pointer"
                                            title="Consulter le journal de la semaine"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION UNIFORMISÉE OPTION A --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-100 text-xs font-semibold">
                <div class="text-slate-500">
                    Montrant <strong class="text-slate-800 font-mono">{{ $totalWeeks == 0 ? 0 : ($weeksCurrentPage - 1) * $weeksPerPage + 1 }}</strong> à <strong class="text-slate-800 font-mono">{{ min($weeksCurrentPage * $weeksPerPage, $totalWeeks) }}</strong> de <strong class="text-slate-800 font-mono">{{ $totalWeeks }}</strong> résultats
                </div>
                
                <div class="flex items-center space-x-1">
                    <button 
                        @if($weeksCurrentPage <= 1) disabled @endif
                        wire:click="setPageNum({{ max($weeksCurrentPage - 1, 1) }})"
                        class="px-2.5 py-1 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed transition cursor-pointer"
                    >
                        ‹
                    </button>

                    @foreach(range(1, min(6, $totalPages)) as $page)
                        <button
                            wire:click="setPageNum({{ $page }})"
                            class="px-3 py-1 rounded-lg text-xs font-extrabold transition cursor-pointer {{ $weeksCurrentPage == $page ? 'bg-crt-navy text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}"
                        >
                            {{ $page }}
                        </button>
                    @endforeach

                    @if($totalPages > 6)
                        <span class="px-1 text-slate-400">...</span>
                    @endif

                    <button 
                        @if($weeksCurrentPage >= $totalPages) disabled @endif
                        wire:click="setPageNum({{ min($weeksCurrentPage + 1, $totalPages) }})"
                        class="px-2.5 py-1 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed transition cursor-pointer"
                    >
                        ›
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
