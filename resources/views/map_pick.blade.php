@extends('layouts.app')

@section('content')
    @php
        $game = $match['game'];
        $team1 = $match['teams']['team1'];
        $team2 = $match['teams']['team2'];
        $vetoState = $match['vetoState'];

        $t1_confirmed = $game['status']['confirmed']['team1']['status'] ?? false;
        $t2_confirmed = $game['status']['confirmed']['team2']['status'] ?? false;

        $is_ready = trim($game['status']['state']) !== 'waiting';

        $is_t1_captain = auth()->id() == $team1['captain']['id'];
        $is_t2_captain = auth()->id() == $team2['captain']['id'];
        $am_i_captain = $is_t1_captain || $is_t2_captain;

        $my_team_key = $is_t1_captain ? 'team1' : ($is_t2_captain ? 'team2' : null);

        $my_team_confirmed = false;
        if ($my_team_key && isset($game['status']['confirmed'][$my_team_key]['status'])) {
            $my_team_confirmed = $game['status']['confirmed'][$my_team_key]['status'];
        }

        $is_finished = $vetoState['is_finished'] ?? false;

        $sequence = [];
        if ($game['format'] === 'BO3') {
            $sequence = [['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'pick'], ['team' => 'team2', 'act' => 'pick'], ['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban']];
        } elseif ($game['format'] === 'BO5') {
            $sequence = [['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'pick'], ['team' => 'team2', 'act' => 'pick'], ['team' => 'team1', 'act' => 'pick'], ['team' => 'team2', 'act' => 'pick']];
        } else {
            $sequence = [['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban'], ['team' => 'team1', 'act' => 'ban'], ['team' => 'team2', 'act' => 'ban']];
        }

        $currentTurn = (!$is_finished) ? ($sequence[$vetoState['step']] ?? null) : null;

        $isMyMapTurn = false;
        if ($currentTurn) {
            if ($currentTurn['team'] == 'team1' && $is_t1_captain) $isMyMapTurn = true;
            if ($currentTurn['team'] == 'team2' && $is_t2_captain) $isMyMapTurn = true;
        }
    @endphp

    {{-- ================= KUTISH MODAL OYNASI ================= --}}
    @if(!$is_ready)
        <div id="acceptModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/80 backdrop-blur-md transition-opacity">
            <div class="bg-slate-900 border border-slate-700 p-8 rounded-2xl shadow-2xl text-center max-w-md w-full transform scale-100 transition-transform">
                <i class="fa-solid fa-gamepad text-5xl text-blue-500 mb-4 animate-bounce"></i>
                <h2 class="text-3xl font-black uppercase mb-2 text-white">OYÍN SERVERI TAYÍN</h2>
                <p class="text-slate-400 mb-6 text-sm">Oyın formatı: <span class="text-white font-bold">{{ $game['format'] }}</span>.<br>Komanda kapitanlarınıń oyınǵa tayın ekenligin tastıyıqlawı kútilmekte!</p>

                <div class="flex justify-between items-center bg-slate-800 p-4 rounded-xl mb-6">
                    <div class="text-center w-1/2 border-r border-slate-700">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">{{ $team1['name'] }}</p>
                        @if($t1_confirmed)
                            <span class="text-emerald-500 font-bold"><i class="fa-solid fa-check"></i> Tayın</span>
                        @else
                            <span class="text-amber-500 text-sm"><i class="fa-solid fa-spinner fa-spin"></i></span>
                        @endif
                    </div>
                    <div class="text-center w-1/2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">{{ $team2['name'] }}</p>
                        @if($t2_confirmed)
                            <span class="text-emerald-500 font-bold"><i class="fa-solid fa-check"></i> Tayın</span>
                        @else
                            <span class="text-amber-500 text-sm"><i class="fa-solid fa-spinner fa-spin"></i></span>
                        @endif
                    </div>
                </div>

                @if($am_i_captain && !$my_team_confirmed)
                    <button id="acceptBtn" onclick="acceptGame('{{ $my_team_key }}')" class="w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-lg uppercase tracking-widest rounded-xl transition-colors shadow-[0_0_20px_rgba(16,185,129,0.3)]">OYÍNǴA TAYARMÍZ</button>
                @elseif($am_i_captain && $my_team_confirmed)
                    <button disabled class="w-full py-4 bg-slate-700 border border-slate-600 text-slate-400 font-black text-lg uppercase tracking-widest rounded-xl cursor-not-allowed">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i> QARSÍLASTÍ KÚTEMIZ...
                    </button>
                @endif
            </div>
        </div>
    @endif

    {{-- ================= ASOSIY EKRAN LAYOUT ================= --}}
    <div class="min-h-screen bg-slate-950 text-white p-4 md:p-8 font-sans transition-all duration-700 {{ !$is_ready ? 'opacity-30 pointer-events-none filter blur-sm' : '' }}">

        <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- CHAP TOMON: Jamoa 1 (Team 1) --}}
            <div class="lg:col-span-3">
                <div class="bg-slate-900 border {{ $currentTurn && $currentTurn['team'] == 'team1' ? 'border-amber-500 shadow-[0_0_20px_rgba(245,158,11,0.2)]' : 'border-slate-800' }} rounded-2xl p-6 transition-all">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 mx-auto bg-slate-800 rounded-full border-4 border-slate-700 flex items-center justify-center text-3xl font-black text-amber-500 mb-4">T1</div>
                        <h2 class="text-2xl font-black text-white uppercase">{{ $team1['name'] }}</h2>
                        <p class="text-slate-400 text-sm mt-1">Kapitan: {{ $team1['captain']['name'] }}</p>
                    </div>

                    @if($is_finished)
                        <div class="bg-emerald-500/10 text-emerald-400 text-center py-2 rounded-lg font-bold border border-emerald-500/20">Tayyor</div>
                    @elseif($currentTurn && $currentTurn['team'] == 'team1')
                        <div class="bg-amber-500 text-slate-950 text-center py-2 rounded-lg font-black uppercase tracking-widest animate-pulse">Navbat</div>
                    @else
                        <div class="bg-slate-800 text-slate-500 text-center py-2 rounded-lg font-bold">Kutmoqda</div>
                    @endif
                </div>
            </div>

            {{-- O'RTA TOMON: Map Veto Qismi --}}
            <div class="lg:col-span-6">
                <div class="text-center mb-8">
                    <span class="text-emerald-500 bg-emerald-500/10 px-4 py-1 rounded-full border border-emerald-500/20 font-bold uppercase tracking-widest">{{ $game['format'] }} MATCH</span>
                    <h1 class="text-3xl font-black uppercase tracking-widest text-slate-100 mt-4 mb-4">Oyın kartaların saylaw</h1>

                    @if($is_finished)
                        <div class="text-xl font-black px-8 py-4 inline-block rounded-xl border border-emerald-500/50 bg-emerald-500/10 text-emerald-400 animate-pulse">
                            VETO JUWMAQLANDÍ! <br>
                            <span class="text-sm font-medium mt-1 block text-emerald-300">SERVER: {{ $game['server']['connect_url'] }}</span>
                        </div>
                    @elseif($currentTurn)
                        <div class="text-lg font-bold px-6 py-3 inline-block rounded-xl border border-slate-700 bg-slate-800 shadow-lg">
                            <span class="{{ $currentTurn['team'] == 'team1' ? 'text-amber-500' : 'text-blue-500' }} uppercase">
                                {{ $currentTurn['team'] == 'team1' ? $team1['name'] : $team2['name'] }}
                            </span>
                            <span class="mx-2 text-slate-500">|</span>
                            <span class="uppercase {{ $currentTurn['act'] == 'ban' ? 'text-red-500' : 'text-emerald-500' }}">
                                {{ $currentTurn['act'] == 'ban' ? 'XARITANI BAN QILADI' : 'XARITANI PICK QILADI' }}
                            </span>
                        </div>

                        @if($isMyMapTurn)
                            <p class="mt-4 text-emerald-400 text-sm font-bold animate-pulse">Quyidan xaritani bosing!</p>
                        @endif
                    @endif
                </div>

                {{-- XARITALAR --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($match['veto'] as $vetoItem)
                        @php
                            $map = $vetoItem['map'];
                            $slug = $map['slug'];
                            $stage = $map['status']['stage'];
                            $actionTeam = $map['status']['team'];
                            $side = $map['status']['side'] ?? null;
                            $is_actioned = $stage !== 'open';

                            $canClick = !$is_finished && $isMyMapTurn && !$is_actioned;
                        @endphp

                        <div class="map-card relative group aspect-[4/3] rounded-xl border border-slate-800 overflow-hidden transition-all duration-300 {{ $canClick ? 'cursor-pointer hover:scale-[1.03] hover:border-emerald-500 hover:shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'pointer-events-none' }}" data-map="{{ $slug }}">

                            <img src="/images/map/pick/{{ $slug }}.png" alt="{{ $map['name'] }}" class="absolute inset-0 w-full h-full object-cover {{ $is_actioned ? 'grayscale opacity-20' : '' }}">

                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-3">
                                <h3 class="text-sm md:text-base font-black uppercase tracking-widest text-white drop-shadow-md">{{ $map['name'] }}</h3>
                            </div>

                            <div class="action-overlay absolute inset-0 flex flex-col items-center justify-center bg-black/60 backdrop-blur-[2px] transition-opacity duration-300 {{ $is_actioned ? 'opacity-100' : 'opacity-0' }}">
                                @if($is_actioned)
                                    @if($stage == 'ban')
                                        <i class="fa-solid fa-xmark text-5xl text-red-500/80 mb-2 drop-shadow-lg"></i>
                                        <p class="text-[10px] font-bold text-slate-300 uppercase bg-black/50 px-2 py-1 rounded">Banned</p>
                                        <p class="text-xs font-black text-red-400 text-center px-2 mt-1">{{ $actionTeam }}</p>
                                    @elseif($stage == 'pick' || $stage == 'decider')
                                        @if($stage == 'pick')
                                            <i class="fa-solid fa-check text-4xl text-emerald-500 mb-1 drop-shadow-lg"></i>
                                            <p class="text-[10px] font-bold text-slate-300 uppercase bg-black/50 px-2 py-1 rounded">Picked</p>
                                            <p class="text-[10px] font-black text-emerald-400 text-center px-2 mb-2 leading-tight mt-1">{{ $actionTeam }}</p>
                                        @else
                                            <i class="fa-solid fa-dice text-4xl text-purple-500 mb-2 animate-bounce"></i>
                                            <p class="text-xs font-black text-purple-400 uppercase tracking-widest mb-2 bg-black/50 px-3 py-1 rounded-full">Decider</p>
                                        @endif

                                        {{-- Avtomat belgilanadigan tomonlar (Side) --}}
                                        @if($side)
                                            <div class="inline-flex items-center gap-2 bg-slate-900 border border-slate-700 px-3 py-1 rounded-full shadow-lg mt-1">
                                                @if($side == 't')
                                                    <i class="fa-solid fa-bomb text-amber-500"></i> <span class="text-[10px] font-bold text-amber-400 uppercase">{{ $actionTeam }} (T)</span>
                                                @elseif($side == 'knife')
                                                    <i class="fa-solid fa-k text-purple-400"></i> <span class="text-[10px] font-bold text-purple-400 uppercase">Knife Round</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- O'NG TOMON: Jamoa 2 (Team 2) --}}
            <div class="lg:col-span-3">
                <div class="bg-slate-900 border {{ $currentTurn && $currentTurn['team'] == 'team2' ? 'border-blue-500 shadow-[0_0_20px_rgba(59,130,246,0.2)]' : 'border-slate-800' }} rounded-2xl p-6 transition-all">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 mx-auto bg-slate-800 rounded-full border-4 border-slate-700 flex items-center justify-center text-3xl font-black text-blue-500 mb-4">T2</div>
                        <h2 class="text-2xl font-black text-white uppercase">{{ $team2['name'] }}</h2>
                        <p class="text-slate-400 text-sm mt-1">Kapitan: {{ $team2['captain']['name'] }}</p>
                    </div>

                    @if($is_finished)
                        <div class="bg-emerald-500/10 text-emerald-400 text-center py-2 rounded-lg font-bold border border-emerald-500/20">Tayyor</div>
                    @elseif($currentTurn && $currentTurn['team'] == 'team2')
                        <div class="bg-blue-500 text-white text-center py-2 rounded-lg font-black uppercase tracking-widest animate-pulse">Navbat</div>
                    @else
                        <div class="bg-slate-800 text-slate-500 text-center py-2 rounded-lg font-bold">Kutmoqda</div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        let matchId = "{{ $id ?? $game['id'] }}";

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        var channel = pusher.subscribe('match.' + matchId);

        channel.bind('MatchUpdated', function (data) {
            window.location.reload();
        });

        setInterval(function () {
            $.get(`/api/match/${matchId}/status`, function (data) {
                if (data.status !== "{{ $game['status']['state'] }}") {
                    window.location.reload();
                }
            });
        }, 3000);

        function acceptGame(teamKey) {
            $('#acceptBtn').html('<i class="fa-solid fa-spinner fa-spin mr-2"></i> KUTILMOQDA...').prop('disabled', true).removeClass('bg-emerald-500 hover:bg-emerald-400').addClass('bg-slate-600 text-white cursor-not-allowed');

            $.ajax({
                url: `/match/${matchId}/accept`,
                type: 'POST',
                data: {team: teamKey, _token: '{{ csrf_token() }}'},
                error: function () {
                    alert('Qabul qilishda xatolik yuz berdi. Iltimos sahifani yangilang.');
                    window.location.reload();
                }
            });
        }

        $('.map-card').click(function () {
            if ($(this).hasClass('pointer-events-none')) return;
            $(this).addClass('pointer-events-none opacity-50');

            $.ajax({
                url: `/match/${matchId}/veto/action`,
                type: 'POST',
                data: {map: $(this).data('map'), _token: '{{ csrf_token() }}'},
                error: function (xhr) {
                    alert(xhr.responseJSON?.error || "Xatolik yuz berdi");
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
