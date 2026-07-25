<!-- 4. MODALE: Modifier l'heure (modifier_nombre_d_heure_par_semaine_dans_historique.png) -->
@if ($isEditHoursModalOpen)
    <template x-teleport="body">
        <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-fade-in">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
                    <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Modifier l'heure
                    </h3>
                    <button wire:click="$set('isEditHoursModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form novalidate wire:submit.prevent="handleSaveHoursChange" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nouvelle Heure *</label>
                        <input type="number" step="0.5" wire:model="editHoursForm.newHours" class="w-full font-semibold border @error('editHoursForm.newHours') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-slate-50 focus:bg-white @enderror rounded-xl p-2.5 font-mono" />
                        @error('editHoursForm.newHours')
                            <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Date de debut de la nouvelle heure *</label>
                        <div class="relative">
                            <input type="datetime-local" wire:model="editHoursForm.startDate" class="w-full font-semibold border @error('editHoursForm.startDate') border-rose-400 bg-rose-50/30 @else border-slate-200 bg-crt-cyan-light @enderror rounded-xl p-2.5 text-crt-navy font-mono cursor-pointer pr-10" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-crt-cyan">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        @error('editHoursForm.startDate')
                            <span class="text-rose-600 font-bold text-[11px] mt-1.5 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" wire:click="$set('isEditHoursModalOpen', false)" class="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl cursor-pointer"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                        <button type="submit" class="px-5 py-2 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg cursor-pointer"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4" /></svg> Créer</span></button>
                    </div>
                </form>
            </div>
        </div>
    </template>
@endif
