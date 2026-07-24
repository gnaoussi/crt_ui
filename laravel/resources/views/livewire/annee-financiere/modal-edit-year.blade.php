@if($isEditModalOpen)
    <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in space-y-4">
            {{-- Header --}}
            <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Modifier une Année Financière
                </h3>
                <button 
                    wire:click="$set('isEditModalOpen', false)" 
                    class="text-slate-400 hover:text-slate-700 p-1.5 rounded-lg transition cursor-pointer"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Form Inputs --}}
            <form wire:submit.prevent="updateAnnee" class="space-y-4 text-xs">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">
                            Date de début <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            required
                            wire:model="anneeForm.startDate" 
                            class="w-full border border-slate-200 rounded-xl p-2.5 bg-slate-50 font-mono font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20"
                        />
                        <span class="text-[11px] text-slate-400 mt-1 block">Doit être le 1er avril</span>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">
                            Date de fin <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            required
                            wire:model="anneeForm.endDate" 
                            class="w-full border border-slate-200 rounded-xl p-2.5 bg-slate-50 font-mono font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20"
                        />
                        <span class="text-[11px] text-slate-400 mt-1 block">Doit être le 31 mars de l'année suivante</span>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        Premier jour de la semaine <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        wire:model="anneeForm.firstDay"
                        class="w-full border border-slate-200 rounded-xl p-2.5 bg-slate-50 font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20"
                    >
                        <option value="Dimanche">Dimanche</option>
                        <option value="Lundi">Lundi</option>
                    </select>
                    <span class="text-[11px] text-slate-400 mt-1 block">Jour de début des semaines pour cette année financière</span>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        Plafond banque de temps <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        required
                        wire:model="anneeForm.timeBankCeiling" 
                        class="w-full border border-slate-200 rounded-xl p-2.5 bg-slate-50 font-mono font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20"
                    />
                    <span class="text-[11px] text-slate-400 mt-1 block">Nombre maximum d'heures dans la banque de temps</span>
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-2 font-bold text-slate-700 cursor-pointer">
                        <input 
                            type="checkbox" 
                            wire:model="anneeForm.isActive" 
                            class="w-4 h-4 rounded text-crt-cyan focus:ring-crt-cyan"
                        />
                        Année active
                    </label>
                    <span class="text-[11px] text-slate-400 mt-1 block pl-6">Une seule année peut être active à la fois</span>
                </div>

                {{-- Footer Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <button 
                        type="button" 
                        wire:click="$set('isEditModalOpen', false)" 
                        class="px-4 py-2 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition flex items-center gap-1 cursor-pointer"
                    >
                        ✕ Fermer
                    </button>
                    <button 
                        type="submit" 
                        class="px-5 py-2 text-xs font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl transition shadow-lg flex items-center gap-1.5 cursor-pointer"
                    >
                        <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
