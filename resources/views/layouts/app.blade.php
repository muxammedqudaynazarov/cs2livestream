<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CS2 DevCUP') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Alpine.js yuklanguncha miltillab qolmasligi uchun */
        [x-cloak] {
            display: none !important;
        }

        /* Toastr uchun kamayib boruvchi progress bar animatsiyasi */
        @keyframes shrink {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }

        .animate-shrink {
            animation: shrink 5s linear forwards;
        }

        .faceit-icon {
            display: inline-block;
            width: 38px;
            height: 38px;
            background-image: url('/images/faceit_lvl.png');
            background-repeat: no-repeat;
        }

        .lvl-0 {
            background-position: 0 0;
        }

        .lvl-1 {
            background-position: -38px 0;
        }

        .lvl-2 {
            background-position: -76px 0;
        }

        .lvl-3 {
            background-position: -114px 0;
        }

        .lvl-4 {
            background-position: -152px 0;
        }

        .lvl-5 {
            background-position: -190px 0;
        }

        .lvl-6 {
            background-position: -228px 0;
        }

        .lvl-7 {
            background-position: -266px 0;
        }

        .lvl-8 {
            background-position: -304px 0;
        }

        .lvl-9 {
            background-position: -342px 0;
        }

        .lvl-10 {
            background-position: -380px 0;
        }

        .lvl-master {
            background-position: -418px 0;
        }
    </style>
    @yield('style')
</head>
<body class="min-h-screen flex flex-col bg-slate-50 relative overflow-x-hidden">
<nav class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-2">
                    <div
                        class="w-8 h-8 bg-blue-600 text-white rounded font-black flex items-center justify-center text-xl">
                        U
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900 hidden sm:block">CS2 DevCUP</span>
                </a>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium text-blue-600 @if(request()->is('home')) bg-blue-50 @endif">Bas
                        meyu</a>
                    <a href="{{ route('matchmaking.index') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium text-blue-600">Matchmaking</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-blue-600">Turnirler</a>
                    <a href="{{ route('teams.index') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium text-blue-600 @if(request()->is('teams*')) bg-blue-50 @endif">Komandalar</a>
                </div>
            </div>

            <div class="flex items-center">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                                class="flex items-center gap-3 cursor-pointer p-1.5 rounded-lg hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all focus:outline-none">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] font-bold text-blue-600 uppercase mt-1 tracking-wider">{{ Auth::user()->pos ?? 'O\'yinchi' }}</p>
                            </div>
                            <img class="h-9 w-9 rounded-full object-cover border border-slate-200 shadow-sm"
                                 src="{{ Auth::user()->steam_avatar ?? '/images/avatar.jpg' }}" alt="Avatar">

                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200"
                                 :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open"
                             x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-200 py-2 z-[100] overflow-hidden">

                            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/50">
                                <p class="text-xs text-slate-800 font-medium uppercase tracking-wider">{{ Auth::user()->name }}</p>
                                <p class="text-slate-400 truncate" style="font-size: x-small">{{ Auth::user()->id }}</p>
                            </div>

                            <div class="py-1">
                                <a href="/home"
                                   class="group flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors"><span>Kabinet</span></a>
                                <a href="/invoices"
                                   class="group flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors"><span>Ótkerilgen tólemler</span></a>
                            </div>

                            <div class="border-t border-slate-100 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full group flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <span class="font-semibold">Sistemadan shıǵıw</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('auth.steam') }}"
                       class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm">
                        <i class="fab fa-steam text-lg"></i> Steam menen kiriw
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="flex-1 overflow-y-auto pb-28">
    @yield('content')
</main>

@yield('script')

