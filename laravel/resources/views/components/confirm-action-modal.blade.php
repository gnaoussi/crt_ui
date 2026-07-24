@props([
    'show' => false,
    'title' => 'Confirmer l\'action',
    'confirmText' => 'Confirmer',
    'cancelText' => 'Annuler',
    'confirmColor' => 'bg-crt-navy hover:bg-crt-navy-dark',
    'iconBg' => 'bg-crt-cyan-light text-crt-navy',
    'onConfirm' => '',
    'onCancel' => '',
])

@if ($show)
    <template x-teleport="body">
        <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4 animate-fade-in">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h3 class="text-base font-extrabold text-crt-navy">{{ $title }}</h3>
                    <div class="w-9 h-9 rounded-xl {{ $iconBg }} flex items-center justify-center shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-xs text-slate-600 leading-relaxed">
                    {{ $slot }}
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                    <button 
                        type="button"
                        @if($onCancel) wire:click="{{ $onCancel }}" @endif
                        class="px-4 py-2 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition cursor-pointer"
                    >
                        {{ $cancelText }}
                    </button>
                    <button 
                        type="button"
                        @if($onConfirm) wire:click="{{ $onConfirm }}" @endif
                        class="px-4 py-2 text-xs font-extrabold text-white {{ $confirmColor }} rounded-xl transition shadow-md cursor-pointer"
                    >
                        {{ $confirmText }}
                    </button>
                </div>
            </div>
        </div>
    </template>
@endif
