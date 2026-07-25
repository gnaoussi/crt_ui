<div x-data x-effect="document.body.classList.toggle('overflow-hidden', $wire.isNewEmployeeModalOpen || $wire.isEditEmployeeModalOpen || $wire.isEditManagerModalOpen || $wire.isEditHoursModalOpen || $wire.isEditSiteModalOpen)" class="p-6 space-y-6 max-w-[1600px] mx-auto w-full">

    @php
        $breadcrumbItems = [
            ['label' => 'Accueil', 'url' => '/dashboard'],
            ['label' => 'RH', 'url' => '#'],
        ];

        if ($selectedEmployee) {
            $breadcrumbItems[] = ['label' => 'Employés', 'wireClick' => 'backToList'];
            $breadcrumbItems[] = ['label' => $selectedEmployee->prenom . ' ' . $selectedEmployee->nom, 'active' => true];
        } else {
            $breadcrumbItems[] = ['label' => 'Employés', 'active' => true];
        }
    @endphp

    <div class="-mx-6 -mt-6 mb-6">
        <x-breadcrumb :items="$breadcrumbItems" />
    </div>

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
