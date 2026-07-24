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
        @if ($entrepriseMode === 'saisie')
            <button 
                wire:click="openCreateSiteModal"
                class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-lg shadow-crt-navy/10"
            >
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Nouveau site
            </button>
        @endif
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
            <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Rechercher
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
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                {{ $site->phone }}
                            </div>
                            @if ($site->phone_pro)
                                <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg>
                                    {{ $site->phone_pro }}
                                </div>
                            @endif
                        </td>
                        <td class="p-3.5">
                            <div class="flex items-center justify-center space-x-1.5">
                                <button 
                                    wire:click="openViewSiteModal({{ $site->id }})"
                                    title="Consulter le site"
                                    class="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition cursor-pointer"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                @if ($entrepriseMode === 'saisie')
                                    <button 
                                        wire:click="openEditSiteModal({{ $site->id }})"
                                        title="Modifier le site"
                                        class="p-1.5 text-crt-navy border border-crt-navy/30 bg-slate-100 hover:bg-crt-navy hover:text-white rounded-lg transition cursor-pointer"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button 
                                        wire:click="confirmDeleteSite({{ $site->id }})"
                                        title="Supprimer le site"
                                        class="p-1.5 text-rose-600 border border-rose-200 bg-rose-50 hover:bg-rose-600 hover:text-white rounded-lg transition cursor-pointer"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @endif
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
