<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tournament;
use App\Models\University;
use App\Models\UserTournament;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = [
            'liveGames' => Game::where('status', 'live')->with(['team1', 'team2'])->get(),
            'activeTournaments' => Tournament::where('status', 'upcoming')->take(3)->get(),
            'topPlayers' => UserTournament::with('user')->orderBy('kills', 'desc')->take(5)->get(),
        ];

        return view('index', $data);
    }
}
