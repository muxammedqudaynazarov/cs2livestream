@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-8 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Komandalar reytingi</h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Sistemada dizimge alınǵan hámme komandalar hám olardıń statistikaları.
                    </p>
                </div>

                <a href="{{ route('teams.create') }}"
                   class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition-all active:scale-95 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fa-solid fa-plus text-sm"></i>
                    <span>Komanda qosıw</span>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/80 flex justify-between items-center">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-crosshairs text-blue-500"></i>
                        Komandalar
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead
                            class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase font-black text-slate-500 tracking-widest">
                        <tr>
                            <th scope="col" style="width: 7%" class="px-6 py-4 text-center">#</th>
                            <th scope="col" class="px-6 py-4">Jamoa (Team)</th>
                            <th scope="col" style="width: 7%" class="px-6 py-4 text-center">O</th>
                            <th scope="col" style="width: 7%" class="px-6 py-4 text-center">U</th>
                            <th scope="col" style="width: 7%" class="px-6 py-4 text-center">J</th>
                            <th scope="col" style="width: 7%" class="px-6 py-4 text-center">%</th>
                            <th scope="col" style="width: 12%" class="px-6 py-4 text-center">K / D</th>
                            <th scope="col" style="width: 12%" class="px-6 py-4 text-center text-blue-600">Rating</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                        @forelse($teams as $team)
                            <tr class="hover:bg-slate-50/80 transition-colors group">

                                <td class="px-6 py-4 text-center font-bold text-slate-400">
                                    {{ ($teams->currentPage() - 1) * $teams->perPage() + $loop->iteration }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="relative w-10 h-10 rounded-full bg-slate-100 border-2 border-slate-200 overflow-hidden flex-shrink-0 group-hover:border-blue-400 transition-colors">
                                            @if($team->team->logo)
                                                <img src="{{ $team->team->logo }}" alt="{{ $team->team->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <i class="fa-solid fa-shield text-slate-400 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></i>
                                            @endif
                                        </div>
                                        <span
                                            class="font-black text-slate-900 text-base uppercase tracking-tight">{{ $team->team->name }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center font-bold text-slate-600">
                                    {{ $team->team->all_games->count() }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $team->team->wins_count }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $team->team->losses_count }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ number_format(($team->team->wins_count / ($team->team->all_games->count() == 0 ? 1 : $team->team->all_games->count()) * 100), 2) }}%
                                </td>

                                <td class="px-6 py-4 text-center font-semibold text-slate-600">
                                    <span class="text-slate-900">{{ $team->kills }}</span>
                                    <span class="text-slate-300 mx-1">/</span>
                                    <span class="text-slate-500">{{ $team->deaths }}</span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-black {{ $team->ratio >= 1.0 ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ number_format($team->ratio, 2) }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-300 mb-4">
                                        <i class="fa-solid fa-users-slash text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Hesh qanday maǵlıwmat tabılmadı
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @if($teams->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $teams->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
