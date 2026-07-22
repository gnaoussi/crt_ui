with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace action buttons block in table rows with ALL 5 BUTTONS matching index.html 100%
old_actions_block = """                                    <div class="flex items-center justify-center space-x-1.5">
                                        <button wire:click="selectEmployee({{ $emp->id }})" title="Consulter la fiche détaillée" class="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <a href="/timesheets" title="Feuilles de temps de l'employé" class="p-1.5 text-crt-navy border border-crt-navy/30 bg-slate-100 hover:bg-crt-navy hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                        <button wire:click="toggleAccountStatus({{ $emp->id }})" title="{{ $emp->account_status === 'Activé' ? 'Désactiver le compte' : 'Activer le compte' }}" class="p-1.5 text-slate-700 border border-slate-300 bg-slate-100 hover:bg-slate-700 hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </div>"""

new_actions_block = """                                    <div class="flex items-center justify-center space-x-1.5">
                                        <button wire:click="selectEmployee({{ $emp->id }})" title="Consulter la fiche détaillée" class="p-1.5 text-crt-cyan border border-crt-cyan/30 bg-crt-cyan-light hover:bg-crt-cyan hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <a href="/timesheets" title="Feuilles de temps de l'employé" class="p-1.5 text-crt-navy border border-crt-navy/30 bg-slate-100 hover:bg-crt-navy hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                        <button wire:click="showReportNotification('{{ $emp->prenom }}', '{{ $emp->nom }}')" title="Rapports de performance" class="p-1.5 text-amber-700 border border-amber-300 bg-amber-50 hover:bg-amber-600 hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </button>
                                        <button wire:click="toggleAccountStatus({{ $emp->id }})" title="{{ $emp->account_status === 'Activé' ? 'Désactiver le compte' : 'Activer le compte' }}" class="p-1.5 text-slate-700 border border-slate-300 bg-slate-100 hover:bg-slate-700 hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                        <button wire:click="showRoleNotification('{{ $emp->prenom }}', '{{ $emp->nom }}')" title="Attribuer un rôle ou gestionnaire" class="p-1.5 text-purple-700 border border-purple-300 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </button>
                                    </div>"""

content = content.replace(old_actions_block, new_actions_block)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

# Update App\Livewire\RhComponent.php to add helper notification methods
with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/app/Livewire/RhComponent.php', 'r', encoding='utf-8') as f:
    php_content = f.read()

helper_methods = """
    public function showReportNotification($prenom, $nom)
    {
        session()->flash('message', "Rapport de performance de {$prenom} {$nom}");
    }

    public function showRoleNotification($prenom, $nom)
    {
        session()->flash('message', "Attribution de rôle pour {$prenom} {$nom}");
    }
"""

if "showReportNotification" not in php_content:
    php_content = php_content.replace(
        "public function render()",
        helper_methods + "\n    public function render()"
    )
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/app/Livewire/RhComponent.php', 'w', encoding='utf-8') as f:
        f.write(php_content)

print("SUCCESS: Added all 5 action buttons and notification handlers to match JS template 100%!")
