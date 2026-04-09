@extends('layouts.app')

@section('content')
    @php
        $game = $match['game'];
        $team1 = $match['teams']['team1'];
        $team2 = $match['teams']['team2'];
        $vetoState = $match['vetoState'];

        $t1_confirmed = $game['status']['confirmed']['team1']['status'] ?? false;
        $t2_confirmed = $game['status']['confirmed']['team2']['status'] ?? false;

        $is_ready = $t1_confirmed && $t2_confirmed;

        $is_t1_captain = auth()->id() == $team1['captain']['id'];
        $is_t2_captain = auth()->id() == $team2['captain']['id'];

        // Veto Turn logikasi
        $is_finished = $vetoState['is_finished'];
        $sequence = [];

        if ($game['format'] === 'BO3') {
            $sequence = [['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'pick'], ['team' => 'team2', 'act' => 'pick'], ['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban']];
        } elseif ($game['format'] === 'BO5') {
            $sequence = [['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'pick'], ['team' => 'team2', 'act' => 'pick'], ['team' => 'team1', 'act' => 'pick'], ['team' => 'team2', 'act' => 'pick']];
        } else {
            $sequence = [['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban']];
        }

        $currentTurn = !$is_finished ? $sequence[$vetoState['step']] : null;

        $isMyTurn = false;
        if ($currentTurn) {
            if ($currentTurn['team'] == 'team1' && $is_t1_captain) $isMyTurn = true;
            if ($currentTurn['team'] == 'team2' && $is_t2_captain) $isMyTurn = true;
        }
    @endphp

    <div class="min-h-screen bg-slate-950 text-white p-4 md:p-8 font-sans">

        @if(!$is_ready)
            {{-- KUTISH ZALI --}}
            <div class="max-w-4xl mx-auto mt-10">
                <div class="text-center mb-10">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-slate-900 border border-slate-700 rounded-full mb-4">
                        <i class="fa-solid fa-hourglass-half text-3xl text-amber-500 animate-pulse"></i>
                    </div>
                    <h1 class="text-4xl font-black uppercase tracking-widest text-slate-100 mb-2">O'yinga
                        Tayyorgarlik</h1>
                    <p class="text-slate-400">Ikkala jamoa kapitanlari o'yinni tasdiqlashi kutilmoqda...</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative">
                    <div
                        class="hidden md:flex absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-slate-950 border-4 border-slate-800 rounded-full items-center justify-center z-10">
                        <span class="text-xl font-black text-slate-500 italic">VS</span>
                    </div>

                    {{-- TEAM 1 --}}
                    <div
                        class="bg-slate-900 border {{ $t1_confirmed ? 'border-emerald-500/50 shadow-[0_0_30px_-5px_rgba(16,185,129,0.3)]' : 'border-slate-800' }} p-8 rounded-3xl text-center transition-all">
                        <h2 class="text-2xl font-black text-amber-500 mb-1">{{ $team1['name'] }}</h2>
                        <p class="text-sm text-slate-500 mb-6">Sardor: {{ $team1['captain']['name'] }}</p>

                        @if($t1_confirmed)
                            <div
                                class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-400 px-6 py-3 rounded-full border border-emerald-500/20">
                                <i class="fa-solid fa-check-circle text-xl"></i>
                                <span class="font-bold tracking-widest uppercase">Tasdiqladi</span>
                            </div>
                        @else
                            <div
                                class="inline-flex items-center gap-2 bg-slate-800 text-slate-400 px-6 py-3 rounded-full border border-slate-700">
                                <i class="fa-solid fa-spinner fa-spin text-xl"></i>
                                <span class="font-bold tracking-widest uppercase">Kutilmoqda</span>
                            </div>

                            @if($is_t1_captain)
                                <button onclick="acceptGame('team1')"
                                        class="mt-6 w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black uppercase tracking-widest rounded-xl transition-colors">
                                    O'yinni Qabul Qilish
                                </button>
                            @endif
                        @endif
                    </div>

                    {{-- TEAM 2 --}}
                    <div
                        class="bg-slate-900 border {{ $t2_confirmed ? 'border-emerald-500/50 shadow-[0_0_30px_-5px_rgba(16,185,129,0.3)]' : 'border-slate-800' }} p-8 rounded-3xl text-center transition-all">
                        <h2 class="text-2xl font-black text-blue-500 mb-1">{{ $team2['name'] }}</h2>
                        <p class="text-sm text-slate-500 mb-6">Sardor: {{ $team2['captain']['name'] }}</p>

                        @if($t2_confirmed)
                            <div
                                class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-400 px-6 py-3 rounded-full border border-emerald-500/20">
                                <i class="fa-solid fa-check-circle text-xl"></i>
                                <span class="font-bold tracking-widest uppercase">Tasdiqladi</span>
                            </div>
                        @else
                            <div
                                class="inline-flex items-center gap-2 bg-slate-800 text-slate-400 px-6 py-3 rounded-full border border-slate-700">
                                <i class="fa-solid fa-spinner fa-spin text-xl"></i>
                                <span class="font-bold tracking-widest uppercase">Kutilmoqda</span>
                            </div>

                            @if($is_t2_captain)
                                <button onclick="acceptGame('team2')"
                                        class="mt-6 w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black uppercase tracking-widest rounded-xl transition-colors">
                                    O'yinni Qabul Qilish
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        @else
            {{-- MAP VETO ZALI --}}
            <div
                class="max-w-5xl mx-auto mb-8 text-center bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-lg relative">
                <div class="flex justify-between items-center px-4 mb-6 text-sm font-bold text-slate-400">
                    <span class="text-amber-500">{{ $team1['name'] }}</span>
                    <span class="text-emerald-500 bg-emerald-500/10 px-3 py-1 rounded-full">{{ $game['format'] }}</span>
                    <span class="text-blue-500">{{ $team2['name'] }}</span>
                </div>

                <h1 class="text-3xl font-black uppercase tracking-widest text-slate-100 mb-2">Map Veto</h1>

                @if(!$is_finished)
                    <div class="text-xl font-bold px-6 py-2 inline-block rounded border border-slate-700 bg-slate-800">
                        Harakat: <span
                            class="{{ $currentTurn['team'] == 'team1' ? 'text-amber-500' : 'text-blue-500' }}">
                            {{ $currentTurn['team'] == 'team1' ? $team1['name'] : $team2['name'] }}
                        </span> -
                        <span
                            class="uppercase {{ $currentTurn['act'] == 'ban' ? 'text-red-500' : 'text-emerald-500' }}">
                            {{ $currentTurn['act'] }}
                        </span>
                    </div>

                    @if(!$isMyTurn)
                        <p class="mt-4 text-slate-400 animate-pulse">Raqib jamoa sardori tanlashi kutilmoqda...</p>
                    @else
                        <div id="timer-container" class="mt-4">
                            <div
                                class="inline-flex items-center justify-center gap-2 bg-slate-950 px-4 py-2 rounded-full border border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                                <i class="fa-regular fa-clock text-emerald-500 animate-pulse"></i>
                                <span class="text-sm text-slate-300 uppercase font-bold tracking-widest">Sizning navbatingiz:</span>
                                <span id="time-left"
                                      class="text-2xl font-black text-emerald-500 w-8 text-left">30</span>
                            </div>
                        </div>
                    @endif
                @else
                    <div
                        class="text-xl font-bold px-6 py-3 inline-block rounded-xl border border-emerald-500/50 bg-emerald-500/10 text-emerald-400">
                        VETO YAKUNLANDI! SERVER TAYYORLANMOQDA...
                    </div>
                @endif
            </div>

            <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($match['veto'] as $vetoItem)
                    @php
                        $map = $vetoItem['map'];
                        $slug = $map['slug'];
                        $mapName = $map['name'];
                        $stage = $map['status']['stage'];
                        $actionTeam = $map['status']['team'];
                        $is_actioned = $stage !== 'open';

                        // Faqat o'z navbatida bosishga ruxsat berish
                        $canClick = !$is_finished && $isMyTurn && !$is_actioned;
                    @endphp

                    <div
                        class="map-card relative group aspect-video rounded-xl border border-slate-800 overflow-hidden transition-transform {{ $canClick ? 'cursor-pointer hover:scale-105 hover:border-emerald-500' : 'pointer-events-none' }}"
                        data-map="{{ $slug }}">

                        <img src="/images/map/pick/{{ $slug }}.png" alt="{{ $mapName }}"
                             class="absolute inset-0 w-full h-full object-cover {{ $is_actioned ? 'grayscale opacity-30' : '' }}">

                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-3">
                            <h3 class="text-lg font-black uppercase tracking-widest text-white drop-shadow-md">{{ $mapName }}</h3>
                        </div>

                        <div
                            class="action-overlay absolute inset-0 flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity {{ $is_actioned ? 'opacity-100' : 'opacity-0' }}">
                            @if($is_actioned)
                                @if($stage == 'ban')
                                    <div class="text-center">
                                        <i class="fa-solid fa-xmark text-5xl text-red-500 mb-1"></i>
                                        <p class="text-xs font-bold text-red-400 uppercase">Banned
                                            by {{ $actionTeam }}</p>
                                    </div>
                                @elseif($stage == 'pick')
                                    <div class="text-center">
                                        <i class="fa-solid fa-check text-5xl text-emerald-500 mb-1"></i>
                                        <p class="text-xs font-bold text-emerald-400 uppercase">Picked
                                            by {{ $actionTeam }}</p>
                                    </div>
                                @elseif($stage == 'decider')
                                    <div class="text-center">
                                        <i class="fa-solid fa-dice text-5xl text-purple-500 mb-1 animate-bounce"></i>
                                        <p class="text-xs font-bold text-purple-400 uppercase">Decider Map</p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        let matchId = "{{ $id ?? $game['id'] }}";
        let isReady = {{ $is_ready ? 'true' : 'false' }};
        let isFinished = {{ isset($is_finished) && $is_finished ? 'true' : 'false' }};
        let isMyTurn = {{ isset($isMyTurn) && $isMyTurn ? 'true' : 'false' }};

        // --- PUSHER ULASH (ENV dan API klyuchni olib keladi) ---
        // Laravel Echo bo'lmagani uchun to'g'ridan-to'g'ri Pusher obyekti yaratamiz
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        // O'yin ID siga bog'langan kanalni eshitish
        var channel = pusher.subscribe('match.' + matchId);

        // Serverdan MatchUpdated signali kelsa, sahifani yangilaymiz
        channel.bind('MatchUpdated', function (data) {
            window.location.reload();
        });
        // ----------------------------------------------------

        // KUTISH ZALI
        if (!isReady) {
            function acceptGame(teamKey) {
                $.ajax({
                    url: `/match/${matchId}/accept`,
                    type: 'POST',
                    data: {team: teamKey, _token: '{{ csrf_token() }}'},
                    // Success holatida hech nima qilmaymiz, chunki Pusher o'zi sahifani yangilaydi
                });
            }
        }
        // VETO ZALI
        else if (!isFinished) {
            if (isMyTurn) {
                let timeLeft = 30;
                let timerInterval = setInterval(function () {
                    timeLeft--;
                    $('#time-left').text(timeLeft);

                    if (timeLeft <= 10) $('#time-left').removeClass('text-emerald-500').addClass('text-red-500');

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        $.post(`/match/${matchId}/veto/auto`, {_token: '{{ csrf_token() }}'});
                    }
                }, 1000);

                $('.map-card').click(function () {
                    if ($(this).hasClass('pointer-events-none')) return;

                    $(this).addClass('pointer-events-none');
                    clearInterval(timerInterval);

                    $.ajax({
                        url: `/match/${matchId}/veto/action`,
                        type: 'POST',
                        data: {map: $(this).data('map'), _token: '{{ csrf_token() }}'},
                    });
                });
            }
        }
    </script>
@endsection
