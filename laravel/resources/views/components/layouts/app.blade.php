<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRT Solution - Laravel Livewire</title>
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
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <!-- Header Navbar -->
    <header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-40">
        <div className="px-6 py-3.5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100 px-6 py-3">
            <div className="flex items-center space-x-4">
                <div>
                    <h1 className="text-base font-extrabold text-crt-navy tracking-tight flex items-center gap-2">
                        CRT Solution — Laravel Livewire v3
                        <span className="text-xs font-bold px-2 py-0.5 rounded-md bg-crt-cyan-light border border-crt-cyan/20 text-crt-navy">Docker SQLite</span>
                    </h1>
                    <p className="text-xs text-slate-500 font-medium">Jean-Marc Dupont — Application RH & Timesheet</p>
                </div>
            </div>
        </div>

        <div className="bg-slate-900 text-white px-6 py-2 text-xs font-semibold flex items-center space-x-4">
            <a href="/dashboard" className="hover:text-crt-cyan transition">📊 Tableau de bord</a>
            <a href="/entreprise" className="hover:text-crt-cyan transition">🏢 Entreprise</a>
            <a href="/rh" className="text-crt-cyan font-bold hover:underline transition">👥 RH (Employés)</a>
            <a href="/timesheets" className="hover:text-crt-cyan transition">📑 Feuilles de Temps</a>
        </div>
    </header>

    <main className="min-h-screen">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
