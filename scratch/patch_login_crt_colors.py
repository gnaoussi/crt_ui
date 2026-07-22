with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Define harmonised LoginComponent with CRT Solution palette
login_component_crt = """
        function LoginComponent({ onLoginSuccess, onSkipToApp }) {
            const [email, setEmail] = React.useState("jean-marc.dupont@crtsolution.com");
            const [password, setPassword] = React.useState("••••••••••••");
            const [showPassword, setShowPassword] = React.useState(false);
            const [rememberMe, setRememberMe] = React.useState(true);
            const [isCaptchaChecked, setIsCaptchaChecked] = React.useState(true);
            const [activeSlide, setActiveSlide] = React.useState(0);

            const slides = [
                {
                    title: "“Chaque minute compte, chaque objectif atteint”",
                    text: "Visualisez vos progrès, célébrez vos succès et restez motivé tout au long de votre parcours. Notre application vous aide à suivre vos réalisations, à identifier vos forces et à continuer à progresser."
                },
                {
                    title: "“Optimisez la gestion de vos feuilles de temps”",
                    text: "Centralisez les validations de vos équipes, réduisez les délais administratifs et offrez une visibilité transparente à vos responsables de projets."
                },
                {
                    title: "“Une collaboration fluide et performante”",
                    text: "Accédez en temps réel aux données de vos collaborateurs, gérez la structure des sites d'entreprise et pilotez vos budgets sans effort."
                }
            ];

            const handleSubmit = (e) => {
                e.preventDefault();
                if (onLoginSuccess) onLoginSuccess();
            };

            return (
                <div className="min-h-screen bg-slate-900 flex items-center justify-center p-4 sm:p-6 lg:p-8 font-sans relative overflow-hidden">
                    {/* Subtle CRT Navy Gradient & Glow */}
                    <div className="absolute inset-0 bg-gradient-to-br from-crt-navy via-slate-900 to-crt-navy-dark opacity-95 pointer-events-none"></div>

                    {/* Quick Access Floating Button */}
                    <div className="absolute top-4 right-4 z-50">
                        <button 
                            onClick={onSkipToApp}
                            className="text-xs font-extrabold text-crt-navy bg-crt-cyan hover:bg-crt-cyan-dark px-4 py-2 rounded-xl shadow-lg shadow-crt-cyan/20 transition flex items-center gap-2 cursor-pointer border border-crt-cyan/30"
                        >
                            <span>Accéder au Dashboard (Démo)</span>
                            <svg className="w-4 h-4 text-crt-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>

                    {/* Main Card Container */}
                    <div className="max-w-5xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[640px] border border-slate-200/80 z-10">
                        
                        {/* LEFT PANEL: Form & Logo */}
                        <div className="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between bg-white">
                            <div>
                                {/* Logo CRT Solution */}
                                <div className="flex flex-col items-center justify-center text-center">
                                    <img src="./logo.png" alt="CRT Solution Logo" className="h-16 w-auto object-contain mb-2" />
                                    <p className="text-[11px] font-semibold text-slate-400 tracking-wide">
                                        Maîtrisez votre temps, libérez votre potentiel
                                    </p>
                                </div>

                                {/* Form */}
                                <form onSubmit={handleSubmit} className="mt-8 space-y-4">
                                    <div>
                                        <label className="block text-xs font-bold text-crt-navy mb-1.5">
                                            Email <span className="text-rose-500 font-extrabold">*</span>
                                        </label>
                                        <input 
                                            type="email" 
                                            value={email}
                                            onChange={(e) => setEmail(e.target.value)}
                                            placeholder="votre.email@crtsolution.com"
                                            className="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan rounded-xl px-4 py-3 text-xs font-semibold text-crt-navy placeholder-slate-400 transition focus:outline-none"
                                            required
                                        />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-crt-navy mb-1.5">
                                            Mot de passe <span className="text-rose-500 font-extrabold">*</span>
                                        </label>
                                        <div className="relative">
                                            <input 
                                                type={showPassword ? "text" : "password"} 
                                                value={password}
                                                onChange={(e) => setPassword(e.target.value)}
                                                placeholder="••••••••••••"
                                                className="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan rounded-xl pl-4 pr-10 py-3 text-xs font-semibold text-crt-navy placeholder-slate-400 transition focus:outline-none font-mono"
                                                required
                                            />
                                            <button 
                                                type="button" 
                                                onClick={() => setShowPassword(!showPassword)}
                                                className="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-crt-navy p-1 cursor-pointer"
                                            >
                                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {showPassword ? (
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.05 10.05 0 012.122-.063c4.478 0 8.268 2.943 9.543 7a9.97 9.97 0 01-1.563 3.029m-5.858 5.908L3 3l18 18" />
                                                    ) : (
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    )}
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div className="flex items-center justify-between pt-1">
                                        <label className="flex items-center gap-2 cursor-pointer select-none">
                                            <input 
                                                type="checkbox" 
                                                checked={rememberMe}
                                                onChange={(e) => setRememberMe(e.target.checked)}
                                                className="w-4 h-4 rounded border-slate-300 text-crt-cyan focus:ring-crt-cyan cursor-pointer"
                                            />
                                            <span className="text-xs font-semibold text-slate-700">Se souvenir de moi</span>
                                        </label>
                                    </div>

                                    {/* Simulation Captcha Box matching mockup */}
                                    <div className="bg-slate-50 border border-slate-200/80 rounded-xl p-3 flex items-center justify-between shadow-2xs">
                                        <label className="flex items-center gap-3 cursor-pointer select-none">
                                            <input 
                                                type="checkbox" 
                                                checked={isCaptchaChecked}
                                                onChange={(e) => setIsCaptchaChecked(e.target.checked)}
                                                className="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer"
                                            />
                                            <span className="text-xs font-bold text-slate-700">Je ne suis pas un robot</span>
                                        </label>
                                        <div className="flex flex-col items-end text-[9px] text-slate-400 font-semibold">
                                            <div className="flex items-center gap-1">
                                                <svg className="w-4 h-4 text-crt-cyan" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 2A10 10 0 1022 12A10 10 0 0012 2Zm-1 14.5v-9l6 4.5Z"/>
                                                </svg>
                                                <span className="font-extrabold text-slate-500 tracking-tighter">reCAPTCHA</span>
                                            </div>
                                            <div className="flex gap-1.5 mt-0.5 text-[8px] text-slate-400">
                                                <span className="hover:underline cursor-pointer">Confidentialité</span>
                                                <span>-</span>
                                                <span className="hover:underline cursor-pointer">Conditions</span>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Submit Button branded in CRT Navy with CRT Cyan Highlight */}
                                    <button 
                                        type="submit" 
                                        className="w-full py-3.5 px-6 bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs rounded-xl shadow-lg shadow-crt-navy/20 hover:shadow-crt-navy/30 transition-all flex items-center justify-center gap-2 cursor-pointer mt-2"
                                    >
                                        <span>Se connecter</span>
                                        <svg className="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            {/* Footer Text matching mockup */}
                            <div className="text-center pt-6 text-[11px] font-semibold text-slate-400">
                                &copy; 2026 ChronoTemps - par GCS Technologie
                            </div>
                        </div>

                        {/* RIGHT PANEL: Inspiring Illustration & Carousel branded in CRT Navy & Cyan */}
                        <div className="lg:col-span-7 bg-gradient-to-br from-crt-navy via-crt-navy-dark to-slate-900 p-8 sm:p-12 flex flex-col items-center justify-between relative overflow-hidden text-center text-white border-l border-crt-navy-light">
                            
                            {/* Layered Semicircle Pattern Background in CRT Cyan Glow */}
                            <div className="absolute inset-0 opacity-20 pointer-events-none flex items-center justify-center">
                                <div className="w-[500px] h-[500px] rounded-full border-[40px] border-crt-cyan/30 absolute -right-20 -top-20"></div>
                                <div className="w-[380px] h-[380px] rounded-full border-[30px] border-crt-cyan/20 absolute -left-20 -bottom-20"></div>
                            </div>

                            {/* SVG Vector Illustration with CRT Palette */}
                            <div className="w-full max-w-md my-auto relative z-10 py-6">
                                <svg className="w-full h-auto drop-shadow-xl" viewBox="0 0 600 350" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    {/* Floor / Desk Base Shadow */}
                                    <ellipse cx="300" cy="310" rx="260" ry="18" fill="#041829" opacity="0.8" />
                                    
                                    {/* CRT Cyan Desk */}
                                    <rect x="70" y="220" width="460" height="10" rx="5" fill="#00A8B5" />
                                    <rect x="110" y="230" width="10" height="80" fill="#0E3B61" />
                                    <rect x="480" y="230" width="10" height="80" fill="#0E3B61" />
                                    <rect x="295" y="230" width="10" height="80" fill="#06233B" />

                                    {/* Person 1 (Left - Bearded Man in CRT Navy Suit & Cyan Tie) */}
                                    <path d="M120 180 C120 140 140 130 160 130 C180 130 200 140 200 180 L210 260 L110 260 Z" fill="#0E3B61" />
                                    <circle cx="160" cy="100" r="22" fill="#F87171" />
                                    <path d="M148 95 Q160 115 172 95 Q160 120 148 95 Z" fill="#041829" /> {/* Beard */}
                                    <rect x="156" y="130" width="8" height="40" fill="#00A8B5" /> {/* Cyan Tie */}
                                    <path d="M110 180 L85 240 L120 240 Z" fill="#06233B" />
                                    {/* Chair 1 */}
                                    <rect x="100" y="140" width="15" height="100" rx="5" fill="#1E293B" />

                                    {/* Person 2 (Center - Man in White Shirt & Cyan Accent) */}
                                    <path d="M270 170 C270 135 290 125 305 125 C320 125 340 135 340 170 L345 260 L265 260 Z" fill="#FFFFFF" stroke="#CBD5E1" strokeWidth="2" />
                                    <circle cx="305" cy="95" r="22" fill="#FCA5A5" />
                                    <path d="M285 85 C285 70 325 70 325 85 Z" fill="#EF4444" /> {/* Hair */}
                                    <rect x="301" y="125" width="8" height="45" fill="#00A8B5" /> {/* Cyan Tie */}
                                    {/* Chair 2 */}
                                    <rect x="260" y="120" width="90" height="10" rx="5" fill="#0F172A" />
                                    <rect x="250" y="130" width="10" height="100" rx="5" fill="#0F172A" />

                                    {/* Person 3 (Right - Woman in Yellow Tank Top & Coral Pants) */}
                                    <path d="M420 170 C420 135 440 130 460 130 C480 130 500 135 500 170 L495 240 L415 240 Z" fill="#F59E0B" />
                                    <circle cx="460" cy="98" r="20" fill="#FDBA74" />
                                    <circle cx="475" cy="80" r="14" fill="#334155" /> {/* Hair Bun */}
                                    <path d="M430 240 L420 310 L460 310 L470 240 Z" fill="#F87171" /> {/* Pants */}
                                    {/* Coffee Cup */}
                                    <rect x="500" y="200" width="14" height="20" rx="3" fill="#FFFFFF" stroke="#00A8B5" />
                                    <rect x="500" y="206" width="14" height="8" fill="#00A8B5" />

                                    {/* Laptops on Desk */}
                                    {/* Laptop 1 */}
                                    <polygon points="180,220 225,220 235,190 190,190" fill="#38BDF8" />
                                    <rect x="175" y="220" width="55" height="4" rx="2" fill="#94A3B8" />

                                    {/* Laptop 2 */}
                                    <polygon points="280,220 330,220 335,190 285,190" fill="#00A8B5" />
                                    <rect x="275" y="220" width="60" height="4" rx="2" fill="#64748B" />

                                    {/* Laptop 3 */}
                                    <polygon points="430,220 475,220 480,195 435,195" fill="#E8F7F8" />
                                    <rect x="425" y="220" width="55" height="4" rx="2" fill="#94A3B8" />
                                </svg>
                            </div>

                            {/* Inspiring Quotes Carousel Section matching CRT Palette */}
                            <div className="max-w-lg mx-auto space-y-3 relative z-10">
                                <h3 className="text-base sm:text-lg font-extrabold text-white tracking-tight transition-all duration-300">
                                    {slides[activeSlide].title}
                                </h3>
                                <p className="text-xs font-medium text-slate-300 leading-relaxed max-w-md mx-auto transition-all duration-300">
                                    {slides[activeSlide].text}
                                </p>

                                {/* Carousel Indicators in CRT Cyan */}
                                <div className="flex items-center justify-center gap-2 pt-4">
                                    {slides.map((_, idx) => (
                                        <button 
                                            key={idx} 
                                            onClick={() => setActiveSlide(idx)}
                                            className={`h-1.5 rounded-full transition-all duration-300 cursor-pointer ${
                                                activeSlide === idx ? 'w-8 bg-crt-cyan shadow-sm shadow-crt-cyan/50' : 'w-4 bg-slate-700 hover:bg-slate-600'
                                            }`}
                                        />
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            );
        }
"""

# Extract the existing function LoginComponent definition and replace it
start_marker = "function LoginComponent({ onLoginSuccess, onSkipToApp }) {"
end_marker = "function TimesheetApp() {"

start_idx = content.find(start_marker)
end_idx = content.find(end_marker)

if start_idx != -1 and end_idx != -1:
    content = content[:start_idx] + login_component_crt.strip() + "\n\n        " + content[end_idx:]
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
        f.write(content)
    print("SUCCESS: LoginComponent harmonised with CRT Solution palette!")
else:
    print("ERROR: Could not locate markers in index.html!")
