with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

target = """                        </main>
                    )}
                </div>
            );
        }"""

replacement = """                        </main>
                    )}

                    {/* APPLICATION FOOTER (Harmonisé 100% avec la version Laravel bg-slate-900) */}
                    <footer className="bg-slate-900 text-white border-t border-slate-800 py-5 mt-auto">
                        <div className="max-w-[1600px] mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                            <div className="flex items-center space-x-2 font-medium text-slate-300">
                                <span>&copy; {new Date().getFullYear()} <strong className="text-white">CRT Solution</strong>. Tous droits réservés.</span>
                            </div>
                            <div className="flex items-center space-x-1.5 font-semibold text-slate-300">
                                <span>Powered by</span>
                                <span className="text-crt-cyan font-extrabold tracking-wide bg-slate-800 px-2.5 py-1 rounded-lg border border-crt-cyan/20">
                                    GCS Technologie
                                </span>
                            </div>
                        </div>
                    </footer>
                </div>
            );
        }"""

if target in content:
    content = content.replace(target, replacement)
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
        f.write(content)
    print("SUCCESS: Application footer inserted into index.html matching Laravel version!")
else:
    print("ERROR: Target end marker not found in index.html!")
