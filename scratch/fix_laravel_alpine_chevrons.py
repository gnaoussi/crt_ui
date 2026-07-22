with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Add Alpine CDN in head if not present
if 'alpinejs' not in content:
    content = content.replace('<!-- Favicon -->', '<!-- Alpine.js CDN -->\n    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>\n    <!-- Favicon -->')

# 2. Fix Rapport chevron condition
content = content.replace(
    ":class=\"openDropdown === 'budget' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'\"",
    ":class=\"openDropdown === 'rapports' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'\""
)

# 3. Ensure button click toggles dropdown and chevron rotation on full button
# Entreprise
old_ent = """                <!-- 2. Entreprise -->
                <div class="relative" @click.away="openDropdown = null">
                    <div class="flex items-center rounded-lg transition-all {{ request()->is('entreprise') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                        <a href="/entreprise" class="flex items-center gap-1.5 px-3 py-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                            </svg>
                            Entreprise
                        </a>
                        <button @click.stop="openDropdown = openDropdown === 'entreprise' ? null : 'entreprise'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 transition-transform" :class="openDropdown === 'entreprise' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>"""

new_ent = """                <!-- 2. Entreprise -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'entreprise' ? null : 'entreprise'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('entreprise') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }} cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                        </svg>
                        Entreprise
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'entreprise' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>"""

# RH
old_rh = """                <!-- 4. RH -->
                <div class="relative" @click.away="openDropdown = null">
                    <div class="flex items-center rounded-lg transition-all {{ request()->is('rh') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                        <a href="/rh" class="flex items-center gap-1.5 px-3 py-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            RH
                        </a>
                        <button @click.stop="openDropdown = openDropdown === 'rh' ? null : 'rh'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rh' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>"""

new_rh = """                <!-- 4. RH -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'rh' ? null : 'rh'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('rh') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }} cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        RH
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rh' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>"""

# Feuilles
old_feuilles = """                <!-- 5. Feuilles de Temps -->
                <div class="relative" @click.away="openDropdown = null">
                    <div class="flex items-center rounded-lg transition-all {{ request()->is('timesheets') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                        <a href="/timesheets" class="flex items-center gap-1.5 px-3 py-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Feuilles de Temps
                        </a>
                        <button @click.stop="openDropdown = openDropdown === 'feuilles' ? null : 'feuilles'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'feuilles' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>"""

new_feuilles = """                <!-- 5. Feuilles de Temps -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'feuilles' ? null : 'feuilles'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('timesheets') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }} cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Feuilles de Temps
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'feuilles' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>"""

content = content.replace(old_ent, new_ent)
content = content.replace(old_rh, new_rh)
content = content.replace(old_feuilles, new_feuilles)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: Alpine.js CDN added and all Laravel dropdown buttons unified with 180° chevron rotation!")
