<div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
        <div>
            <h3 class="text-base font-black text-crt-navy flex items-center gap-2">
                <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Historique des années financières
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">Consultez et gérez les exercices financiers de votre entreprise</p>
        </div>
        <button 
            wire:click="openCreateModal"
            class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow-lg shadow-crt-navy/10 cursor-pointer"
        >
            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Nouvelle Année
        </button>
    </div>

    {{-- Filter Dropdown: Année de Début --}}
    <div class="flex items-center gap-3 bg-slate-50/80 p-3 rounded-xl border border-slate-200/80">
        <label class="text-xs font-extrabold text-crt-navy flex items-center gap-1.5">
            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Année de début :
        </label>
        <select 
            wire:model.live="anneeSearchQuery"
            class="text-xs font-semibold border border-slate-200 rounded-xl px-3.5 py-2 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition cursor-pointer min-w-[180px]"
        >
            <option value="">Toutes les années</option>
            @php
                $years = collect($financialYears)->map(fn($f) => explode('/', $f['startDate'])[2] ?? '')->unique()->sortDesc();
            @endphp
            @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
        @if($anneeSearchQuery)
            <button 
                wire:click="$set('anneeSearchQuery', '')"
                class="text-xs font-bold text-slate-500 hover:text-rose-600 transition cursor-pointer flex items-center gap-1 bg-white px-2.5 py-1.5 rounded-lg border border-slate-200"
            >
                ✕ Réinitialiser
            </button>
        @endif
    </div>

    {{-- Financial Years Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-slate-100/80 text-slate-700 border-b border-slate-200 text-xs uppercase tracking-wider font-extrabold">
                    <th class="p-3.5">DATE DE DÉBUT</th>
                    <th class="p-3.5">DATE DE FIN</th>
                    <th class="p-3.5">PREMIER JOUR</th>
                    <th class="p-3.5">PLAFOND BANQUE DE TEMPS</th>
                    <th class="p-3.5">STATUT</th>
                    <th class="p-3.5 text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                @php
                    $filteredYears = collect($financialYears)->filter(function($f) use ($anneeSearchQuery) {
                        return !$anneeSearchQuery || str_contains($f['startDate'], $anneeSearchQuery) || str_contains($f['endDate'], $anneeSearchQuery);
                    });
                @endphp
                @forelse($filteredYears as $annee)
                    <tr class="hover:bg-crt-cyan-light/30 transition">
                        <td class="p-3.5 font-bold text-crt-navy font-mono">
                            {{ $annee['startDate'] }}
                        </td>
                        <td class="p-3.5 font-bold text-crt-navy font-mono">
                            {{ $annee['endDate'] }}
                        </td>
                        <td class="p-3.5 font-semibold text-slate-700">
                            {{ $annee['firstDay'] }}
                        </td>
                        <td class="p-3.5 font-semibold text-slate-700">
                            {{ $annee['timeBankCeiling'] }}
                        </td>
                        <td class="p-3.5">
                            @if($annee['isActive'])
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                    Actif
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    Inactif
                                </span>
                            @endif
                        </td>
                        <td class="p-3.5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                {{-- 📄 Consulter --}}
                                <button 
                                    wire:click="selectAnnee({{ $annee['id'] }})"
                                    class="p-1.5 text-crt-navy bg-crt-cyan-light hover:bg-crt-navy hover:text-white border border-crt-cyan/30 rounded-lg transition cursor-pointer"
                                    title="Consulter la fiche détaillée"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                {{-- ✏️ Édition --}}
                                @if(!$annee['hasTimesheets'])
                                    <button 
                                        wire:click="openEditModal({{ $annee['id'] }})"
                                        class="p-1.5 text-amber-700 bg-amber-50 hover:bg-amber-600 hover:text-white border border-amber-200 rounded-lg transition cursor-pointer"
                                        title="Éditer l'année financière"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                @else
                                    <button 
                                        disabled
                                        class="p-1.5 text-slate-300 bg-slate-100 border border-slate-200 rounded-lg cursor-not-allowed"
                                        title="Modification impossible : des feuilles de temps existent déjà pour cette année"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                @endif

                                {{-- 🗑️ Suppression --}}
                                @if(!$annee['hasTimesheets'])
                                    <button 
                                        wire:click="deleteAnnee({{ $annee['id'] }})"
                                        wire:confirm="Êtes-vous sûr de vouloir supprimer cette année financière ?"
                                        class="p-1.5 text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white border border-rose-200 rounded-lg transition cursor-pointer"
                                        title="Supprimer l'année financière"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @else
                                    <button 
                                        disabled
                                        class="p-1.5 text-slate-300 bg-slate-100 border border-slate-200 rounded-lg cursor-not-allowed"
                                        title="Suppression impossible : des feuilles de temps existent déjà pour cette année"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500 font-medium">
                            Aucune année financière trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
