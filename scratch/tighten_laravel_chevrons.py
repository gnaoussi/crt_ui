with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace spacing for Entreprise, RH, Feuilles de Temps
content = content.replace(
    'class="flex items-center gap-1.5 px-3.5 py-2"',
    'class="flex items-center gap-1.5 pl-3.5 pr-1 py-2"'
)
content = content.replace(
    'class="pr-3 py-2 cursor-pointer focus:outline-none"',
    'class="pr-3.5 pl-0.5 py-2 cursor-pointer focus:outline-none flex items-center"'
)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: Tightened chevron spacing to match JS template in app.blade.php!")
