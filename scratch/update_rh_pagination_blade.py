with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Remove element count in table header grid
old_header = '<h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4.5 h-4.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg> Liste des employés</span> ({{ count($employees) }})</h3>'
new_header = '<h3 class="text-sm font-extrabold text-crt-navy"><span class="flex items-center gap-1.5"><svg class="w-4.5 h-4.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg> Liste des employés</span></h3>'

content = content.replace(old_header, new_header)

# 2. Add pagination links below table
old_table_end = """                </table>
            </div>
        </div>"""

new_table_end = """                </table>
            </div>

            <!-- PAGINATION 10 PAR PAGE -->
            <div class="mt-4 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                <div>
                    Affichage de <span class="font-extrabold text-crt-navy">{{ $employees->firstItem() ?? 0 }}</span> à <span class="font-extrabold text-crt-navy">{{ $employees->lastItem() ?? 0 }}</span> sur <span class="font-extrabold text-crt-navy">{{ $employees->total() }}</span> employés (10 par page)
                </div>
                <div>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>"""

content = content.replace(old_table_end, new_table_end)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: Updated rh-component.blade.php with pagination 10 per page and removed element count from table grid header!")
