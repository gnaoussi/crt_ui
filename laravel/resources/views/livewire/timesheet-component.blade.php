<div className="p-6 space-y-6 max-w-[1600px] mx-auto w-full">
    <div className="bg-white rounded-2xl border p-6 shadow-sm">
        <h3 className="text-sm font-extrabold text-crt-navy mb-4">📑 Feuille de temps hebdomadaire (Livewire)</h3>
        <table className="w-full text-left text-xs border-collapse">
            <thead><tr className="bg-slate-100 uppercase font-extrabold"><th className="p-3">Client</th><th className="p-3">Tâche</th></tr></thead>
            <tbody>
                @foreach ($clients as $c)
                    @foreach ($c->tasks as $t)
                        <tr className="border-b"><td className="p-3 font-bold">{{ $c->name }}</td><td className="p-3">{{ $t->name }}</td></tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
