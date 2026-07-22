<div className="p-6 space-y-6 max-w-[1600px] mx-auto w-full">
    <div className="bg-white rounded-2xl border p-6 shadow-sm space-y-5">
        <h3 className="text-sm font-extrabold text-crt-navy">🏢 Informations Entreprise & Sites</h3>
        <div className="overflow-x-auto">
            <table className="w-full text-left text-xs border-collapse">
                <thead><tr className="bg-slate-100 uppercase font-extrabold"><th className="p-3">Nom</th><th className="p-3">Adresse</th><th className="p-3">Téléphone</th></tr></thead>
                <tbody>
                    @foreach ($sites as $site)
                        <tr className="border-b"><td className="p-3 font-extrabold text-crt-navy">{{ $site->name }}</td><td className="p-3">{{ $site->address }}</td><td className="p-3 font-mono">{{ $site->phone }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
