<main class="flex-1 p-6 space-y-6 max-w-[1600px] mx-auto w-full">
    {{-- Flash Notifications --}}
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold px-4 py-3 rounded-xl shadow-xs flex items-center justify-between animate-fade-in">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('message') }}
            </span>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-extrabold cursor-pointer">✕</button>
        </div>
    @endif

    {{-- Main View Switcher --}}
    @if ($viewMode === 'list')
        @include('livewire.annee-financiere.list-years')
    @else
        @include('livewire.annee-financiere.detail-year')
    @endif

    {{-- Modals --}}
    @include('livewire.annee-financiere.modal-create-year')
    @include('livewire.annee-financiere.modal-edit-year')
</main>
