<main class="flex-1 p-6 space-y-6 max-w-[1600px] mx-auto w-full">
    
    <!-- Top Header Banner -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-lg font-extrabold text-crt-navy flex items-center gap-2">
                <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Tableau de bord CRT Solution
            </h2>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Période d'activité : <strong class="text-slate-700 font-mono">Du 13/07/2026 au 26/07/2026</strong></p>
        </div>
        <button wire:click="$refresh" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-bold text-xs px-4 py-2 rounded-xl transition flex items-center gap-2 shadow-xs">
            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Rafraîchir
        </button>
    </div>

    <!-- 4 KPI Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Heures de la Semaine</span>
                <h3 class="text-2xl font-black text-crt-navy font-mono mt-0.5">45.5h / 37.5h</h3>
                <span class="text-[11px] font-bold text-emerald-600">121% de l'objectif hebdo</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-crt-cyan-light border border-crt-cyan/30 flex items-center justify-center text-crt-navy font-bold text-lg">
                ⏱️
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Projets Imputés</span>
                <h3 class="text-2xl font-black text-crt-navy font-mono mt-0.5">{{ $totalProjects }} Projets</h3>
                <span class="text-[11px] font-bold text-crt-cyan-dark">Semaine active 17</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-crt-cyan-light border border-crt-cyan/30 flex items-center justify-center text-crt-navy font-bold text-lg">
                📁
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Semaines Inactives</span>
                <h3 class="text-2xl font-black text-amber-600 font-mono mt-0.5">13 Semaines</h3>
                <a href="#" class="text-[11px] font-bold text-amber-700 hover:underline block text-left mt-0.5">
                    Régulariser →
                </a>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 font-bold text-lg">
                ⚠️
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">En attente revue</span>
                <h3 class="text-2xl font-black text-crt-navy font-mono mt-0.5">1 Feuille</h3>
                <span class="text-[11px] font-bold text-slate-500">Validation manager</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-700 font-bold text-lg">
                ⏳
            </div>
        </div>
    </div>

    <!-- Project Hour Consumption Section -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Taux de consommation du total des heures de projets ({{ $totalProjects }} Projets)
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Suivi en direct des budgets au Forfait et des projets en Régie (Sans quota).</p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="🔍 Rechercher un projet..." 
                            wire:model.live="dashboardProjectSearch"
                            class="w-full sm:w-60 text-xs border border-slate-200 rounded-xl px-3 py-2 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition font-medium"
                        />
                    </div>

                    <div class="flex bg-slate-100 p-1 rounded-xl border border-slate-200 text-xs font-semibold">
                        <button 
                            wire:click="setDashboardProjectTypeFilter('all')"
                            class="px-3 py-1.5 rounded-lg transition {{ $dashboardProjectTypeFilter === 'all' ? 'bg-white text-crt-navy font-bold shadow-xs' : 'text-slate-600' }}"
                        >
                            Tous ({{ $totalProjects }})
                        </button>
                        <button 
                            wire:click="setDashboardProjectTypeFilter('quota')"
                            class="px-3 py-1.5 rounded-lg transition {{ $dashboardProjectTypeFilter === 'quota' ? 'bg-white text-crt-navy font-bold shadow-xs' : 'text-slate-600' }}"
                        >
                            Forfait (Quota)
                        </button>
                        <button 
                            wire:click="setDashboardProjectTypeFilter('regie')"
                            class="px-3 py-1.5 rounded-lg transition {{ $dashboardProjectTypeFilter === 'regie' ? 'bg-white text-crt-navy font-bold shadow-xs' : 'text-slate-600' }}"
                        >
                            Régie (Illimité)
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                @foreach ($filteredDashboardProjects as $proj)
                    @php
                        $pct = $proj['isQuota'] ? round(($proj['consumedHours'] / $proj['maxQuota']) * 100) : null;
                        $isOverQuota = $pct && $pct > 100;
                        $isWarning = $pct && $pct >= 85 && $pct <= 100;
                    @endphp
                    <div class="p-4 rounded-xl border border-slate-100 hover:border-crt-cyan/40 hover:bg-crt-cyan-light/20 transition space-y-2 shadow-2xs">
                        <div class="flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="bg-crt-navy text-white font-extrabold text-[10px] px-2 py-0.5 rounded font-mono">
                                    {{ $proj['code'] }}
                                </span>
                                <span class="font-extrabold text-crt-navy truncate">
                                    {{ $proj['name'] }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-700 font-mono">
                                    {{ $proj['consumedHours'] }}h {{ $proj['isQuota'] ? "/ {$proj['maxQuota']}h" : '' }}
                                </span>
                                @if ($proj['isQuota'])
                                    <span class="px-2 py-0.5 text-[11px] font-extrabold rounded-md font-mono {{ $isOverQuota ? 'bg-rose-100 text-rose-800 border border-rose-200' : ($isWarning ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-crt-cyan-light text-crt-navy border border-crt-cyan/20') }}">
                                        {{ $pct }}%
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 text-[11px] font-extrabold rounded-md bg-slate-100 text-slate-700 border border-slate-200 font-mono">
                                        ♾️ Régie
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if ($proj['isQuota'])
                            <div class="h-2.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div 
                                    style="width: {{ min($pct, 100) }}%" 
                                    class="h-full rounded-full transition-all duration-500 {{ $isOverQuota ? 'bg-rose-600' : ($isWarning ? 'bg-amber-500' : 'bg-crt-cyan') }}"
                                ></div>
                            </div>
                        @else
                            <div class="h-2.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-crt-cyan-dark/40 rounded-full w-full animate-pulse"></div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 text-xs pt-4 border-t border-slate-100">
            <span class="text-slate-500 font-medium">
                Montrant <strong class="text-slate-700">{{ ($dashboardPage - 1) * $projectsPerPage + 1 }}</strong> à <strong class="text-slate-700">{{ min($dashboardPage * $projectsPerPage, $totalFilteredProjects) }}</strong> de <strong class="text-slate-700">{{ $totalFilteredProjects }}</strong> résultats
            </span>
            <div class="flex items-center space-x-1">
                <button 
                    @if ($dashboardPage === 1) disabled @endif
                    wire:click="setPage({{ $dashboardPage - 1 }})"
                    class="px-3 py-1.5 text-xs border border-slate-200 rounded-lg hover:bg-slate-50 disabled:opacity-40 font-semibold"
                >
                    Précédent
                </button>
                @for ($i = 1; $i <= $totalDashboardPages; $i++)
                    <button 
                        wire:click="setPage({{ $i }})"
                        class="px-3 py-1.5 text-xs rounded-lg font-bold {{ $dashboardPage === $i ? 'bg-crt-navy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
                    >
                        {{ $i }}
                    </button>
                @endfor
                <button 
                    @if ($dashboardPage === $totalDashboardPages) disabled @endif
                    wire:click="setPage({{ $dashboardPage + 1 }})"
                    class="px-3 py-1.5 text-xs border border-slate-200 rounded-lg hover:bg-slate-50 disabled:opacity-40 font-semibold"
                >
                    Suivant
                </button>
            </div>
        </div>
    </div>

    <!-- Timesheet Quick Access Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Feuille de temps en cours
                </h3>
                <span class="text-xs font-bold px-2.5 py-0.5 bg-amber-100 text-amber-800 rounded-md border border-amber-200">
                    Brouillon
                </span>
            </div>
            <div>
                <h4 class="text-base font-black text-crt-navy">Semaine 17</h4>
                <p class="text-xs text-slate-500 font-mono">Du 20/07/2026 au 26/07/2026</p>
            </div>
            <a 
                href="/timesheets"
                class="w-full bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs py-3 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2"
            >
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Remplir ma feuille
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
            <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Mes feuilles manquantes
            </h3>
            <div class="space-y-2.5">
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <div>
                        <span class="text-xs font-extrabold text-crt-navy bg-amber-100 text-amber-900 px-2 py-0.5 rounded mr-2 font-mono">Semaine 17</span>
                        <span class="text-xs text-slate-600 font-mono">20/07/2026 - 26/07/2026</span>
                    </div>
                    <a 
                        href="/timesheets"
                        class="bg-white hover:bg-crt-cyan-light text-crt-navy border border-slate-300 font-extrabold text-xs px-3 py-1.5 rounded-lg transition"
                    >
                        🖊️ Remplir
                    </a>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <div>
                        <span class="text-xs font-extrabold text-crt-navy bg-amber-100 text-amber-900 px-2 py-0.5 rounded mr-2 font-mono">Semaine 16</span>
                        <span class="text-xs text-slate-600 font-mono">13/07/2026 - 19/07/2026</span>
                    </div>
                    <a 
                        href="/timesheets"
                        class="bg-white hover:bg-crt-cyan-light text-crt-navy border border-slate-300 font-extrabold text-xs px-3 py-1.5 rounded-lg transition"
                    >
                        🖊️ Remplir
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Missing Timesheets & Annual Stats Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Feuilles de temps absentes : Semaine 17 (20/07/2026 – 26/07/2026)
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 uppercase font-extrabold">
                            <th class="p-3">Employé</th>
                            <th class="p-3">Semaine / Période</th>
                            <th class="p-3 text-right">Relance</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-semibold">
                        <tr>
                            <td class="p-3 font-extrabold text-crt-navy flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-crt-cyan-light text-crt-navy border border-crt-cyan/30 flex items-center justify-center text-[10px]">FD</span>
                                Fabrice DENOU
                            </td>
                            <td class="p-3">
                                <span class="bg-amber-100 text-amber-900 text-[10px] px-2 py-0.5 rounded font-mono font-bold">Semaine 17</span> 20/07 - 26/07
                            </td>
                            <td class="p-3 text-right">
                                <button class="text-crt-cyan-dark hover:underline font-bold text-[11px]">
                                    🔔 Relancer
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3 font-extrabold text-crt-navy flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-crt-cyan-light text-crt-navy border border-crt-cyan/30 flex items-center justify-center text-[10px]">MR</span>
                                Mitch Richmond
                            </td>
                            <td class="p-3">
                                <span class="bg-amber-100 text-amber-900 text-[10px] px-2 py-0.5 rounded font-mono font-bold">Semaine 17</span> 20/07 - 26/07
                            </td>
                            <td class="p-3 text-right">
                                <button class="text-crt-cyan-dark hover:underline font-bold text-[11px]">
                                    🔔 Relancer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4 flex flex-col justify-between">
            <div class="space-y-3">
                <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Statistiques annuelles globales
                </h3>
                <div class="space-y-2 text-xs font-semibold">
                    <div class="flex items-center gap-2 text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-200">
                        <span class="font-bold text-crt-navy font-mono">2</span> Employés avec feuilles manquantes
                    </div>
                    <div class="flex items-center gap-2 text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-200">
                        <span class="font-bold text-crt-navy font-mono">7</span> Total feuilles manquantes
                    </div>
                </div>
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-[11px] text-amber-800 font-medium">
                    ℹ️ Métriques compilées depuis le début de l'année financière CRT Solution.
                </div>
            </div>
            <button class="w-full text-left text-xs font-extrabold text-crt-navy hover:text-crt-cyan-dark flex items-center justify-between">
                Voir le récapitulatif annuel ➔
            </button>
        </div>
    </div>
</main>
