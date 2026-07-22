<div class="min-h-screen bg-slate-900 flex items-center justify-center p-4 sm:p-6 lg:p-8 font-sans relative overflow-hidden">
    <!-- Subtle CRT Navy Gradient & Glow -->
    <div class="absolute inset-0 bg-gradient-to-br from-crt-navy via-slate-900 to-crt-navy-dark opacity-95 pointer-events-none"></div>

    <!-- Quick Access Floating Button -->
    <div class="absolute top-4 right-4 z-50">
        <a 
            href="/dashboard"
            class="text-xs font-extrabold text-crt-navy bg-crt-cyan hover:bg-crt-cyan-dark px-4 py-2 rounded-xl shadow-lg shadow-crt-cyan/20 transition flex items-center gap-2 cursor-pointer border border-crt-cyan/30"
        >
            <span>Accéder au Dashboard (Démo)</span>
            <svg class="w-4 h-4 text-crt-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="max-w-5xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[640px] border border-slate-200/80 z-10">
        
        <!-- LEFT PANEL: Form & Logo -->
        <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between bg-white">
            <div>
                <!-- Logo CRT Solution -->
                <div class="flex flex-col items-center justify-center text-center">
                    <img src="/logo.png" alt="CRT Solution Logo" class="h-16 w-auto object-contain mb-2" />
                    <p class="text-[11px] font-semibold text-slate-400 tracking-wide">
                        Maîtrisez votre temps, libérez votre potentiel
                    </p>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="login" class="mt-8 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-crt-navy mb-1.5">
                            Email <span class="text-rose-500 font-extrabold">*</span>
                        </label>
                        <input 
                            type="email" 
                            wire:model="email"
                            placeholder="votre.email@crtsolution.com"
                            class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan rounded-xl px-4 py-3 text-xs font-semibold text-crt-navy placeholder-slate-400 transition focus:outline-none"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-crt-navy mb-1.5">
                            Mot de passe <span class="text-rose-500 font-extrabold">*</span>
                        </label>
                        <div class="relative" x-data="{ show: false }">
                            <input 
                                :type="show ? 'text' : 'password'" 
                                wire:model="password"
                                placeholder="••••••••••••"
                                class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-crt-cyan/20 focus:border-crt-cyan rounded-xl pl-4 pr-10 py-3 text-xs font-semibold text-crt-navy placeholder-slate-400 transition focus:outline-none font-mono"
                                required
                            />
                            <button 
                                type="button" 
                                @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-crt-navy p-1 cursor-pointer"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                wire:model="rememberMe"
                                class="w-4 h-4 rounded border-slate-300 accent-[#00A8B5] text-crt-cyan focus:ring-crt-cyan cursor-pointer"
                            />
                            <span class="text-xs font-semibold text-slate-700">Se souvenir de moi</span>
                        </label>
                    </div>

                    <!-- Simulation Captcha Box matching mockup -->
                    <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-3 flex items-center justify-between shadow-2xs">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                wire:model="isCaptchaChecked"
                                class="w-5 h-5 rounded border-slate-300 accent-[#00A8B5] text-crt-cyan focus:ring-crt-cyan cursor-pointer"
                            />
                            <span class="text-xs font-bold text-slate-700">Je ne suis pas un robot</span>
                        </label>
                        <div class="flex flex-col items-end text-[9px] text-slate-400 font-semibold">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-crt-cyan" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2A10 10 0 1022 12A10 10 0 0012 2Zm-1 14.5v-9l6 4.5Z"/>
                                </svg>
                                <span class="font-extrabold text-slate-500 tracking-tighter">reCAPTCHA</span>
                            </div>
                            <div class="flex gap-1.5 mt-0.5 text-[8px] text-slate-400">
                                <span class="hover:underline cursor-pointer">Confidentialité</span>
                                <span>-</span>
                                <span class="hover:underline cursor-pointer">Conditions</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button branded in CRT Navy with CRT Cyan Highlight -->
                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-6 bg-crt-navy hover:bg-crt-navy-dark text-white font-extrabold text-xs rounded-xl shadow-lg shadow-crt-navy/20 hover:shadow-crt-navy/30 transition-all flex items-center justify-center gap-2 cursor-pointer mt-2"
                    >
                        <span>Se connecter</span>
                        <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Footer Text matching mockup -->
            <div class="text-center pt-6 text-[11px] font-semibold text-slate-400">
                &copy; {{ date('Y') }} ChronoTemps - par GCS Technologie
            </div>
        </div>

        <!-- RIGHT PANEL: Official Illustration login-img.png & Quote in Soft CRT Dark Slate -->
        <div class="lg:col-span-7 bg-gradient-to-br from-slate-900 via-crt-navy to-slate-900 p-8 sm:p-12 flex flex-col items-center justify-between relative overflow-hidden text-center text-white border-l border-slate-800">
            
            <!-- Layered Semicircle Pattern Background in Subtle Soft Glow -->
            <div class="absolute inset-0 opacity-15 pointer-events-none flex items-center justify-center">
                <div class="w-[500px] h-[500px] rounded-full border-[40px] border-crt-cyan/20 absolute -right-20 -top-20"></div>
                <div class="w-[380px] h-[380px] rounded-full border-[30px] border-crt-cyan/15 absolute -left-20 -bottom-20"></div>
            </div>

            <!-- Real Image Illustration from login-img.png -->
            <div class="w-full max-w-lg my-auto relative z-10 py-4">
                <img 
                    src="/login-img.png" 
                    alt="Collaboration Équipe CRT" 
                    class="w-full h-auto object-contain mx-auto drop-shadow-2xl" 
                />
            </div>

            <!-- Inspiring Quote Section in Soft Restful Typography -->
            <div class="max-w-lg mx-auto space-y-2.5 relative z-10 pt-2">
                <h3 class="text-base sm:text-lg font-extrabold text-white tracking-tight">
                    “Chaque minute compte, chaque objectif atteint”
                </h3>
                <p class="text-xs font-medium text-slate-300 leading-relaxed max-w-md mx-auto">
                    Visualisez vos progrès, célébrez vos succès et restez motivé tout au long de votre parcours. Notre application vous aide à suivre vos réalisations, à identifier vos forces et à continuer à progresser.
                </p>
            </div>
        </div>
    </div>
</div>
