<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - CRT Solution</title>
    <link rel="icon" type="image/png" href="/logo.png">
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
                            'cyan-glow': 'rgba(0, 168, 181, 0.15)',
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-slate-900 text-slate-800 font-sans antialiased min-h-screen">
    {{ $slot }}
    @livewireScripts
</body>
</html>
