<!-- Subview: Saisie / Formulaire d'Édition et Grille Active -->
<div class="flex-1 flex flex-col gap-6">
    
    <!-- Top Header Banner & Quick Submit Action Bar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Saisie de la Feuille de Temps Hebdomadaire
                </h2>
                <span class="text-xs font-extrabold px-3 py-1 bg-amber-100 text-amber-900 border border-amber-300 rounded-full flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    Brouillon
                </span>
            </div>
            <p class="text-xs text-slate-500 font-medium mt-1">Saisie et suivi des heures travaillées du Lundi au Vendredi.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <select class="bg-slate-50 border border-slate-300 text-slate-700 text-xs font-bold rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-crt-cyan focus:outline-none shadow-2xs">
                <option>Semaine 17 (20/07/2026 - 24/07/2026) — Active</option>
                <option>Semaine 16 (13/07/2026 - 17/07/2026)</option>
                <option>Semaine 15 (06/07/2026 - 10/07/2026)</option>
            </select>

            <button 
                type="button"
                wire:click="$set('viewMode', 'consultation')"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow-md shadow-emerald-600/20 cursor-pointer"
            >
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Soumettre la feuille
            </button>
        </div>
    </div>

    <!-- Advanced Row Adder Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
        <div class="flex flex-col md:flex-row items-start justify-between gap-4 mb-4 pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-sm font-extrabold text-crt-navy">Ajouter des tâches à ma feuille</h3>
                <p class="text-xs text-slate-600 font-medium">Recherchez parmi les 100 clients et 50 tâches disponibles configurés par l'administration CRT Solution.</p>
            </div>
            <button 
                type="button"
                class="text-xs font-bold text-crt-navy hover:text-crt-cyan-dark bg-crt-cyan-light hover:bg-crt-cyan/20 px-3.5 py-2 rounded-xl transition flex items-center gap-1.5 self-stretch md:self-auto justify-center border border-crt-cyan/30 cursor-pointer"
            >
                <svg class="w-4 h-4 text-crt-cyan-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                </svg>
                Copier la semaine dernière
            </button>
        </div>

        <form class="flex flex-col md:flex-row items-end gap-4">
            <div class="flex-1 w-full space-y-1">
                <label class="block text-xs font-bold text-slate-700">1. Rechercher un Client (100+ dispos)</label>
                <select wire:model.live="selectedClientId" class="w-full bg-white border border-slate-300 text-slate-800 text-xs rounded-xl px-3 py-2 focus:ring-2 focus:ring-crt-cyan focus:outline-none font-medium shadow-xs">
                    <option value="">Tapez (ex: Stark, Orange, L'Oréal...)</option>
                    @foreach ($clients as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 w-full space-y-1">
                <label class="block text-xs font-bold text-slate-700">2. Associer une Tâche (50 dispos)</label>
                <select 
                    wire:model.live="selectedTaskId" 
                    @if(!$selectedClientId) disabled @endif
                    class="w-full bg-white border border-slate-300 text-slate-800 text-xs rounded-xl px-3 py-2 focus:ring-2 focus:ring-crt-cyan focus:outline-none font-medium shadow-xs disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed disabled:opacity-60"
                >
                    <option value="">Tapez (ex: Dev, Audit, Figma...)</option>
                    @if ($selectedClientId)
                        @php
                            $currentClient = $clients->firstWhere('id', $selectedClientId);
                        @endphp
                        @if ($currentClient)
                            @foreach ($currentClient->tasks as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        @endif
                    @endif
                </select>
            </div>

            <button 
                type="button" 
                @if(!$selectedClientId || !$selectedTaskId) disabled @endif
                class="bg-crt-cyan hover:bg-crt-cyan-dark text-crt-navy font-extrabold px-6 py-2.5 rounded-xl text-xs transition shadow-lg shadow-crt-cyan/20 h-[38px] flex items-center justify-center gap-1.5 w-full md:w-auto cursor-pointer disabled:opacity-40 disabled:pointer-events-none"
            >
                <svg class="w-4 h-4 text-crt-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Ajouter à ma feuille
            </button>
        </form>
        
        <div class="flex flex-wrap items-center gap-2 mt-3.5 text-xs">
            <span class="text-slate-600 font-bold">Suggestions fréquentes :</span>
            <button type="button" class="bg-slate-100 hover:bg-crt-cyan-light hover:text-crt-navy text-slate-700 px-2.5 py-1 rounded-lg transition font-semibold border border-slate-200/60 cursor-pointer">
                Renault Software + Dev API
            </button>
            <button type="button" class="bg-slate-100 hover:bg-crt-cyan-light hover:text-crt-navy text-slate-700 px-2.5 py-1 rounded-lg transition font-semibold border border-slate-200/60 cursor-pointer">
                L'Oréal + Figma Integration
            </button>
            <button type="button" class="bg-slate-100 hover:bg-crt-cyan-light hover:text-crt-navy text-slate-700 px-2.5 py-1 rounded-lg transition font-semibold border border-slate-200/60 cursor-pointer">
                Stark Industries + Gestion de Projet
            </button>
        </div>
    </div>

    <!-- Active Grid Saisie Table (Du Lundi au Dimanche - 7 Jours Complet) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse table-fixed min-w-[1300px]">
                <thead>
                    <tr class="bg-slate-100/80 text-slate-700 border-b border-slate-200 text-xs uppercase tracking-wider font-extrabold">
                        <th class="p-4 w-[240px]">Clients / Tâches Actives</th>
                        <th class="p-4 text-center w-[150px]">
                            <div class="font-extrabold text-crt-navy">Lundi</div>
                        </th>
                        <th class="p-4 text-center w-[150px]">
                            <div class="font-extrabold text-crt-navy">Mardi</div>
                        </th>
                        <th class="p-4 text-center w-[150px]">
                            <div class="font-extrabold text-crt-navy">Mercredi</div>
                        </th>
                        <th class="p-4 text-center w-[150px]">
                            <div class="font-extrabold text-crt-navy">Jeudi</div>
                        </th>
                        <th class="p-4 text-center w-[150px]">
                            <div class="font-extrabold text-crt-navy">Vendredi</div>
                        </th>
                        <th class="p-4 text-center w-[150px] bg-amber-50/60">
                            <div class="font-extrabold text-amber-900">Samedi</div>
                        </th>
                        <th class="p-4 text-center w-[150px] bg-amber-50/60">
                            <div class="font-extrabold text-amber-900">Dimanche</div>
                        </th>
                        <th class="p-4 text-center w-[100px]">Total</th>
                        <th class="p-4 text-center w-[60px]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr class="bg-slate-100/70 border-y border-slate-200">
                            <td class="p-3 font-extrabold text-crt-navy text-sm">
                                <span class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-md bg-crt-cyan shadow-sm shadow-crt-cyan/30"></span>
                                    {{ $client->name }}
                                </span>
                            </td>
                            <td colspan="8" class="p-3"></td>
                            <td class="p-3 text-center">
                                <button title="Retirer toutes les tâches de ce client" class="text-slate-400 hover:text-rose-600 hover:bg-rose-50 p-1.5 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>

                        @foreach ($client->tasks as $task)
                            <tr class="border-b border-slate-100 hover:bg-crt-cyan-light/40 transition">
                                <td class="p-3 pl-8 text-xs font-semibold text-slate-700 whitespace-normal break-words leading-relaxed">
                                    {{ $task->name }}
                                </td>

                                @for ($i = 0; $i < 7; $i++)
                                    <td class="p-2 transition-all relative border-r border-slate-100 {{ $i >= 5 ? 'bg-amber-50/30' : '' }}">
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex items-center bg-white border border-slate-300 focus-within:border-crt-cyan rounded-lg px-2 py-1 shadow-xs transition">
                                                <span class="text-xs font-bold text-crt-cyan-dark mr-1.5 select-none font-mono">H</span>
                                                <input 
                                                    type="number" 
                                                    step="0.5" 
                                                    min="0" 
                                                    max="24"
                                                    placeholder="0.0"
                                                    value="{{ $i < 5 ? '7.5' : '0.0' }}"
                                                    class="w-full bg-transparent text-crt-navy text-xs font-bold text-right outline-none focus:ring-0 p-0 font-mono"
                                                />
                                            </div>

                                            <div class="relative">
                                                <input 
                                                    type="text"
                                                    maxlength="50"
                                                    placeholder="Réalisation..."
                                                    value="{{ $i < 5 ? 'Développement feature CRT' : '' }}"
                                                    class="w-full bg-slate-100 focus:bg-white text-xs px-2.5 py-1 rounded-md text-slate-700 placeholder-slate-500 border border-transparent focus:border-slate-300 outline-none transition font-medium"
                                                />
                                            </div>
                                        </div>
                                    </td>
                                @endfor

                                <td class="p-3 text-center font-extrabold text-sm text-crt-navy bg-slate-50/60 font-mono">
                                    37.5h
                                </td>

                                <td class="p-3 text-center">
                                    <button title="Retirer cette tâche" class="text-slate-400 hover:text-rose-600 hover:bg-rose-50 p-1.5 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colSpan="10" class="text-center py-16 text-slate-500 text-sm font-medium">
                                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Votre grille de la semaine est vide. Ajoutez un client ci-dessus pour commencer.
                            </td>
                        </tr>
                    @endforelse

                    @if ($clients->count() > 0)
                        <tr class="bg-crt-navy text-white font-semibold text-sm">
                            <td class="p-4 pl-6 text-left uppercase tracking-wider text-xs font-extrabold text-crt-cyan">
                                Total Heures / Jour
                            </td>
                            <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                            <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                            <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                            <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                            <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                            <td class="p-4 text-center text-sm font-extrabold text-amber-300 font-mono bg-crt-navy-dark/40">0.0h</td>
                            <td class="p-4 text-center text-sm font-extrabold text-amber-300 font-mono bg-crt-navy-dark/40">0.0h</td>
                            <td class="p-4 text-center text-base font-black text-crt-cyan bg-crt-navy-dark font-mono border-l border-crt-navy-light">
                                37.5h
                            </td>
                            <td></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Footer d'action de la Grille (Soumission par l'employé) -->
        <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Assurez-vous d'avoir complété toutes vos imputations de la semaine avant de soumettre.</span>
            </div>
            
            <button 
                type="button"
                wire:click="$set('currentMode', 'consultation')"
                class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs px-6 py-2.5 rounded-xl transition shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-2 cursor-pointer"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Soumettre ma feuille de temps
            </button>
        </div>
    </div>
</div>
