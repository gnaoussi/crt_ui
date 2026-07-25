<!-- VIEW 2: EMPLOYEE DETAIL VIEW (Simplifié & Harmonisé 1-à-1 sans redondance) -->
<div class="space-y-6">

    {{-- 1. Header Card (Synthèse complète de l'employé) --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
            <h3 class="text-sm font-extrabold text-crt-navy flex items-center gap-2">
                <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Fiche Employé — {{ $selectedEmployee->prenom }} {{ $selectedEmployee->nom }}
            </h3>

            <div class="flex items-center gap-3">
                <button 
                    wire:click="backToList"
                    class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-md cursor-pointer"
                >
                    <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux employés
                </button>
                <button 
                    wire:click="openEditEmployeeModal"
                    class="bg-crt-cyan hover:bg-crt-cyan-dark text-crt-navy font-extrabold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-md cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Modifier l'employé
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 text-xs font-semibold">
            <div>
                <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Matricule</span>
                <p class="font-mono text-crt-navy text-xs font-extrabold">{{ $selectedEmployee->matricule }}</p>
            </div>
            <div>
                <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Email</span>
                <p class="font-mono text-crt-cyan-dark text-xs font-bold">{{ $selectedEmployee->email }}</p>
            </div>
            <div>
                <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Date de naissance</span>
                <p class="text-slate-800 text-xs font-bold">{{ $selectedEmployee->dob }}</p>
            </div>
            <div>
                <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Gestionnaire</span>
                <p class="text-slate-800 text-xs font-extrabold">{{ $selectedEmployee->gestionnaire ?? 'Admin Plateforme GCS' }}</p>
            </div>
            <div>
                <span class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Statut du compte</span>
                @if($selectedEmployee->account_status === 'Activé')
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 inline-flex items-center gap-1">
                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        Actif
                    </span>
                @else
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                        Inactif
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- 2. 4 Stat KPI Cards (Informations rapides) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <h4 class="text-2xl font-black text-crt-navy font-mono">{{ $selectedEmployee->weekly_hours }} h</h4>
                <span class="text-xs font-bold text-slate-500">Heures / Semaine</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-crt-cyan-light border border-crt-cyan/30 text-crt-navy flex items-center justify-center">
                <svg class="w-5 h-5 text-crt-cyan font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <h4 class="text-sm font-black text-amber-700">{{ $selectedEmployee->probation_status }}</h4>
                <span class="text-xs font-bold text-slate-500">Statut Probation</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <h4 class="text-sm font-black text-emerald-700 font-mono">{{ $selectedEmployee->hire_date }}</h4>
                <span class="text-xs font-bold text-slate-500">Date d'embauche</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <h4 class="text-sm font-black text-slate-700">{{ $selectedEmployee->role }}</h4>
                <span class="text-xs font-bold text-slate-500">Rôle / Groupe</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- 3. Historiques de l'Employé (Direct) --}}
    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Historique des heures par semaine</span></h3>
                <button wire:click="openEditHoursModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Modifier l'heure
                </button>
            </div>
            <table class="w-full text-left text-xs border-collapse">
                <thead><tr className="bg-slate-100 text-slate-700 font-extrabold uppercase"><th class="p-3">NOMBRE D'HEURE</th><th class="p-3">DATE DE DÉBUT</th><th class="p-3">DATE DE FIN</th></tr></thead>
                <tbody class="divide-y divide-slate-100 font-mono">
                    @foreach ($selectedEmployee->hoursHistories as $h)
                        <tr><td class="p-3 font-extrabold text-crt-navy">{{ $h->hours }}</td><td class="p-3 text-slate-600">{{ $h->start_date }}</td><td class="p-3 text-slate-400">{{ $h->end_date }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Historique des gestionnaires</span></h3>
                <button wire:click="openEditManagerModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Modifier le gestionnaire
                </button>
            </div>
            <table class="w-full text-left text-xs border-collapse">
                <thead><tr class="bg-slate-100 text-slate-700 font-extrabold uppercase"><th class="p-3">GESTIONNAIRE</th><th class="p-3">DATE DE DÉBUT</th><th class="p-3">DATE DE FIN</th></tr></thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach ($selectedEmployee->managerHistories as $m)
                        <tr><td class="p-3 font-extrabold text-crt-navy">{{ $m->manager }}</td><td class="p-3 text-slate-600 font-mono">{{ $m->start_date }}</td><td class="p-3 text-slate-400 font-mono">{{ $m->end_date }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg> Historique des affectations aux sites</span></h3>
                <button wire:click="openEditSiteModal" class="bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition shadow-sm flex items-center gap-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Affecter à un site
                </button>
            </div>
            <table class="w-full text-left text-xs border-collapse">
                <thead><tr class="bg-slate-100 text-slate-700 font-extrabold uppercase"><th class="p-3">NOM DU SITE</th><th class="p-3">ADRESSE</th><th class="p-3">DATE DE DÉBUT</th><th class="p-3">DATE DE FIN</th><th class="p-3">STATUT</th></tr></thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach ($selectedEmployee->siteHistories as $s)
                        <tr><td class="p-3 font-extrabold text-crt-navy">{{ $s->site_name }}</td><td class="p-3 text-slate-600">{{ $s->address }}</td><td class="p-3 text-slate-600 font-mono">{{ $s->start_date }}</td><td class="p-3 text-slate-600 font-mono">{{ $s->end_date }}</td><td class="p-3"><span class="px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800 border">{{ $s->status }}</span></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
