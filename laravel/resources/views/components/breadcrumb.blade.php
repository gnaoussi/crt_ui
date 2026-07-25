@props([
    'items' => []
])

@php
    // Fallback dynamique si aucun tableau personnalisé n'est fourni
    if (empty($items)) {
        if (request()->is('rh*')) {
            $items = [
                ['label' => 'Accueil', 'url' => '/dashboard'],
                ['label' => 'RH', 'url' => '#'],
            ];

            // Récupération dynamique depuis l'instance Livewire RH si disponible
            if (isset($this) && isset($this->selectedEmployeeId) && $this->selectedEmployeeId) {
                $items[] = ['label' => 'Employés', 'wireClick' => 'backToList'];
                $emp = \App\Models\Employee::find($this->selectedEmployeeId);
                $items[] = ['label' => ($emp ? $emp->prenom . ' ' . $emp->nom : 'Fiche employé'), 'active' => true];
            } else {
                $items[] = ['label' => 'Employés', 'active' => true];
            }
        } elseif (request()->is('entreprise*')) {
            $items = [
                ['label' => 'Accueil', 'url' => '/dashboard'],
                ['label' => 'Entreprise', 'url' => '#'],
                ['label' => 'Présentation entreprise', 'active' => true],
            ];
        } elseif (request()->is('annee-financiere*')) {
            $items = [
                ['label' => 'Accueil', 'url' => '/dashboard'],
                ['label' => 'Budget', 'url' => '#'],
            ];

            if (isset($this) && isset($this->viewMode) && $this->viewMode === 'detail') {
                $items[] = ['label' => 'Années Financières', 'wireClick' => 'backToList'];
                $items[] = ['label' => 'Détails de l\'Année', 'active' => true];
            } else {
                $items[] = ['label' => 'Années Financières', 'active' => true];
            }
        } elseif (request()->is('timesheets*')) {
            $items = [
                ['label' => 'Accueil', 'url' => '/dashboard'],
                ['label' => 'Feuilles de Temps', 'url' => '#'],
                ['label' => 'Projets & Suivi Hebdomadaire', 'active' => true],
            ];
        } else {
            $items = [
                ['label' => 'Accueil', 'url' => '/dashboard'],
                ['label' => 'Dashboard', 'url' => '#'],
                ['label' => 'Tableau de bord', 'active' => true],
            ];
        }
    }
@endphp

<div class="bg-white border-b border-slate-200/80 px-6 py-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs font-semibold">
    <nav class="flex items-center space-x-2 text-slate-600">
        @foreach($items as $index => $item)
            @if($index > 0)
                <span class="text-slate-300">/</span>
            @endif

            @if(!empty($item['active']))
                <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                    {{ $item['label'] }}
                </span>
            @elseif(!empty($item['wireClick']))
                <button wire:click="{{ $item['wireClick'] }}" class="flex items-center gap-1 hover:text-crt-navy transition cursor-pointer text-slate-600 font-semibold">
                    {{ $item['label'] }}
                </button>
            @elseif(!empty($item['url']) && $item['url'] !== '#')
                <a href="{{ $item['url'] }}" class="flex items-center gap-1 hover:text-crt-navy transition cursor-pointer">
                    @if($index === 0)
                        <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    @endif
                    {{ $item['label'] }}
                </a>
            @else
                <span class="text-slate-600 hover:text-crt-navy cursor-pointer">
                    {{ $item['label'] }}
                </span>
            @endif
        @endforeach
    </nav>
</div>
