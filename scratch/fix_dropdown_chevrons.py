with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Update Budget Chevron
old_budget_svg = """                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>"""
new_budget_svg = """                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'budget' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>"""

# Update RH Chevron
old_rh_svg = """                        <button @click.stop="openDropdown = openDropdown === 'rh' ? null : 'rh'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>"""
new_rh_svg = """                        <button @click.stop="openDropdown = openDropdown === 'rh' ? null : 'rh'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rh' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>"""

# Update Feuilles Chevron
old_feuilles_svg = """                        <button @click.stop="openDropdown = openDropdown === 'feuilles' ? null : 'feuilles'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>"""
new_feuilles_svg = """                        <button @click.stop="openDropdown = openDropdown === 'feuilles' ? null : 'feuilles'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'feuilles' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>"""

# Update Rapport Chevron
old_rapport_svg = """                    <button @click="openDropdown = openDropdown === 'rapports' ? null : 'rapports'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all hover:bg-slate-800 text-slate-300 hover:text-white cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Rapport
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>"""
new_rapport_svg = """                    <button @click="openDropdown = openDropdown === 'rapports' ? null : 'rapports'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all hover:bg-slate-800 text-slate-300 hover:text-white cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Rapport
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rapports' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>"""

content = content.replace(old_budget_svg, new_budget_svg)
content = content.replace(old_rh_svg, new_rh_svg)
content = content.replace(old_feuilles_svg, new_feuilles_svg)
content = content.replace(old_rapport_svg, new_rapport_svg)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: All navbar dropdown chevrons updated with smooth 180° rotation on click in app.blade.php!")
