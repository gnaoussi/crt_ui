with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Make all dropdown chevrons in app.blade.php use bright CRT Cyan (text-crt-cyan) when open so they are vibrant and 100% visible on dark bg
replacements = [
    (":class=\"openDropdown === 'entreprise' ? 'rotate-180 text-crt-navy' : 'text-slate-400'\"", ":class=\"openDropdown === 'entreprise' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'\""),
    (":class=\"openDropdown === 'rh' ? 'rotate-180 text-crt-navy' : 'text-slate-400'\"", ":class=\"openDropdown === 'rh' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'\""),
    (":class=\"openDropdown === 'feuilles' ? 'rotate-180 text-crt-navy' : 'text-slate-400'\"", ":class=\"openDropdown === 'feuilles' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'\""),
    (":class=\"openDropdown === 'budget' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'\"", ":class=\"openDropdown === 'budget' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'\""),
    (":class=\"openDropdown === 'rapports' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'\"", ":class=\"openDropdown === 'rapports' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'\"")
]

for old, new in replacements:
    content = content.replace(old, new)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

# Now update index.html as well
with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    index_content = f.read()

index_content = index_content.replace(
    "openNavDropdown === 'entreprise' ? 'rotate-180 text-crt-navy' : 'text-slate-400'",
    "openNavDropdown === 'entreprise' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'"
)
index_content = index_content.replace(
    "openNavDropdown === 'rh' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'",
    "openNavDropdown === 'rh' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'"
)
index_content = index_content.replace(
    "openNavDropdown === 'feuilles' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'",
    "openNavDropdown === 'feuilles' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'"
)
index_content = index_content.replace(
    "openNavDropdown === 'budget' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'",
    "openNavDropdown === 'budget' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'"
)
index_content = index_content.replace(
    "openNavDropdown === 'rapports' ? 'rotate-180 text-crt-cyan' : 'text-slate-400'",
    "openNavDropdown === 'rapports' ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'"
)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
    f.write(index_content)

print("SUCCESS: Updated chevrons in app.blade.php and index.html with high contrast CRT Cyan glow!")
