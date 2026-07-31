<!-- Subview: Consultation Grid Table View -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse table-fixed min-w-[1300px]">
            <thead>
                <tr class="bg-slate-100/80 text-slate-700 border-b border-slate-200 text-xs uppercase tracking-wider font-extrabold">
                    <th class="p-4 w-[240px]">Clients / Tâches</th>
                    <th class="p-4 text-center w-[150px]">
                        <div class="font-extrabold text-crt-navy">Lundi</div>
                    </th>
                    <th class="p-4 text-center w-[150px]">
                        <div class="font-extrabold text-crt-navy">Mardi</div>
                    </th>
                    <th class="p-4 text-center w-[150px]">
                        <div class="font-extrabold text-crt-navy">Mercredi</div>
                    </th>
                    <th class="p-4 text-center w-[150px]">
                        <div class="font-extrabold text-crt-navy">Jeudi</div>
                    </th>
                    <th class="p-4 text-center w-[150px]">
                        <div class="font-extrabold text-crt-navy">Vendredi</div>
                    </th>
                    <th class="p-4 text-center w-[150px] bg-amber-50/60">
                        <div class="font-extrabold text-amber-900">Samedi</div>
                    </th>
                    <th class="p-4 text-center w-[150px] bg-amber-50/60">
                        <div class="font-extrabold text-amber-900">Dimanche</div>
                    </th>
                    <th class="p-4 text-center w-[100px]">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr class="bg-slate-100/70 border-y border-slate-200">
                        <td class="p-3 font-extrabold text-crt-navy text-sm">
                            <span class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-md bg-crt-cyan shadow-sm shadow-crt-cyan/30"></span>
                                {{ $client->name }}
                            </span>
                        </td>
                        <td colspan="8" class="p-3"></td>
                    </tr>

                    @foreach ($client->tasks as $task)
                        <tr class="border-b border-slate-100 hover:bg-crt-cyan-light/40 transition">
                            <td class="p-3 pl-8 text-xs font-semibold text-slate-700 whitespace-normal break-words leading-relaxed">
                                {{ $task->name }}
                            </td>
                            @for ($i = 0; $i < 7; $i++)
                                <td class="p-3 border-r border-slate-100 transition-colors {{ $i >= 5 ? 'bg-amber-50/20' : '' }}">
                                    @if ($i < 5)
                                        <div class="flex flex-col gap-1.5">
                                            <span class="text-xs font-bold text-crt-navy bg-crt-cyan-light border border-crt-cyan/30 px-2 py-0.5 rounded-md w-fit shadow-xs font-mono">
                                                7.5 h
                                            </span>
                                            <p class="text-xs text-slate-600 leading-relaxed italic pr-2 break-words font-medium">
                                                "Développement feature CRT Solution"
                                            </p>
                                        </div>
                                    @else
                                        <span class="text-slate-300 font-light block text-center">-</span>
                                    @endif
                                </td>
                            @endfor
                            <td class="p-3 text-center font-extrabold text-sm text-crt-navy bg-slate-50/60 font-mono">
                                37.5h
                            </td>
                        </tr>
                    @endforeach
                @endforeach

                <tr class="bg-crt-navy text-white font-semibold text-sm">
                    <td class="p-4 pl-6 text-left uppercase tracking-wider text-xs font-extrabold text-crt-cyan">
                        Total Heures Validées
                    </td>
                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                    <td class="p-4 text-center text-sm font-extrabold text-slate-100 font-mono">7.5h</td>
                    <td class="p-4 text-center text-sm font-extrabold text-amber-300 font-mono bg-crt-navy-dark/40">0.0h</td>
                    <td class="p-4 text-center text-sm font-extrabold text-amber-300 font-mono bg-crt-navy-dark/40">0.0h</td>
                    <td class="p-4 text-center text-base font-black text-crt-cyan bg-crt-navy-dark font-mono border-l border-crt-navy-light">
                        37.5h
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
