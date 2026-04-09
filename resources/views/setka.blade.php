@extends('layouts.app')

@section('content')
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-10 text-center sm:text-left flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-slate-900 border border-slate-800 rounded-lg text-white font-bold text-xs uppercase tracking-wider shadow-sm">
                    <i class="fa-solid fa-sync text-blue-400"></i> Round Robin (Liga) Formati
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Tiykarǵı Liga Basqıshı</h1>
                <p class="text-sm font-medium text-slate-500 mt-1">8 komandalıq liga. Hár komanda bir-biri menen 1 martadan oynap shıǵadı.</p>
            </div>

            <div class="flex gap-3 flex-wrap">
                <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg shadow-sm">
                    <div class="w-2 h-2 inline-block bg-emerald-500 rounded-full mr-1"></div> Top-4 (Pley-off)
                </span>
                <span class="text-[11px] font-bold text-rose-700 bg-rose-50 border border-rose-200 px-3 py-1.5 rounded-lg shadow-sm">
                    <i class="fa-solid fa-plane-departure mr-1"></i> Shıǵıp ketiw
                </span>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden mb-12">
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg shadow-inner">
                    <i class="fa-solid fa-list-ol"></i>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Turnir Kestesi</h3>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Top-4 komanda kiyingi basqıshqa ótedi</p>
                </div>
            </div>

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                    <tr class="bg-white text-[11px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-100">
                        <th class="px-6 py-4 w-12 text-center">#</th>
                        <th class="px-4 py-4">Komanda</th>
                        <th class="px-3 py-4 text-center" title="Oynalǵan oyınlar">O</th>
                        <th class="px-3 py-4 text-center text-emerald-500" title="Ǵalaba">Ǵ</th>
                        <th class="px-3 py-4 text-center text-rose-500" title="Maǵlubiyat">M</th>
                        <th class="px-3 py-4 text-center text-indigo-400" title="Raundlar parqı (+/-)">+/-</th>
                        <th class="px-6 py-4 text-center font-black text-blue-600 text-sm" title="Ochko">Ochko</th>
                    </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                    @for($i=1; $i<=8; $i++)
                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/80 transition-colors {{ $i <= 4 ? 'bg-emerald-50/20' : '' }}">
                            <td class="px-6 py-3.5 text-center relative">
                                @if($i <= 4)
                                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-emerald-500"></div>
                                @endif
                                <span class="w-6 h-6 inline-flex items-center justify-center rounded-md {{ $i <= 4 ? 'bg-emerald-100 text-emerald-700 font-black' : 'text-slate-400 font-bold' }}">
                                        {{ $i }}
                                    </span>
                            </td>

                            <td class="px-4 py-3.5 font-bold text-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-black text-slate-400 shadow-sm">
                                        T{{ $i }}
                                    </div>
                                    <span>Komanda {{ $i }}</span>
                                </div>
                            </td>

                            <td class="px-3 py-3.5 text-center text-slate-500">7</td>
                            <td class="px-3 py-3.5 text-center font-bold text-emerald-600">{{ 8 - $i }}</td>
                            <td class="px-3 py-3.5 text-center font-bold text-rose-500">{{ $i - 1 }}</td>
                            <td class="px-3 py-3.5 text-center font-bold {{ $i <= 4 ? 'text-indigo-500' : 'text-slate-400' }}">
                                {{ $i <= 4 ? '+' : '' }}{{ (8 - $i) * 5 - ($i * 2) }}
                            </td>

                            <td class="px-6 py-3.5 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-8 rounded-lg bg-slate-100 font-black text-slate-900 shadow-inner">
                                        {{ (8 - $i) * 3 }}
                                    </span>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pt-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-600 flex items-center justify-center text-lg shadow-inner border border-blue-200">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Oyınlar Kestesi</h2>
                    <p class="text-[11px] font-bold text-slate-500 mt-0.5 uppercase tracking-wider">Jámi 7 tur oyanladı</p>
                </div>
            </div>

            <div class="flex gap-2 overflow-x-auto pb-4 custom-scrollbar mb-6">
                <button class="px-6 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-sm shadow-md whitespace-nowrap transform scale-105 transition-transform">1-Tur</button>
                @for($t=2; $t<=7; $t++)
                    <button class="px-6 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-blue-600 font-bold text-sm transition-all whitespace-nowrap shadow-sm">
                        {{ $t }}-Tur
                    </button>
                @endfor
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @for($match=1; $match<=4; $match++)
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col hover:border-blue-400 hover:shadow-md transition-all group cursor-pointer relative transform hover:-translate-y-1">

                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-slate-200 group-hover:bg-blue-500 transition-colors"></div>

                        <div class="flex justify-between items-center px-5 py-4 border-b border-slate-50">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded bg-slate-100 flex items-center justify-center text-[9px] font-black text-slate-400">T{{ $match*2 - 1 }}</span>
                                <span class="text-sm font-bold text-slate-800">Komanda {{ $match*2-1 }}</span>
                            </div>
                            <span class="text-sm font-black text-slate-900 bg-slate-100 px-3 py-1 rounded-md shadow-inner border border-slate-200">13</span>
                        </div>

                        <div class="flex justify-between items-center px-5 py-4 bg-slate-50/80">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded bg-slate-100 flex items-center justify-center text-[9px] font-black text-slate-400">T{{ $match*2 }}</span>
                                <span class="text-sm font-bold text-slate-500">Komanda {{ $match*2 }}</span>
                            </div>
                            <span class="text-sm font-bold text-slate-400 px-3 py-1">8</span>
                        </div>

                        <div class="bg-white border-t border-slate-100 px-5 py-3 flex justify-between items-center">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide"><i class="fa-regular fa-clock mr-1.5"></i> Búgin, 18:00</span>
                            <span class="text-[10px] font-black text-blue-600 uppercase tracking-wider bg-blue-50 px-2.5 py-1 rounded-md border border-blue-100">Bo1</span>
                        </div>
                    </div>
                @endfor

            </div>

            <div class="mt-8 text-center">
                <button class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:border-slate-300 hover:bg-slate-50 transition-all shadow-sm">
                    Kesteni tolıq kóriw <i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>

        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 8px; width: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; border: 2px solid #fff; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
@endsection
