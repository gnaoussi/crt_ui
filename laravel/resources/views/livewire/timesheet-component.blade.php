<div x-data="{ 
    mode: @entangle('currentMode'),
    searchQuery: '',
    consultationViewType: 'grid' 
}">

    <!-- Sub Header Breadcrumb & Mode Selector Navigation Bar (Identique index.html) -->
    <div class="bg-white border-b border-slate-200/80 px-6 py-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs font-semibold">
        <nav class="flex items-center space-x-2 text-slate-600">
            <a href="/dashboard" class="flex items-center gap-1 hover:text-crt-navy transition cursor-pointer">
                <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Accueil
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-600 hover:text-crt-navy cursor-pointer">Feuilles de Temps</span>
            <span class="text-slate-300">/</span>
            <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                Projets & Suivi Hebdomadaire
            </span>
        </nav>

        <!-- Mode Toggle (Saisie vs Consultation) -->
        <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
            <div class="flex bg-slate-100 p-1 rounded-xl border border-slate-200">
                <button 
                    type="button"
                    wire:click="$set('currentMode', 'saisie')"
                    class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all {{ $currentMode === 'saisie' ? 'bg-white text-crt-navy shadow-sm' : 'text-slate-500 hover:text-crt-navy' }}"
                >
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Mode Saisie (Grille)
                </button>
                <button 
                    type="button"
                    wire:click="$set('currentMode', 'consultation')"
                    class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all {{ $currentMode === 'consultation' ? 'bg-white text-crt-cyan-dark shadow-sm' : 'text-slate-500 hover:text-crt-navy' }}"
                >
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Mode Consultation (Manager)
                </button>
            </div>
        </div>
    </div>

    <!-- MAIN CONTAINER (Prend TOUT l'espace horizontal) -->
    <main class="flex-1 flex flex-col xl:flex-row p-6 gap-6 w-full">
        
        <!-- LEFT AREA: Saisie Mode ou Consultation Mode -->
        @if ($currentMode === 'saisie')
            <div class="flex-1 flex flex-col gap-6">
                
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
                            <select wire:model.live="selectedTaskId" class="w-full bg-white border border-slate-300 text-slate-800 text-xs rounded-xl px-3 py-2 focus:ring-2 focus:ring-crt-cyan focus:outline-none font-medium shadow-xs">
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
                            class="bg-crt-cyan hover:bg-crt-cyan-dark text-crt-navy font-extrabold px-6 py-2.5 rounded-xl text-xs transition shadow-lg shadow-crt-cyan/20 h-[38px] flex items-center justify-center gap-1.5 w-full md:w-auto cursor-pointer"
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

                <!-- Active Grid Saisie Table (Du Lundi au Vendredi uniquement, identique index.html DAYS_CONFIG) -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse table-fixed min-w-[1100px]">
                            <thead>
                                <tr class="bg-slate-100/80 text-slate-700 border-b border-slate-200 text-xs uppercase tracking-wider font-extrabold">
                                    <th class="p-4 w-[240px]">Clients / Tâches Actives</th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Lundi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Mardi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Mercredi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Jeudi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Vendredi</div>
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
                                        <td colspan="6" class="p-3"></td>
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

                                            @for ($i = 0; $i < 5; $i++)
                                                <td class="p-2 transition-all relative border-r border-slate-100">
                                                    <div class="flex flex-col gap-1.5">
                                                        <div class="flex items-center bg-white border border-slate-300 focus-within:border-crt-cyan rounded-lg px-2 py-1 shadow-xs transition">
                                                            <span class="text-xs font-bold text-crt-cyan-dark mr-1.5 select-none font-mono">H</span>
                                                            <input 
                                                                type="number" 
                                                                step="0.5" 
                                                                min="0" 
                                                                max="24"
                                                                placeholder="0.0"
                                                                value="7.5"
                                                                class="w-full bg-transparent text-crt-navy text-xs font-bold text-right outline-none focus:ring-0 p-0 font-mono"
                                                            />
                                                        </div>

                                                        <div class="relative">
                                                            <input 
                                                                type="text"
                                                                maxlength="50"
                                                                placeholder="Réalisation..."
                                                                value="Développement feature CRT"
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
                                        <td colSpan="8" class="text-center py-16 text-slate-500 text-sm font-medium">
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
                                        <td class="p-4 text-center text-base font-black text-crt-cyan bg-crt-navy-dark font-mono border-l border-crt-navy-light">
                                            37.5h
                                        </td>
                                        <td></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <!-- LEFT AREA: Consultation Mode (Manager) -->
            <div class="flex-1 flex flex-col gap-6">
                
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

                <!-- Consultation Grid Table View (Du Lundi au Vendredi) -->
                <div x-show="consultationViewType === 'grid'" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse table-fixed min-w-[1100px]">
                            <thead>
                                <tr class="bg-slate-100/80 text-slate-700 border-b border-slate-200 text-xs uppercase tracking-wider font-extrabold">
                                    <th class="p-4 w-[240px]">Clients / Tâches</th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Lundi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Mardi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Mercredi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Jeudi</div>
                                    </th>
                                    <th class="p-4 text-center w-[180px]">
                                        <div class="font-extrabold text-crt-navy">Vendredi</div>
                                    </th>
                                    <th class="p-4 text-center w-[100px]">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr class="bg-slate-100/70 border-y border-slate-200">
                                        <td class="p-3 font-extrabold text-crt-navy text-sm">
                                            <span class="flex items-center gap-2">
                                                <span class="w-3 h-3 rounded-md bg-crt-cyan shadow-sm shadow-crt-cyan/30"></span>
                                                {{ $client->name }}
                                            </span>
                                        </td>
                                        <td colspan="6" class="p-3"></td>
                                    </tr>

                                    @foreach ($client->tasks as $task)
                                        <tr class="border-b border-slate-100 hover:bg-crt-cyan-light/40 transition">
                                            <td class="p-3 pl-8 text-xs font-semibold text-slate-700 whitespace-normal break-words leading-relaxed">
                                                {{ $task->name }}
                                            </td>
                                            @for ($i = 0; $i < 5; $i++)
                                                <td class="p-3 text-center font-mono font-bold text-xs text-slate-700 border-r border-slate-100">
                                                    7.5h
                                                </td>
                                            @endfor
                                            <td class="p-3 text-center font-extrabold text-sm text-crt-navy bg-slate-50/60 font-mono">
                                                37.5h
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                <tr class="bg-crt-navy text-white font-semibold text-sm">
                                    <td class="p-4 pl-6 text-left uppercase tracking-wider text-xs font-extrabold text-crt-cyan">
                                        Total Heures Validées
                                    </td>
                                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                                    <td class="p-4 text-center text-base font-black text-crt-cyan bg-crt-navy-dark font-mono border-l border-crt-navy-light">
                                        37.5h
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
