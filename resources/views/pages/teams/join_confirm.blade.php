@extends('layouts.app')

@section('content')
    <div class="max-w-[800px] mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="bg-white border border-slate-200 rounded-3xl shadow-lg overflow-hidden max-w-lg mx-auto">

            <div class="bg-slate-50 border-b border-slate-100 px-8 py-6 text-center">
                <div
                    class="w-20 h-20 mx-auto rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-3xl font-black text-slate-400 shadow-sm mb-4 overflow-hidden">
                    @if($team->logo)
                        <img src="{{ url($team->logo) }}" alt="Team Logo" class="w-full h-full object-cover">
                    @else
                        <i class="fa-solid fa-users"></i>
                    @endif
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                    {{ $team->name }}
                </h2>
            </div>

            <div class="px-8 py-8 text-center">
                <h3 class="text-lg font-bold text-slate-800 mb-2">
                    Rasınan da usı komandaǵa qosılıwdı qáleysizbe?
                </h3>
                <p class="text-sm font-medium text-slate-500">
                    Siziń arzańız komanda sardorına jiberiledi. Olar tastıyıqlaǵannan keyin siz usı komandanıń
                    tolıqqanlı aǵzasına aylanasaız.
                </p>
            </div>

            <div class="bg-slate-50 px-8 py-5 border-t border-slate-100 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}"
                   class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-100 transition-colors text-center shadow-sm">
                    Biykar etiw
                </a>

                <form action="{{ route('teams.join.post', $token) }}" method="POST" class="m-0 flex-1 sm:flex-none">
                    @csrf
                    <button type="submit"
                            class="w-full px-6 py-3 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-200 transition-colors">
                        Usınıs beriw
                    </button>
                </form>
            </div>

        </div>

    </div>
@endsection
