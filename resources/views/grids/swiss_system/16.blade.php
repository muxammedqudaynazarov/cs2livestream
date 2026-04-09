@extends('layouts.app')

@section('content')
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-10 text-center sm:text-left">
            <div
                class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-slate-900 border border-slate-800 rounded-lg text-white font-bold text-xs uppercase tracking-wider shadow-sm">
                <i class="fa-solid fa-chess-board text-blue-400"></i> Swiss system
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Tiykarǵı topar basqıshı</h1>
        </div>
        <div
            class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-x-auto custom-scrollbar p-6 sm:p-10 relative">
            <div class="flex gap-8 sm:gap-12 min-w-max pb-4">

                <div class="flex flex-col w-64 gap-3 relative shrink-0">
                    <div class="text-center mb-5">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Round 1</h3>
                        <span
                            class="text-[10px] font-bold bg-slate-100 text-slate-600 px-3 py-1 rounded-full mt-1.5 inline-block border border-slate-200 shadow-sm">
                            Balans: 0-0
                        </span>
                    </div>
                    @for($i=1; $i<=8; $i++)
                        <div
                            class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden flex flex-col hover:border-slate-400 transition-colors group">
                            <div
                                class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                <span
                                    class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition-colors">Komanda {{ $i*2-1 }}</span>
                                <span class="text-xs font-black text-slate-900">13</span></div>
                            <div class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                <span
                                    class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition-colors">Komanda {{ $i*2 }}</span>
                                <span class="text-xs font-bold text-slate-400">9</span></div>
                        </div>
                    @endfor
                </div>

                <div class="flex flex-col w-64 gap-12 relative shrink-0">
                    <div class="flex flex-col gap-3 relative">
                        <div class="text-center mb-2">
                            <h3 class="text-sm font-black text-blue-600 uppercase tracking-widest">Round 2 (upper)</h3>
                            <span
                                class="text-[10px] font-bold bg-blue-50 text-blue-600 px-3 py-1 rounded-full mt-1.5 inline-block border border-blue-200 shadow-sm">
                                Balans: 1-0
                            </span>
                        </div>
                        @for($i=1; $i<=4; $i++)
                            <div
                                class="bg-white border border-blue-200 rounded-lg shadow-sm overflow-hidden flex flex-col hover:border-blue-400 transition-colors">
                                <div class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100">
                                    <span class="text-xs font-bold text-slate-800">1-0 Komanda</span>
                                    <span class="text-xs font-black text-slate-900">16</span>
                                </div>
                                <div class="flex justify-between items-center px-3 py-2.5 bg-blue-50/50">
                                    <span class="text-xs font-bold text-slate-800">1-0 Komanda</span>
                                    <span class="text-xs font-bold text-slate-400">14</span>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="flex flex-col gap-3 relative">
                        <div class="text-center mb-2">
                            <h3 class="text-sm font-black text-rose-600 uppercase tracking-widest">Round 2 (lower)</h3>
                            <span
                                class="text-[10px] font-bold bg-rose-50 text-rose-600 px-3 py-1 rounded-full mt-1.5 inline-block border border-rose-200 shadow-sm">
                                Balans: 0-1
                            </span>
                        </div>
                        @for($i=1; $i<=4; $i++)
                            <div
                                class="bg-white border border-rose-200 rounded-lg shadow-sm overflow-hidden flex flex-col hover:border-rose-400 transition-colors">
                                <div class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100">
                                    <span class="text-xs font-bold text-slate-800">0-1 Komanda</span>
                                    <span class="text-xs font-black text-slate-900">13</span>
                                </div>
                                <div class="flex justify-between items-center px-3 py-2.5 bg-rose-50/50">
                                    <span class="text-xs font-bold text-slate-800">0-1 Komanda</span>
                                    <span class="text-xs font-bold text-slate-400">7</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="flex flex-col w-64 gap-10 relative shrink-0">

                    <div
                        class="flex flex-col gap-3 relative p-4 bg-emerald-50 rounded-xl border border-emerald-200 shadow-sm">
                        <div class="text-center mb-1">
                            <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">Round 3
                                (upper)</h3>
                            <span
                                class="text-[10px] font-bold bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full mt-1.5 inline-block shadow-sm">
                                <i class="fa-solid fa-star text-amber-500 mr-1"></i> Balans: 2-0
                            </span>
                        </div>
                        @for($i=1; $i<=2; $i++)
                            <div
                                class="bg-white border-2 border-emerald-400 rounded-lg shadow-md overflow-hidden flex flex-col transform hover:scale-[1.02] transition-transform">
                                <div class="flex justify-between items-center px-3 py-3 border-b border-slate-100">
                                    <span class="text-xs font-bold text-slate-800">2-0 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black text-emerald-500">BO3</span>
                                        <span class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center px-3 py-3 bg-emerald-50/30">
                                    <span class="text-xs font-bold text-slate-800">2-0 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black text-emerald-500 opacity-0">BO3</span>
                                        <span class="text-xs font-bold text-slate-400 w-3 text-right">1</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="flex flex-col gap-3 relative">
                        <div class="text-center mb-2">
                            <h3 class="text-sm font-black text-amber-600 uppercase tracking-widest">Round 3
                                (middle)</h3>
                            <span
                                class="text-[10px] font-bold bg-amber-50 text-amber-600 px-3 py-1 rounded-full mt-1.5 inline-block border border-amber-200 shadow-sm">
                                Balans: 1-1
                            </span>
                        </div>
                        @for($i=1; $i<=4; $i++)
                            <div
                                class="bg-white border border-amber-300 rounded-lg shadow-sm overflow-hidden flex flex-col hover:border-amber-500 transition-colors">
                                <div class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100">
                                    <span class="text-xs font-bold text-slate-800">1-1 Komanda</span>
                                    <span class="text-xs font-black text-slate-900">13</span>
                                </div>
                                <div class="flex justify-between items-center px-3 py-2.5 bg-amber-50/50">
                                    <span class="text-xs font-bold text-slate-800">1-1 Komanda</span>
                                    <span class="text-xs font-bold text-slate-400">11</span>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div
                        class="flex flex-col gap-3 relative p-4 bg-rose-50 rounded-xl border border-rose-200 shadow-sm">
                        <div class="text-center mb-1">
                            <h3 class="text-sm font-black text-rose-600 uppercase tracking-widest">Round 3 (lower)</h3>
                            <span
                                class="text-[10px] font-bold bg-rose-100 text-rose-700 px-3 py-1 rounded-full mt-1.5 inline-block shadow-sm">
                                <i class="fa-solid fa-skull text-rose-500 mr-1"></i> Balans: 0-2
                            </span>
                        </div>
                        @for($i=1; $i<=2; $i++)
                            <div
                                class="bg-white border-2 border-rose-400 rounded-lg shadow-md overflow-hidden flex flex-col transform hover:scale-[1.02] transition-transform">
                                <div class="flex justify-between items-center px-3 py-3 border-b border-slate-100">
                                    <span class="text-xs font-bold text-slate-800">0-2 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black text-rose-500">BO3</span>
                                        <span class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center px-3 py-3 bg-rose-50/30">
                                    <span class="text-xs font-bold text-slate-800">0-2 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black opacity-0">BO3</span>
                                        <span class="text-xs font-bold text-slate-400 w-3 text-right">0</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="flex flex-col w-64 gap-16 relative justify-center shrink-0">

                    <div
                        class="flex flex-col gap-3 relative p-4 bg-emerald-50 rounded-xl border border-emerald-200 shadow-sm">
                        <div class="text-center mb-1">
                            <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">Round 4
                                (upper)</h3>
                            <span
                                class="text-[10px] font-bold bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full mt-1.5 inline-block shadow-sm">
                                <i class="fa-solid fa-star text-amber-500 mr-1"></i> Balans: 2-1
                            </span>
                        </div>
                        @for($i=1; $i<=3; $i++)
                            <div
                                class="bg-white border-2 border-emerald-400 rounded-lg shadow-md overflow-hidden flex flex-col transform hover:scale-[1.02] transition-transform">
                                <div class="flex justify-between items-center px-3 py-3 border-b border-slate-100">
                                    <span class="text-xs font-bold text-slate-800">2-1 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black text-emerald-500">BO3</span>
                                        <span class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center px-3 py-3 bg-emerald-50/30">
                                    <span class="text-xs font-bold text-slate-800">2-1 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black opacity-0">BO3</span>
                                        <span class="text-xs font-bold text-slate-400 w-3 text-right">1</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div
                        class="flex flex-col gap-3 relative p-4 bg-rose-50 rounded-xl border border-rose-200 shadow-sm">
                        <div class="text-center mb-1">
                            <h3 class="text-sm font-black text-rose-600 uppercase tracking-widest">Round 4 (lower)</h3>
                            <span
                                class="text-[10px] font-bold bg-rose-100 text-rose-700 px-3 py-1 rounded-full mt-1.5 inline-block shadow-sm">
                                <i class="fa-solid fa-skull text-rose-500 mr-1"></i> Balans: 1-2
                            </span>
                        </div>
                        @for($i=1; $i<=3; $i++)
                            <div
                                class="bg-white border-2 border-rose-400 rounded-lg shadow-md overflow-hidden flex flex-col transform hover:scale-[1.02] transition-transform">
                                <div class="flex justify-between items-center px-3 py-3 border-b border-slate-100">
                                    <span class="text-xs font-bold text-slate-800">1-2 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black text-rose-500">BO3</span>
                                        <span class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center px-3 py-3 bg-rose-50/30">
                                    <span class="text-xs font-bold text-slate-800">1-2 Komanda</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black opacity-0">BO3</span>
                                        <span class="text-xs font-bold text-slate-400 w-3 text-right">0</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="flex flex-col w-64 relative justify-center shrink-0">
                    <div
                        class="flex flex-col gap-3 relative p-5 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border-2 border-indigo-300 shadow-lg relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 text-indigo-100 opacity-50 pointer-events-none">
                            <i class="fa-solid fa-trophy text-9xl"></i>
                        </div>
                        <div class="text-center mb-2 mt-1 relative z-10">
                            <div
                                class="inline-block px-3 py-1 bg-indigo-600 text-white text-[10px] font-black uppercase rounded-full shadow-sm mb-2">
                                <i class="fa-solid fa-fire text-amber-400 mr-1"></i> Sońǵı imkaniyat
                            </div>
                            <h3 class="text-sm font-black text-indigo-900 uppercase tracking-widest">Round 5</h3>
                            <span
                                class="text-[11px] font-bold bg-white text-indigo-700 px-3 py-1 rounded-full mt-2 inline-block border border-indigo-200 shadow-sm">
                                Balans: 2-2
                            </span>
                        </div>
                        <div class="relative z-10 space-y-3">
                            @for($i=1; $i<=3; $i++)
                                <div
                                    class="bg-white border-2 border-indigo-400 rounded-xl shadow-md overflow-hidden flex flex-col transform hover:-translate-y-1 transition-all">
                                    <div class="flex justify-between items-center px-4 py-3 border-b border-indigo-100">
                                        <span class="text-xs font-bold text-slate-800">2-2 Komanda</span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black text-indigo-600">BO3</span>
                                            <span class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center px-4 py-3 bg-indigo-50/50">
                                        <span class="text-xs font-bold text-slate-800">2-2 Komanda</span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black opacity-0">BO3</span>
                                            <span class="text-xs font-bold text-slate-400 w-3 text-right">1</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-trophy"></i></div>
                <div>
                    <h4 class="text-sm font-black text-emerald-900">Pley-off ótiw</h4>
                    <p class="text-xs font-medium text-emerald-700 mt-1">
                        Jámi 8 komanda 3 oyındı utıw arqalı pley-off basqıshqa shıǵadı.
                    </p>
                </div>
            </div>
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-5 flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-plane-departure"></i></div>
                <div>
                    <h4 class="text-sm font-black text-rose-900">Turnirdi tárk etiwshiler</h4>
                    <p class="text-xs font-medium text-rose-700 mt-1">
                        Jámi 8 komanda 3 oyında utılǵanlar turnir menen xoshlasadı.
                    </p>
                </div>
            </div>
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-5 flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-gamepad"></i></div>
                <div>
                    <h4 class="text-sm font-black text-indigo-900">Format (BO1 & BO3)</h4>
                    <p class="text-xs font-medium text-indigo-700 mt-1">
                        Dáslepki oyınlar BO1, pley-off yamasa shıǵıp ketiw oyınları BO3 formatında boladı.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 12px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
            border: 3px solid #f8fafc;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .shrink-0 {
            flex-shrink: 0;
        }
    </style>
@endsection
