<div x-data x-effect="document.body.classList.toggle('overflow-hidden', $wire.isCreateSiteModalOpen || $wire.isViewSiteModalOpen || $wire.isEditSiteModalOpen || $wire.isDeleteSiteModalOpen)" class="p-6 space-y-6 max-w-[1600px] mx-auto w-full">

    <!-- Card 1: Informations de l'Entreprise (Consultation / Edition) -->
    @include('livewire.entreprise.info-card')

    <!-- Card 2: Sites de l'entreprise (Tableau / Recherche) -->
    @include('livewire.entreprise.sites-list')

    <!-- Modales du Module Entreprise -->
    @include('livewire.entreprise.modal-create-site')
    @include('livewire.entreprise.modal-view-site')
    @include('livewire.entreprise.modal-edit-site')
    @include('livewire.entreprise.modal-delete-site')

</div>
