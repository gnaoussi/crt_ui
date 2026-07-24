<!-- Card 1: Informations de l'Entreprise -->
<div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5" x-data="{ mode: @entangle('entrepriseMode') }">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
        <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
            </svg>
            Informations de l'Entreprise
        </h3>

        <!-- Switch Mode Saisie / Mode Consultation -->
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
        <!-- Mode Consultation: Affichage lecture seule -->
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

    <!-- Mode Édition / Saisie: Formulaire de modification direct -->
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
