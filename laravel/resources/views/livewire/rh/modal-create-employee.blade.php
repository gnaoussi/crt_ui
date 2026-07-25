<!-- 1. MODALE: Création Nouvel Employé (new_employe_modal.png) -->
@if ($isNewEmployeeModalOpen)
    <template x-teleport="body">
        <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                    <h3 class="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg class="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Nouvel employé
                    </h3>
                    <button wire:click="$set('isNewEmployeeModalOpen', false)" class="text-slate-400 hover:text-slate-700 p-1.5 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="handleCreateEmployee" class="space-y-6 text-xs">
                    <div class="space-y-3">
                        <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-6 0h6" /></svg> Informations personnelles</span></h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nom *</label>
                                <input type="text" required wire:model="newEmpForm.nom" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Prénom *</label>
                                <input type="text" required wire:model="newEmpForm.prenom" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Date de naissance *</label>
                                <input type="text" placeholder="ex: 07-21" wire:model="newEmpForm.dob" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">E-mail *</label>
                                <input type="email" required placeholder="employe@exemple.com" wire:model="newEmpForm.email" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-3 border-t border-slate-100">
                        <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> Informations professionnelles</span></h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Matricule ID Unique</label>
                                <input type="text" wire:model="newEmpForm.matricule" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Date d'embauche *</label>
                                <input type="date" wire:model="newEmpForm.hireDate" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nombre d'heures / semaine *</label>
                                <input type="number" step="0.5" wire:model="newEmpForm.weeklyHours" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Gestionnaire assigné *</label>
                                <select wire:model="newEmpForm.gestionnaire" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                    <option value="Admin Plateforme GCS">Admin Plateforme GCS</option>
                                    <option value="Fabrice DENOU">Fabrice DENOU</option>
                                    <option value="Mitch Richmond">Mitch Richmond</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-3 border-t border-slate-100">
                        <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg> Site de travail</span></h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Site d'affectation *</label>
                                <select wire:model="newEmpForm.site" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                    @foreach ($sites as $s)
                                        <option value="{{ $s->name }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Date de début *</label>
                                <input type="date" wire:model="newEmpForm.startDate" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-3 border-t border-slate-100">
                        <h4 class="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">👤 Rôles et permissions</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Définir comme gestionnaire ?</label>
                                <select wire:model="newEmpForm.isManager" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                    <option value="Non">Non</option>
                                    <option value="Oui">Oui</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Groupe d'accès *</label>
                                <select wire:model="newEmpForm.accessGroup" class="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-bold text-crt-navy">
                                    <option value="ADMINISTRATEUR">ADMINISTRATEUR</option>
                                    <option value="MANAGER">MANAGER</option>
                                    <option value="EMPLOYE">EMPLOYÉ</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="$set('isNewEmployeeModalOpen', false)" class="px-4 py-2.5 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl cursor-pointer"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span></button>
                        <button type="submit" class="px-5 py-2.5 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg cursor-pointer"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4" /></svg> Créer</span></button>
                    </div>
                </form>
            </div>
        </div>
    </template>
@endif
