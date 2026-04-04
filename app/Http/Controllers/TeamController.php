<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\Team;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function index()
    {
        $season = Season::where('actual', '1')->first();
        $teams = SeasonTeam::orderBy('ratio', 'desc')->where('season_id', $season->id)->paginate(20);
        return view('pages.teams.index', compact(['teams']));
    }

    public function create()
    {
        $universities = University::all();
        return view('pages.teams.create', compact(['universities']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
            'tag' => 'required|string|size:3|unique:teams,tag',
            'from_id' => 'required|exists:universities,id',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:4096|dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200',
        ], [
            'name.unique' => 'Bul komanda ataması aldın dizimge alınǵan.',
            'tag.unique' => 'Bul 3 háripli TEG aldın basqa komanda ushın dizimge alınǵan.',
            'tag.size' => 'TEG eń kemi hám kóbi menen 3 belgiden ibarat bolıwı kerak.',
            'logo.max' => 'Súwrettiń kólemi maksimal kólemnen aspawı kerek.',
            'logo.image' => 'Tek ǵana súwretli fayllardı qosıw múmkin.',
            'logo.dimensions' => 'Súwrettiń ólshemi eń keminde 300x300px hám eń kóbi 1200x1200px aralıǵında bolıwı shárt.',
        ]);
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = strtoupper($request->tag) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('teams_logo', $filename, 'public');
            $logoPath = 'storage/teams_logo/' . $filename;
        }
        $team = Team::create([
            'name' => $request->name,
            'tag' => strtoupper($request->tag),
            'university_id' => $request->from_id,
            'creator_id' => auth()->id(),
            'captain_id' => auth()->id(),
            'join_url' => Str::random(16),
            'logo' => $logoPath,
        ]);
        $season = Season::where('actual', '1')->first();
        SeasonTeam::create([
            'team_id' => $team->id,
            'season_id' => $season->id,
        ]);
        return redirect()->route('teams.index')->with('success', 'Siziń komandańız tekseriw ushın dizimge alındı. Raxmet!');
    }
}
