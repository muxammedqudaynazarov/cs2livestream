@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-950 text-white p-8 font-sans">

        <div class="max-w-5xl mx-auto mb-8 text-center bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-lg relative">
            <h1 class="text-3xl font-black uppercase tracking-widest text-slate-100 mb-2">Map Veto</h1>

            <div id="turn-indicator" class="text-xl font-bold px-6 py-2 inline-block rounded border border-slate-700 bg-slate-800">
                @if($vetoState['is_finished'])
                    <span class="text-emerald-500">VETO YAKUNLANDI</span>
                @else
                    Harakat: <span id="active-team" class="{{ $currentTurn['team'] == 'Team 1' ? 'text-amber-500' : 'text-blue-500' }}">{{ $currentTurn['team'] }}</span>
                    -
                    <span id="active-action" class="uppercase {{ $currentTurn['action'] == 'ban' ? 'text-red-500' : 'text-emerald-500' }}">{{ $currentTurn['action'] }}</span>
                @endif
            </div>

            <div id="timer-container" class="mt-4 {{ $vetoState['is_finished'] ? 'hidden' : '' }}">
                <div class="inline-flex items-center justify-center gap-2 bg-slate-950 px-4 py-2 rounded-full border border-slate-700">
                    <i class="fa-regular fa-clock text-amber-500 animate-pulse"></i>
                    <span class="text-sm text-slate-400 uppercase font-bold tracking-widest">Vaqt:</span>
                    <span id="time-left" class="text-2xl font-black text-amber-500 w-8 text-left">60</span>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $all_maps = ['de_mirage', 'de_inferno', 'de_nuke', 'de_ancient', 'de_anubis', 'de_dust2', 'de_overpass'];
            @endphp

            @foreach($all_maps as $map)
                @php
                    $is_actioned = isset($vetoState['history'][$map]);
                    $action_data = $is_actioned ? $vetoState['history'][$map] : null;
                @endphp

                <div class="map-card relative group aspect-video rounded-xl border border-slate-800 overflow-hidden cursor-pointer transition-transform hover:scale-105 {{ $is_actioned ? 'pointer-events-none' : '' }}"
                     data-map="{{ $map }}">

                    <img src="/images/map/pick/{{ $map }}.png" alt="{{ $map }}" class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-3">
                        <h3 class="text-lg font-black uppercase tracking-widest text-white drop-shadow-md">{{ str_replace('de_', '', $map) }}</h3>
                    </div>

                    <div class="action-overlay absolute inset-0 flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity {{ $is_actioned ? 'opacity-100' : 'opacity-0' }}">
                        @if($is_actioned)
                            @if($action_data['action'] == 'ban')
                                <div class="text-center">
                                    <i class="fa-solid fa-xmark text-5xl text-red-500 mb-1"></i>
                                    <p class="text-xs font-bold text-red-400 uppercase">Banned by {{ $action_data['team'] }}</p>
                                </div>
                            @elseif($action_data['action'] == 'pick')
                                <div class="text-center">
                                    <i class="fa-solid fa-check text-5xl text-emerald-500 mb-1"></i>
                                    <p class="text-xs font-bold text-emerald-400 uppercase">Picked by {{ $action_data['team'] }}</p>
                                </div>
                            @elseif($action_data['action'] == 'decider')
                                <div class="text-center">
                                    <i class="fa-solid fa-dice text-5xl text-purple-500 mb-1"></i>
                                    <p class="text-xs font-bold text-purple-400 uppercase">Decider Map</p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let matchId = "{{ $id }}";
            let isFinished = {{ $vetoState['is_finished'] ? 'true' : 'false' }};

            // Taymer o'zgaruvchilari
            let timeLeft = 60;
            let timerInterval;

            // Sahifa yuklanganda taymerni boshlaymiz
            if (!isFinished) {
                startTimer();
            }

            function startTimer() {
                clearInterval(timerInterval);
                timeLeft = 60;
                $('#time-left').text(timeLeft).removeClass('text-red-500').addClass('text-amber-500');

                timerInterval = setInterval(function() {
                    timeLeft--;
                    $('#time-left').text(timeLeft);

                    // Vaqt oz qolganda qizilga aylanadi
                    if (timeLeft <= 10) {
                        $('#time-left').removeClass('text-amber-500').addClass('text-red-500');
                    }

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        triggerAutoAction();
                    }
                }, 1000);
            }

            function triggerAutoAction() {
                if (isFinished) return;

                // Ekranni bloklab turamiz, toki serverdan javob kelguncha
                $('.map-card').addClass('pointer-events-none');

                $.ajax({
                    url: `/match/${matchId}/veto/auto`,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status === 'success') {
                            updateUI(response, true);
                        }
                    }
                });
            }

            $('.map-card').click(function() {
                if (isFinished || $(this).hasClass('pointer-events-none')) return;

                let card = $(this);
                let mapName = card.data('map');

                card.addClass('pointer-events-none');
                clearInterval(timerInterval); // Bosilganda vaqtni to'xtatamiz

                $.ajax({
                    url: `/match/${matchId}/veto/action`,
                    type: 'POST',
                    data: {
                        map: mapName,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            updateUI(response, false);
                        }
                    },
                    error: function() {
                        alert('Xatolik yuz berdi. Sahifani yangilang.');
                        card.removeClass('pointer-events-none');
                        startTimer(); // Xato bo'lsa taymer davom etadi
                    }
                });
            });

            // Kod takrorlanmasligi uchun UI yangilashni alohida funksiya qildik
            function updateUI(response, isAuto) {
                let card = $(`.map-card[data-map="${response.map}"]`);
                card.addClass('pointer-events-none'); // O'chirib qo'yamiz

                let overlay = card.find('.action-overlay');
                let iconHtml = '';

                let displayTeam = isAuto ? `${response.team} (Avto)` : response.team;

                if (response.action === 'ban') {
                    iconHtml = `<div class="text-center"><i class="fa-solid fa-xmark text-5xl text-red-500 mb-1"></i><p class="text-xs font-bold text-red-400 uppercase">Banned by ${displayTeam}</p></div>`;
                } else if (response.action === 'pick') {
                    iconHtml = `<div class="text-center"><i class="fa-solid fa-check text-5xl text-emerald-500 mb-1"></i><p class="text-xs font-bold text-emerald-400 uppercase">Picked by ${displayTeam}</p></div>`;
                }

                overlay.html(iconHtml).removeClass('opacity-0').addClass('opacity-100');

                if (response.is_finished) {
                    isFinished = true;
                    clearInterval(timerInterval);
                    $('#timer-container').fadeOut();
                    $('#turn-indicator').html('<span class="text-emerald-500">VETO YAKUNLANDI</span>');

                    renderDeciderMap(response.history);
                } else {
                    // Keyingi navbat
                    let teamColor = response.next_turn.team === 'Team 1' ? 'text-amber-500' : 'text-blue-500';
                    let actionColor = response.next_turn.action === 'ban' ? 'text-red-500' : 'text-emerald-500';

                    $('#active-team').text(response.next_turn.team).attr('class', teamColor);
                    $('#active-action').text(response.next_turn.action).attr('class', `uppercase ${actionColor}`);

                    startTimer(); // Yangi jamoa uchun taymerni qayta ishga tushiramiz
                    $('.map-card').not('.pointer-events-none').removeClass('pointer-events-none'); // Boshqa kartalarni ochamiz
                }
            }

            function renderDeciderMap(history) {
                for (let map in history) {
                    if (history[map].action === 'decider') {
                        let deciderCard = $(`.map-card[data-map="${map}"]`);
                        deciderCard.addClass('pointer-events-none border-purple-500 shadow-[0_0_20px_rgba(168,85,247,0.5)]');

                        let iconHtml = `<div class="text-center"><i class="fa-solid fa-dice text-5xl text-purple-500 mb-1"></i><p class="text-xs font-bold text-purple-400 uppercase">Decider Map</p></div>`;
                        deciderCard.find('.action-overlay').html(iconHtml).removeClass('opacity-0').addClass('opacity-100');
                    }
                }
            }
        });
    </script>
@endsection
