<div x-data="{ 
    mode: @entangle('currentMode'),
    searchQuery: '',
    consultationViewType: 'grid' 
}">

    <!-- MAIN CONTAINER (Prend TOUT l'espace horizontal) -->
    <main class="flex-1 flex flex-col xl:flex-row p-6 gap-6 w-full">
        
        <!-- LEFT AREA: Saisie Mode ou Consultation Mode -->
        @if ($currentMode === 'saisie')
            @include('livewire.timesheet.form-saisie')
        @else
            <!-- LEFT AREA: Consultation Mode (Manager) -->
            <div class="flex-1 flex flex-col gap-6">
                
                <!-- Consultation Control Banner Header -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 shadow-sm">
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Statut de validation</span>
                            <span class="text-xs font-extrabold px-2.5 py-0.5 rounded-full uppercase tracking-wider bg-amber-100 text-amber-800 border border-amber-200">
                                En attente de revue
                            </span>
                        </div>
                        <h2 class="text-base font-extrabold text-crt-navy">Rapport hebdomadaire d'activités CRT Solution</h2>
                        <p class="text-xs text-slate-600 font-medium">Vue de consultation et contrôle pour la direction ou le client final.</p>
                    </div>

                    <div class="flex flex-wrap gap-2.5 w-full lg:w-auto">
                        <button 
                            type="button"
                            wire:click="$set('currentMode', 'saisie')"
                            class="flex-1 lg:flex-initial bg-amber-50 hover:bg-amber-100 border border-amber-300 text-amber-900 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2 shadow-xs cursor-pointer"
                            title="Rappeler la feuille de temps pour effectuer des modifications"
                        >
                            <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                            </svg>
                            Rappeler pour modification
                        </button>
                        <button class="flex-1 lg:flex-initial bg-white hover:bg-rose-50 border border-slate-200 hover:border-rose-200 text-rose-600 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Demander correction
                        </button>
                        <button class="flex-1 lg:flex-initial bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/10 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Approuver la feuille
                        </button>
                    </div>
                </div>

                <!-- Consultation Switcher Bar (Grid vs Timeline) -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-sm">
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input 
                            type="text"
                            x-model="searchQuery"
                            placeholder="Filtrer par mot-clé, tâche, client..."
                            class="w-full text-xs font-medium border border-slate-200 rounded-xl pl-9 pr-4 py-2 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition"
                        />
                    </div>

                    <div class="flex bg-slate-100 p-1 rounded-xl border border-slate-200 w-full sm:w-auto">
                        <button 
                            @click="consultationViewType = 'grid'"
                            :class="consultationViewType === 'grid' ? 'bg-white text-crt-navy shadow-sm' : 'text-slate-500 hover:text-crt-navy'"
                            class="flex-1 sm:flex-initial flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all"
                        >
                            <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Grille Récapitulative
                        </button>
                        <button 
                            @click="consultationViewType = 'timeline'"
                            :class="consultationViewType === 'timeline' ? 'bg-white text-crt-navy shadow-sm' : 'text-slate-500 hover:text-crt-navy'"
                            class="flex-1 sm:flex-initial flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all"
                        >
                            <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Journal d'activités (Timeline)
                        </button>
                    </div>
                </div>

                <!-- Subview: Consultation Grid Table View -->
                <div x-show="consultationViewType === 'grid'">
                    @include('livewire.timesheet.grid-consultation')
                </div>

                <!-- Subview: Consultation Timeline Journal View -->
                <div x-show="consultationViewType === 'timeline'">
                    @include('livewire.timesheet.timeline-consultation')
                </div>

            </div>
        @endif

        <!-- RIGHT AREA: Analytics Dashboard (Identique index.html) -->
        <div class="w-full xl:w-80 bg-white rounded-2xl shadow-sm border border-slate-200 p-5 flex flex-col h-fit space-y-5">
            <div>
                <h2 class="text-xs font-extrabold text-crt-navy flex items-center gap-2 uppercase tracking-wider">
                    <svg class="w-4 h-4 text-crt-cyan font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    Indicateurs CRT Solution
                </h2>
            </div>

            <div class="bg-crt-cyan-light border border-crt-cyan/30 rounded-2xl p-4 text-center">
                <span class="text-xs text-crt-navy font-bold uppercase tracking-wider">Cumul de la semaine</span>
                <h3 class="text-3xl font-black text-crt-navy mt-1 font-mono">37.5h</h3>
                <p class="text-xs text-slate-600 mt-1 font-medium">Calculé en direct</p>
            </div>

            <div class="space-y-1">
                <div class="flex justify-between text-xs font-semibold">
                    <span class="text-slate-600">Taux de descriptions (qualité)</span>
                    <span class="font-bold font-mono text-emerald-600">100%</span>
                </div>
                <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                    <div style="width: 100%" class="h-full bg-crt-cyan rounded-full transition-all duration-500"></div>
                </div>
                <p class="text-xs text-slate-500 mt-1">Pourcentage d'heures travaillées ayant un descriptif.</p>
            </div>

            <hr class="border-slate-100" />

            <div class="space-y-3">
                <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider">Répartition de la charge</h4>
                <div class="space-y-3">
                    @foreach ($clients as $client)
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs font-semibold">
                                <span class="text-slate-700 truncate max-w-[150px]">{{ $client->name }}</span>
                                <span class="text-slate-600 font-mono">37.5h (100%)</span>
                            </div>
                            <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div style="width: 100%" class="h-full bg-crt-cyan rounded-full transition-all duration-500"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr class="border-slate-100" />

            <button 
                type="button"
                class="w-full bg-crt-navy hover:bg-crt-navy-dark text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2 cursor-pointer"
            >
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Exporter pour la direction
            </button>
        </div>

    </main>
</div>
