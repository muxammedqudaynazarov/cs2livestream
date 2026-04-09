@extends('layouts.app')

@section('content')
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div
            class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-5">
                <div
                    class="w-20 h-20 rounded-2xl bg-slate-100 border-2 border-slate-200 flex items-center justify-center text-3xl font-black text-slate-400 shadow-inner overflow-hidden relative group">
                    @if($team->logo)
                        <img src="{{ url($team->logo) }}" alt="Logo"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    @else
                        <i class="fa-solid fa-users"></i>
                    @endif
                </div>
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 mb-2 bg-indigo-50 border border-indigo-100 rounded-lg text-indigo-700 font-bold text-[10px] uppercase tracking-wider shadow-sm">
                        <i class="fa-solid fa-shield-halved"></i> Komanda profili
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $team->name }}</h1>
                </div>
            </div>

            <div class="flex gap-4">
                <div
                    class="text-center px-5 py-3 bg-slate-50 rounded-xl border border-slate-200 shadow-sm min-w-[110px]">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Oyınshılar</p>
                    <p class="text-xl font-black text-slate-800">
                        {{ $team->players->where('status', '1')->count() }}
                    </p>
                </div>
                <div
                    class="text-center px-5 py-3 bg-purple-50 rounded-xl border border-purple-100 shadow-sm min-w-[110px]">
                    <p class="text-[10px] font-bold text-purple-400 uppercase tracking-wider mb-1">Kristall</p>
                    <p class="text-xl font-black text-purple-700">
                        {{ number_format($team->cristal, 1, '.', ' ') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 lg:border-r border-slate-200 lg:pr-8">
                <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-2">
                    Tiykarǵı quram
                </h2>

                <div class="flex flex-col gap-4">
                    @foreach($team->players->where('status', '1')->sortByDesc('user.elo') as $player)
                        <div
                            class="bg-white border {{ $player->user_id == $team->captain_id ? 'border-amber-200 shadow-amber-50' : 'border-slate-200' }} rounded-2xl p-4 shadow-sm hover:shadow-md transition-all relative overflow-hidden group flex flex-col md:flex-row items-center justify-between gap-4">

                            @if($player->user_id == $team->captain_id)
                                <div
                                    class="absolute top-0 left-0 bg-amber-400 text-amber-900 text-[10px] font-black uppercase px-3 py-1 rounded-br-xl shadow-sm z-10 flex items-center gap-1">
                                    <i class="fa-solid fa-crown"></i> Kapitan
                                </div>
                            @endif

                            <div class="flex items-center gap-4 w-full md:w-auto">
                                <div
                                    class="w-14 h-14 rounded-full bg-slate-100 border-2 {{ $player->user_id == $team->captain_id ? 'border-amber-400' : 'border-slate-200' }} flex items-center justify-center text-lg shadow-inner overflow-hidden shrink-0 {{ $player->user_id == $team->captain_id ? 'mt-3 md:mt-0' : '' }}">
                                    <img src="{{ $player->user->steam_avatar }}" alt="Avatar"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="w-32">
                                    <a class="text-base font-black text-blue-600 truncate block hover:text-blue-800 transition-colors"
                                       href="{{ route('player', $player->user_id) }}">
                                        {{ $player->user->name }}
                                    </a>
                                    <p class="text-xs font-bold text-slate-500 truncate"
                                       title="{{ $player->user->name }}">
                                        {{ $player->user->real_name ?? $player->user->name }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="grid grid-cols-4 divide-x divide-slate-200 w-full md:w-[320px] shrink-0 bg-slate-50 rounded-xl border border-slate-100 items-center justify-center py-2 shadow-inner">
                                <div class="flex flex-col items-center justify-center px-2">
                                    <div class="flex items-center justify-center h-[24px]">
                                        @if (optional(json_decode($player->user->faceit))->level)
                                            <div
                                                class="faceit-icon lvl-{{ json_decode($player->user->faceit)->level }}"></div>
                                        @else
                                            <div class="faceit-icon lvl-0"></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col items-center justify-center px-2">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-1">SElo</p>
                                    <p class="text-sm font-black text-slate-800 leading-none h-[24px] flex items-center">
                                        {{ $player->user->elo ?? 0 }}
                                    </p>
                                </div>
                                <div class="flex flex-col items-center justify-center px-2">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-1">Oyınlar</p>
                                    <p class="text-sm font-black text-slate-800 leading-none h-[24px] flex items-center">
                                        0</p>
                                </div>
                                <div class="flex flex-col items-center justify-center px-2">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-1">K/D ratio</p>
                                    <p class="text-sm font-black text-slate-800 leading-none h-[24px] flex items-center">
                                        {{ number_format($player->user->kd ?? 0, 2) }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-row md:flex-col gap-2 w-full md:w-36 shrink-0">
                                @if(auth()->id() == $team->creator_id)
                                    @if($player->user_id == $team->creator_id)
                                        <div
                                            class="flex-1 py-1.5 bg-slate-800 text-white font-bold rounded-lg text-[11px] text-center shadow-sm">
                                            <i class="fa-solid fa-user-tie mr-1"></i> Tiykarshı
                                        </div>
                                    @endif

                                    @if($player->user_id != $team->captain_id)
                                        <form
                                            action="{{ route('team.make_captain', ['team' => $team->id, 'player' => $player->user->id]) }}"
                                            method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="w-full py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 rounded-lg text-[11px] font-bold transition-colors shadow-sm border border-blue-100">
                                                Kapitan qılıw
                                            </button>
                                        </form>
                                    @endif

                                    @if($transfer == '1' && $player->user_id != $team->creator_id)
                                        <button type="button"
                                                onclick="openTransferModal({{ $player->user_id }}, '{{ $player->user->name }}')"
                                                class="flex-1 py-1.5 bg-purple-50 text-purple-600 hover:bg-purple-100 hover:text-purple-700 rounded-lg text-[11px] font-bold transition-colors shadow-sm border border-purple-100">
                                            Transferge beriw
                                        </button>
                                    @endif
                                @elseif($player->user_id == $team->creator_id)
                                    <div
                                        class="flex-1 py-1.5 bg-slate-800 text-white font-bold rounded-lg text-[11px] text-center shadow-sm">
                                        Tiykarshı
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($team->players->where('status', '1')->isEmpty())
                    <div class="bg-slate-50 border border-slate-200 border-dashed rounded-3xl p-12 text-center mt-6">
                        <i class="fa-solid fa-users-slash text-5xl text-slate-300 mb-4"></i>
                        <h3 class="text-lg font-black text-slate-700 mb-1">Quram bos</h3>
                        <p class="text-sm font-medium text-slate-500">
                            Házirgi waqıtta komanda quramında oyınshılar tabılmadı.
                        </p>
                    </div>
                @endif
            </div>

            <div class="lg:col-span-1 flex flex-col gap-8">

                @if($team->creator_id == auth()->id())
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col">
                        <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
                            <h3 class="text-sm font-black text-slate-800 flex items-center gap-2">
                                Qosılıw ushın arzalar
                                @php $pendingCount = $team->players->where('status', '0')->count(); @endphp
                                @if($pendingCount > 0)
                                    <span
                                        class="bg-rose-100 text-rose-600 text-[10px] px-2 py-0.5 rounded-full font-black">{{ $pendingCount }}</span>
                                @endif
                            </h3>
                        </div>

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
                                        <p class="text-[10px] font-bold text-orange-500 mt-1 flex items-center gap-1">
                                            <i class="fa-brands fa-faceit"></i>
                                            ELO: {{ optional(json_decode($pendingPlayer->user->faceit))->elo ?? '0' }}
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
                                                onclick="return confirm('Oyınshı komandaǵa qabıllanǵannan keyin onı óshiriw imkaniyatı bolmaydı. Tastıyıqlaysızba?')"
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
                            <div class="p-8 text-center bg-slate-50/50">
                                <i class="fa-solid fa-inbox text-3xl text-slate-300 mb-3"></i>
                                <p class="text-xs font-bold text-slate-500">Sorawlar tabılmadı.</p>
                            </div>
                        @endforelse
                    </div>
                @endif

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
                        <h3 class="text-sm font-black text-slate-800 flex items-center gap-2">
                            Kartalar boyınsha statistika
                        </h3>
                    </div>
                    <div class="p-5">
                        <div class="relative w-full h-[280px]">
                            <canvas id="teamMapStatsChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if($transfer == '1')
        <div id="transferModal"
             class="fixed inset-0 z-[100] hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center px-4 transition-opacity opacity-0">
            <div
                class="bg-white rounded-3xl shadow-2xl w-full max-w-xl overflow-hidden transform scale-95 transition-transform"
                id="transferModalContent">

                <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h3 class="text-xl font-black text-slate-800">
                        <i class="fa-solid fa-tag text-purple-500 mr-2"></i>
                        Oyınshını transferge shıǵarıw
                    </h3>
                    <button type="button" onclick="closeTransferModal()"
                            class="text-slate-400 hover:text-rose-500 transition-colors">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>

                <form id="transferForm" method="POST" action="">
                    @csrf
                    <div class="p-8">
                        <div class="text-sm font-medium text-slate-600 mb-6">
                            <p class="mb-3">Komandańızdaǵı usı oyınshını transfer aynasına shıǵarıw ushın onıń bahasın
                                belgileń.</p>
                            <div
                                class="text-xs font-bold text-amber-700 bg-amber-50 p-3 rounded-lg border border-amber-200 flex gap-2 items-start">
                                <i class="fa-solid fa-triangle-exclamation mt-0.5"></i>
                                <span>Satıwǵa shıǵarıw ushın qoyılıp atırǵan bahanıń 15% muǵdarında komissiya uslap qalınadı!</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="price"
                                   class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Satılıw
                                bahası (PTS)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <span class="text-purple-500 font-black"><i class="fa-solid fa-gem"></i></span>
                                </div>
                                <input type="number" name="price" id="price" required min="0"
                                       placeholder="Mısalı ushın: 3000"
                                       class="block w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-base font-black text-slate-800 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                        <button type="button" onclick="closeTransferModal()"
                                class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-100 transition-colors shadow-sm">
                            Biykar etiw
                        </button>
                        <button type="submit"
                                class="px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-purple-600 hover:bg-purple-700 shadow-md shadow-purple-200 transition-colors">
                            Bazarǵa shıǵarıw
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartCanvas = document.getElementById('teamMapStatsChart');
            if (chartCanvas) {
                const ctx = chartCanvas.getContext('2d');
                const labels = {!! json_encode($labels ?? ['Mirage', 'Dust II', 'Inferno', 'Nuke']) !!};
                const winsData = {!! json_encode($winsData ?? [5, 3, 2, 4]) !!};
                const lossesData = {!! json_encode($lossesData ?? [2, 4, 1, 3]) !!};

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: ' Utqan (wins)',
                                data: winsData,
                                backgroundColor: 'rgba(59, 130, 246, 0.85)',
                                borderColor: 'rgb(37, 99, 235)',
                                borderWidth: 1,
                                borderRadius: 4,
                                borderSkipped: false,
                                barPercentage: 0.8,
                                categoryPercentage: 0.8
                            },
                            {
                                label: ' Jeńilgen (losses)',
                                data: lossesData,
                                backgroundColor: 'rgba(244, 63, 94, 0.85)',
                                borderColor: 'rgb(225, 29, 72)',
                                borderWidth: 1,
                                borderRadius: 4,
                                borderSkipped: false,
                                barPercentage: 0.8,
                                categoryPercentage: 0.8
                            }
                        ]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,

                        interaction: {
                            mode: 'index',
                            axis: 'y',
                            intersect: true,
                        },

                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.95)',
                                titleFont: {size: 13, family: "'Inter', sans-serif", weight: 'bold'},
                                bodyFont: {size: 12, family: "'Inter', sans-serif", weight: '600'},
                                padding: 12,
                                cornerRadius: 8,
                                displayColors: true,
                                boxWidth: 10,
                                boxHeight: 10,
                                usePointStyle: true,
                                borderColor: 'rgba(255,255,255,0.1)',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            x: {
                                display: false,
                                stacked: false,
                                beginAtZero: false,
                                border: {display: false},
                                grid: {
                                    color: '#f1f5f9',
                                    tickLength: 0
                                },
                                ticks: {
                                    stepSize: 1,
                                    font: {family: "'Inter', sans-serif", weight: 'bold', size: 11},
                                    color: '#94a3b8',
                                    padding: 5
                                }
                            },
                            y: {
                                stacked: false,
                                grid: {
                                    display: false,
                                    drawBorder: true
                                },
                                ticks: {
                                    font: {family: "'Inter', sans-serif", weight: 'bold', size: 11},
                                    color: '#64748b',
                                    padding: 5
                                }
                            }
                        }
                    }
                });
            }

            // ================= TRANSFER MODAL =================
            const modal = document.getElementById('transferModal');
            const modalContent = document.getElementById('transferModalContent');
            const transferForm = document.getElementById('transferForm');

            if (modal) {
                window.openTransferModal = function (playerId, playerName) {
                    transferForm.action = `/teams/{{ $team->id ?? 0 }}/players/${playerId}/transfer`;
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                        modalContent.classList.remove('scale-95');
                    }, 10);
                }

                window.closeTransferModal = function () {
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
            }

        });
    </script>
@endsection
