@extends('layouts.app')

@section('content')
    <div class="max-w-[800px] mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight uppercase">
                O'yin Qidirish
            </h1>
            <p class="text-slate-500 font-medium mt-2">CS2 DevCUP - 5v5 Raqobatbardosh Matchmaking</p>
        </div>

        <div class="bg-slate-900 rounded-3xl shadow-2xl p-1 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-20 animate-blob pointer-events-none"></div>
            <div
                class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-emerald-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-10 animate-blob animation-delay-2000 pointer-events-none"></div>

            <div class="bg-slate-800/90 backdrop-blur-xl rounded-[23px] p-8 relative z-10 border border-slate-700/50">

                <div class="flex flex-col sm:flex-row items-center gap-6 mb-10 pb-10 border-b border-slate-700/50">
                    <div class="relative group shrink-0">
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-blue-500 to-purple-500 rounded-2xl blur opacity-40 group-hover:opacity-60 transition duration-500"></div>
                        <img
                            src="{{ auth()->user()->steam_avatar ?? 'https://api.dicebear.com/8.x/adventurer/svg?seed='.urlencode(auth()->user()->name ?? 'Player') }}"
                            alt="Avatar"
                            class="relative w-24 h-24 rounded-2xl border-2 border-slate-600 object-cover shadow-xl">
                    </div>

                    <div class="flex-1 text-center sm:text-left w-full">
                        <h2 class="text-2xl font-black text-white truncate mb-1">{{ auth()->user()->real_name ?? auth()->user()->name ?? 'O\'yinchi' }}</h2>
                        <p class="text-sm font-bold text-slate-400 flex items-center justify-center sm:justify-start gap-2 mb-4">
                            <i class="fa-brands fa-steam text-slate-500"></i> {{ auth()->user()->name ?? 'Steam ID' }}
                        </p>

                        <div class="grid grid-cols-3 gap-4 bg-slate-900/50 rounded-xl p-3 border border-slate-700/30">
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">ELO</p>
                                <p class="text-lg font-black text-emerald-400">{{ auth()->user()->elo ?? '1000' }}</p>
                            </div>
                            <div class="text-center border-l border-r border-slate-700/50">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                                    O'yinlar</p>
                                <p class="text-lg font-black text-white">
                                    {{-- Agar o'yinlar sonini hisoblash kodingiz bo'lsa shu yerga yozing --}}
                                    0
                                </p>
                            </div>
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">K/D</p>
                                <p class="text-lg font-black text-white">{{ number_format(auth()->user()->kd ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center">

                    <div id="idleState" class="w-full transition-all duration-300">
                        <p class="text-center text-slate-400 text-xs font-medium mb-4">Hozirda <span
                                class="text-white font-bold">142</span> ta o'yinchi navbatda.</p>
                        <button onclick="startSearch()"
                                class="w-full py-5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-2xl font-black text-xl tracking-wide shadow-[0_0_40px_-10px_rgba(59,130,246,0.5)] transform transition hover:-translate-y-1 active:translate-y-0">
                            O'YIN QIDIRISH
                        </button>
                    </div>

                    <div id="searchingState"
                         class="w-full hidden flex-col items-center justify-center transition-all duration-300">
                        <div class="relative w-24 h-24 mb-6">
                            <div class="absolute inset-0 border-4 border-slate-700 rounded-full"></div>
                            <div
                                class="absolute inset-0 border-4 border-blue-500 rounded-full border-t-transparent animate-spin"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-blue-500">
                                <i class="fa-solid fa-radar fa-beat-fade text-2xl"></i>
                            </div>
                            <div
                                class="absolute inset-0 border-4 border-blue-500 rounded-full animate-ping opacity-20"></div>
                        </div>

                        <h3 class="text-white font-black text-xl mb-2 tracking-wide uppercase">Qidirilmoqda...</h3>
                        <p id="searchTimer"
                           class="text-blue-400 font-mono font-bold text-3xl mb-8 tracking-widest drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">
                            00:00</p>

                        <button onclick="cancelSearch()"
                                class="px-8 py-3 bg-slate-700/50 hover:bg-slate-700 text-white rounded-xl font-bold text-sm transition-colors border border-slate-600 hover:border-slate-500">
                            BEKOR QILISH
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="matchFoundModal"
         class="fixed inset-0 z-[100] hidden bg-slate-900/95 backdrop-blur-lg flex items-center justify-center px-4 transition-opacity opacity-0 duration-300">
        <div
            class="bg-slate-800 border border-slate-700 p-10 rounded-3xl shadow-[0_0_100px_-20px_rgba(16,185,129,0.3)] max-w-md w-full text-center transform scale-95 transition-transform duration-300"
            id="matchFoundContent">

            <div
                class="w-28 h-28 bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-8 relative">
                <div class="absolute inset-0 bg-emerald-500 rounded-full animate-ping opacity-20"></div>
                <div class="absolute inset-0 bg-emerald-500 rounded-full animate-pulse opacity-10"></div>
                <i class="fa-solid fa-check-double text-5xl text-emerald-400"></i>
            </div>

            <h2 class="text-4xl font-black text-white mb-3 tracking-tight uppercase drop-shadow-md">O'yin Topildi</h2>
            <p class="text-slate-400 text-base font-medium mb-10">Tayyor ekanligingizni tasdiqlang.<br><span
                    class="text-white font-bold text-lg mt-2 inline-block" id="acceptPlayersCount">1/10</span> <span
                    class="text-sm">o'yinchi tayyor</span></p>

            <div class="relative w-full h-3 bg-slate-700/50 rounded-full mb-10 overflow-hidden shadow-inner">
                <div id="acceptProgressBar"
                     class="absolute top-0 left-0 h-full bg-emerald-500 w-full shadow-[0_0_10px_rgba(16,185,129,0.8)]"></div>
            </div>

            <button onclick="acceptMatch()" id="acceptBtn"
                    class="w-full py-5 bg-emerald-500 hover:bg-emerald-400 text-slate-900 rounded-2xl font-black text-2xl uppercase tracking-widest shadow-[0_0_30px_-5px_rgba(16,185,129,0.4)] transform transition hover:scale-[1.02] active:scale-[0.98]">
                QABUL QILISH
            </button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // --- MATCHMAKING MANTIG'I ---
        let searchInterval;
        let seconds = 0;
        let acceptTimeout;

        const idleState = document.getElementById('idleState');
        const searchingState = document.getElementById('searchingState');
        const searchTimerDisplay = document.getElementById('searchTimer');
        const matchFoundModal = document.getElementById('matchFoundModal');
        const matchFoundContent = document.getElementById('matchFoundContent');
        const acceptProgressBar = document.getElementById('acceptProgressBar');
        const acceptBtn = document.getElementById('acceptBtn');

        function startSearch() {
            // UI ni o'zgartirish
            idleState.classList.add('hidden');
            searchingState.classList.remove('hidden');
            searchingState.classList.add('flex');

            seconds = 0;
            searchTimerDisplay.innerText = "00:00";

            // Taymerni ishga tushirish
            searchInterval = setInterval(() => {
                seconds++;
                const m = Math.floor(seconds / 60).toString().padStart(2, '0');
                const s = (seconds % 60).toString().padStart(2, '0');
                searchTimerDisplay.innerText = `${m}:${s}`;
            }, 1000);

            // DEMO: 5 soniyadan so'ng o'yin topildi oynasini chiqarish
            setTimeout(() => {
                showMatchFound();
            }, 5000);
        }

        function cancelSearch() {
            clearInterval(searchInterval);
            searchingState.classList.add('hidden');
            searchingState.classList.remove('flex');
            idleState.classList.remove('hidden');
        }

        function showMatchFound() {
            clearInterval(searchInterval);
            matchFoundModal.classList.remove('hidden');
            setTimeout(() => {
                matchFoundModal.classList.remove('opacity-0');
                matchFoundContent.classList.remove('scale-95');
            }, 10);

            acceptProgressBar.style.transition = 'none';
            acceptProgressBar.style.width = '100%';
            acceptProgressBar.offsetHeight;
            acceptProgressBar.style.transition = 'width 20s linear';
            acceptProgressBar.style.width = '0%';
            acceptTimeout = setTimeout(() => {
                if (!matchFoundModal.classList.contains('hidden')) {
                    closeMatchModal();
                    cancelSearch();
                    alert("Siz o'yinni qabul qilmadingiz!");
                }
            }, 20000);
        }

        function acceptMatch() {
            clearTimeout(acceptTimeout);
            acceptBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-3"></i> KUTILMOQDA...';
            acceptBtn.className = "w-full py-5 bg-slate-600 text-white rounded-2xl font-black text-2xl uppercase tracking-widest cursor-not-allowed transition-all";
            acceptBtn.disabled = true;
            const computedWidth = window.getComputedStyle(acceptProgressBar).width;
            acceptProgressBar.style.transition = 'none';
            acceptProgressBar.style.width = computedWidth;
            setTimeout(() => {
                closeMatchModal();
                alert("Barcha o'yinchilar qabul qildi! Server tayyorlanmoqda...");
            }, 3000);
        }

        function closeMatchModal() {
            matchFoundModal.classList.add('opacity-0');
            matchFoundContent.classList.add('scale-95');
            setTimeout(() => {
                matchFoundModal.classList.add('hidden');
                acceptBtn.innerHTML = 'QABUL QILISH';
                acceptBtn.className = "w-full py-5 bg-emerald-500 hover:bg-emerald-400 text-slate-900 rounded-2xl font-black text-2xl uppercase tracking-widest shadow-[0_0_30px_-5px_rgba(16,185,129,0.4)] transform transition hover:scale-[1.02] active:scale-[0.98]";
                acceptBtn.disabled = false;
            }, 300);
        }
    </script>
@endsection
