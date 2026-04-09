@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>
@endsection
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
                                <div class="text-slate-500">Mámleket:</div>
                                <div class="text-slate-800 font-medium flex items-center gap-2">
                                    @php
                                        $countryCode = strtolower(Auth::user()->country ?? 'uz');
                                    @endphp
                                    <span class="fi fi-{{ $countryCode }} rounded-sm shadow-sm"></span>
                                    <span class="uppercase">{{ Auth::user()->country ?? 'UZ' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-shield-halved text-blue-500"></i> Meniń komandam
                        </h3>
                        @forelse($myTeams as $myTeam)
                            <div class="flex items-center gap-4">
                                <img src="{{ url($myTeam->team->logo) }}" alt="Team Logo"
                                     class="w-12 h-12 rounded-lg bg-slate-100 border border-slate-200 object-cover shrink-0">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-slate-900 truncate">
                                        {{ $myTeam->team->name }} [<a
                                            href="{{ route('player', $myTeam->team->captain_id) }}"
                                            class="text-blue-500 hover:underline transition-all">{{ $myTeam->team->captain->name }}</a>]
                                    </h4>
                                    @if(auth()->id() == $myTeam->team->creator_id)
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            Oyınshılar: {{ $myTeam->team->players->count() }}
                                        </p>
                                    @else
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            @if($myTeam->status == '1')
                                                @if($myTeam->main == '1')
                                                    Tiykarǵı quramda
                                                @else
                                                    Rezervte
                                                @endif
                                            @elseif($myTeam->status == '0')
                                                Tastıyıqlaw kútilip atır
                                            @elseif($myTeam->status == '2')
                                                Transferge shıǵarılǵan
                                            @elseif($myTeam->status == '3')
                                                Komandadan ketken
                                            @endif
                                        </p>
                                    @endif
                                </div>
                                @if ($myTeam->team->creator_id == auth()->id())
                                    <a href="{{ route('teams.edit', $myTeam->team->id) }}"
                                       class=" w-9 h-9 flex items-center justify-center bg-slate-50 hover:bg-slate-200
                                   text-slate-600 hover:text-blue-600 text-sm rounded-lg transition-colors border
                                   border-slate-200 shrink-0">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                @endif
                                <a href="{{ route('teams.show', $myTeam->team->id) }}"
                                   class=" w-9 h-9 flex items-center justify-center bg-slate-50 hover:bg-slate-200
                                   text-slate-600 hover:text-blue-600 text-sm rounded-lg transition-colors border
                                   border-slate-200 shrink-0">
                                    <i class="fa fa-users"></i>
                                </a>
                            </div>
                        @empty
                            <div class="text-center">
                                <div
                                    class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-3 text-slate-400">
                                    <i class="fa-solid fa-users-slash text-xl"></i>
                                </div>
                                <p class="text-slate-400" style="font-size: 12px">
                                    Siz házirge shekem hesh bir komandaǵa aǵza bolmaǵansız yamasa komanda dúzbegensiz.
                                </p>
                            </div>
                        @endforelse
                        @if(auth()->user()->priority == '1')
                            <a href="{{ route('teams.create') }}"
                               class="mt-4 inline-block w-full text-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-lg transition-colors shadow-sm">
                                Komanda dúziw
                            </a>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-5 flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-emerald-500"></i>
                            Meniń reytingim
                        </h3>
                        @php
                            $colCl = (isset($faceit) && $faceit->level) ? 'md:grid-cols-5' : 'md:grid-cols-4'
                        @endphp
                        <div class="grid grid-cols-2 sm:grid-cols-3 {!! $colCl !!} gap-4">
                            <div
                                class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center flex flex-col justify-center">
                                <div class="block text-2xl font-black text-slate-900">
                                    {{ $userKpi['games'] ?? 0 }}
                                </div>
                                <span class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">Oyınlar</span>
                            </div>

                            <div
                                class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center flex flex-col justify-center">
                                <div class="block text-2xl font-black text-emerald-600">
                                    {{ number_format(0, 2) }}
                                </div>
                                <span class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">K/D ratio</span>
                            </div>

                            <div
                                class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center flex flex-col justify-center">
                                <div class="flex items-center justify-center gap-1">
                                    <span class="text-2xl font-black text-amber-500">0</span>
                                    <span class="text-xl text-slate-300">/</span>
                                    <span class="text-2xl font-black text-rose-500">0</span>
                                </div>
                                <span
                                    class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">Kills / Deaths</span>
                            </div>

                            <div
                                class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center flex flex-col justify-center">
                                <span class="block text-2xl font-black text-blue-600">0%</span>
                                <span class="text-[10px] font-bold text-slate-500 uppercase mt-1 block">Win Rate</span>
                            </div>

                            @if(isset($faceit) && $faceit->level)
                                <div
                                    class="p-4 bg-slate-50 rounded-lg border border-slate-100 text-center flex flex-col justify-center relative overflow-hidden group">
                                    <i class="fa-brands fa-faceit absolute -right-4 -bottom-4 text-6xl text-[#FF5500]/10 group-hover:scale-110 transition-transform"></i>
                                    <div class="relative z-10 flex flex-col items-center justify-center w-full h-full">
                                        <div class="flex items-center justify-center gap-4">
                                            <div class="faceit-icon lvl-{{ $faceit->level }}"></div>
                                            <div class="text-left flex flex-col justify-center">
                                                <div class="block text-2xl font-black text-slate-900 leading-none">
                                                    {{ $faceit->elo }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
                        <div
                            class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-crosshairs text-blue-500"></i>
                                Oyınlar statistikası
                            </h3>
                        </div>
                        <div class="p-6 flex justify-center">
                            <div class="relative w-full max-w-2xl" style="height: 400px;">
                                <canvas id="mapStatsChart"></canvas>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->priority == '1')
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('mapStatsChart').getContext('2d');
            const mapRates = @json($mapRates);
            const mapLabels = Object.keys(mapRates);
            const winData = [];
            const lossData = [];
            mapLabels.forEach(mapName => {
                winData.push(mapRates[mapName].wins);
                lossData.push(mapRates[mapName].loss);
            });
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: mapLabels,
                    datasets: [
                        {
                            label: 'Wins',
                            data: winData,
                            backgroundColor: 'rgba(16, 185, 129, 0.4)',
                            borderColor: 'rgb(16, 185, 129)',
                            borderWidth: 1,
                            pointBackgroundColor: 'rgb(16, 185, 129)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgb(16, 185, 129)',
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Loss',
                            data: lossData,
                            backgroundColor: 'rgba(244, 63, 94, 0.4)',
                            borderColor: 'rgb(244, 63, 94)',
                            borderWidth: 1,
                            pointBackgroundColor: 'rgb(244, 63, 94)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgb(244, 63, 94)',
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    elements: {
                        line: {
                            tension: 0
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: {size: 14, family: "'Inter', sans-serif"},
                            bodyFont: {size: 13, family: "'Inter', sans-serif"},
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: true
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                color: 'rgba(148, 163, 184, 0.15)'
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.15)',
                                circular: false
                            },
                            pointLabels: {
                                font: {family: "'Inter', sans-serif", weight: 'bold', size: 12},
                                color: '#1e293b'
                            },
                            ticks: {
                                display: false,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
