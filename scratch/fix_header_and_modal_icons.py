with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Update Header Login Button to CRT Navy & Cyan styling
old_header_btn = """<button 
                                    onClick={() => setCurrentView('login')}
                                    className="text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-3.5 py-1.5 rounded-xl transition flex items-center gap-1.5 shadow-sm cursor-pointer"
                                >
                                    <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Page de Connexion (Login)
                                </button>"""

new_header_btn = """<button 
                                    onClick={() => setCurrentView('login')}
                                    className="text-xs font-extrabold text-white bg-crt-navy hover:bg-crt-navy-dark border border-crt-cyan/30 px-3.5 py-1.5 rounded-xl transition flex items-center gap-1.5 shadow-xs cursor-pointer"
                                >
                                    <svg className="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Page de Connexion (Login)
                                </button>"""

if old_header_btn in content:
    content = content.replace(old_header_btn, new_header_btn)
    print("SUCCESS: Header Login button harmonized to CRT Navy & Cyan!")

# 2. Update Modal Action Buttons (replace emojis with clean SVG icons)
content = content.replace("💾 Créer le site", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Créer le site</span>')
content = content.replace("💾 Enregistrer", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Enregistrer</span>')
content = content.replace("💾 Créer", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M12 4v16m8-8H4" /></svg> Créer</span>')
content = content.replace("💾 Modifier", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg> Modifier</span>')
content = content.replace("💾 Sauvegarder", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Sauvegarder</span>')
content = content.replace("✖ Fermer", '<span className="flex items-center gap-1.5"><svg className="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M6 18L18 6M6 6l12 12" /></svg> Fermer</span>')

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: Modal buttons and header login button harmonized in index.html!")
