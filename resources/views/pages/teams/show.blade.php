@extends('layouts.app')

@section('content')
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div
            class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-5">
                <div
                    class="w-16 h-16 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-2xl font-black text-slate-400 shadow-inner overflow-hidden">
                    <img src="{{ url($team->logo) }}" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-2.5 py-1 mb-2 bg-indigo-50 border border-indigo-100 rounded-md text-indigo-600 font-bold text-[10px] uppercase tracking-wider">
                        <i class="fa-solid fa-users"></i> Komanda profili
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $team->name }}</h1>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="text-center px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 min-w-[100px]">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Gamers</p>
                    <p class="text-lg font-black text-slate-800">
                        {{ $team->players->where('status', '1')->count() }}
                    </p>
                </div>
                <div class="text-center px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 min-w-[100px]">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kristall</p>
                    <p class="text-lg font-black text-slate-800 text-purple-600">
                        0
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 lg:border-r border-slate-200 lg:pr-8">

                <div class="flex flex-col gap-4">
                    @foreach($team->players->where('status', '1') as $player)
                        <div @if($team->main == '0')  style="background-color: #ddd" @endif
                        class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm hover:shadow-md transition-all relative overflow-hidden group flex flex-col md:flex-row items-center justify-between gap-4">
                            @if($player->user_id == $team->captain_id)
                                <div
                                    class="absolute top-0 left-0 bg-amber-400 text-amber-900 text-[10px] font-black uppercase px-3 py-1 rounded-br-xl shadow-sm z-10">
                                    <i class="fa-solid fa-crown mr-1"></i> Kapitan
                                </div>
                            @endif
                            <div class="flex items-center gap-4 w-full md:w-auto">
                                <div
                                    class="w-14 h-14 rounded-full bg-slate-100 border-2 {{ $player->user_id == $team->captain_id ? 'border-amber-400' : 'border-slate-200' }} flex items-center justify-center text-lg shadow-inner overflow-hidden shrink-0 {{ $player->user_id == $team->captain_id ? 'mt-3 md:mt-0' : '' }}">
                                    <img src="{{ $player->user->steam_avatar }}" alt="Avatar"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="w-32">
                                    <a class="text-base font-black text-blue-500 truncate"
                                       href="{{ route('player', $player->id) }}"
                                       title="{{ $player->user->real_name ?? $player->user->name }}">{{ $player->user->real_name ?? $player->user->name }}</a>
                                    <p class="text-xs font-bold text-slate-500 truncate"
                                       title="{{ $player->user->name }}">{{ $player->user->name }}</p>
                                </div>
                            </div>
                            <div
                                class="grid grid-cols-3 divide-x divide-slate-200 w-full md:w-[260px] shrink-0 bg-slate-50 rounded-xl border border-slate-100 items-center justify-center py-2">
                                <div class="flex flex-col items-center justify-center px-2">
                                    <div class="flex items-center justify-center h-[24px]">
                                        @if (json_decode($player->user->faceit)->level)
                                            <div
                                                class="faceit-icon lvl-{{ json_decode($player->user->faceit)->level }}"></div>
                                        @else
                                            <div class="faceit-icon lvl-0"></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col items-center justify-center px-2">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-1">Oyınlar</p>
                                    <p class="text-sm font-black text-slate-800 leading-none flex items-center h-[24px]">
                                        0
                                    </p>
                                </div>

                                <div class="flex flex-col items-center justify-center px-2">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-1">K/D</p>
                                    <p class="text-sm font-black text-slate-800 leading-none flex items-center h-[24px]">
                                        {{ number_format($player->user->kd ?? 0, 2) }}
                                    </p>
                                </div>

                            </div>
                            <div class="flex flex-row md:flex-col gap-2 w-full md:w-36 shrink-0">
                                @if(auth()->id() == $team->creator_id)
                                    @if($player->user_id == $team->creator_id)
                                        <div
                                            class="flex-1 py-1.5 bg-purple-50 rounded-lg text-[11px] text-center shadow-sm">
                                            Tiykarshı
                                        </div>
                                    @endif
                                    @if($player->user_id != $team->captain_id)
                                        <form
                                            action="{{ route('team.make_captain', ['team' => $team->id, 'player' => $player->user->id]) }}"
                                            method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="w-full py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 rounded-lg text-[11px] font-bold transition-colors shadow-sm">
                                                Kapitan qılıw
                                            </button>
                                        </form>
                                    @endif
                                    @if($transfer == '1')
                                        @if($player->user_id != $team->creator_id)
                                            <button type="button"
                                                    onclick="openTransferModal({{ $player->user_id }}, '{{ $player->user->name }}')"
                                                    class="flex-1 py-1.5 bg-purple-50 text-purple-600 hover:bg-purple-100 hover:text-purple-700 rounded-lg text-[11px] font-bold transition-colors shadow-sm">
                                                Transferge beriw
                                            </button>
                                        @endif
                                    @endif
                                @elseif($player->user_id == $team->creator_id)
                                    <div
                                        class="flex-1 py-1.5 bg-purple-50 rounded-lg text-[11px] text-center shadow-sm">
                                        Tiykarshı
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($team->players->where('status', '1')->isEmpty())
                    <div class="bg-slate-50 border border-slate-200 border-dashed rounded-2xl p-10 text-center mt-4">
                        <i class="fa-solid fa-users-slash text-4xl text-slate-300 mb-3"></i>
                        <p class="text-sm font-bold text-slate-500">
                            Házirgi waqıtta komanda quramında oyınshılar tabılmadı.
                        </p>
                    </div>
                @endif
            </div>

            @if($team->creator_id == auth()->id())
                <div class="lg:col-span-1">
                    <div
                        class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col gap-0">
                        @forelse($team->players->where('status', '0') as $pendingPlayer)
                            <div
                                class="p-5 border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-lg shadow-inner overflow-hidden shrink-0">
                                        <img src="{{ $pendingPlayer->user->steam_avatar }}" alt=""
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800 leading-tight">
                                            {{ $pendingPlayer->user->real_name ? $pendingPlayer->user->real_name . ' (' . $pendingPlayer->user->name . ')' : $pendingPlayer->user->name }}
                                        </h4>
                                        <p class="text-[10px] font-bold text-orange-500 mt-1">
                                            FaceIT ELO: {{ json_decode($pendingPlayer->user->faceit)->elo ?? '0' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <form
                                        action="{{ route('team.accept_player', ['team' => $team->id, 'player' => $pendingPlayer->user_id]) }}"
                                        method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                onclick="return confirm('Oyınshı komandaǵa qabıllanǵannan keyin onı óshiriw imkaniyatı bolmaydı. Siz usı oyınshını komandańızǵa qosıp alıwdı tastıyıqlaysızba?')"
                                                class="w-full py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-bold transition-colors shadow-sm">
                                            Qabıllaw
                                        </button>
                                    </form>
                                    <form
                                        action="{{ route('team.reject_player', ['team' => $team->id, 'player' => $pendingPlayer->id]) }}"
                                        method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs font-bold transition-colors shadow-sm">
                                            Biykar etiw
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-10 text-center">
                                <i class="fa-solid fa-inbox text-4xl text-slate-200 mb-3"></i>
                                <p class="text-xs font-bold text-slate-500">
                                    Toparǵa qosılıw sorawları tabılmadı.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($transfer == '1')
        <div id="transferModal"
             class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center px-4 transition-opacity opacity-0">
            <div
                class="bg-white rounded-3xl shadow-2xl w-full max-w-xl overflow-hidden transform scale-95 transition-transform"
                id="transferModalContent">

                <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h3 class="text-xl font-black text-slate-800">
                        <i class="fa-solid fa-tag text-purple-500 mr-2"></i>
                        Oyınshını transfer aynasına shıǵarıw
                    </h3>
                    <button type="button" onclick="closeTransferModal()"
                            class="text-slate-400 hover:text-rose-500 transition-colors">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>

                <form id="transferForm" method="POST" action="">
                    @csrf
                    <div class="p-8">
                        <div class="text-base font-medium text-slate-600 mb-6">
                            Komandańızdaǵı usı oyınshını transfer aynasına shıǵarıw ushın onıń bahasın belgileń?
                            <div style="font-size: 11px; color: red">
                                Satıwǵa shıǵarıw qoyılıp atırǵan bahanıń 15% payızına teń boladı!
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="price"
                                   class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-2">
                                Satılıw bahası (PTS)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-bold text-lg">?</span>
                                </div>
                                <input type="number" name="price" id="price" required min="0"
                                       placeholder="Mısalı ushın: 3000"
                                       class="block w-full pl-10 pr-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-base font-black text-slate-800 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                        <button type="button" onclick="closeTransferModal()"
                                class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                            Biykar etiw
                        </button>
                        <button type="submit"
                                class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-purple-600 hover:bg-purple-700 shadow-md shadow-purple-200 transition-colors">
                            Bazarǵa shıǵarıw
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            const modal = document.getElementById('transferModal');
            const modalContent = document.getElementById('transferModalContent');
            const transferForm = document.getElementById('transferForm');

            function openTransferModal(playerId, playerName) {
                transferForm.action = `/teams/{{ $team->id }}/players/${playerId}/transfer`;
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modalContent.classList.remove('scale-95');
                }, 10);
            }

            function closeTransferModal() {
                modal.classList.add('opacity-0');
                modalContent.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    transferForm.reset();
                }, 200);
            }

            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeTransferModal();
                }
            });
        </script>
    @endif
@endsection
