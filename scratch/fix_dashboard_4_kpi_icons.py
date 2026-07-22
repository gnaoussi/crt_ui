with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

target_kpi_grid = """<div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">Heures de la Semaine</span>
                                        <h3 className="text-2xl font-black text-crt-navy font-mono mt-0.5">{getGrandTotal()}h / 37.5h</h3>
                                        <span className="text-[11px] font-bold text-emerald-600">121% de l'objectif hebdo</span>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-crt-cyan-light border border-crt-cyan/30 flex items-center justify-center text-crt-navy font-bold">
                                        ⏱️
                                    </div>
                                </div>
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">Projets Imputés</span>
                                        <h3 className="text-2xl font-black text-crt-navy font-mono mt-0.5">{clients.length} Projets</h3>
                                        <span className="text-[11px] font-bold text-crt-cyan-dark">Semaine active 17</span>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-crt-cyan-light border border-crt-cyan/30 flex items-center justify-center text-crt-navy font-bold">
                                        📁
                                    </div>
                                </div>
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">Semaines Inactives</span>
                                        <h3 className="text-2xl font-black text-amber-600 font-mono mt-0.5">13 Semaines</h3>
                                        <button 
                                            onClick={() => showNotification("Régularisation des semaines inactives lancée.", "info")}
                                            className="text-[11px] font-bold text-amber-700 hover:underline block text-left mt-0.5"
                                        >
                                            Régulariser →
                                        </button>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 font-bold">
                                        ⚠️
                                    </div>
                                </div>
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">En attente revue</span>
                                        <h3 className="text-2xl font-black text-crt-navy font-mono mt-0.5">1 Feuille</h3>
                                        <span className="text-[11px] font-bold text-slate-500">Validation manager</span>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-700 font-bold">
                                        ⏳
                                    </div>
                                </div>
                            </div>"""

replacement_kpi_grid = """<div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <!-- KPI 1: Heures de la Semaine -->
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-emerald-300 transition">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">Heures de la Semaine</span>
                                        <h3 className="text-2xl font-black text-crt-navy font-mono mt-0.5">{getGrandTotal()}h / 37.5h</h3>
                                        <span className="text-[11px] font-bold text-emerald-600 flex items-center gap-1">
                                            <svg className="w-3 h-3 text-emerald-500 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M5 10l7-7 7 7M12 3v18" /></svg>
                                            121% de l'objectif hebdo
                                        </span>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 shadow-2xs">
                                        <svg className="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- KPI 2: Projets Imputés -->
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-crt-cyan/50 transition">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">Projets Imputés</span>
                                        <h3 className="text-2xl font-black text-crt-navy font-mono mt-0.5">{clients.length} Projets</h3>
                                        <span className="text-[11px] font-bold text-crt-cyan-dark">Semaine active 17</span>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-crt-cyan-light border border-crt-cyan/30 flex items-center justify-center text-crt-cyan-dark shadow-2xs">
                                        <svg className="w-6 h-6 text-crt-cyan-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- KPI 3: Semaines Inactives -->
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-amber-300 transition">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">Semaines Inactives</span>
                                        <h3 className="text-2xl font-black text-amber-600 font-mono mt-0.5">13 Semaines</h3>
                                        <button 
                                            onClick={() => showNotification("Régularisation des semaines inactives lancée.", "info")}
                                            className="text-[11px] font-bold text-amber-700 hover:underline block text-left mt-0.5 flex items-center gap-0.5"
                                        >
                                            Régulariser
                                            <svg className="w-3 h-3 text-amber-700 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" /></svg>
                                        </button>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 shadow-2xs">
                                        <svg className="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- KPI 4: En attente revue -->
                                <div className="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-sky-300 transition">
                                    <div>
                                        <span className="text-[11px] font-bold uppercase tracking-wider text-slate-500">En attente revue</span>
                                        <h3 className="text-2xl font-black text-crt-navy font-mono mt-0.5">1 Feuille</h3>
                                        <span className="text-[11px] font-bold text-slate-500">Validation manager</span>
                                    </div>
                                    <div className="w-12 h-12 rounded-2xl bg-sky-50 border border-sky-200 flex items-center justify-center text-sky-600 shadow-2xs">
                                        <svg className="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>"""

if target_kpi_grid in content:
    content = content.replace(target_kpi_grid, replacement_kpi_grid)
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
        f.write(content)
    print("SUCCESS: The 4 Dashboard KPI card icons replaced with clean vector SVGs in index.html!")
else:
    print("ERROR: Target KPI grid not found in index.html!")
