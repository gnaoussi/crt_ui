with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Replace className with class in Blade
content = content.replace('className=', 'class=')
content = content.replace('strokeLinecap=', 'stroke-linecap=')
content = content.replace('strokeLinejoin=', 'stroke-linejoin=')
content = content.replace('strokeWidth=', 'stroke-width=')

# 2. Standardize stroke-width to 1.8 across SVGs
content = content.replace('stroke-width="2.5"', 'stroke-width="1.8"')
content = content.replace('stroke-width="2"', 'stroke-width="1.8"')

# 3. Replace emojis with clean vector SVGs / text in RH module
emoji_replacements = [
    ("🔍 Filtres", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg> Filtres</span>'),
    ("👥 Liste des employés", '<span class="flex items-center gap-1.5"><svg class="w-4.5 h-4.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg> Liste des employés</span>'),
    ("⬅ Retour à la liste des employés", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-slate-500 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg> Retour à la liste des employés</span>'),
    ('<div class="w-20 h-20 rounded-full bg-white text-crt-navy flex items-center justify-center text-2xl font-black mx-auto mb-3 shadow-md">👤</div>', '<div class="w-20 h-20 rounded-full bg-white text-crt-navy flex items-center justify-center mx-auto mb-3 shadow-md border border-crt-cyan/30"><svg class="w-10 h-10 text-crt-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></div>'),
    ("👤 Informations de l'employé", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg> Informations de l\'employé</span>'),
    ("📜 Historiques", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg> Historiques</span>'),
    ("📅 Date de naissance", '<span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Date de naissance</span>'),
    ("✉️ E-mail", '<span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> E-mail</span>'),
    ("👥 Groupes", '<span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Groupes</span>'),
    ("📅 Date d'embauche", '<span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Date d\'embauche</span>'),
    ("👤 Historique des heures par semaine", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Historique des heures par semaine</span>'),
    ("👥 Historique des gestionnaires", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Historique des gestionnaires</span>'),
    ("🏠 Historique des affectations aux sites", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" /></svg> Historique des affectations aux sites</span>'),
    ("📇 Informations personnelles", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-6 0h6" /></svg> Informations personnelles</span>'),
    ("💼 Informations professionnelles", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> Informations professionnelles</span>'),
    ("👤 Rôles et permissions", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg> Rôles et permissions</span>'),
    ("🏠 Site de travail", '<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-crt-cyan inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg> Site de travail</span>'),
    ("✖ Fermer", "Fermer"),
    ("💾 Créer", "Créer"),
    ("💾 Modifier", "Enregistrer"),
    ("💾 Sauvegarder", "Enregistrer")
]

for t, r in emoji_replacements:
    content = content.replace(t, r)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/rh-component.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: Improved Laravel RH module with valid Blade class syntax, vector SVGs, and 100% harmonization!")
