<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $game = UserGame::where('user_id', auth()->id())->first();
        $userKpi = [
            'games' => UserGame::where('user_id', auth()->id())->count(),
        ];
        return view('home', compact(['userKpi']));
    }
}