{{-- ======================================================= --}}
{{-- 1. GLOBAL O'YIN QIDIRUVCHI (FACEIT MODAL) --}}
{{-- ======================================================= --}}
@auth
    @php
        $activeMatchId = null;

        // FOYDALANUVCHI JAMOASINI ANIQLASH:
        // E'tibor bering: O'zingizni bazangizga qarab teamId ni olyapmiz.
        // Ikkala eng ko'p tarqalgan variantni yozib qo'ydim:
        $teamId = Auth::user()->team_id ?? (Auth::user()->team->id ?? null);

        // JORIY SAHIFANI TEKSHIRISH: (Agar Veto xonasida bo'lsa modal chiqarmaymiz)
        $isMatchPage = request()->is('match/*') || request()->is('matchmaking*');

        if ($teamId && !$isMatchPage) {
            // Shu jamoa ishtirokidagi Kutilayotgan o'yinni izlaymiz
            $activeGame = \App\Models\Game::whereIn('status', ['waiting', 'picking'])
                ->where(function($query) use ($teamId) {
                    $query->where('team_1_id', $teamId)
                          ->orWhere('team_2_id', $teamId);
                })->first();

            if ($activeGame) {
                $activeMatchId = $activeGame->id;
            }
        }
    @endphp

    {{-- AGAR O'YIN TOPILSA, MODAL CHIQARAMIZ --}}
    @if($activeMatchId)
        <div x-data="{ show: true }"
             x-init="setTimeout(() => { document.getElementById('matchFoundAudio')?.play().catch(e => console.log('Brauzer audioni blokladi')); }, 100)"
             x-cloak
             x-show="show"
             class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-950/90 backdrop-blur-md">

            <div
                class="bg-slate-900 border border-emerald-500 shadow-[0_0_50px_rgba(16,185,129,0.2)] p-8 md:p-12 rounded-3xl text-center max-w-lg w-full transform transition-all"
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-75"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="relative w-32 h-32 mx-auto mb-8">
                    <div class="absolute inset-0 border-4 border-emerald-500/20 rounded-full"></div>
                    <div
                        class="absolute inset-0 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
                    <div class="absolute inset-0 flex items-center justify-center bg-emerald-500/10 rounded-full">
                        <i class="fa-solid fa-trophy text-5xl text-emerald-500 drop-shadow-[0_0_10px_rgba(16,185,129,0.8)]"></i>
                    </div>
                </div>

                <h2 class="text-4xl font-black text-white uppercase tracking-widest mb-3 animate-pulse">
                    OYÍN JARATÍLDÍ!
                </h2>
                <p class="text-slate-400 text-lg mb-10">
                    Oyın tabıldı hám házirde oyın kartaların tańlaw processi baslanıw aldında, kabinetke ótseńiz?
                </p>

                <a href="/matchmaking/{{ $activeMatchId }}"
                   class="block w-full py-5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xl uppercase tracking-widest rounded-xl transition-all shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:shadow-[0_0_30px_rgba(16,185,129,0.6)] hover:-translate-y-1">
                    KABINETKE KIRIW
                </a>

                <audio id="matchFoundAudio" src="/sounds/match_found.mp3" preload="auto"></audio>
            </div>
        </div>
    @endif
@endauth


{{-- ======================================================= --}}
{{-- 2. TOASTR BARKARORLIK QISMI --}}
{{-- ======================================================= --}}
@php
    $toastType = '';
    $toastMessage = '';
    $toastTitle = '';

    if(session('success')) {
        $toastType = 'success'; $toastTitle = 'Qutlıqlaymız!'; $toastMessage = session('success');
    } elseif(session('error')) {
        $toastType = 'error'; $toastTitle = 'Qátelik payda boldı!'; $toastMessage = session('error');
    } elseif(session('info')) {
        $toastType = 'info'; $toastTitle = 'Maǵlıwmat ushın'; $toastMessage = session('info');
    } elseif(session('warning')) {
        $toastType = 'warning'; $toastTitle = 'Dıqqat etiń!'; $toastMessage = session('warning');
    }
@endphp

@if($toastMessage)
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 5000)"
         x-show="show"
         x-cloak
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:translate-x-10"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-10"
         class="fixed bottom-6 right-6 z-[100] max-w-sm w-full bg-white border border-slate-200 shadow-2xl rounded-2xl overflow-hidden flex flex-col pointer-events-auto">

        <div class="flex items-start gap-4 p-4 pb-5">
            @if($toastType == 'success')
                <div
                    class="shrink-0 w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-500 text-lg">
                    <i class="fa-solid fa-check-double"></i>
                </div>
            @elseif($toastType == 'error')
                <div
                    class="shrink-0 w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center text-rose-500 text-lg">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
            @elseif($toastType == 'info')
                <div
                    class="shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 text-lg">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
            @elseif($toastType == 'warning')
                <div
                    class="shrink-0 w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-500 text-lg">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            @endif

            <div class="flex-1 pt-0.5">
                <h3 class="text-sm font-black text-slate-800">{{ $toastTitle }}</h3>
                <p class="text-xs font-bold text-slate-500 mt-1 leading-relaxed">{{ $toastMessage }}</p>
            </div>

            <button @click="show = false"
                    class="shrink-0 text-slate-400 hover:text-slate-600 transition-colors cursor-pointer focus:outline-none">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <div class="h-1 w-full bg-slate-100 absolute bottom-0 left-0">
            <div class="h-full animate-shrink
                {{ $toastType == 'success' ? 'bg-emerald-500' : '' }}
                {{ $toastType == 'error' ? 'bg-rose-500' : '' }}
                {{ $toastType == 'info' ? 'bg-blue-500' : '' }}
                {{ $toastType == 'warning' ? 'bg-amber-500' : '' }}
            "></div>
        </div>
    </div>
@endif
</body>
</html>
