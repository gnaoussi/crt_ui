<!-- MODALE: Modifier le Site -->
@if ($isEditSiteModalOpen)
    <template x-teleport="body">
        <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                    <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <span class="text-crt-cyan"><svg class="w-4 h-4 text-crt-cyan inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg></span>
                        Modifier le site
                    </h3>
                    <button wire:click="$set('isEditSiteModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1.5 rounded-lg transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="updateSite" class="space-y-5">
                    <div class="space-y-3">
                        <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg> Informations du Site</span>
                        </h4>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nom du Site *</label>
                            <input type="text" required placeholder="Nom du Site" wire:model="siteForm.name" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Description</label>
                            <textarea rows="3" placeholder="Site description" wire:model="siteForm.description" class="w-full text-xs font-medium border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition resize-none"></textarea>
                        </div>
                    </div>

                    <div class="space-y-3 pt-3 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg> Adresse</span>
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1">Rue *</label>
                                <input type="text" required placeholder="Adresse de la rue" wire:model="siteForm.address" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Appartement / Bureau</label>
                                <input type="text" placeholder="Appartement / Bureau" wire:model="siteForm.extension" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Ville *</label>
                                <input type="text" required placeholder="Ville" wire:model="siteForm.city" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Code postal *</label>
                                <input type="text" required placeholder="Code postal" wire:model="siteForm.postal_code" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition font-mono" />
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-3 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> Contacts</span>
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Téléphone *</label>
                                <input type="text" required placeholder="XXX.XXX.XXXX" wire:model="siteForm.phone" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition font-mono" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Téléphone Pro</label>
                                <input type="text" placeholder="XXX.XXX.XXXX" wire:model="siteForm.phone_pro" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition font-mono" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Extension</label>
                                <input type="text" placeholder="123" wire:model="siteForm.extension" class="w-full text-xs font-semibold border border-slate-200 focus:border-crt-cyan rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 transition font-mono" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="$set('isEditSiteModalOpen', false)" class="px-4 py-2.5 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition flex items-center gap-1.5 cursor-pointer">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Annuler</span>
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-xs font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl transition shadow-lg flex items-center gap-1.5 cursor-pointer">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Sauvegarder</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
@endif
