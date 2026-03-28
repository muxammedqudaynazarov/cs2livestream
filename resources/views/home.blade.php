@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            <img src="{{ Auth::user()->steam_avatar ?? '/images/avatar.jpg' }}" alt="Avatar"
                                 class="w-24 h-24 rounded-full object-cover border-4 border-slate-50 shadow-md">
                            <div
                                class="absolute bottom-0 right-0 w-5 h-5 bg-emerald-500 border-2 border-white rounded-full"
                                title="Online"></div>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">{{ Auth::user()->name }}</h2>
                        <p class="text-sm font-medium text-blue-600 uppercase tracking-widest mt-1">
                            {{ Auth::user()->pos ?? 'oyınshı' }}
                        </p>
                        <div class="w-full mt-6 pt-6 border-t border-slate-100 flex flex-col gap-3 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Steam ID:</span>
                                <span class="font-mono text-slate-800 font-medium">
                                    {{ Auth::user()->id ?? 'anıqlanbaǵan' }}
                                    </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Mámleket:</span>
                                <span class="text-slate-800 font-medium flex items-center gap-2">
                                {{ Auth::user()->country ?? 'UZ' }}
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-shield-halved text-blue-500"></i> Meniń komandam
                        </h3>
                        @if(false)
                            <div class="flex items-center gap-4">
                                <img src="/images/team-logo.png" alt="Team Logo"
                                     class="w-12 h-12 rounded bg-slate-100 border border-slate-200">
                                <div>
                                    <h4 class="font-bold text-slate-900">TUIT Dragons</h4>
                                    <p class="text-xs text-slate-500">Sardor: Siz</p>
                                </div>
                            </div>
                            <a href="#"
                               class="mt-4 w-full block text-center py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 text-sm font-semibold rounded transition-colors border border-slate-200">
                                Komandanı basqarıw
                            </a>
                        @else
                            <div class="text-center py-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-3 text-slate-400">
                                    <i class="fa-solid fa-users-slash text-xl"></i>
                                </div>
                                <p class="text-sm text-slate-500 mb-4">
                                    Siz házirge shekem hesh bir komandaǵa aǵza bolmaǵansız yamasa komanda dúzbegensiz.
                                </p>
                                <a href="#"
                                   class="inline-block w-full text-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-lg transition-colors shadow-sm">
                                    Komanda dúziw
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-5 flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-emerald-500"></i>
                            Meniń reytingim
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center">
                                <span class="block text-2xl font-black text-slate-900">
                                    {{ $userKpi['games'] ?? 0 }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">Oyınlar</span>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center">
                                <span class="block text-2xl font-black text-emerald-600">
                                    {{ number_format(0, 2) }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">K/D ratio</span>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center">
                                <span class="text-2xl font-black text-amber-400">0</span>
                                <span class="text-2xl">/</span>
                                <span class="text-2xl font-black text-amber-700">0</span>
                                <span
                                    class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">
                                    Ulıwma (Kill / Dead)
                                </span>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center">
                                <span class="block text-2xl font-black text-blue-600">0%</span>
                                <span class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">Win Rate</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-file-invoice-dollar text-amber-500"></i>
                                Turnir ushın tólemler
                            </h3>
                        </div>
                        <div class="p-6 text-center text-slate-500">
                            <div class="py-6">
                                <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3"></i>
                                <p class="text-sm">Házirgi waqıtta sizge tiyisli bolǵan invoyslar tabılmadı.</p>
                                <p class="text-xs mt-1 text-slate-400">
                                    Turnir túrine qarap (pullı yamasa pulsız) komandańızdı turnirden dizimnen
                                    ótkerseńiz, invoyslar avtomatikalıq túrde payda boladı.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
