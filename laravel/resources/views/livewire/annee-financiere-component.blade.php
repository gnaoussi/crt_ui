<main class="flex-1 p-6 space-y-6 max-w-[1600px] mx-auto w-full">

    {{-- Main View Switcher --}}
    @if ($viewMode === 'list')
        @include('livewire.annee-financiere.list-years')
    @else
        @include('livewire.annee-financiere.detail-year')
    @endif

    {{-- Modals --}}
    @include('livewire.annee-financiere.modal-create-year')
    @include('livewire.annee-financiere.modal-edit-year')
    @include('livewire.annee-financiere.modal-delete-year')
</main>
