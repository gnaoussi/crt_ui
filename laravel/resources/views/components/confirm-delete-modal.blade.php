@props([
    'show' => false,
    'title' => 'Confirmer la suppression',
    'confirmText' => 'Oui, supprimer',
    'cancelText' => 'Annuler',
    'onConfirm' => '',
    'onCancel' => '',
])

@if ($show)
    <template x-teleport="body">
        <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4 animate-fade-in">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-extrabold text-crt-navy">{{ $title }}</h3>
                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
                <div class="text-sm text-slate-500 mb-6 leading-relaxed">
                    {{ $slot }}
                </div>
                <div class="flex justify-end gap-3">
                    <button 
                        type="button"
                        @if($onCancel) wire:click="{{ $onCancel }}" @endif
                        class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition cursor-pointer"
                    >
                        {{ $cancelText }}
                    </button>
                    <button 
                        type="button"
                        @if($onConfirm) wire:click="{{ $onConfirm }}" @endif
                        class="px-4 py-2 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition shadow-lg cursor-pointer"
                    >
                        {{ $confirmText }}
                    </button>
                </div>
            </div>
        </div>
    </template>
@endif
