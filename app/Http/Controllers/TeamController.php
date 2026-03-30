<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::where('creator_id', auth()->id())->get();
        return view('pages.teams.index', compact('teams'));
    }
}
