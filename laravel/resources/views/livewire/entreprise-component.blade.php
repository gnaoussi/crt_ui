<div x-data x-effect="document.body.classList.toggle('overflow-hidden', $wire.isCreateSiteModalOpen || $wire.isViewSiteModalOpen || $wire.isEditSiteModalOpen || $wire.isDeleteSiteModalOpen)" class="p-6 space-y-6 max-w-[1600px] mx-auto w-full">

    <!-- Card 1: Informations de l'Entreprise -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5" x-data="{ mode: @entangle('entrepriseMode') }">
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
                    @click="mode = 'saisie'"
                    wire:click="setMode('saisie')"
                    :class="mode === 'saisie' ? 'bg-white text-crt-navy shadow-sm' : 'text-slate-500 hover:text-crt-navy'"
                    class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Mode Édition (Saisie)
                </button>
                <button 
                    @click="mode = 'consultation'"
                    wire:click="setMode('consultation')"
                    :class="mode === 'consultation' ? 'bg-white text-crt-cyan-dark shadow-sm' : 'text-slate-500 hover:text-crt-navy'"
                    class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg transition-all cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Mode Consultation
                </button>
            </div>
        </div>

        <div x-show="mode === 'consultation'">
            <!-- Consultation Mode: Clean Read-Only view -->
            <div class="space-y-4 text-xs">
                <div>
                    <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Nom de l'entreprise</span>
                    <h4 class="text-sm font-extrabold text-crt-navy">{{ $companyName }}</h4>
                </div>
                <div>
                    <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Délai de probation</span>
                    <p class="font-semibold text-slate-700 font-mono">{{ $probationPeriod }}</p>
                </div>
                <div>
                    <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Description</span>
                    <p class="font-medium text-slate-700 leading-relaxed max-w-4xl">{{ $companyDescription }}</p>
                </div>
            </div>
        </div>

        <!-- Saisie / Edition Mode: Form to edit directly -->
        <div x-show="mode === 'saisie'">
            <form wire:submit.prevent="saveCompanyInfo" class="space-y-4 text-xs" novalidate>

                @if ($errors->any())
                    <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-800 font-bold text-xs rounded-xl flex items-center gap-2 animate-fade-in shadow-2xs">
                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <span>Veuillez corriger l'erreur suivante :</span>
                            <ul class="list-disc list-inside mt-1 font-semibold text-rose-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        Nom de l'entreprise <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text"
                        wire:model.live="editCompanyName"
                        placeholder="Entrez le nom de l'entreprise..."
                        class="w-full text-xs font-semibold border @error('editCompanyName') border-rose-500 bg-rose-50/50 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-300 bg-white focus:ring-crt-cyan/20 focus:border-crt-cyan @enderror rounded-xl p-2.5 transition focus:outline-none focus:ring-2"
                    />
                    @error('editCompanyName')
                        <span class="text-[11px] font-bold text-rose-600 mt-1.5 flex items-center gap-1.5 animate-fade-in">
                            <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Délai de probation</label>
                    <input 
                        type="text"
                        wire:model="editProbationPeriod"
                        class="w-full text-xs font-semibold border border-slate-300 rounded-xl p-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan"
                    />
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Description</label>
                    <textarea 
                        rows="3"
                        wire:model="editCompanyDescription"
                        class="w-full text-xs font-medium border border-slate-300 rounded-xl p-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan resize-none"
                    ></textarea>
                </div>

                <div class="flex justify-end pt-2">
                    <button 
                        type="submit"
                        class="bg-crt-cyan hover:bg-crt-cyan-dark text-crt-navy font-extrabold text-xs px-5 py-2 rounded-xl shadow-lg shadow-crt-cyan/20 flex items-center gap-1.5 cursor-pointer"
                    >
                        <svg class="w-4 h-4 text-crt-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
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
                                        class="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition"
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
                                            class="p-1.5 text-crt-navy border border-crt-navy/30 bg-slate-100 hover:bg-crt-navy hover:text-white rounded-lg transition"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <button 
                                            wire:click="confirmDeleteSite({{ $site->id }})"
                                            title="Supprimer le site"
                                            class="p-1.5 text-rose-600 border border-rose-200 bg-rose-50 hover:bg-rose-600 hover:text-white rounded-lg transition"
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

    <!-- MODALE 1: Nouveau Site -->
    @if ($isCreateSiteModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Nouveau site d'entreprise
                        </h3>
                        <button wire:click="$set('isCreateSiteModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1.5 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="createSite" class="space-y-5 text-xs">
                        <div class="space-y-3">
                            <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg> Informations du Site</span>
                            </h4>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nom du site *</label>
                                <input type="text" required placeholder="Nom du Site" wire:model="siteForm.name" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Description</label>
                                <textarea rows="3" placeholder="Description du site" wire:model="siteForm.description" class="w-full font-medium border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white resize-none"></textarea>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg> Adresse</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="sm:col-span-2">
                                    <label class="block font-bold text-slate-700 mb-1">Adresse complète *</label>
                                    <input type="text" required placeholder="Adresse de la rue" wire:model="siteForm.address" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Ville</label>
                                    <input type="text" placeholder="Ville" wire:model="siteForm.city" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Code postal</label>
                                    <input type="text" placeholder="Code postal" wire:model="siteForm.postal_code" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> Contacts</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Téléphone *</label>
                                    <input type="text" required placeholder="XXX.XXX.XXXX" wire:model="siteForm.phone" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Téléphone Pro</label>
                                    <input type="text" placeholder="XXX.XXX.XXXX" wire:model="siteForm.phone_pro" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                            <button type="button" wire:click="$set('isCreateSiteModalOpen', false)" class="px-4 py-2.5 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                            <button type="submit" class="px-5 py-2.5 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg transition"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4" /></svg> Créer le site</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    <!-- MODALE 2: Fiche détaillée du Site -->
    @if ($isViewSiteModalOpen && $selectedSite)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in space-y-5 text-xs">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Fiche détaillée du site
                        </h3>
                        <button wire:click="$set('isViewSiteModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1.5 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <!-- Section 1: Informations du Site -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg> Informations du Site</span>
                        </h4>
                        <div>
                            <span class="block font-bold text-slate-700 mb-1">Nom du Site</span>
                            <div class="w-full font-extrabold text-crt-navy text-sm border border-slate-200 rounded-xl p-2.5 bg-slate-50">
                                {{ $selectedSite->name }}
                            </div>
                        </div>
                        <div>
                            <span class="block font-bold text-slate-700 mb-1">Description</span>
                            <div class="w-full font-medium text-slate-700 border border-slate-200 rounded-xl p-2.5 bg-slate-50 leading-relaxed">
                                {{ $selectedSite->description ?: 'Aucune description fournie.' }}
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Adresse -->
                    <div class="space-y-3 pt-3 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg> Adresse</span>
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="sm:col-span-2">
                                <span class="block font-bold text-slate-700 mb-1">Adresse complète</span>
                                <div class="w-full font-semibold text-slate-800 border border-slate-200 rounded-xl p-2.5 bg-slate-50">
                                    {{ $selectedSite->address }}
                                </div>
                            </div>
                            <div>
                                <span class="block font-bold text-slate-700 mb-1">Ville</span>
                                <div class="w-full font-semibold text-slate-800 border border-slate-200 rounded-xl p-2.5 bg-slate-50">
                                    {{ $selectedSite->city }}
                                </div>
                            </div>
                            <div>
                                <span class="block font-bold text-slate-700 mb-1">Code postal</span>
                                <div class="w-full font-semibold text-slate-800 border border-slate-200 rounded-xl p-2.5 bg-slate-50 font-mono">
                                    {{ $selectedSite->postal_code }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Contacts -->
                    <div class="space-y-3 pt-3 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> Contacts</span>
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 font-mono">
                            <div>
                                <span class="block font-bold text-slate-700 mb-1 font-sans">Téléphone</span>
                                <div class="w-full font-bold text-slate-800 border border-slate-200 rounded-xl p-2.5 bg-slate-50">
                                    {{ $selectedSite->phone }}
                                </div>
                            </div>
                            <div>
                                <span class="block font-bold text-slate-700 mb-1 font-sans">Téléphone Pro</span>
                                <div class="w-full font-bold text-slate-800 border border-slate-200 rounded-xl p-2.5 bg-slate-50">
                                    {{ $selectedSite->phone_pro ?: '—' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-100">
                        <button wire:click="$set('isViewSiteModalOpen', false)" class="px-5 py-2.5 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                    </div>
                </div>
            </div>
        </template>
    @endif

    <!-- MODALE 3: Modifier le Site -->
    @if ($isEditSiteModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                        <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                            <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Modifier le site d'entreprise
                        </h3>
                        <button wire:click="$set('isEditSiteModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1.5 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="updateSite" class="space-y-5 text-xs">
                        <div class="space-y-3">
                            <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg> Informations du Site</span>
                            </h4>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nom du site *</label>
                                <input type="text" required placeholder="Nom du Site" wire:model="siteForm.name" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Description</label>
                                <textarea rows="3" placeholder="Description du site" wire:model="siteForm.description" class="w-full font-medium border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white resize-none"></textarea>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg> Adresse</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="sm:col-span-2">
                                    <label class="block font-bold text-slate-700 mb-1">Adresse complète *</label>
                                    <input type="text" required placeholder="Adresse de la rue" wire:model="siteForm.address" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Ville</label>
                                    <input type="text" placeholder="Ville" wire:model="siteForm.city" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Code postal</label>
                                    <input type="text" placeholder="Code postal" wire:model="siteForm.postal_code" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> Contacts</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Téléphone *</label>
                                    <input type="text" required placeholder="XXX.XXX.XXXX" wire:model="siteForm.phone" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Téléphone Pro</label>
                                    <input type="text" placeholder="XXX.XXX.XXXX" wire:model="siteForm.phone_pro" class="w-full font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                            <button type="button" wire:click="$set('isEditSiteModalOpen', false)" class="px-4 py-2.5 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Annuler</span></button>
                            <button type="submit" class="px-5 py-2.5 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg transition"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Sauvegarder</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    <!-- MODALE 4: Confirmation de suppression du Site -->
    @if ($isDeleteSiteModalOpen && $selectedSite)
        <template x-teleport="body">
            <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl border border-slate-100 space-y-4 text-xs text-center animate-fade-in">
                    <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-extrabold text-crt-navy">Supprimer le site ?</h3>
                    <p class="text-slate-500 font-medium">Êtes-vous sûr de vouloir supprimer le site <strong class="text-crt-navy">{{ $selectedSite->name }}</strong> ? Cette action est irréversible.</p>
                    <div class="flex justify-center gap-3 pt-2">
                        <button wire:click="$set('isDeleteSiteModalOpen', false)" class="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl">Annuler</button>
                        <button wire:click="deleteSite" class="px-5 py-2 font-extrabold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-lg shadow-rose-600/20">Oui, Supprimer</button>
                    </div>
                </div>
            </div>
        </template>
    @endif
</div>
