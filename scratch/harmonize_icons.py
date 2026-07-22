import re

# File 1: index.html
with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace emojis with clean SVG icons in index.html
content = content.replace("🖊️ Remplir", '<span className="flex items-center gap-1"><svg className="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg> Remplir</span>')
content = content.replace("🔔 Relancer", '<span className="flex items-center gap-1"><svg className="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg> Relancer</span>')
content = content.replace("ℹ️ Métriques", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Métriques</span>')
content = content.replace("📥", '<svg className="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>')
content = content.replace("🔍 Filtres", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg> Filtres</span>')
content = content.replace("👥 Liste des employés", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Liste des employés</span>')
content = content.replace("📞 Contacts", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> Contacts</span>')

# Standardize strokeWidth="2" to strokeWidth="1.8"
content = content.replace('strokeWidth="2"', 'strokeWidth="1.8"')

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: index.html icons harmonized with strokeWidth 1.8 and SVGs!")

# File 2: dashboard-component.blade.php
with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/dashboard-component.blade.php', 'r', encoding='utf-8') as f_blade:
    blade_content = f_blade.read()

blade_content = blade_content.replace('stroke-width="2"', 'stroke-width="1.8"')
blade_content = blade_content.replace('stroke-width="2.5"', 'stroke-width="1.8"')
blade_content = blade_content.replace('stroke-width="3"', 'stroke-width="1.8"')

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/dashboard-component.blade.php', 'w', encoding='utf-8') as f_blade:
    f_blade.write(blade_content)

print("SUCCESS: dashboard-component.blade.php icons harmonized!")
