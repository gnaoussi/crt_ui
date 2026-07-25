<div x-data x-effect="document.body.classList.toggle('overflow-hidden', $wire.isNewEmployeeModalOpen || $wire.isEditEmployeeModalOpen || $wire.isEditManagerModalOpen || $wire.isEditHoursModalOpen || $wire.isEditSiteModalOpen)">

    <!-- Sub Header Breadcrumb Navigation Bar (Livewire Reactive) -->
    <div class="bg-white border-b border-slate-200/80 px-6 py-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs font-semibold">
        <nav class="flex items-center space-x-2 text-slate-600">
            <a href="/dashboard" class="flex items-center gap-1 hover:text-crt-navy transition cursor-pointer">
                <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Accueil
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-600 hover:text-crt-navy cursor-pointer">RH</span>
            <span class="text-slate-300">/</span>

            @if ($selectedEmployeeId && $selectedEmployee)
                <button wire:click="backToList" class="flex items-center gap-1 hover:text-crt-navy transition cursor-pointer text-slate-600 font-semibold">
                    Employés
                </button>
                <span class="text-slate-300">/</span>
                <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                    {{ $selectedEmployee->prenom }} {{ $selectedEmployee->nom }}
                </span>
            @else
                <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                    Employés
                </span>
            @endif
        </nav>
    </div>

    <div class="p-6 space-y-6 max-w-[1600px] mx-auto w-full">

    @if ($selectedEmployeeId === null)
        <!-- VIEW 1: EMPLOYEES LIST VIEW -->
        @include('livewire.rh.list-employees')
    @else
        <!-- VIEW 2: EMPLOYEE DETAIL VIEW -->
        @include('livewire.rh.detail-employee')
    @endif

    <!-- MODALES RH -->
    @include('livewire.rh.modal-create-employee')
    @include('livewire.rh.modal-edit-employee')
    @include('livewire.rh.modal-edit-manager')
    @include('livewire.rh.modal-edit-hours')
    @include('livewire.rh.modal-edit-site')

</div>
