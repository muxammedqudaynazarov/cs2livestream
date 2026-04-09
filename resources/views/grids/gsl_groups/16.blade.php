@extends('layouts.app')

@section('content')
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div
            class="mb-10 text-center sm:text-left flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-slate-900 border border-slate-800 rounded-lg text-white font-bold text-xs uppercase tracking-wider shadow-sm">
                    <i class="fa-solid fa-layer-group text-blue-400"></i> GSL topar basqıshı
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    Tiykarǵı toparlar
                </h1>
                <p class="text-sm font-medium text-slate-500 mt-1">
                    Uliwma esapta hár toparda 4 komandadan bolǵan topar 4 topar qatnasıwshıları
                    Double GSL elimination formatında oyın alıp baradı.
                </p>
            </div>
        </div>
        @php
            $groups = ['A', 'B', 'C', 'D'];
        @endphp
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-12">
            @foreach($groups as $group)
                <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden flex flex-col">
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-black text-slate-800">Group {{ $group }}</h3>
                        <div
                            class="text-[10px] font-bold bg-white text-slate-500 px-3 py-1.5 rounded-md shadow-sm border border-slate-200 uppercase tracking-wider">
                            @if($group == 'A')
                                C toparı qarsılası
                            @elseif($group == 'B')
                                D toparı qarsılası
                            @elseif($group == 'C')
                                A toparı qarsılası
                            @elseif($group == 'D')
                                B toparı qarsılası
                            @endif
                        </div>
                    </div>

                    <div class="custom-scrollbar p-6">
                        <div class="bracket-container">
                            <div class="flex flex-col mb-2 relative">
                                <h4 class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2 px-4">
                                    Joqarı setka</h4>
                                <div class="flex">
                                    <div class="bracket-column">
                                        @for($i = 1; $i <= 2; $i++)
                                            <div class="bracket-cell connect-next">
                                                <div
                                                    class="bg-white border border-slate-200 rounded-xl shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-blue-400 hover:shadow-md transition-all">
                                                    <div
                                                        class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                                        <span
                                                            class="text-xs font-bold text-slate-800">Komanda {{ $i*2 - 1 }}</span>
                                                        <div class="flex items-center gap-1.5">
                                                            <span
                                                                class="text-[9px] font-black text-slate-400">BO1</span>
                                                            <span
                                                                class="text-xs font-black text-slate-900 w-3 text-right">13</span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                                        <span
                                                            class="text-xs font-bold text-slate-500">Komanda {{ $i*2 }}</span>
                                                        <div class="flex items-center gap-1.5">
                                                            <span class="text-[9px] font-black opacity-0">BO1</span>
                                                            <span
                                                                class="text-xs font-bold text-slate-400 w-3 text-right">9</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                    <div class="bracket-column justify-center">
                                        <div class="bracket-cell connect-prev connect-next">
                                            <div
                                                class="bg-white border-2 border-emerald-200 rounded-xl shadow-md z-10 relative flex flex-col overflow-hidden hover:border-emerald-400 transition-all">
                                                <div class="bg-emerald-50 px-3 py-1 border-b border-emerald-100">
                                                    <span
                                                        class="text-[9px] font-black uppercase text-emerald-600 tracking-wider">Balans: 1-0</span>
                                                </div>
                                                <div
                                                    class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                                    <span class="text-xs font-bold text-slate-800">Jeńimpaz 1</span>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-[9px] font-black text-emerald-500">BO3</span>
                                                        <span
                                                            class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                                    <span class="text-xs font-bold text-slate-500">Jeńimpaz 2</span>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-[9px] font-black opacity-0">BO3</span>
                                                        <span
                                                            class="text-xs font-bold text-slate-400 w-3 text-right">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bracket-column justify-center w-[140px]">
                                        <div class="bracket-cell connect-prev-straight">
                                            <div
                                                class="bg-emerald-500 text-white rounded-xl shadow-md px-4 py-3 text-center transform hover:scale-105 transition-transform z-10 relative">
                                                <i class="fa-solid fa-trophy text-amber-300 mb-1 text-lg"></i>
                                                <div class="text-xs font-black uppercase tracking-wider">1-orın</div>
                                                <div class="text-[9px] font-medium mt-0.5 opacity-90">
                                                    Pley-offqa shıqtı
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col relative border-t border-dashed border-slate-200 pt-4 mt-2">
                                <h4 class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-2 px-4">
                                    Tómengi setka</h4>
                                <div class="flex">
                                    <div class="bracket-column justify-center">
                                        <div class="bracket-cell connect-next">
                                            <div
                                                class="bg-white border-2 border-rose-200 rounded-xl shadow-sm z-10 relative flex flex-col overflow-hidden hover:border-rose-400 transition-all">
                                                <div class="bg-rose-50 px-3 py-1 border-b border-rose-100">
                                                    <span
                                                        class="text-[9px] font-black uppercase text-rose-600 tracking-wider">
                                                        Balans: 0-1
                                                    </span>
                                                </div>
                                                <div
                                                    class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                                    <span class="text-xs font-bold text-slate-800">Maǵlub 1</span>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-[9px] font-black text-rose-500">BO3</span>
                                                        <span
                                                            class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                                    <span class="text-xs font-bold text-slate-500">Maǵlub 2</span>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-[9px] font-black opacity-0">BO3</span>
                                                        <span
                                                            class="text-xs font-bold text-slate-400 w-3 text-right">1</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bracket-column justify-center">
                                        <div class="bracket-cell connect-prev-straight connect-next">
                                            <div
                                                class="bg-white border-2 border-blue-200 rounded-xl shadow-md z-10 relative flex flex-col overflow-hidden hover:border-blue-400 transition-all">
                                                <div class="bg-blue-50 px-3 py-1 border-b border-blue-100">
                                                    <span
                                                        class="text-[9px] font-black uppercase text-blue-600 tracking-wider">
                                                        Balans: 1-1
                                                    </span>
                                                </div>
                                                <div
                                                    class="flex justify-between items-center px-3 py-2.5 border-b border-slate-100 bg-white">
                                                    <span class="text-[11px] font-bold text-emerald-600">Winners M. Maǵlubı</span>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-[9px] font-black text-blue-500">BO3</span>
                                                        <span
                                                            class="text-xs font-black text-slate-900 w-3 text-right">2</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center px-3 py-2.5 bg-slate-50">
                                                    <span class="text-[11px] font-bold text-rose-600">Elimination M. Jeńimpazı</span>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-[9px] font-black opacity-0">BO3</span>
                                                        <span
                                                            class="text-xs font-bold text-slate-400 w-3 text-right">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bracket-column justify-center w-[140px]">
                                        <div class="bracket-cell connect-prev-straight">
                                            <div
                                                class="bg-blue-500 text-white rounded-xl shadow-md px-4 py-3 text-center transform hover:scale-105 transition-transform z-10 relative">
                                                <i class="fa-solid fa-medal text-slate-200 mb-1 text-lg"></i>
                                                <div class="text-xs font-black uppercase tracking-wider">
                                                    2-orın
                                                </div>
                                                <div class="text-[9px] font-medium mt-0.5 opacity-90">
                                                    Pley-offqa shıqtı
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-trophy"></i></div>
                <div>
                    <h4 class="text-sm font-black text-emerald-900">
                        Winners Match
                    </h4>
                    <p class="text-xs font-medium text-emerald-700 mt-1">
                        Dáslepki 2 oyında utqan komanda tuwrıdan-tuwrı 1-orın menen Pley-off basqıshına shıǵadı.
                    </p>
                </div>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-bolt"></i></div>
                <div>
                    <h4 class="text-sm font-black text-blue-900">Decider Match</h4>
                    <p class="text-xs font-medium text-blue-700 mt-1">
                        Sheshiwshi oyında utqan komanda 2-orın menen Pley-off basqıshına jollanba aladı.
                    </p>
                </div>
            </div>
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-5 flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-plane-departure"></i></div>
                <div>
                    <h4 class="text-sm font-black text-rose-900">Elimination Match</h4>
                    <p class="text-xs font-medium text-rose-700 mt-1">
                        Topar basqıshında 2 márte jeńilgen komanda turnirden shıǵıp ketedi.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bracket-container {
            display: flex;
            flex-direction: column;
            min-width: max-content;
        }

        .bracket-column {
            display: flex;
            flex-direction: column;
            width: 240px;
            position: relative;
        }

        .bracket-cell {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            padding: 0.75rem 1.25rem;
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
            left: -3em;
            top: 25%;
            bottom: 25%;
            width: 3.6rem;
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
            left: 0.6rem;
            top: 50%;
            width: 3.65rem;
            border-top: 2px solid #cbd5e1;
            z-index: 0;
        }

        .connect-prev-straight::before {
            content: '';
            position: absolute;
            left: -2em;
            top: 50%;
            width: 4.25rem;
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
            height: 8px;
            width: 8px;
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
