<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Map;
use App\Models\Option;
use App\Models\Score;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\Team;
use App\Models\University;
use App\Models\UserTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use function Symfony\Component\Translation\t;

class TeamController extends Controller
{
    public function index()
    {
        $season = Season::where('actual', '1')->first();
        if (!$season) {
            $teams = collect();
        } else {
            $teams = SeasonTeam::orderBy('ratio', 'desc')
                ->where('season_id', $season->id)
                ->whereHas('team', function ($query) {
                    $query->where('status', 'active');
                })
                ->paginate(20);
        }
        $i = ($teams instanceof \Illuminate\Pagination\LengthAwarePaginator)
            ? ($teams->currentPage() - 1) * $teams->perPage() + 1
            : 1;
        return view('pages.teams.index', compact('teams', 'i'));
    }

    public function create()
    {
        if (auth()->user()->priority == '0') return redirect()->route('home')->with('error', 'Sizge komanda dúziw huqıqı berilmegen!');
        $universities = University::all();
        return view('pages.teams.create', compact(['universities']));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->priority == '0') return redirect()->route('home')->with('error', 'Sizge komanda dúziw huqıqı berilmegen!');

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
            'form_id' => $request->from_id,
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
        UserTeam::create([
            'user_id' => auth()->id(),
            'team_id' => $team->id,
            'status' => '1',
        ]);
        $user->priority = '0';
        $user->save();
        return redirect()->route('teams.index')->with('success', 'Siziń komandańız tekseriw ushın dizimge alındı. Raxmet!');
    }

    public function edit(Team $team)
    {
        $universities = University::all();
        return view('pages.teams.edit', compact(['team', 'universities']));
    }

    public function regenerateUrl(Team $team)
    {
        $team->update(['join_url' => Str::random(16)]);
        return back()->with('success', 'Silteme tabıslı jańalandı!');
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'required|string|size:3',
            'form_id' => 'required|exists:universities,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);
        if ($request->delete_logo == '1') {
            $this->deleteImage($team->logo);
            $team->logo = null;
        }
        if ($request->hasFile('logo')) {
            $team->logo = $this->uploadImage($request->file('logo'));
        }

        $team->name = $request->name;
        $team->tag = strtoupper($request->tag);
        $team->form_id = $request->form_id;
        $team->save();
        return redirect()->route('home')->with('success', 'Komanda maǵlıwmatları tabıslı ózgertildi!');
    }

    private function uploadImage($file)
    {
        $path = $file->store('teams_logo', 'public');
        return 'storage/' . $path;
    }

    public function joinTeam($token)
    {
        $team = Team::where('join_url', $token)->firstOrFail();
        $user = auth()->user();
        $existingRequest = UserTeam::where('user_id', $user->id)->where('team_id', $team->id)->first();
        if ($existingRequest) {
            if ($existingRequest->status == '1') {
                return redirect()->route('home')->with('info', 'Siz komandaǵa aldınnan qosılǵansız!');
            } else {
                return redirect()->route('home')->with('info', 'Siz usı komandaǵa arza jibergensiz, juwap kútilmekte!');
            }
        }
        $activeInOtherTeam = UserTeam::where('user_id', $user->id)->where('status', '1')->first();
        if ($activeInOtherTeam) {
            return redirect()->route('home')->with('error', 'Siz aldın basqa komanda oyınshısı retinde dizimge alınǵansız!');
        }
        return view('pages.teams.join_confirm', compact('team', 'token'));
    }

    public function joinTeamPost($token)
    {
        $team = Team::where('join_url', $token)->firstOrFail();
        $user = auth()->user();
        $existingRequest = UserTeam::where('user_id', $user->id)->where('team_id', $team->id)->first();
        $activeInOtherTeam = UserTeam::where('user_id', $user->id)->where('status', '1')->first();
        if ($existingRequest || $activeInOtherTeam) {
            return redirect()->route('home')->with('error', 'Arzanı jiberiwde qátelik júz berdi, statusıńızdı tekseriń!');
        }
        UserTeam::create([
            'user_id' => $user->id,
            'team_id' => $team->id,
            'status' => '0',
        ]);
        return redirect()->route('teams.index')->with('success', 'Siziń arzańız komanda kapitanına jiberildi!');
    }

    public function show(Team $team)
    {
        $transfer = Option::where('key', 'transfer')->value('value');
        $maps = Map::all();
        $labels = [];
        $winsData = [];
        $lossesData = [];

        foreach ($maps as $map) {
            $labels[] = ucfirst($map->name);
            $wins = Score::where('map_id', $map->id)->where('winner_team_id', $team->id)->count();
            $losses = Score::where('map_id', $map->id)->whereHas('game', function ($q) use ($team) {
                $q->where('team_1_id', $team->id)->orWhere('team_2_id', $team->id);
            })->whereNotNull('winner_team_id')->where('winner_team_id', '!=', $team->id)->count();
            $winsData[] = $wins;
            $lossesData[] = $losses;
        }
        //dd($team, $transfer, $labels, $winsData, $lossesData);
        return view('pages.teams.show', compact(['team', 'transfer', 'labels', 'winsData', 'lossesData']));
    }
}
