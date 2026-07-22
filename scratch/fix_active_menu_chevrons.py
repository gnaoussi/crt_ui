with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Update Entreprise in app.blade.php
old_ent_svg = """<svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'entreprise' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>"""

new_ent_svg = """<svg class="w-3 h-3 transition-transform duration-200 {{ request()->is('entreprise') ? 'text-crt-navy font-bold' : 'text-slate-400' }}" :class="openDropdown === 'entreprise' ? 'rotate-180 {{ request()->is('entreprise') ? 'text-crt-navy' : 'text-crt-cyan' }} font-extrabold scale-110' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>"""

# Update RH in app.blade.php
old_rh_svg = """<svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rh' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>"""

new_rh_svg = """<svg class="w-3 h-3 transition-transform duration-200 {{ request()->is('rh') ? 'text-crt-navy font-bold' : 'text-slate-400' }}" :class="openDropdown === 'rh' ? 'rotate-180 {{ request()->is('rh') ? 'text-crt-navy' : 'text-crt-cyan' }} font-extrabold scale-110' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>"""

# Update Feuilles in app.blade.php
old_feuilles_svg = """<svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'feuilles' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>"""

new_feuilles_svg = """<svg class="w-3 h-3 transition-transform duration-200 {{ request()->is('timesheets') ? 'text-crt-navy font-bold' : 'text-slate-400' }}" :class="openDropdown === 'feuilles' ? 'rotate-180 {{ request()->is('timesheets') ? 'text-crt-navy' : 'text-crt-cyan' }} font-extrabold scale-110' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>"""

content = content.replace(old_ent_svg, new_ent_svg)
content = content.replace(old_rh_svg, new_rh_svg)
content = content.replace(old_feuilles_svg, new_feuilles_svg)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

# Update index.html as well
with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    index_content = f.read()

index_content = index_content.replace(
    "openNavDropdown === 'entreprise' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'",
    "activeMenuItem.section === 'Entreprise' ? 'text-crt-navy font-bold' : 'text-slate-400'} ${openNavDropdown === 'entreprise' ? `rotate-180 ${activeMenuItem.section === 'Entreprise' ? 'text-crt-navy' : 'text-crt-cyan'} font-extrabold scale-110` : ''"
)
index_content = index_content.replace(
    "openNavDropdown === 'rh' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'",
    "activeMenuItem.section === 'RH' ? 'text-crt-navy font-bold' : 'text-slate-400'} ${openNavDropdown === 'rh' ? `rotate-180 ${activeMenuItem.section === 'RH' ? 'text-crt-navy' : 'text-crt-cyan'} font-extrabold scale-110` : ''"
)
index_content = index_content.replace(
    "openNavDropdown === 'feuilles' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'",
    "activeMenuItem.section === 'Feuilles de Temps' ? 'text-crt-navy font-bold' : 'text-slate-400'} ${openNavDropdown === 'feuilles' ? `rotate-180 ${activeMenuItem.section === 'Feuilles de Temps' ? 'text-crt-navy' : 'text-crt-cyan'} font-extrabold scale-110` : ''"
)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
    f.write(index_content)

print("SUCCESS: Chevrons on active menu buttons fixed with CRT Navy high-contrast text!")
