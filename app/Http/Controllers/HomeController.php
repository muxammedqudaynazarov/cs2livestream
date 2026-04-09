<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Map;
use App\Models\Team;
use App\Models\UserGame;
use App\Models\UserTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $myTeams = UserTeam::where('user_id', auth()->id())->where('status', '1')->take(5)->get();
        $userKpi = [
            'games' => UserGame::where('user_id', auth()->id())->count(),
        ];
        $maps = Map::all();
        $mapRates = [];
        foreach ($maps as $map) {
            $mapRates[ucfirst($map->name)]['wins'] = UserGame::where('user_id', auth()->id())->where('map_id', $map->id)->where('win', '1')->count();
            $mapRates[ucfirst($map->name)]['loss'] = UserGame::where('user_id', auth()->id())->where('map_id', $map->id)->where('win', '0')->count();
        }
        $faceit = json_decode(auth()->user()->faceit);
        return view('home', compact(['userKpi', 'mapRates', 'faceit', 'myTeams']));
    }

    public function pick()
    {
        return view('map_pick');
    }
}
