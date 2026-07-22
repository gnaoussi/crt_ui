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
    @livewireStyles
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- Header Navigation branded with CRT Solution Logo -->
    <header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-40">
        <!-- Top Header Row -->
        <div class="px-6 py-3.5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100">
            <div class="flex items-center space-x-4">
                <div class="p-1 bg-white rounded-lg flex items-center justify-center border border-slate-200">
                    <span class="text-xl font-black text-crt-navy px-2 py-0.5">CRT<span class="text-crt-cyan">.</span></span>
                </div>
                <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                <div>
                    <h1 class="text-base font-extrabold text-crt-navy tracking-tight flex items-center gap-2">
                        Feuille de Temps
                        <span class="text-xs font-bold px-2 py-0.5 rounded-md bg-crt-cyan-light border border-crt-cyan/20 text-crt-navy">Laravel Livewire v3</span>
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
        <div class="bg-slate-900 text-white relative z-50">
            <nav class="px-6 py-1 text-xs font-semibold flex items-center space-x-1.5 flex-wrap">
                <!-- 1. Tableau de bord -->
                <a href="/dashboard" class="flex items-center gap-2 px-3.5 py-2 rounded-lg transition-all {{ request()->is('dashboard') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Tableau de bord
                </a>

                <!-- 2. Entreprise -->
                <a href="/entreprise" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('entreprise') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                    </svg>
                    Entreprise
                </a>

                <!-- 3. RH -->
                <a href="/rh" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('rh') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    RH (Employés)
                </a>

                <!-- 4. Feuilles de Temps -->
                <a href="/timesheets" class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all {{ request()->is('timesheets') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Feuilles de temps
                </a>
            </nav>
        </div>
    </header>

    <!-- Sub Header Breadcrumb Navigation Bar -->
    <div class="bg-white border-b border-slate-200 px-6 py-2.5 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
        <nav class="flex items-center space-x-2 text-xs font-semibold">
            <span class="text-slate-600 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Accueil
            </span>
            <span class="text-slate-300">/</span>
            <span class="text-slate-600">RH</span>
            <span class="text-slate-300">/</span>
            <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                Employés
            </span>
        </nav>
    </div>

    <!-- MAIN WORKSPACE CONTENT -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
