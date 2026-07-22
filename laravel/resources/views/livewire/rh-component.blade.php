<div className="p-6 space-y-6 max-w-[1600px] mx-auto w-full">
    @if (session()->has('message'))
        <div className="bg-emerald-600 text-white px-4 py-3 rounded-xl shadow-lg flex items-center justify-between text-xs font-bold animate-fade-in">
            <span className="flex items-center gap-2">
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" /></svg>
                {{ session('message') }}
            </span>
        </div>
    @endif

    @if ($selectedEmployeeId === null)
        <!-- VIEW 1: EMPLOYEES LIST VIEW (list.png) -->
        <div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
            <div className="flex items-center gap-2 pb-3 border-b text-xs font-extrabold text-crt-navy">🔍 Filtres de recherche</div>
            <div className="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs font-semibold">
                <div>
                    <label className="block text-slate-700 mb-1">Employé</label>
                    <input type="text" wire:model.live="empFilterQuery" placeholder="Matricule, Nom, Prénom..." className="w-full text-xs border rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition" />
                </div>
                <div>
                    <label className="block text-slate-700 mb-1">Gestionnaire</label>
                    <input type="text" wire:model.live="empFilterManager" placeholder="Gestionnaire..." className="w-full text-xs border rounded-xl p-2.5 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan transition" />
                </div>
                <div>
                    <label className="block text-slate-700 mb-1">Probation</label>
                    <select wire:model.live="empFilterProbation" className="w-full text-xs border rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                        <option value="all">-- Tous --</option>
                        <option value="in_progress">1 heure restante</option>
                    </select>
                </div>
                <div>
                    <label className="block text-slate-700 mb-1">Statut</label>
                    <select wire:model.live="empFilterStatus" className="w-full text-xs border rounded-xl p-2.5 bg-slate-50 focus:bg-white">
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
                <button wire:click="openNewEmployeeModal" className="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2.5 rounded-xl transition shadow-lg flex items-center gap-1.5">
                    <svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Nouvel employé
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
                            <tr className="hover:bg-crt-cyan-light/30 transition">
                                <td className="p-3.5 font-mono text-crt-navy font-bold">{{ $emp->matricule }}</td>
                                <td className="p-3.5 font-extrabold text-crt-navy">{{ $emp->nom }}</td>
                                <td className="p-3.5">{{ $emp->prenom }}</td>
                                <td className="p-3.5"><span className="bg-slate-100 border px-2 py-0.5 rounded text-[11px] font-bold">{{ $emp->role }}</span></td>
                                <td className="p-3.5 text-slate-600">{{ $emp->gestionnaire }}</td>
                                <td className="p-3.5"><span className="bg-crt-navy text-white text-[11px] font-bold px-3 py-1 rounded-full">{{ $emp->probation_status }}</span></td>
                                <td className="p-3.5">
                                    <div className="flex items-center justify-center space-x-1.5">
                                        <button wire:click="selectEmployee({{ $emp->id }})" title="Consulter la fiche détaillée" className="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition">
                                            <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <a href="/timesheets" title="Feuilles de temps de l'employé" className="p-1.5 text-crt-navy border border-crt-navy/30 bg-slate-100 hover:bg-crt-navy hover:text-white rounded-lg transition">
                                            <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                        <button wire:click="toggleAccountStatus({{ $emp->id }})" title="{{ $emp->account_status === 'Activé' ? 'Désactiver le compte' : 'Activer le compte' }}" className="p-1.5 text-slate-700 border border-slate-300 bg-slate-100 hover:bg-slate-700 hover:text-white rounded-lg transition">
                                            <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- VIEW 2: EMPLOYEE DETAIL VIEW (employe_view_section_information.png & employe_view_section_historique.png) -->
        <div className="space-y-6">
            <div>
                <button wire:click="backToList" className="text-xs font-bold text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 px-3.5 py-2 rounded-xl transition">⬅ Retour à la liste des employés</button>
            </div>

            <div className="bg-gradient-to-r from-crt-cyan to-crt-navy rounded-2xl p-8 text-center text-white shadow-lg">
                <div className="w-20 h-20 rounded-full bg-white text-crt-navy flex items-center justify-center text-2xl font-black mx-auto mb-3 shadow-md">👤</div>
                <h2 className="text-xl font-black">{{ $selectedEmployee->nom }} {{ $selectedEmployee->prenom }}</h2>
                <p className="text-xs text-crt-cyan-light font-mono mt-1">Matricule : {{ $selectedEmployee->matricule }} — {{ $selectedEmployee->role }}</p>
            </div>

            <div className="flex justify-between items-center bg-white p-2 rounded-2xl border border-slate-200 shadow-sm">
                <div className="flex space-x-2 text-xs font-extrabold">
                    <button wire:click="setTab('information')" className="px-4 py-2.5 rounded-xl transition {{ $employeeActiveTab === 'information' ? 'bg-crt-navy text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' }}">👤 Informations de l'employé</button>
                    <button wire:click="setTab('historiques')" className="px-4 py-2.5 rounded-xl transition {{ $employeeActiveTab === 'historiques' ? 'bg-crt-navy text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' }}">📜 Historiques</button>
                </div>
            </div>

            @if ($employeeActiveTab === 'information')
                <!-- TAB 1: INFORMATIONS DE L'EMPLOYÉ -->
                <div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div className="flex justify-between items-center pb-4 border-b border-slate-100">
                        <h3 className="text-sm font-extrabold text-crt-navy">👤 Informations de l'employé</h3>
                        <button wire:click="openEditEmployeeModal" className="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2 rounded-xl transition shadow-sm flex items-center gap-1.5">
                            <svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Modifier
                        </button>
                    </div>

                    <div className="space-y-6 text-xs font-semibold">
                        <div className="space-y-3">
                            <h4 className="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">IDENTITÉ</h4>
                            <div className="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                <div><span className="block text-slate-500 text-[11px]">Matricule</span><span className="text-crt-navy font-bold font-mono">{{ $selectedEmployee->matricule }}</span></div>
                                <div><span className="block text-slate-500 text-[11px]">Nom</span><span className="text-crt-navy font-extrabold">{{ $selectedEmployee->nom }}</span></div>
                                <div><span className="block text-slate-500 text-[11px]">Prénom</span><span className="text-crt-navy font-extrabold">{{ $selectedEmployee->prenom }}</span></div>
                                <div><span className="block text-slate-500 text-[11px]">📅 Date de naissance</span><span className="text-slate-700">{{ $selectedEmployee->dob }}</span></div>
                            </div>
                        </div>

                        <div className="space-y-3 pt-3 border-t border-slate-100">
                            <h4 className="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">CONTACTS</h4>
                            <div><span className="block text-slate-500 text-[11px]">✉️ E-mail</span><span className="text-crt-cyan-dark font-bold font-mono">{{ $selectedEmployee->email }}</span></div>
                        </div>

                        <div className="space-y-3 pt-3 border-t border-slate-100">
                            <h4 className="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">STATUT PROFESSIONNEL</h4>
                            <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div><span className="block text-slate-500 text-[11px]">👥 Groupes</span><span className="bg-slate-100 border px-2 py-0.5 rounded text-[11px] font-bold">{{ $selectedEmployee->role }}</span></div>
                                <div><span className="block text-slate-500 text-[11px]">Statut du compte</span><span className="text-emerald-600 font-extrabold">{{ $selectedEmployee->account_status }}</span></div>
                                <div><span className="block text-slate-500 text-[11px]">Visibilité/Rapport</span><span className="text-slate-700 font-bold">{{ $selectedEmployee->visibility_report }}</span></div>
                            </div>
                        </div>

                        <div className="space-y-3 pt-3 border-t border-slate-100">
                            <h4 className="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">ORGANISATION</h4>
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div><span className="block text-slate-500 text-[11px]">Gestionnaire</span><span className="text-crt-navy font-bold">{{ $selectedEmployee->gestionnaire }}</span></div>
                                <div><span className="block text-slate-500 text-[11px]">Rôle</span><span className="text-slate-700 font-medium">Gestionnaire ({{ $selectedEmployee->is_manager ? 'Oui' : 'Non' }})</span></div>
                            </div>
                        </div>

                        <div className="space-y-3 pt-3 border-t border-slate-100">
                            <h4 className="text-[11px] font-black text-slate-400 uppercase tracking-wider border-b pb-1">AUTRES & EMBAUCHE</h4>
                            <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div><span className="block text-slate-500 text-[11px]">Heures/semaine</span><span className="text-crt-navy font-extrabold font-mono">{{ $selectedEmployee->weekly_hours }} h</span></div>
                                <div><span className="block text-slate-500 text-[11px]">📅 Date d'embauche</span><span className="text-slate-700 font-mono">{{ $selectedEmployee->hire_date }}</span></div>
                                <div><span className="block text-slate-500 text-[11px]">Statut de probation</span><span className="text-amber-700 font-bold bg-amber-50 border border-amber-200 px-2 py-0.5 rounded text-[11px]">En cours ({{ $selectedEmployee->probation_status }})</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- TAB 2: HISTORIQUES -->
                <div className="space-y-6">
                    <div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <div className="flex justify-between items-center pb-3 border-b border-slate-100">
                            <h3 className="text-sm font-extrabold text-crt-navy">👤 Historique des heures par semaine</h3>
                            <button wire:click="openEditHoursModal" className="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5">
                                <svg className="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Modifier l'heure
                            </button>
                        </div>
                        <table className="w-full text-left text-xs border-collapse">
                            <thead><tr className="bg-slate-100 text-slate-700 font-extrabold uppercase"><th className="p-3">NOMBRE D'HEURE</th><th className="p-3">DATE DE DÉBUT</th><th className="p-3">DATE DE FIN</th></tr></thead>
                            <tbody className="divide-y divide-slate-100 font-mono">
                                @foreach ($selectedEmployee->hoursHistories as $h)
                                    <tr><td className="p-3 font-extrabold text-crt-navy">{{ $h->hours }}h</td><td className="p-3 text-slate-600">{{ $h->start_date }}</td><td className="p-3 text-slate-400">{{ $h->end_date }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <div className="flex justify-between items-center pb-3 border-b border-slate-100">
                            <h3 className="text-sm font-extrabold text-crt-navy">👥 Historique des gestionnaires</h3>
                            <button wire:click="openEditManagerModal" className="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5">
                                <svg className="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Modifier le gestionnaire
                            </button>
                        </div>
                        <table className="w-full text-left text-xs border-collapse">
                            <thead><tr className="bg-slate-100 text-slate-700 font-extrabold uppercase"><th className="p-3">GESTIONNAIRE</th><th className="p-3">DATE DE DÉBUT</th><th className="p-3">DATE DE FIN</th></tr></thead>
                            <tbody className="divide-y divide-slate-100 font-medium">
                                @foreach ($selectedEmployee->managerHistories as $m)
                                    <tr><td className="p-3 font-extrabold text-crt-navy">{{ $m->manager }}</td><td className="p-3 text-slate-600 font-mono">{{ $m->start_date }}</td><td className="p-3 text-slate-400 font-mono">{{ $m->end_date }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div className="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <div className="flex justify-between items-center pb-3 border-b border-slate-100">
                            <h3 className="text-sm font-extrabold text-crt-navy">🏠 Historique des affectations aux sites</h3>
                            <button wire:click="openEditSiteModal" className="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5">
                                <svg className="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Affecter à un site
                            </button>
                        </div>
                        <table className="w-full text-left text-xs border-collapse">
                            <thead><tr className="bg-slate-100 text-slate-700 font-extrabold uppercase"><th className="p-3">NOM DU SITE</th><th className="p-3">ADRESSE</th><th className="p-3">DATE DE DÉBUT</th><th className="p-3">DATE DE FIN</th><th className="p-3">STATUT</th></tr></thead>
                            <tbody className="divide-y divide-slate-100 font-medium">
                                @foreach ($selectedEmployee->siteHistories as $s)
                                    <tr><td className="p-3 font-extrabold text-crt-navy">{{ $s->site_name }}</td><td className="p-3 text-slate-600">{{ $s->address }}</td><td className="p-3 text-slate-600 font-mono">{{ $s->start_date }}</td><td className="p-3 text-slate-600 font-mono">{{ $s->end_date }}</td><td className="p-3"><span className="px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800 border">{{ $s->status }}</span></td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- 1. MODALE: Création Nouvel Employé (new_employe_modal.png) -->
    @if ($isNewEmployeeModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fade-in">
            <div className="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar">
                <div className="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                    <h3 className="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg className="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Nouvel employé
                    </h3>
                    <button wire:click="$set('isNewEmployeeModalOpen', false)" className="text-slate-400 hover:text-slate-700 p-1.5">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="handleCreateEmployee" className="space-y-6 text-xs">
                    <div className="space-y-3">
                        <h4 className="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">📇 Informations personnelles</h4>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Nom *</label>
                                <input type="text" required wire:model="newEmpForm.nom" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Prénom *</label>
                                <input type="text" required wire:model="newEmpForm.prenom" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">📅 Date de naissance *</label>
                                <input type="text" placeholder="ex: 07-21" wire:model="newEmpForm.dob" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">E-mail *</label>
                                <input type="email" required placeholder="employe@exemple.com" wire:model="newEmpForm.email" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                        </div>
                    </div>

                    <div className="space-y-3 pt-3 border-t border-slate-100">
                        <h4 className="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">💼 Informations professionnelles</h4>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Matricule ID Unique</label>
                                <input type="text" wire:model="newEmpForm.matricule" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">📅 Date d'embauche *</label>
                                <input type="date" required wire:model="newEmpForm.hireDate" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Heures de travail par semaine *</label>
                                <input type="number" step="0.5" placeholder="Ex: 37.5 ou 40" wire:model="newEmpForm.weeklyHours" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Gestionnaire</label>
                                <select wire:model="newEmpForm.gestionnaire" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                    <option value="Admin Plateforme GCS">Admin Plateforme GCS</option>
                                    <option value="Fabrice DENOU">Fabrice DENOU</option>
                                    <option value="Mitch Richmond">Mitch Richmond</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div className="space-y-3 pt-3 border-t border-slate-100">
                        <h4 className="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">🏠 Site de travail</h4>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Site d'affectation *</label>
                                <select wire:model="newEmpForm.site" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                    @foreach ($sites as $s)
                                        <option value="{{ $s->name }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div className="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="$set('isNewEmployeeModalOpen', false)" className="px-4 py-2.5 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl">✖ Fermer</button>
                        <button type="submit" className="px-5 py-2.5 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg">💾 Créer</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- 2. MODALE: Mise à jour des informations de l'employé (employe_edit.png) -->
    @if ($isEditEmployeeModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fade-in">
            <div className="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar">
                <div className="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                    <h3 className="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg className="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Mise à jour des informations de l'employé
                    </h3>
                    <button wire:click="$set('isEditEmployeeModalOpen', false)" className="text-slate-400 hover:text-slate-700 p-1.5">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="handleSaveEmployeeUpdate" className="space-y-5 text-xs">
                    <div className="space-y-3">
                        <h4 className="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">📇 Informations personnelles</h4>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Nom *</label>
                                <input type="text" required wire:model="editEmpForm.nom" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Prénom *</label>
                                <input type="text" required wire:model="editEmpForm.prenom" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">📅 Date de naissance *</label>
                                <input type="text" wire:model="editEmpForm.dob" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">E-mail *</label>
                                <input type="email" required wire:model="editEmpForm.email" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white" />
                            </div>
                        </div>
                    </div>

                    <div className="space-y-3 pt-3 border-t border-slate-100">
                        <h4 className="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">💼 Informations professionnelles</h4>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Matricule ID Unique</label>
                                <input type="text" wire:model="editEmpForm.matricule" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">📅 Date d'embauche *</label>
                                <input type="date" wire:model="editEmpForm.hireDate" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                            </div>
                        </div>
                    </div>

                    <div className="space-y-3 pt-3 border-t border-slate-100">
                        <h4 className="font-extrabold text-crt-navy uppercase tracking-wider flex items-center gap-2">👤 Rôles et permissions</h4>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Définir comme gestionnaire ?</label>
                                <select wire:model="editEmpForm.isManager" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                                    <option value="Non">Non</option>
                                    <option value="Oui">Oui</option>
                                </select>
                            </div>
                            <div>
                                <label className="block font-bold text-slate-700 mb-1">Groupe d'accès *</label>
                                <select wire:model="editEmpForm.accessGroup" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-bold text-crt-navy">
                                    <option value="ADMINISTRATEUR">ADMINISTRATEUR</option>
                                    <option value="MANAGER">MANAGER</option>
                                    <option value="EMPLOYE">EMPLOYÉ</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div className="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="$set('isEditEmployeeModalOpen', false)" className="px-4 py-2.5 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl">✖ Fermer</button>
                        <button type="submit" className="px-5 py-2.5 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg">💾 Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- 3. MODALE: Modifier le gestionnaire (modifier_gestionnaire_dans_historique.png) -->
    @if ($isEditManagerModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fade-in">
            <div className="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
                <div className="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
                    <h3 className="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg className="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Modifier le gestionnaire
                    </h3>
                    <button wire:click="$set('isEditManagerModalOpen', false)" className="text-slate-400 hover:text-slate-700 p-1">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="handleSaveManagerChange" className="space-y-4 text-xs">
                    <div>
                        <label className="block font-bold text-slate-700 mb-1">Nouveau gestionnaire *</label>
                        <select wire:model="editManagerForm.newManager" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                            <option value="Admin Plateforme GCS">Admin Plateforme GCS</option>
                            <option value="Fabrice DENOU">Fabrice DENOU</option>
                            <option value="Mitch Richmond">Mitch Richmond</option>
                            <option value="---">Aucun (---)</option>
                        </select>
                    </div>
                    <div>
                        <label className="block font-bold text-slate-700 mb-1">Date de debut du nouveau gestionnaire *</label>
                        <input type="text" wire:model="editManagerForm.startDate" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-crt-cyan-light text-crt-navy font-mono" />
                    </div>

                    <div className="flex justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" wire:click="$set('isEditManagerModalOpen', false)" className="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl">✖ Fermer</button>
                        <button type="submit" className="px-5 py-2 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg">💾 Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- 4. MODALE: Modifier l'heure (modifier_nombre_d_heure_par_semaine_dans_historique.png) -->
    @if ($isEditHoursModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fade-in">
            <div className="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
                <div className="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
                    <h3 className="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg className="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Modifier l'heure
                    </h3>
                    <button wire:click="$set('isEditHoursModalOpen', false)" className="text-slate-400 hover:text-slate-700 p-1">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="handleSaveHoursChange" className="space-y-4 text-xs">
                    <div>
                        <label className="block font-bold text-slate-700 mb-1">Nouvelle Heure *</label>
                        <input type="number" step="0.5" required wire:model="editHoursForm.newHours" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                    </div>
                    <div>
                        <label className="block font-bold text-slate-700 mb-1">Date de debut de la nouvelle heure *</label>
                        <input type="text" wire:model="editHoursForm.startDate" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-crt-cyan-light text-crt-navy font-mono" />
                    </div>

                    <div className="flex justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" wire:click="$set('isEditHoursModalOpen', false)" className="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl">✖ Fermer</button>
                        <button type="submit" className="px-5 py-2 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg">💾 Créer</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- 5. MODALE: Affectation un site (modifier_site_dans_historique.png) -->
    @if ($isEditSiteModalOpen)
        <div className="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fade-in">
            <div className="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
                <div className="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
                    <h3 className="text-base font-extrabold text-crt-navy flex items-center gap-2">
                        <svg className="w-5 h-5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Affectation un site
                    </h3>
                    <button wire:click="$set('isEditSiteModalOpen', false)" className="text-slate-400 hover:text-slate-700 p-1">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="handleSaveSiteAffectation" className="space-y-4 text-xs">
                    <div>
                        <label className="block font-bold text-slate-700 mb-1">Nouveau site *</label>
                        <select wire:model="editSiteForm.newSiteName" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white">
                            @foreach ($sites as $site)
                                <option value="{{ $site->name }}">{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label className="block font-bold text-slate-700 mb-1">Date de début *</label>
                        <input type="text" wire:model="editSiteForm.startDate" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-crt-cyan-light text-crt-navy font-mono" />
                    </div>
                    <div>
                        <label className="block font-bold text-slate-700 mb-1">Date de fin</label>
                        <input type="text" placeholder="Optionnel (ex: 2026-12-31)" wire:model="editSiteForm.endDate" className="w-full font-semibold border border-slate-200 rounded-xl p-2.5 bg-slate-50 focus:bg-white font-mono" />
                    </div>

                    <div className="flex justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" wire:click="$set('isEditSiteModalOpen', false)" className="px-4 py-2 font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl">✖ Fermer</button>
                        <button type="submit" className="px-5 py-2 font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark rounded-xl shadow-lg">💾 Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
