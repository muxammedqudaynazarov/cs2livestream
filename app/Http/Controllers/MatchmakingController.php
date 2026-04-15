<?php

namespace App\Http\Controllers;

use App\Events\MatchUpdated;
use App\Models\Game;
use App\Models\Map;
use App\Models\Team;
use Illuminate\Http\Request;

class MatchmakingController extends Controller
{
    public function index()
    {
        return view('matchmaking');
    }

    public function checkActiveMatch()
    {
        $user = auth()->user();
        $teamId = $user->team->id ?? null;
        if (!$teamId) return response()->json(['status' => 'error']);

        $activeGame = Game::whereIn('status', ['waiting', 'picking'])
            ->where(function ($query) use ($teamId) {
                $query->where('team_1_id', $teamId)
                    ->orWhere('team_2_id', $teamId);
            })->first();

        if ($activeGame) {
            return response()->json([
                'status' => 'success',
                'match_id' => $activeGame->id
            ]);
        }
        return response()->json(['status' => 'not_found']);
    }

    public function create()
    {
        $teams = Team::where('status', 'active')->inRandomOrder()->limit(2)->get();

        if ($teams->count() < 2) {
            return response()->json(['error' => 'Yetarli jamoalar topilmadi!'], 400);
        }

        $team1 = $teams[0];
        $team2 = $teams[1];

        $game = Game::create([
            'tournament_id' => 1,
            'team_1_id' => $team1->id,
            'team_2_id' => $team2->id,
            'stage' => 'Matchmaking',
            'status' => 'waiting',
            'format' => 'BO3',
        ]);

        return response()->json([
            'status' => 'success',
            'game' => [
                'id' => $game->id,
                'status' => $game->status,
            ],
            'teams' => [
                'team_1_id' => $team1->id,
                'team_2_id' => $team2->id,
            ]
        ]);
    }

    public function show($id)
    {
        $game = Game::with(['team1.captain', 'team2.captain'])->find($id);

        if (!$game) abort(404, "O'yin topilmadi yoki yakunlangan.");

        $user = auth()->user();
        $isT1Cap = $user->id == $game->team1->captain_id;
        $isT2Cap = $user->id == $game->team2->captain_id;

        if (in_array($game->status, ['planned', 'waiting', 'picking']) && !$isT1Cap && !$isT2Cap) {
            abort(403, "Ushbu sahifaga faqat jamoa sardorlari kira oladi.");
        }

        $maps = Map::where('status', '1')->get();

        $vetoState = $game->veto;

        if (!$vetoState) {
            $vetoState = [
                'step' => 0,
                'available_maps' => $maps->pluck('slug')->toArray(),
                'history' => [],
                'is_finished' => false,
            ];
            $game->update(['veto' => $vetoState]);
        }

        $veto = $maps->map(function ($map) use ($vetoState) {
            $stage = 'open';
            $team = null;
            $side = null;

            if (isset($vetoState['history'][$map->slug])) {
                $stage = $vetoState['history'][$map->slug]['action'];
                $team = $vetoState['history'][$map->slug]['team'];
                $side = $vetoState['history'][$map->slug]['side'] ?? null;
            }

            return [
                'map' => [
                    'id' => $map->id,
                    'name' => $map->name,
                    'slug' => $map->slug,
                    'status' => ['stage' => $stage, 'team' => $team, 'side' => $side],
                ],
            ];
        })->toArray();

        $confirmedData = is_string($game->confirmed) ? json_decode($game->confirmed, true) : ($game->confirmed ?? []);

        if (isset($confirmedData['team1']['status']) && $confirmedData['team1']['status'] &&
            isset($confirmedData['team2']['status']) && $confirmedData['team2']['status'] &&
            $game->status == 'waiting') {

            $game->update(['status' => 'picking']);
            event(new MatchUpdated($game->id));
        }

        $statusInfo = ['state' => $game->status, 'confirmed' => $confirmedData];

        $matchData = [
            'status' => 'success',
            'game' => [
                'id' => $game->id,
                'format' => $game->format,
                'status' => $statusInfo,
                'server' => [
                    'ip' => '5.133.123.28',
                    'port' => 27015,
                    'password' => 'devcup_match_' . $game->id,
                    'connect_url' => 'steam://connect/5.133.123.28:27015/devcup_match_' . $game->id
                ]
            ],
            'teams' => [
                'team1' => [
                    'id' => $game->team1->id,
                    'name' => $game->team1->name,
                    'captain' => ['id' => $game->team1->captain->id, 'name' => $game->team1->captain->name]
                ],
                'team2' => [
                    'id' => $game->team2->id,
                    'name' => $game->team2->name,
                    'captain' => ['id' => $game->team2->captain->id, 'name' => $game->team2->captain->name]
                ]
            ],
            'veto' => $veto,
            'vetoState' => $vetoState
        ];

        return view('map_pick', [
            'match' => $matchData,
            'id' => $id
        ]);
    }

    public function accept(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $team = $request->input('team');

        $confirmed = is_string($game->confirmed) ? json_decode($game->confirmed, true) : ($game->confirmed ?? []);
        $confirmed[$team] = [
            'status' => true,
            'confirmed_at' => now()->toDateTimeString()
        ];

        $game->confirmed = $confirmed;
        $game->save();

        event(new MatchUpdated($game->id));

        return response()->json(['status' => 'success']);
    }

    public function statusApi($id)
    {
        $game = Game::findOrFail($id);
        $confirmed = is_string($game->confirmed) ? json_decode($game->confirmed, true) : ($game->confirmed ?? []);

        return response()->json([
            'status' => $game->status,
            'confirmed' => $confirmed
        ]);
    }
}
