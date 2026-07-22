<div className="p-6 space-y-6 max-w-[1600px] mx-auto w-full">
    @if (session()->has('message'))
        <div className="bg-emerald-600 text-white px-4 py-3 rounded-xl shadow-lg flex items-center justify-between text-xs font-bold">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    @if ($selectedEmployeeId === null)
        <!-- VIEW 1: LIST OF EMPLOYEES -->
        <div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
            <div className="flex items-center gap-2 pb-3 border-b text-xs font-extrabold text-crt-navy">🔍 Filtres de recherche (Livewire & SQLite)</div>
            <div className="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs font-semibold">
                <div>
                    <label className="block text-slate-700 mb-1">Employé</label>
                    <input type="text" wire:model.live="empFilterQuery" placeholder="Matricule, Nom, Prénom..." className="w-full text-xs border rounded-xl p-2 bg-slate-50" />
                </div>
                <div>
                    <label className="block text-slate-700 mb-1">Gestionnaire</label>
                    <input type="text" wire:model.live="empFilterManager" placeholder="Gestionnaire..." className="w-full text-xs border rounded-xl p-2 bg-slate-50" />
                </div>
                <div>
                    <label className="block text-slate-700 mb-1">Probation</label>
                    <select wire:model.live="empFilterProbation" className="w-full text-xs border rounded-xl p-2 bg-slate-50">
                        <option value="all">-- Tous --</option>
                        <option value="in_progress">1 heure restante</option>
                    </select>
                </div>
                <div>
                    <label className="block text-slate-700 mb-1">Statut</label>
                    <select wire:model.live="empFilterStatus" className="w-full text-xs border rounded-xl p-2 bg-slate-50">
                        <option value="all">Tous</option>
                        <option value="active">Activé</option>
                        <option value="disabled">Désactivé</option>
                    </select>
                </div>
            </div>
        </div>

        <div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
            <div className="flex justify-between items-center pb-4 border-b">
                <h3 className="text-sm font-extrabold text-crt-navy">👥 Liste des employés ({{ count($employees) }})</h3>
                <button wire:click="openNewEmployeeModal" className="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2.5 rounded-xl shadow-lg flex items-center gap-1.5">
                    ➕ Nouvel employé
                </button>
            </div>

            <div className="overflow-x-auto">
                <table className="w-full text-left border-collapse min-w-[1000px] text-xs">
                    <thead>
                        <tr className="bg-slate-100 text-slate-700 uppercase font-extrabold">
                            <th className="p-3.5">Matricule</th>
                            <th className="p-3.5">Nom</th>
                            <th className="p-3.5">Prénom</th>
                            <th className="p-3.5">Rôle</th>
                            <th className="p-3.5">Gestionnaire</th>
                            <th className="p-3.5">Probation</th>
                            <th className="p-3.5 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-slate-100 font-semibold">
                        @foreach ($employees as $emp)
                            <tr className="hover:bg-crt-cyan-light/30">
                                <td className="p-3.5 font-mono text-crt-navy font-bold">{{ $emp->matricule }}</td>
                                <td className="p-3.5 font-extrabold text-crt-navy">{{ $emp->nom }}</td>
                                <td className="p-3.5">{{ $emp->prenom }}</td>
                                <td className="p-3.5"><span className="bg-slate-100 border px-2 py-0.5 rounded text-[11px] font-bold">{{ $emp->role }}</span></td>
                                <td className="p-3.5 text-slate-600">{{ $emp->gestionnaire }}</td>
                                <td className="p-3.5"><span className="bg-crt-navy text-white text-[11px] font-bold px-3 py-1 rounded-full">{{ $emp->probation_status }}</span></td>
                                <td className="p-3.5">
                                    <div className="flex items-center justify-center space-x-1.5">
                                        <button wire:click="selectEmployee({{ $emp->id }})" title="Voir la fiche" className="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light rounded-lg">👁️</button>
                                        <button wire:click="toggleAccountStatus({{ $emp->id }})" title="Activer/Désactiver" className="p-1.5 text-slate-700 border border-slate-300 bg-slate-100 rounded-lg">🔓</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- VIEW 2: EMPLOYEE DETAILS -->
        <div>
            <button wire:click="backToList" className="text-xs font-bold text-slate-600 bg-white border px-3.5 py-2 rounded-xl mb-4">⬅ Retour à la liste</button>
        </div>

        <div className="bg-gradient-to-r from-crt-cyan to-crt-navy rounded-2xl p-8 text-center text-white shadow-lg mb-6">
            <div className="w-20 h-20 rounded-full bg-white text-crt-navy flex items-center justify-center text-2xl font-black mx-auto mb-3">👤</div>
            <h2 className="text-xl font-black">{{ $selectedEmployee->nom }} {{ $selectedEmployee->prenom }}</h2>
            <p className="text-xs text-crt-cyan-light font-mono mt-1">Matricule : {{ $selectedEmployee->matricule }} — {{ $selectedEmployee->role }}</p>
        </div>

        <div className="flex space-x-2 text-xs font-extrabold mb-6">
            <button wire:click="setTab('information')" className="px-4 py-2.5 rounded-xl {{ $employeeActiveTab === 'information' ? 'bg-crt-navy text-white' : 'bg-white text-slate-600 border' }}">👤 Informations</button>
            <button wire:click="setTab('historiques')" className="px-4 py-2.5 rounded-xl {{ $employeeActiveTab === 'historiques' ? 'bg-crt-navy text-white' : 'bg-white text-slate-600 border' }}">📜 Historiques (Audit Trail)</button>
        </div>

        @if ($employeeActiveTab === 'information')
            <div className="bg-white rounded-2xl border p-6 shadow-sm space-y-6">
                <div className="flex justify-between items-center pb-4 border-b">
                    <h3 className="text-sm font-extrabold text-crt-navy">👤 Informations</h3>
                    <button wire:click="openEditEmployeeModal" className="bg-crt-navy text-white font-extrabold text-xs px-4 py-2 rounded-xl">🖊️ Modifier</button>
                </div>
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs font-semibold">
                    <div><span className="block text-slate-500">Nom & Prénom</span><span className="text-crt-navy font-bold">{{ $selectedEmployee->nom }} {{ $selectedEmployee->prenom }}</span></div>
                    <div><span className="block text-slate-500">Email</span><span className="text-crt-cyan-dark font-bold">{{ $selectedEmployee->email }}</span></div>
                    <div><span className="block text-slate-500">Gestionnaire</span><span className="text-slate-700 font-bold">{{ $selectedEmployee->gestionnaire }}</span></div>
                </div>
            </div>
        @else
            <div className="space-y-6">
                <div className="bg-white rounded-2xl border p-6 shadow-sm space-y-4">
                    <div className="flex justify-between items-center pb-3 border-b">
                        <h3 className="text-sm font-extrabold text-crt-navy">⏱️ Historique des heures</h3>
                        <button wire:click="openEditHoursModal" className="bg-crt-navy text-white text-xs px-3.5 py-1.5 rounded-xl">🖊️ Modifier l'heure</button>
                    </div>
                    <table className="w-full text-left text-xs">
                        <thead><tr className="bg-slate-100 uppercase font-extrabold"><th className="p-3">Heures</th><th className="p-3">Début</th><th className="p-3">Fin</th></tr></thead>
                        <tbody>
                            @foreach ($selectedEmployee->hoursHistories as $h)
                                <tr className="border-b"><td className="p-3 font-bold">{ $h->hours }}h</td><td className="p-3">{ $h->start_date }}</td><td className="p-3">{ $h->end_date }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div className="bg-white rounded-2xl border p-6 shadow-sm space-y-4">
                    <div className="flex justify-between items-center pb-3 border-b">
                        <h3 className="text-sm font-extrabold text-crt-navy">👥 Historique des gestionnaires</h3>
                        <button wire:click="openEditManagerModal" className="bg-crt-navy text-white text-xs px-3.5 py-1.5 rounded-xl">🖊️ Modifier le gestionnaire</button>
                    </div>
                    <table className="w-full text-left text-xs">
                        <thead><tr className="bg-slate-100 uppercase font-extrabold"><th className="p-3">Gestionnaire</th><th className="p-3">Début</th><th className="p-3">Fin</th></tr></thead>
                        <tbody>
                            @foreach ($selectedEmployee->managerHistories as $m)
                                <tr className="border-b"><td className="p-3 font-bold">{ $m->manager }}</td><td className="p-3">{ $m->start_date }}</td><td className="p-3">{ $m->end_date }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div className="bg-white rounded-2xl border p-6 shadow-sm space-y-4">
                    <div className="flex justify-between items-center pb-3 border-b">
                        <h3 className="text-sm font-extrabold text-crt-navy">🏠 Historique des affectations aux sites</h3>
                        <button wire:click="openEditSiteModal" className="bg-crt-navy text-white text-xs px-3.5 py-1.5 rounded-xl">🔗 Affecter à un site</button>
                    </div>
                    <table className="w-full text-left text-xs">
                        <thead><tr className="bg-slate-100 uppercase font-extrabold"><th className="p-3">Site</th><th className="p-3">Début</th><th className="p-3">Statut</th></tr></thead>
                        <tbody>
                            @foreach ($selectedEmployee->siteHistories as $s)
                                <tr className="border-b"><td className="p-3 font-bold">{ $s->site_name }}</td><td className="p-3">{ $s->start_date }}</td><td className="p-3">{ $s->status }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif

    <!-- MODAL 1: NEW EMPLOYEE -->
    @if ($isNewEmployeeModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl space-y-4 text-xs">
                <h3 className="text-base font-extrabold text-crt-navy">➕ Nouvel employé (Livewire)</h3>
                <form wire:submit.prevent="handleCreateEmployee" className="space-y-3">
                    <div className="grid grid-cols-2 gap-3">
                        <div><label className="font-bold">Nom</label><input type="text" wire:model="newEmpForm.nom" required className="w-full border rounded-xl p-2" /></div>
                        <div><label className="font-bold">Prénom</label><input type="text" wire:model="newEmpForm.prenom" required className="w-full border rounded-xl p-2" /></div>
                    </div>
                    <div><label className="font-bold">Email</label><input type="email" wire:model="newEmpForm.email" required className="w-full border rounded-xl p-2" /></div>
                    <div className="flex justify-end gap-2 pt-3">
                        <button type="button" wire:click="$set('isNewEmployeeModalOpen', false)" className="px-4 py-2 bg-slate-100 rounded-xl">Annuler</button>
                        <button type="submit" className="px-5 py-2 bg-crt-navy text-white rounded-xl font-bold">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- MODAL 2: EDIT EMPLOYEE -->
    @if ($isEditEmployeeModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl space-y-4 text-xs">
                <h3 className="text-base font-extrabold text-crt-navy">🖊️ Mise à jour de l'employé</h3>
                <form wire:submit.prevent="handleSaveEmployeeUpdate" className="space-y-3">
                    <div className="grid grid-cols-2 gap-3">
                        <div><label className="font-bold">Nom</label><input type="text" wire:model="editEmpForm.nom" required className="w-full border rounded-xl p-2" /></div>
                        <div><label className="font-bold">Prénom</label><input type="text" wire:model="editEmpForm.prenom" required className="w-full border rounded-xl p-2" /></div>
                    </div>
                    <div className="flex justify-end gap-2 pt-3">
                        <button type="button" wire:click="$set('isEditEmployeeModalOpen', false)" className="px-4 py-2 bg-slate-100 rounded-xl">Fermer</button>
                        <button type="submit" className="px-5 py-2 bg-crt-navy text-white rounded-xl font-bold">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- MODAL 3: CHANGE MANAGER -->
    @if ($isEditManagerModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4 text-xs">
                <h3 className="text-base font-extrabold text-crt-navy">👥 Modifier le gestionnaire</h3>
                <form wire:submit.prevent="handleSaveManagerChange" className="space-y-3">
                    <div>
                        <label className="font-bold">Nouveau gestionnaire</label>
                        <select wire:model="editManagerForm.newManager" className="w-full border rounded-xl p-2">
                            <option value="Admin Plateforme GCS">Admin Plateforme GCS</option>
                            <option value="Fabrice DENOU">Fabrice DENOU</option>
                            <option value="Mitch Richmond">Mitch Richmond</option>
                        </select>
                    </div>
                    <div className="flex justify-end gap-2 pt-3">
                        <button type="button" wire:click="$set('isEditManagerModalOpen', false)" className="px-4 py-2 bg-slate-100 rounded-xl">Fermer</button>
                        <button type="submit" className="px-5 py-2 bg-crt-navy text-white rounded-xl font-bold">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- MODAL 4: CHANGE HOURS -->
    @if ($isEditHoursModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4 text-xs">
                <h3 className="text-base font-extrabold text-crt-navy">⏱️ Modifier l'heure</h3>
                <form wire:submit.prevent="handleSaveHoursChange" className="space-y-3">
                    <div><label className="font-bold">Nouvelle heure</label><input type="number" step="0.5" wire:model="editHoursForm.newHours" required className="w-full border rounded-xl p-2" /></div>
                    <div className="flex justify-end gap-2 pt-3">
                        <button type="button" wire:click="$set('isEditHoursModalOpen', false)" className="px-4 py-2 bg-slate-100 rounded-xl">Fermer</button>
                        <button type="submit" className="px-5 py-2 bg-crt-navy text-white rounded-xl font-bold">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- MODAL 5: SITE AFFECTATION -->
    @if ($isEditSiteModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4 text-xs">
                <h3 className="text-base font-extrabold text-crt-navy">🏠 Affectation un site</h3>
                <form wire:submit.prevent="handleSaveSiteAffectation" className="space-y-3">
                    <div>
                        <label className="font-bold">Nouveau site</label>
                        <select wire:model="editSiteForm.newSiteName" className="w-full border rounded-xl p-2">
                            @foreach ($sites as $site)
                                <option value="{{ $site->name }}">{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div className="flex justify-end gap-2 pt-3">
                        <button type="button" wire:click="$set('isEditSiteModalOpen', false)" className="px-4 py-2 bg-slate-100 rounded-xl">Fermer</button>
                        <button type="submit" className="px-5 py-2 bg-crt-navy text-white rounded-xl font-bold">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
