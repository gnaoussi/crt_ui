<!-- Subview: Consultation Timeline Journal View -->
<div class="space-y-6">
    @php
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    @endphp
    @foreach ($days as $day)
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-crt-cyan"></span>
                    <h3 class="text-sm font-extrabold text-crt-navy uppercase tracking-wider">{{ $day }}</h3>
                </div>
                <span class="text-xs font-bold bg-crt-cyan-light border border-crt-cyan/30 text-crt-navy px-2.5 py-1 rounded-lg">
                    Total journée : <strong class="text-crt-cyan-dark font-mono">7.5h</strong>
                </span>
            </div>

            <div class="space-y-4">
                @foreach ($clients as $client)
                    @foreach ($client->tasks as $task)
                        <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-crt-cyan-light/30 transition-colors border border-transparent hover:border-crt-cyan/20">
                            <div class="bg-crt-cyan-light border border-crt-cyan/30 text-crt-navy font-extrabold text-xs px-2.5 py-1.5 rounded-xl min-w-[50px] text-center shadow-sm font-mono">
                                7.5h
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-x-2 text-xs">
                                    <span class="font-extrabold text-crt-navy">{{ $client->name }}</span>
                                    <span class="text-slate-400">/</span>
                                    <span class="text-slate-600 font-semibold">{{ $task->name }}</span>
                                </div>
                                <p class="text-xs text-slate-700 italic mt-1 font-serif pr-4">
                                    "Développement feature CRT Solution"
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
</div>
