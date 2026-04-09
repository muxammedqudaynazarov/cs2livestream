@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 text-slate-800 font-sans">

        <div class="bg-white border-b border-slate-200 shadow-sm relative overflow-hidden">
            <div
                class="absolute top-0 right-0 -mt-16 -mr-16 w-64 h-64 bg-amber-100 rounded-full opacity-50 blur-3xl"></div>
            <div
                class="absolute bottom-0 left-0 -mb-16 -ml-16 w-48 h-48 bg-blue-100 rounded-full opacity-50 blur-2xl"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center relative z-10">
                <span class="text-sm font-bold tracking-widest text-blue-600 uppercase mb-3 block">
                    Qaraqalpaq mámleketlik universiteti
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 uppercase">
                    CS2DevCUP <span class="text-amber-500">kibersport</span> turniri
                </h1>
                <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto mb-8">
                    Counter-Strike 2 boyınsha Qaraqalpaq mámleketlik universiteti Matematika fakultetinde ótkerilip
                    atırǵan keń kólemli turnir. Komandańızdı toplań, háreket etiń hám champion atanıń! </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#"
                       class="px-8 py-3 text-base font-bold rounded-lg bg-amber-500 text-white hover:bg-amber-600 transition-colors shadow-md hover:shadow-lg">
                        Turnirge qosılıw
                    </a>
                    <a href="#"
                       class="px-8 py-3 text-base font-bold rounded-lg bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-500 hover:text-blue-600 transition-colors">
                        Reytingti kóriw
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
            @if(count($liveGames))
                <section>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-8 bg-red-500 rounded-full"></div>
                        <h2 class="text-2xl font-bold uppercase tracking-wide text-slate-900">Jonli O'yinlar</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($liveGames as $game)
                            <div
                                class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                                <div class="absolute top-4 right-4 flex items-center gap-2">
                                    <span class="text-xs font-bold text-red-500 uppercase tracking-widest">Live</span>
                                    <span class="flex h-2.5 w-2.5 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                            </span>
                                </div>

                                <div class="flex justify-between items-center mt-6 mb-2">
                                    <div class="text-center w-1/3 flex flex-col items-center">
                                        <img src="{{ $game->team1->logo ?? '/images/default-team.png' }}" alt="Team 1"
                                             class="w-14 h-14 rounded-full bg-slate-100 border border-slate-200 mb-2 object-cover">
                                        <h3 class="font-bold text-sm text-slate-800 truncate w-full">{{ $game->team1->name }}</h3>
                                    </div>

                                    <div class="text-center w-1/3">
                                        <div
                                            class="text-3xl font-black text-slate-900 bg-slate-50 px-3 py-1 rounded-lg border border-slate-100">
                                            {{ $game->team_1_score }} <span
                                                class="text-slate-400 font-medium mx-1">:</span> {{ $game->team_2_score }}
                                        </div>
                                        <span
                                            class="text-[10px] font-bold text-slate-500 uppercase mt-2 block">{{ $game->format }}</span>
                                    </div>

                                    <div class="text-center w-1/3 flex flex-col items-center">
                                        <img src="{{ $game->team2->logo ?? '/images/default-team.png' }}" alt="Team 2"
                                             class="w-14 h-14 rounded-full bg-slate-100 border border-slate-200 mb-2 object-cover">
                                        <h3 class="font-bold text-sm text-slate-800 truncate w-full">{{ $game->team2->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="col-span-full flex flex-col items-center justify-center py-12 bg-white rounded-xl border border-slate-200 border-dashed text-slate-400">
                                <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <p class="font-medium">Hozircha jonli efirda o'yinlar yo'q</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-blue-500 rounded-full"></div>
                        <h2 class="text-2xl font-bold uppercase tracking-wide text-slate-900">
                            Rejelestirilgen turnirler
                        </h2>
                    </div>
                    <div class="space-y-4">
                        @foreach($activeTournaments as $tournament)
                            <div
                                class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4 hover:border-blue-300 transition-colors">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span
                                            class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-700 uppercase">Ro'yxatdan o'tish ochiq</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $tournament->name }}</h3>
                                    <p class="text-sm text-slate-500 flex items-center gap-4">
                                        <span><i class="fas fa-sitemap mr-1"></i> {{ $tournament->type }}</span>
                                        <span><i
                                                class="fas fa-users mr-1"></i> {{ $tournament->max_teams }} jamoa</span>
                                    </p>
                                </div>
                                <div
                                    class="text-left sm:text-right w-full sm:w-auto border-t sm:border-t-0 border-slate-100 pt-4 sm:pt-0">
                                    <p class="text-xs text-slate-500 mb-2 uppercase font-semibold">Boshlanish sanasi</p>
                                    <p class="text-sm font-bold text-slate-800 mb-3">{{ \Carbon\Carbon::parse($tournament->started_at)->format('d.m.Y - H:i') }}</p>
                                    <a href="#"
                                       class="block w-full text-center px-5 py-2 bg-slate-900 text-white hover:bg-blue-600 transition-colors rounded-lg font-medium text-sm">Batafsil</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-8">
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-2 h-8 bg-emerald-500 rounded-full"></div>
                            <h2 class="text-xl font-bold uppercase tracking-wide text-slate-900">
                                Eń nátiyjeli oyınshılar
                            </h2>
                        </div>
                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                            <ul class="divide-y divide-slate-100">
                                @foreach($topPlayers as $index => $player)
                                    <li class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <span class="text-slate-400 font-bold w-4">{{ $index + 1 }}</span>
                                            <img src="{{ $player->user->stream_avatar ?? '/images/avatar.jpg' }}"
                                                 alt="Avatar"
                                                 class="w-8 h-8 rounded-full border border-slate-200 object-cover">
                                            <div>
                                                <p class="font-bold text-slate-800 text-sm leading-tight">{{ $player->user->name }}</p>
                                                <p class="text-[10px] text-slate-500 uppercase">{{ $player->team->tag ?? 'Erkin agent' }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="block text-emerald-600 font-black">{{ $player->kills }}</span>
                                            <span class="text-[9px] text-slate-400 uppercase font-bold">Kills</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
