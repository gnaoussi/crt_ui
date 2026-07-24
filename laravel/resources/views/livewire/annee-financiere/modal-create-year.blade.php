@if($isCreateModalOpen)
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 z-50 animate-fade-in">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 space-y-5">
            {{-- Header --}}
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                    <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer une Année Financière
                </h3>
                <button 
                    wire:click="$set('isCreateModalOpen', false)" 
                    class="text-slate-400 hover:text-slate-600 transition font-bold text-lg cursor-pointer"
                >
                    ✕
                </button>
            </div>

            {{-- Form Inputs --}}
            <div class="space-y-4 text-xs font-semibold text-slate-700">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-slate-500 mb-1">Date de début *</label>
                        <input 
                            type="text" 
                            wire:model="anneeForm.startDate" 
                            placeholder="ex: 01/04/2027"
                            class="w-full border border-slate-200 rounded-xl px-3 py-2 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition font-mono"
                        />
                    </div>
                    <div>
                        <label class="block text-slate-500 mb-1">Date de fin *</label>
                        <input 
                            type="text" 
                            wire:model="anneeForm.endDate" 
                            placeholder="ex: 31/03/2028"
                            class="w-full border border-slate-200 rounded-xl px-3 py-2 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition font-mono"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-slate-500 mb-1">Premier jour de la semaine *</label>
                    <select 
                        wire:model="anneeForm.firstDay"
                        class="w-full border border-slate-200 rounded-xl px-3 py-2 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition cursor-pointer"
                    >
                        <option value="Dimanche">Dimanche</option>
                        <option value="Lundi">Lundi</option>
                        <option value="Samedi">Samedi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-slate-500 mb-1">Plafond banque de temps (heures)</label>
                    <input 
                        type="number" 
                        wire:model="anneeForm.timeBankCeiling" 
                        placeholder="0 pour sans plafond"
                        class="w-full border border-slate-200 rounded-xl px-3 py-2 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition font-mono"
                    />
                    <p class="text-[11px] text-slate-400 mt-1 font-normal">Saisir 0 si aucun plafond d'heures supplémentaires n'est imposé.</p>
                </div>

                <div class="pt-2">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input 
                            type="checkbox" 
                            wire:model="anneeForm.isActive" 
                            class="w-4 h-4 rounded border-slate-300 text-crt-navy focus:ring-crt-cyan"
                        />
                        <span class="text-xs font-bold text-crt-navy">Définir comme année financière active</span>
                    </label>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button 
                    wire:click="$set('isCreateModalOpen', false)" 
                    class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 border border-slate-200 hover:bg-slate-50 transition cursor-pointer"
                >
                    Annuler
                </button>
                <button 
                    wire:click="createAnnee" 
                    class="px-4 py-2 rounded-xl text-xs font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark transition shadow-md shadow-crt-navy/10 cursor-pointer"
                >
                    Créer l'Année
                </button>
            </div>
        </div>
    </div>
@endif
