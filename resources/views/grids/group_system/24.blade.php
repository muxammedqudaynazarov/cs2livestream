@extends('layouts.app')

@section('content')
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div
            class="mb-10 text-center sm:text-left flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-slate-900 border border-slate-800 rounded-lg text-white font-bold text-xs uppercase tracking-wider shadow-sm">
                    <i class="fa-solid fa-layer-group text-blue-400"></i> Topar basqıshı (24 komanda)
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Tiykarǵı toparlar</h1>
                <p class="text-sm font-medium text-slate-500 mt-1">
                    Hár toparda 6 komanda. Eń kúshli 2 komanda pley-off (1/4 final) basqıshına shıǵadı.
                </p>
            </div>
        </div>
        @php
            $groups = ['A', 'B', 'C', 'D'];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
            @foreach($groups as $group)
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col">
                    <div class="bg-slate-50 border-b border-slate-200 px-4 py-3 flex justify-between items-center">
                        <h3 class="text-lg font-black text-slate-800">Group {{ $group }}</h3>
                        <span
                            class="text-[10px] font-bold bg-white text-slate-500 px-2 py-1 rounded shadow-sm border border-slate-200 uppercase">
                            @if($group == 'A')
                                C toparı qarsılası
                            @elseif($group == 'B')
                                D toparı qarsılası
                            @elseif($group == 'C')
                                A toparı qarsılası
                            @elseif($group == 'D')
                                B toparı qarsılası
                            @endif
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                            <tr class="bg-white text-[10px] uppercase tracking-wider text-slate-400 font-bold border-b border-slate-100">
                                <th class="px-4 py-2 w-8 text-center">#</th>
                                <th class="px-3 py-2">Komanda</th>
                                <th class="px-2 py-2 text-center text-emerald-500" title="Jeńdi">J</th>
                                <th class="px-2 py-2 text-center text-rose-500" title="Utılǵan">U</th>
                                <th class="px-4 py-2 text-center font-black text-blue-600" title="Ochko">O</th>
                            </tr>
                            </thead>
                            <tbody class="text-sm font-medium">
                            @for($i = 1; $i <= 6; $i++)
                                <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors {{ $i <= 2 ? 'bg-emerald-50/30' : '' }}">
                                    <td class="px-2 py-2.5 text-center relative">
                                        @if($i <= 2)
                                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500"></div>
                                        @endif
                                        <span class="{{ $i <= 2 ? 'text-emerald-600 font-bold' : 'text-slate-400' }}">
                                            {{ $i }}
                                        </span>
                                    </td>

                                    <td class="px-3 py-2.5 font-bold text-slate-800 whitespace-nowrap">
                                        Komanda {{ $group }}{{ $i }}
                                    </td>
                                    <td class="px-2 py-2.5 text-center font-bold text-emerald-600">{{ 5 - $i }}</td>
                                    <td class="px-2 py-2.5 text-center text-rose-500">{{ $i - 1 }}</td>

                                    <td class="px-4 py-2.5 text-center font-black text-slate-900 bg-slate-50/50">{{ (5 - $i) * 3 }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="pt-8 border-t border-slate-200">
            <div class="flex items-center gap-3 mb-8">
                <div
                    class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg shadow-inner">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Oyınlar kestesi</h2>
            </div>

            <div class="flex gap-2 overflow-x-auto pb-4 custom-scrollbar mb-6">
                <button
                    class="px-5 py-2 rounded-lg bg-slate-900 text-white font-bold text-sm shadow-sm whitespace-nowrap">
                    1-tur
                </button>
                <button
                    class="px-5 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-sm transition-colors whitespace-nowrap">
                    2-tur
                </button>
                <button
                    class="px-5 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-sm transition-colors whitespace-nowrap">
                    3-tur
                </button>
                <button
                    class="px-5 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-sm transition-colors whitespace-nowrap">
                    4-tur
                </button>
                <button
                    class="px-5 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-sm transition-colors whitespace-nowrap">
                    5-tur
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @foreach($groups as $group)
                    <div class="flex flex-col gap-3">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest pl-1">
                            Group {{ $group }}
                        </h4>
                        @for($match=1; $match<=3; $match++)
                            <div
                                class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden flex flex-col hover:border-blue-400 hover:shadow-md transition-all group cursor-pointer relative">
                                <div
                                    class="absolute left-0 top-0 bottom-0 w-1 bg-slate-300 group-hover:bg-blue-500 transition-colors"></div>
                                <div class="flex justify-between items-center px-4 py-3 border-b border-slate-50">
                                    <span class="text-sm font-bold text-slate-800">
                                        Komanda {{ $group }}{{ $match*2-1 }}
                                    </span>
                                    <span class="text-sm font-bold text-slate-400 px-2 py-0.5">0</span>
                                </div>
                                <div class="flex justify-between items-center px-4 py-3 bg-slate-50/50">
                                    <span
                                        class="text-sm font-bold text-slate-500">Komanda {{ $group }}{{ $match*2 }}</span>
                                    <span class="text-sm font-bold text-slate-400 px-2 py-0.5">0</span>
                                </div>
                                <div
                                    class="bg-white border-t border-slate-100 px-4 py-2 flex justify-between items-center">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase"><i
                                            class="fa-regular fa-clock mr-1"></i> 06.04.2026 18:00</span>
                                    <span
                                        class="text-[10px] font-bold text-blue-500 uppercase tracking-wider">BO1</span>
                                </div>
                            </div>
                        @endfor

                    </div>
                @endforeach

            </div>
        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
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
