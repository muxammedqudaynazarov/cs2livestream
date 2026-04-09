@extends('layouts.app')

@section('content')
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-10 text-center sm:text-left">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Pley-off Setkası</h1>
            <p class="text-sm font-medium text-slate-500 mt-1">32 komandalıq tiykarǵı final basqıshı</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-x-auto custom-scrollbar pb-10">

            <div class="bracket-container">

                <div class="bracket-column">
                    <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-slate-400 uppercase tracking-widest">
                        1/16 Final</h3>

                    @for($i=1; $i<=16; $i++)
                        <div class="bracket-cell connect-next">
                            <div
                                class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-blue-400 hover:shadow-md transition-all">
                                <div
                                    class="flex items-center justify-between px-3 py-2.5 border-b border-slate-100 bg-white">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-100 flex items-center justify-center text-[9px] font-bold text-slate-500">
                                            T1
                                        </div>
                                        <span class="text-xs font-bold text-slate-800">Komanda {{ $i*2 - 1 }}</span>
                                    </div>
                                    <span class="text-xs font-black text-slate-900">2</span>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2.5 bg-slate-50 opacity-80">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-100 flex items-center justify-center text-[9px] font-bold text-slate-500">
                                            T2
                                        </div>
                                        <span class="text-xs font-bold text-slate-600">Komanda {{ $i*2 }}</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400">0</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="bracket-column">
                    <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-indigo-400 uppercase tracking-widest">
                        1/8 Final</h3>

                    @for($i=1; $i<=8; $i++)
                        <div class="bracket-cell connect-prev connect-next">
                            <div
                                class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-indigo-400 hover:shadow-md transition-all">
                                <div
                                    class="flex items-center justify-between px-3 py-2.5 border-b border-slate-100 bg-white">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-5 h-5 rounded bg-indigo-50 text-indigo-500 flex items-center justify-center text-[10px]">
                                            <i class="fa-solid fa-angles-right"></i></div>
                                        <span class="text-xs font-bold text-slate-800">Jeńimpaz {{ $i*2 - 1 }}</span>
                                    </div>
                                    <span class="text-xs font-black text-slate-900">-</span>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2.5 bg-slate-50">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-100 text-slate-400 flex items-center justify-center text-[10px]">
                                            <i class="fa-solid fa-shield"></i></div>
                                        <span class="text-xs font-bold text-slate-600">Jeńimpaz {{ $i*2 }}</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400">-</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="bracket-column">
                    <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-blue-500 uppercase tracking-widest">
                        1/4 Final</h3>

                    @for($i=1; $i<=4; $i++)
                        <div class="bracket-cell connect-prev connect-next">
                            <div
                                class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-blue-400 hover:shadow-md transition-all">
                                <div
                                    class="flex items-center justify-between px-3 py-2.5 border-b border-slate-100 bg-white">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-5 h-5 rounded bg-blue-50 text-blue-500 flex items-center justify-center text-[10px]">
                                            <i class="fa-solid fa-bolt"></i></div>
                                        <span class="text-xs font-bold text-slate-800">Kúshli {{ $i*2 - 1 }}</span>
                                    </div>
                                    <span class="text-xs font-black text-slate-900">-</span>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2.5 bg-slate-50">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-100 text-slate-400 flex items-center justify-center text-[10px]">
                                            <i class="fa-solid fa-shield"></i></div>
                                        <span class="text-xs font-bold text-slate-600">Kúshli {{ $i*2 }}</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400">-</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="bracket-column">
                    <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-amber-500 uppercase tracking-widest">
                        Yarım Final</h3>

                    @for($i=1; $i<=2; $i++)
                        <div class="bracket-cell connect-prev connect-next">
                            <div
                                class="bg-white border-2 border-slate-200 rounded-lg shadow-md z-10 relative flex flex-col overflow-hidden hover:border-amber-400 transition-all">
                                <div
                                    class="flex items-center justify-between px-4 py-3 border-b border-slate-100 bg-white">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-black text-slate-800">Yarım finalist {{ $i*2 - 1 }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between px-4 py-3 bg-slate-50">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-black text-slate-600">Yarım finalist {{ $i*2 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="bracket-column" style="width: 280px;">
                    <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-rose-500 uppercase tracking-widest">
                        Grand Final</h3>

                    <div class="bracket-cell connect-prev">
                        <div
                            class="bg-white border-2 border-rose-500 rounded-xl shadow-xl z-10 relative flex flex-col overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <div class="bg-rose-500 px-3 py-1.5 text-center shadow-sm">
                            <span class="text-[10px] font-black uppercase text-white tracking-wider">
                               <i class="fa-solid fa-trophy mr-1 text-amber-300"></i> Chempionlıq ushın
                            </span>
                            </div>
                            <div class="flex items-center justify-between px-4 py-4 border-b border-slate-100 bg-white">
                                <span class="text-sm font-black text-slate-900">Finalist 1</span>
                                <span class="text-sm font-black text-rose-600">-</span>
                            </div>
                            <div class="flex items-center justify-between px-4 py-4 bg-slate-50">
                                <span class="text-sm font-black text-slate-700">Finalist 2</span>
                                <span class="text-sm font-black text-slate-400">-</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .bracket-container {
            display: flex;
            min-width: max-content;
            padding: 4rem 1rem 1rem 1rem;
        }

        .bracket-column {
            display: flex;
            flex-direction: column;
            width: 250px;
            position: relative;
        }

        .bracket-cell {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            padding: 0.5rem 1.5rem;
        }

        .connect-next::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            width: 0;
            border-top: 2px solid #cbd5e1;
            z-index: 0;
        }

        .connect-prev::before {
            content: '';
            position: absolute;
            left: -1.75em;
            top: 25%;
            bottom: 25%;
            width: 2.55rem;
            border-right: 2px solid #cbd5e1;
            border-top: 2px solid #cbd5e1;
            border-bottom: 2px solid #cbd5e1;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            z-index: 0;
        }

        .connect-prev::after {
            content: '';
            position: absolute;
            left: 0.75rem;
            top: 50%;
            width: 0.75rem;
            border-top: 2px solid #cbd5e1;
            z-index: 0;
        }

        .connect-next::after, .connect-prev::before, .connect-prev::after {
            transition: border-color 0.3s ease;
        }

        .bracket-cell:hover .connect-next::after,
        .bracket-cell:hover.connect-prev::before,
        .bracket-cell:hover.connect-prev::after {
            border-color: #3b82f6;
        }

        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection
