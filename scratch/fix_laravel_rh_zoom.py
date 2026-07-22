with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    app_content = f.read()

# Add cyan-glow to app.blade.php
if "'cyan-glow'" not in app_content:
    app_content = app_content.replace(
        "'cyan-light': '#E8F7F8',",
        "'cyan-light': '#E8F7F8',\n                            'cyan-glow': 'rgba(0, 168, 181, 0.15)',"
    )
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'w', encoding='utf-8') as f:
        f.write(app_content)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'r', encoding='utf-8') as f:
    rh_content = f.read()

# 1. Update filter inputs padding to p-2 (instead of p-2.5) matching index.html
rh_content = rh_content.replace('p-2.5 bg-slate-50', 'p-2 bg-slate-50')

# 2. Make pagination controls ultra-compact matching template styling
old_pagination_box = """            <!-- PAGINATION 10 PAR PAGE -->
            <div class="mt-4 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                <div>
                    Affichage de <span class="font-extrabold text-crt-navy">{{ $employees->firstItem() ?? 0 }}</span> à <span class="font-extrabold text-crt-navy">{{ $employees->lastItem() ?? 0 }}</span> sur <span class="font-extrabold text-crt-navy">{{ $employees->total() }}</span> employés (10 par page)
                </div>
                <div>
                    {{ $employees->links() }}
                </div>
            </div>"""

new_pagination_box = """            <!-- PAGINATION COMPACTE 10 PAR PAGE -->
            <div class="mt-4 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-semibold text-slate-600">
                <div class="text-[11px]">
                    Affichage <strong class="text-crt-navy font-bold">{{ $employees->firstItem() ?? 0 }}</strong> - <strong class="text-crt-navy font-bold">{{ $employees->lastItem() ?? 0 }}</strong> sur <strong class="text-crt-navy font-bold">{{ $employees->total() }}</strong> employés (10 / page)
                </div>
                <div class="flex items-center space-x-1 font-mono text-xs">
                    @if ($employees->onFirstPage())
                        <span class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 cursor-not-allowed">‹ Précédent</span>
                    @else
                        <button wire:click="previousPage" class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-crt-navy font-bold shadow-2xs transition">‹ Précédent</button>
                    @endif

                    <span class="px-3 py-1 rounded-lg bg-crt-navy text-white font-bold">{{ $employees->currentPage() }} / {{ $employees->lastPage() }}</span>

                    @if ($employees->hasMorePages())
                        <button wire:click="nextPage" class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-crt-navy font-bold shadow-2xs transition">Suivant ›</button>
                    @else
                        <span class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 cursor-not-allowed">Suivant ›</span>
                    @endif
                </div>
            </div>"""

rh_content = rh_content.replace(old_pagination_box, new_pagination_box)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'w', encoding='utf-8') as f:
    f.write(rh_content)

print("SUCCESS: Fixed padding & compact pagination controls to eliminate zoom effect in Laravel RH module!")
