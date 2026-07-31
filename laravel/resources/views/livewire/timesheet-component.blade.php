<div x-data="{ 
    mode: @entangle('currentMode'),
    searchQuery: '',
    consultationViewType: 'grid' 
}">

    <!-- MAIN CONTAINER (Centré pour overview, pleine largeur pour Saisie & Consultation) -->
    <main class="flex-1 flex flex-col xl:flex-row p-6 gap-6 w-full {{ $viewMode === 'overview' ? 'max-w-[1600px] mx-auto' : '' }}">
        
        <!-- LEFT AREA: Overview vs Saisie Mode vs Consultation Mode -->
        @if ($viewMode === 'overview')
            @include('livewire.timesheet.overview')
        @elseif ($viewMode === 'saisie' && $currentMode === 'saisie')
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
                            wire:click="$set('viewMode', 'saisie'); $set('currentMode', 'saisie')"
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
                            type="button"
                            wire:click="$set('consultationViewType', 'grid')"
                            class="flex-1 sm:flex-initial flex items-center gap-1.5 text-xs font-bold px-3.5 py-2 rounded-lg transition-all cursor-pointer {{ $consultationViewType === 'grid' ? 'bg-white text-crt-navy shadow-sm' : 'text-slate-500 hover:text-crt-navy' }}"
                        >
                            <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Grille Récapitulative
                        </button>
                        <button 
                            type="button"
                            wire:click="$set('consultationViewType', 'timeline')"
                            class="flex-1 sm:flex-initial flex items-center gap-1.5 text-xs font-bold px-3.5 py-2 rounded-lg transition-all cursor-pointer {{ $consultationViewType === 'timeline' ? 'bg-white text-crt-navy shadow-sm' : 'text-slate-500 hover:text-crt-navy' }}"
                        >
                            <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Journal d'activités (Timeline)
                        </button>
                    </div>
                </div>

                <!-- Subview: Consultation Grid Table View -->
                @if ($consultationViewType === 'grid')
                    @include('livewire.timesheet.grid-consultation')
                @else
                    <!-- Subview: Consultation Timeline Journal View -->
                    @include('livewire.timesheet.timeline-consultation')
                @endif

            </div>
        @endif

    </main>
</div>
