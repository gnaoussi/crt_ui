<main class="flex-1 p-6 space-y-6 max-w-[1600px] mx-auto w-full">
    
    <!-- Card 1: Informations de l'Entreprise -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
            <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                </svg>
                Informations de l'Entreprise
            </h3>

            <!-- Switched to Mode Saisie & Mode Consultation Switch Buttons -->
            <div class="flex bg-slate-100 p-1 rounded-xl border border-slate-200">
                <button 
                    wire:click="$set('entrepriseMode', 'saisie')"
                    class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all {{ $entrepriseMode === 'saisie' ? 'bg-white text-crt-navy shadow-sm' : 'text-slate-500 hover:text-crt-navy' }}"
                >
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Mode Édition (Saisie)
                </button>
                <button 
                    wire:click="$set('entrepriseMode', 'consultation')"
                    class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all {{ $entrepriseMode === 'consultation' ? 'bg-white text-crt-cyan-dark shadow-sm' : 'text-slate-500 hover:text-crt-navy' }}"
                >
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Mode Consultation
                </button>
            </div>
        </div>

        @if ($entrepriseMode === 'consultation')
            <!-- Consultation Mode: Clean Read-Only view -->
            <div class="space-y-4 text-xs">
                <div>
                    <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Nom de l'entreprise</span>
                    <h4 class="text-sm font-extrabold text-crt-navy">{{ $companyInfo['name'] }}</h4>
                </div>
                <div>
                    <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Délai de probation</span>
                    <p class="font-semibold text-slate-700 font-mono">{{ $companyInfo['probationPeriod'] }}</p>
                </div>
                <div>
                    <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Description</span>
                    <p class="font-medium text-slate-700 leading-relaxed max-w-4xl">{{ $companyInfo['description'] }}</p>
                </div>
            </div>
        @else
            <!-- Saisie / Edition Mode: Form to edit directly -->
            <div class="space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nom de l'entreprise</label>
                    <input 
                        type="text"
                        wire:model="editedCompanyInfo.name"
                        class="w-full text-xs font-semibold border border-slate-300 rounded-xl p-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan"
                    />
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Délai de probation</label>
                    <input 
                        type="text"
                        wire:model="editedCompanyInfo.probationPeriod"
                        class="w-full text-xs font-semibold border border-slate-300 rounded-xl p-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan"
                    />
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Description</label>
                    <textarea 
                        rows="3"
                        wire:model="editedCompanyInfo.description"
                        class="w-full text-xs font-medium border border-slate-300 rounded-xl p-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan resize-none"
                    ></textarea>
                </div>
                <div class="flex justify-end pt-2">
                    <button 
                        wire:click="saveCompanyInfo"
                        class="bg-crt-cyan hover:bg-crt-cyan-dark text-crt-navy font-extrabold text-xs px-5 py-2 rounded-xl shadow-lg shadow-crt-cyan/20 flex items-center gap-1.5"
                    >
                        💾 Enregistrer les modifications
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Card 2: Sites de l'entreprise -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
            <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Sites de l'entreprise ({{ count($sites) }})
            </h3>
        </div>

        <!-- Search Bar -->
        <div class="flex gap-2">
            <div class="relative flex-1">
                <input 
                    type="text"
                    placeholder="Rechercher dans tous les champs (nom, description, adresse, téléphone)..."
                    wire:model.live="siteSearchQuery"
                    class="w-full text-xs font-medium border border-slate-200 rounded-xl px-3.5 py-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition"
                />
            </div>
            <button class="bg-white border border-slate-300 hover:bg-crt-cyan-light text-crt-navy font-bold text-xs px-4 py-2.5 rounded-xl transition flex items-center gap-1.5">
                🔍 Rechercher
            </button>
        </div>

        <!-- Sites Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-slate-100/80 text-slate-700 border-b border-slate-200 text-xs uppercase tracking-wider font-extrabold">
                        <th class="p-3.5 w-[280px]">Nom du site</th>
                        <th class="p-3.5">Adresse</th>
                        <th class="p-3.5 w-[220px]">Téléphone</th>
                        <th class="p-3.5 text-center w-[120px]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse ($sites as $site)
                        <tr class="hover:bg-crt-cyan-light/30 transition">
                            <td class="p-3.5">
                                <h4 class="font-extrabold text-crt-navy text-xs">{{ $site->name }}</h4>
                                <p class="text-slate-500 text-[11px] truncate max-w-[260px] font-medium">{{ $site->description }}</p>
                            </td>
                            <td class="p-3.5 font-medium text-slate-700 leading-relaxed">
                                <div>{{ $site->address }}</div>
                                <div class="text-slate-500 font-mono text-[11px]">{{ $site->postal_code }} {{ $site->city }}</div>
                            </td>
                            <td class="p-3.5 font-mono text-slate-700">
                                <div class="flex items-center gap-1">
                                    <span class="text-slate-400">📞</span> {{ $site->phone }}
                                </div>
                                @if ($site->phone_pro)
                                    <div class="flex items-center gap-1 text-[11px] text-slate-500">
                                        <span class="text-slate-400">📠</span> {{ $site->phone_pro }}
                                    </div>
                                @endif
                            </td>
                            <td class="p-3.5">
                                <div class="flex items-center justify-center space-x-1.5">
                                    <button 
                                        title="Consulter le site"
                                        class="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colSpan="4" class="text-center py-12 text-slate-400 italic">
                                Aucun site trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
