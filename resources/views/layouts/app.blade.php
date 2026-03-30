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
    </style>
    @yield('style')
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 flex flex-col min-h-screen">
<nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
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
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-blue-600 bg-blue-50">Bas meyu</a>
                    <a href="#"
                       class="px-3 py-2 rounded-md text-sm font-medium text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors">Turnirler</a>
                    <a href="#"
                       class="px-3 py-2 rounded-md text-sm font-medium text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors">Komandalar</a>
                    <a href="#"
                       class="px-3 py-2 rounded-md text-sm font-medium text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors">Reyting</a>
                </div>
            </div>

            <div class="flex items-center">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                                class="flex items-center gap-3 cursor-pointer p-1.5 rounded-lg hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all focus:outline-none">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] font-bold text-blue-600 uppercase mt-1 tracking-wider">
                                    {{ Auth::user()->pos ?? 'O\'yinchi' }}
                                </p>
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
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-200 py-2 z-[100] overflow-hidden"
                             style="display: none;">

                            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/50">
                                <p class="text-xs text-slate-800 font-medium uppercase tracking-wider">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-slate-400 truncate" style="font-size: x-small">{{ Auth::user()->id }}</p>
                            </div>

                            <div class="py-1">
                                <a href="/home"
                                   class="group flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <span>Kabinet</span>
                                </a>
                                <a href="/team"
                                   class="group flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <span>Komandam</span>
                                </a>
                                <a href="/invoices"
                                   class="group flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <span>Ótkerilgen tólemler</span>
                                </a>
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
                        <i class="fab fa-steam text-lg"></i>
                        Steam menen kiriw
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="flex-grow">
    @yield('content')
</main>

@yield('script')

<footer class="bg-white border-t border-slate-200 mt-auto">
    <div
        class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-2">
            <div
                class="w-6 h-6 bg-slate-300 text-slate-700 rounded font-black flex items-center justify-center text-xs">
                U
            </div>
            <div class="text-slate-500 font-medium text-sm">© {{ date('Y') }}
                CS2 DevCUP. Hámme huqıqlar qorǵalǵan.
            </div>
        </div>
        <div class="flex space-x-6 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-600 transition-colors">Qaǵıydalar</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Qáwipsizlik siyasatı</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Qollap-quwatlaw</a>
        </div>
    </div>
</footer>

</body>
</html>
