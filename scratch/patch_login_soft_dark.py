with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

target = """{/* RIGHT PANEL: Official Illustration login-img.png & Quote */}
                        <div className="lg:col-span-7 bg-gradient-to-br from-slate-50 via-indigo-50/20 to-blue-50/40 p-8 sm:p-12 flex flex-col items-center justify-between relative overflow-hidden text-center border-l border-slate-100">
                            
                            {/* Layered Semicircle Pattern Background in CRT Cyan Glow */}
                            <div className="absolute inset-0 opacity-15 pointer-events-none flex items-center justify-center">
                                <div className="w-[500px] h-[500px] rounded-full border-[40px] border-indigo-300/30 absolute -right-20 -top-20"></div>
                                <div className="w-[380px] h-[380px] rounded-full border-[30px] border-blue-300/20 absolute -left-20 -bottom-20"></div>
                            </div>

                            {/* Real Image Illustration from mockup/login-img.png */}
                            <div className="w-full max-w-lg my-auto relative z-10 py-4">
                                <img 
                                    src="./login-img.png" 
                                    alt="Collaboration Équipe CRT" 
                                    className="w-full h-auto object-contain mx-auto drop-shadow-xl" 
                                />
                            </div>

                            {/* Inspiring Quote Section matching mockup/login.png */}
                            <div className="max-w-lg mx-auto space-y-2.5 relative z-10 pt-2">
                                <h3 className="text-base sm:text-lg font-extrabold text-slate-800 tracking-tight">
                                    “Chaque minute compte, chaque objectif atteint”
                                </h3>
                                <p className="text-xs font-medium text-slate-500 leading-relaxed max-w-md mx-auto">
                                    Visualisez vos progrès, célébrez vos succès et restez motivé tout au long de votre parcours. Notre application vous aide à suivre vos réalisations, à identifier vos forces et à continuer à progresser.
                                </p>
                            </div>
                        </div>"""

replacement = """{/* RIGHT PANEL: Official Illustration login-img.png & Quote in Soft CRT Dark Slate */}
                        <div className="lg:col-span-7 bg-gradient-to-br from-slate-900 via-crt-navy to-slate-900 p-8 sm:p-12 flex flex-col items-center justify-between relative overflow-hidden text-center text-white border-l border-slate-800">
                            
                            {/* Layered Semicircle Pattern Background in Subtle Soft Glow */}
                            <div className="absolute inset-0 opacity-15 pointer-events-none flex items-center justify-center">
                                <div className="w-[500px] h-[500px] rounded-full border-[40px] border-crt-cyan/20 absolute -right-20 -top-20"></div>
                                <div className="w-[380px] h-[380px] rounded-full border-[30px] border-crt-cyan/15 absolute -left-20 -bottom-20"></div>
                            </div>

                            {/* Real Image Illustration from mockup/login-img.png */}
                            <div className="w-full max-w-lg my-auto relative z-10 py-4">
                                <img 
                                    src="./login-img.png" 
                                    alt="Collaboration Équipe CRT" 
                                    className="w-full h-auto object-contain mx-auto drop-shadow-2xl" 
                                />
                            </div>

                            {/* Inspiring Quote Section in Soft Restful Typography */}
                            <div className="max-w-lg mx-auto space-y-2.5 relative z-10 pt-2">
                                <h3 className="text-base sm:text-lg font-extrabold text-white tracking-tight">
                                    “Chaque minute compte, chaque objectif atteint”
                                </h3>
                                <p className="text-xs font-medium text-slate-300 leading-relaxed max-w-md mx-auto">
                                    Visualisez vos progrès, célébrez vos succès et restez motivé tout au long de votre parcours. Notre application vous aide à suivre vos réalisations, à identifier vos forces et à continuer à progresser.
                                </p>
                            </div>
                        </div>"""

if target in content:
    content = content.replace(target, replacement)
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
        f.write(content)
    print("SUCCESS: Right panel updated with soft CRT Dark Slate background!")
else:
    print("ERROR: Target string not found in index.html!")
