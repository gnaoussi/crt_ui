with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Remove duplicate Alpine CDN tag from head
content = content.replace('<!-- Alpine.js CDN -->\n    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>\n', '')

# 2. Re-write the navbar row with working links AND working chevrons
old_nav_row = """        <!-- Horizontal Navbar Row -->
        <div class="bg-slate-900 text-white relative z-50" x-data="{ openDropdown: null }">
            <nav class="px-6 py-1 text-xs font-semibold flex items-center space-x-1.5 flex-wrap">
                
                <!-- 1. Tableau de bord -->
                <a href="/dashboard" class="flex items-center gap-2 px-3.5 py-2 rounded-lg transition-all {{ request()->is('dashboard') || request()->is('/') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Tableau de bord
                </a>

                <!-- 2. Entreprise -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'entreprise' ? null : 'entreprise'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('entreprise') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }} cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                        </svg>
                        Entreprise
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'entreprise' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'entreprise'" x-cloak class="absolute left-0 top-full mt-1 w-52 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">ENTREPRISE</div>
                        <a href="/entreprise" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Présentation entreprise
                        </a>
                    </div>
                </div>

                <!-- 3. Budget -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'budget' ? null : 'budget'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all hover:bg-slate-800 text-slate-300 hover:text-white cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Budget
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rapports' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'budget'" x-cloak class="absolute left-0 top-full mt-1 w-56 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">BUDGET</div>
                        <a href="#" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Années Financières
                        </a>
                    </div>
                </div>

                <!-- 4. RH -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'rh' ? null : 'rh'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('rh') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }} cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        RH
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rh' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'rh'" x-cloak class="absolute left-0 top-full mt-1 w-52 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">RESSOURCES HUMAINES</div>
                        <a href="/rh" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Employés
                        </a>
                    </div>
                </div>

                <!-- 5. Feuilles de Temps -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'feuilles' ? null : 'feuilles'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('timesheets') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }} cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Feuilles de Temps
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'feuilles' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'feuilles'" x-cloak class="absolute left-0 top-full mt-1 w-64 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">FEUILLES DE TEMPS</div>
                        <a href="/timesheets" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Projets & Suivi Hebdomadaire
                        </a>
                    </div>
                </div>

                <!-- 6. Rapport -->
                <div class="relative" @click.away="openDropdown = null">
                    <button @click="openDropdown = openDropdown === 'rapports' ? null : 'rapports'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all hover:bg-slate-800 text-slate-300 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Rapport
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rapports' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'rapports'" x-cloak class="absolute left-0 top-full mt-1 w-60 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">RAPPORTS & AUDIT</div>
                        <a href="#" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Feuilles absentes
                        </a>
                    </div>
                </div>
            </nav>
        </div>"""

new_nav_row = """        <!-- Horizontal Navbar Row -->
        <div class="bg-slate-900 text-white relative z-50" x-data="{ openDropdown: null }">
            <nav class="px-6 py-1 text-xs font-semibold flex items-center space-x-1.5 flex-wrap">
                
                <!-- 1. Tableau de bord -->
                <a href="/dashboard" class="flex items-center gap-2 px-3.5 py-2 rounded-lg transition-all {{ request()->is('dashboard') || request()->is('/') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Tableau de bord
                </a>

                <!-- 2. Entreprise -->
                <div class="relative flex items-center rounded-lg transition-all {{ request()->is('entreprise') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}" @click.away="openDropdown = null">
                    <a href="/entreprise" class="flex items-center gap-1.5 px-3.5 py-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                        </svg>
                        Entreprise
                    </a>
                    <button type="button" @click.stop="openDropdown = openDropdown === 'entreprise' ? null : 'entreprise'" class="pr-3 py-2 cursor-pointer focus:outline-none">
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'entreprise' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'entreprise'" x-cloak class="absolute left-0 top-full mt-1 w-52 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">ENTREPRISE</div>
                        <a href="/entreprise" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Présentation entreprise
                        </a>
                    </div>
                </div>

                <!-- 3. Budget -->
                <div class="relative" @click.away="openDropdown = null">
                    <button type="button" @click="openDropdown = openDropdown === 'budget' ? null : 'budget'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all hover:bg-slate-800 text-slate-300 hover:text-white cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Budget
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'budget' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'budget'" x-cloak class="absolute left-0 top-full mt-1 w-56 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">BUDGET</div>
                        <a href="#" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Années Financières
                        </a>
                    </div>
                </div>

                <!-- 4. RH -->
                <div class="relative flex items-center rounded-lg transition-all {{ request()->is('rh') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}" @click.away="openDropdown = null">
                    <a href="/rh" class="flex items-center gap-1.5 px-3.5 py-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        RH
                    </a>
                    <button type="button" @click.stop="openDropdown = openDropdown === 'rh' ? null : 'rh'" class="pr-3 py-2 cursor-pointer focus:outline-none">
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rh' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'rh'" x-cloak class="absolute left-0 top-full mt-1 w-52 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">RESSOURCES HUMAINES</div>
                        <a href="/rh" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Employés
                        </a>
                    </div>
                </div>

                <!-- 5. Feuilles de Temps -->
                <div class="relative flex items-center rounded-lg transition-all {{ request()->is('timesheets') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}" @click.away="openDropdown = null">
                    <a href="/timesheets" class="flex items-center gap-1.5 px-3.5 py-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Feuilles de Temps
                    </a>
                    <button type="button" @click.stop="openDropdown = openDropdown === 'feuilles' ? null : 'feuilles'" class="pr-3 py-2 cursor-pointer focus:outline-none">
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'feuilles' ? 'rotate-180 text-crt-navy' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'feuilles'" x-cloak class="absolute left-0 top-full mt-1 w-64 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">FEUILLES DE TEMPS</div>
                        <a href="/timesheets" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Projets & Suivi Hebdomadaire
                        </a>
                    </div>
                </div>

                <!-- 6. Rapport -->
                <div class="relative" @click.away="openDropdown = null">
                    <button type="button" @click="openDropdown = openDropdown === 'rapports' ? null : 'rapports'" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all hover:bg-slate-800 text-slate-300 hover:text-white cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Rapport
                        <svg class="w-3 h-3 transition-transform duration-200" :class="openDropdown === 'rapports' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'rapports'" x-cloak class="absolute left-0 top-full mt-1 w-60 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50">
                        <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">RAPPORTS & AUDIT</div>
                        <a href="#" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Feuilles absentes
                        </a>
                    </div>
                </div>
            </nav>
        </div>"""

if old_nav_row in content:
    content = content.replace(old_nav_row, new_nav_row)
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'w', encoding='utf-8') as f:
        f.write(content)
    print("SUCCESS: Restored full navigation links and clean Alpine bindings in app.blade.php!")
else:
    print("ERROR: old_nav_row pattern not found in app.blade.php")
