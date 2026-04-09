@extends('layouts.app')

@section('content')
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div
            class="mb-10 text-center sm:text-left flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-slate-900 border border-slate-800 rounded-lg text-white font-bold text-xs uppercase tracking-wider shadow-sm">
                    <i class="fa-solid fa-sitemap text-blue-400"></i> Double elimination
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Pley-off Setkası</h1>
                <p class="text-sm font-medium text-slate-500 mt-1">
                    Joqarı (upper) hám Tómengi (lower) setkalı qos bazalıq format.</p>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-x-auto custom-scrollbar pb-10">
            <div class="flex flex-col min-w-max p-8 gap-16">
                <div class="relative pt-6 border-t border-dashed border-blue-300">
                    <div
                        class="absolute -top-3 left-4 px-3 py-1 bg-blue-50 border border-blue-200 rounded-md text-blue-700 font-bold text-xs uppercase tracking-wider shadow-sm">
                        Joqarı setka
                    </div>
                    <div class="flex mt-8">
                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-slate-400 uppercase tracking-widest">
                                1/8 Final</h3>
                            @for($i=1; $i<=8; $i++)
                                <div class="bracket-cell connect-next">
                                    <div
                                        class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-blue-400 hover:shadow-md transition-all">
                                        <div
                                            class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                                <span
                                                    class="text-xs font-bold text-slate-800">Komanda {{ $i*2 - 1 }}</span>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-black text-slate-400">BO3</span>
                                                <span
                                                    class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                            <span class="text-xs font-bold text-slate-500">Komanda {{ $i*2 }}</span>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-black opacity-0">BO3</span>
                                                <span
                                                    class="text-xs font-bold text-slate-400 w-3 text-right">0</span>
                                            </div>
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
                                            class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                            <span
                                                class="text-xs font-bold text-slate-800">Jeńimpaz {{ $i*2 - 1 }}</span>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-black text-blue-500">BO3</span>
                                                <span
                                                    class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                                <span
                                                    class="text-xs font-bold text-slate-500">Jeńimpaz {{ $i*2 }}</span>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-black opacity-0">BO3</span>
                                                <span
                                                    class="text-xs font-bold text-slate-400 w-3 text-right">1</span>
                                            </div>
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
                                        class="bg-white border-2 border-amber-200 rounded-lg shadow-md z-10 relative flex flex-col overflow-hidden hover:border-amber-400 transition-all">
                                        <div
                                            class="flex justify-between items-center px-4 py-3 border-b border-slate-100 bg-white">
                                                <span
                                                    class="text-sm font-black text-slate-800">Kúshli {{ $i*2 - 1 }}</span>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-black text-amber-500">BO3</span>
                                                <span
                                                    class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center px-4 py-3 bg-slate-50">
                                            <span class="text-sm font-black text-slate-500">Kúshli {{ $i*2 }}</span>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-black opacity-0">BO3</span>
                                                <span
                                                    class="text-xs font-bold text-slate-400 w-3 text-right">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-indigo-500 uppercase tracking-widest">
                                Joqarı Final</h3>
                            <div class="bracket-cell connect-prev connect-next">
                                <div
                                    class="bg-white border-2 border-indigo-300 rounded-lg shadow-md z-10 relative flex flex-col overflow-hidden hover:border-indigo-500 transition-all">
                                    <div
                                        class="flex justify-between items-center px-4 py-3 border-b border-slate-100 bg-white">
                                        <span class="text-sm font-black text-slate-800">UB Finalist 1</span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black text-indigo-500">BO3</span>
                                            <span class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center px-4 py-3 bg-slate-50">
                                        <span class="text-sm font-black text-slate-500">UB Finalist 2</span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black opacity-0">BO3</span>
                                            <span class="text-xs font-bold text-slate-400 w-3 text-right">1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bracket-column" style="width: 280px;">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-rose-500 uppercase tracking-widest">
                                Grand Final</h3>
                            <div class="bracket-cell connect-prev-straight">
                                <div
                                    class="bg-white border-2 border-rose-500 rounded-xl shadow-xl z-10 relative flex flex-col overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="bg-rose-500 px-3 py-1.5 text-center shadow-sm">
                                        <span class="text-[10px] font-black uppercase text-white tracking-wider">
                                           <i class="fa-solid fa-trophy mr-1 text-amber-300"></i> Chempionlıq ushın (BO5)
                                        </span>
                                    </div>
                                    <div
                                        class="flex justify-between items-center px-4 py-4 border-b border-slate-100 bg-white">
                                            <span
                                                class="text-sm font-black text-slate-900">Joqarı Setka Jeńimpazı</span>
                                        <span class="text-sm font-black text-rose-600">3</span>
                                    </div>
                                    <div class="flex justify-between items-center px-4 py-4 bg-slate-50">
                                            <span
                                                class="text-sm font-black text-slate-700">Tómengi Setka Jeńimpazı</span>
                                        <span class="text-sm font-black text-slate-400">1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative pt-6 border-t border-dashed border-slate-300">
                    <div
                        class="absolute -top-3 left-4 px-3 py-1 bg-rose-50 border border-rose-200 rounded-md text-rose-700 font-bold text-xs uppercase tracking-wider shadow-sm">
                        Tómengi setka
                    </div>

                    <div class="flex mt-8">
                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-slate-400 uppercase tracking-widest">
                                LB 1-basqısh</h3>
                            @for($i=1; $i<=4; $i++)
                                <div class="bracket-cell connect-next">
                                    <div
                                        class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-rose-400 transition-all">
                                        <div
                                            class="flex justify-between items-center px-3 py-2 border-b border-slate-100 bg-white">
                                            <span
                                                class="text-[11px] font-bold text-slate-800">1/8 Yutqazǵan {{ $i*2 - 1 }}</span>
                                            <span class="text-xs font-black text-slate-900">2</span>
                                        </div>
                                        <div class="flex justify-between items-center px-3 py-2 bg-slate-50">
                                            <span
                                                class="text-[11px] font-bold text-slate-500">1/8 Yutqazǵan {{ $i*2 }}</span>
                                            <span class="text-xs font-bold text-slate-400">1</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-slate-400 uppercase tracking-widest">
                                LB 2-basqısh</h3>
                            @for($i=1; $i<=4; $i++)
                                <div class="bracket-cell connect-prev-straight connect-next">
                                    <div
                                        class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-rose-400 transition-all">
                                        <div
                                            class="flex justify-between items-center px-3 py-2 border-b border-slate-100 bg-white">
                                            <span
                                                class="text-[11px] font-bold text-slate-800">1/4 Yutqazǵan {{ $i }}</span>
                                            <span class="text-xs font-black text-slate-900">2</span>
                                        </div>
                                        <div class="flex justify-between items-center px-3 py-2 bg-blue-50/30">
                                            <span class="text-[11px] font-bold text-blue-600">LB 1 Jeńimpazı</span>
                                            <span class="text-xs font-bold text-slate-400">0</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-slate-400 uppercase tracking-widest">
                                LB 3-basqısh</h3>
                            @for($i=1; $i<=2; $i++)
                                <div class="bracket-cell connect-prev connect-next">
                                    <div
                                        class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-rose-400 transition-all">
                                        <div
                                            class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                            <span
                                                class="text-xs font-bold text-slate-800">Jeńimpaz {{ $i*2 - 1 }}</span>
                                            <span class="text-xs font-black text-slate-900">2</span>
                                        </div>
                                        <div class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                                <span
                                                    class="text-xs font-bold text-slate-500">Jeńimpaz {{ $i*2 }}</span>
                                            <span class="text-xs font-bold text-slate-400">1</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-slate-400 uppercase tracking-widest">
                                LB 4-basqısh</h3>
                            @for($i=1; $i<=2; $i++)
                                <div class="bracket-cell connect-prev-straight connect-next">
                                    <div
                                        class="bg-white border border-slate-200 rounded-lg shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-rose-400 transition-all">
                                        <div
                                            class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                            <span
                                                class="text-[11px] font-bold text-slate-800">Y.Final Yutqazǵan {{ $i }}</span>
                                            <span class="text-xs font-black text-slate-900">2</span>
                                        </div>
                                        <div class="flex justify-between items-center px-3 py-2.5 bg-blue-50/30">
                                            <span class="text-[11px] font-bold text-blue-600">LB 3 Jeńimpazı</span>
                                            <span class="text-xs font-bold text-slate-400">0</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-amber-500 uppercase tracking-widest">
                                LB Yarım Final</h3>
                            <div class="bracket-cell connect-prev connect-next">
                                <div
                                    class="bg-white border-2 border-slate-200 rounded-lg shadow-md z-10 relative flex flex-col overflow-hidden hover:border-amber-400 transition-all">
                                    <div
                                        class="flex justify-between items-center px-4 py-3 border-b border-slate-100 bg-white">
                                        <span class="text-sm font-black text-slate-800">Kúshli 1</span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black text-amber-500">BO3</span>
                                            <span class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center px-4 py-3 bg-slate-50">
                                        <span class="text-sm font-black text-slate-500">Kúshli 2</span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black opacity-0">BO3</span>
                                            <span class="text-xs font-bold text-slate-400 w-3 text-right">1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bracket-column">
                            <h3 class="absolute -top-6 w-full text-center text-[11px] font-black text-rose-500 uppercase tracking-widest">
                                Tómengi Final</h3>
                            <div class="bracket-cell connect-prev-straight">
                                <div
                                    class="bg-white border-2 border-rose-200 rounded-lg shadow-md z-10 relative flex flex-col overflow-hidden hover:border-rose-400 transition-all">
                                    <div
                                        class="flex justify-between items-center px-4 py-3 border-b border-slate-100 bg-white">
                                            <span
                                                class="text-xs font-black text-slate-800">Joqarı Final Yutqazǵanı</span>
                                        <span class="text-xs font-black text-slate-900">2</span>
                                    </div>
                                    <div class="flex justify-between items-center px-4 py-3 bg-blue-50/30">
                                        <span class="text-xs font-black text-blue-600">LB Y.Final Jeńimpazı</span>
                                        <span class="text-xs font-bold text-slate-400">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
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

        /* O'ngga chiquvchi chiziq */
        .connect-next::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            width: 0;
            border-top: 2px solid #cbd5e1;
            z-index: 0;
        }

        /* Birlashtiruvchi chiziq ( ] shaklida ) */
        .connect-prev::before {
            content: '';
            position: absolute;
            left: -2em;
            top: 25%;
            bottom: 25%;
            width: 2.75rem;
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
            width: 2.75rem;
            border-top: 2px solid #cbd5e1;
            z-index: 0;
        }

        /* To'g'ri kiruvchi chiziq (Double Elimination uchun) */
        .connect-prev-straight::before {
            content: '';
            position: absolute;
            left: -2em;
            top: 50%;
            width: 3.5rem;
            border-top: 2px solid #cbd5e1;
            z-index: 0;
        }

        /* Hover animatsiyalari */
        .connect-next::after, .connect-prev::before, .connect-prev::after, .connect-prev-straight::before {
            transition: border-color 0.3s ease;
        }

        .bracket-cell:hover .connect-next::after,
        .bracket-cell:hover.connect-prev::before,
        .bracket-cell:hover.connect-prev::after,
        .bracket-cell:hover .connect-prev-straight::before {
            border-color: #3b82f6;
        }

        /* Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            height: 10px;
            width: 10px;
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
