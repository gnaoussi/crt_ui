<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRT Solution - Laravel Livewire v3</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        crt: {
                            navy: '#06233B',
                            'navy-dark': '#041829',
                            'navy-light': '#0E3B61',
                            cyan: '#00A8B5',
                            'cyan-dark': '#008C97',
                            'cyan-light': '#E8F7F8',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    }
                }
            }
        }
    </script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/logo.png">
    <link rel="shortcut icon" type="image/png" href="/favicon.png">
    @livewireStyles
</head>
<body class="bg-slate-100/90 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- Navigation Header branded with CRT Solution Logo -->
    <header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-40">
        <!-- Top Header Row -->
        <div class="px-6 py-3.5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100">
            <div class="flex items-center space-x-4">
                <div class="p-1 bg-white rounded-lg flex items-center justify-center">
                    <img src="/logo.png" alt="CRT Solution Logo" class="h-10 w-auto object-contain" />
                </div>
                <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                <div>
                    <h1 class="text-base font-extrabold text-crt-navy tracking-tight flex items-center gap-2">
                        Feuille de Temps
                        <span class="text-xs font-bold px-2 py-0.5 rounded-md bg-crt-cyan-light border border-crt-cyan/20 text-crt-navy">Interactive v3.0</span>
                    </h1>
                    <p class="text-xs text-slate-500 font-medium">Jean-Marc Dupont — Concepteur Développeur</p>
                </div>
            </div>

            <!-- Top Metadata info -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <span class="text-xs font-bold text-crt-navy bg-crt-cyan-light border border-crt-cyan/30 px-3.5 py-1.5 rounded-xl block text-center w-full sm:w-auto shadow-xs">
                    Semaine du 20 Juillet 2026
                </span>
            </div>
        </div>

        <!-- Horizontal Navbar Row -->
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
                    </div>
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
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                    <div class="flex items-center rounded-lg transition-all {{ request()->is('rh') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                        <a href="/rh" class="flex items-center gap-1.5 px-3 py-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            RH
                        </a>
                        <button @click.stop="openDropdown = openDropdown === 'rh' ? null : 'rh'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
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
                    <div class="flex items-center rounded-lg transition-all {{ request()->is('timesheets') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                        <a href="/timesheets" class="flex items-center gap-1.5 px-3 py-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Feuilles de Temps
                        </a>
                        <button @click.stop="openDropdown = openDropdown === 'feuilles' ? null : 'feuilles'" class="pr-2 py-2 cursor-pointer">
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
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
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
        </div>
    </header>

    <!-- Sub Header Breadcrumb Navigation Bar -->
    <div class="bg-slate-100/80 border-b border-slate-200/80 px-6 py-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs font-semibold">
        <nav class="flex items-center space-x-2 text-slate-600">
            <a href="/dashboard" class="flex items-center gap-1 hover:text-crt-navy cursor-pointer">
                <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Accueil
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-600">
                @if (request()->is('rh')) RH
                @elseif (request()->is('entreprise')) Entreprise
                @elseif (request()->is('timesheets')) Feuilles de Temps
                @else Dashboard
                @endif
            </span>
            <span class="text-slate-300">/</span>
            <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                @if (request()->is('rh')) Employés
                @elseif (request()->is('entreprise')) Présentation entreprise
                @elseif (request()->is('timesheets')) Projets & Suivi Hebdomadaire
                @else Tableau de bord
                @endif
            </span>
        </nav>
    </div>

    <!-- MAIN WORKSPACE CONTENT -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- APPLICATION FOOTER (Harmonisé 100% avec le menu bg-slate-900) -->
    <footer class="bg-slate-900 text-white border-t border-slate-800 py-5 mt-auto">
        <div class="max-w-[1600px] mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
            <div class="flex items-center space-x-2 font-medium text-slate-300">
                <span>&copy; {{ date('Y') }} <strong class="text-white">CRT Solution</strong>. Tous droits réservés.</span>
            </div>
            <div class="flex items-center space-x-1.5 font-semibold text-slate-300">
                <span>Powered by</span>
                <span class="text-crt-cyan font-extrabold tracking-wide bg-slate-800 px-2.5 py-1 rounded-lg border border-crt-cyan/20">
                    GCS Technologie
                </span>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
