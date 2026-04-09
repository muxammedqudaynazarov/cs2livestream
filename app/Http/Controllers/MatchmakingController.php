<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Map;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MatchmakingController extends Controller
{
    public function index()
    {
        return view('matchmaking');
    }

    public function create()
    {
        $teams = Team::where('status', 'active')->inRandomOrder()->limit(2)->get();
        $team1 = $teams[0];
        $team2 = $teams[1];

        $game = Game::create([
            'tournament_id' => 1,
            'team_1_id' => $team1->id,
            'team_2_id' => $team2->id,
            'stage' => 'Matchmaking',
            'status' => 'waiting',
            'format' => 'BO1',
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

        if (!$game) {
            abort(404, "O'yin topilmadi yoki yakunlangan.");
        }

        $user = auth()->user();
        $isT1Cap = $user->id == $game->team1->captain_id;
        $isT2Cap = $user->id == $game->team2->captain_id;

        // XAVFSIZLIK: Planned, waiting va picking statuslarida faqat kapitanlar kira oladi
        if (in_array($game->status, ['planned', 'waiting', 'picking']) && !$isT1Cap && !$isT2Cap) {
            abort(403, "Ushbu sahifaga faqat jamoa sardorlari kira oladi.");
        }

        $maps = Map::where('status', '1')->get();
        $cacheKey = 'veto_match_' . $id;

        // Veto holatini Cache dan olish (bo'lmasa yaratish)
        $vetoState = Cache::rememberForever($cacheKey, function () use ($maps) {
            return [
                'step' => 0,
                'available_maps' => $maps->pluck('slug')->toArray(),
                'history' => [],
                'is_finished' => false
            ];
        });

        // Xaritalarni Veto holati bilan birlashtirish
        $veto = $maps->map(function ($map) use ($vetoState) {
            $stage = 'open';
            $team = null;

            if (isset($vetoState['history'][$map->slug])) {
                $stage = $vetoState['history'][$map->slug]['action'];
                $team = $vetoState['history'][$map->slug]['team'];
            }

            return [
                'map' => [
                    'id' => $map->id,
                    'name' => $map->name,
                    'slug' => $map->slug,
                    'status' => [
                        'stage' => $stage,
                        'team' => $team,
                    ],
                ],
            ];
        })->toArray();

        // O'yin qabul qilinish holati
        $confirmedData = is_string($game->confirmed) ? json_decode($game->confirmed, true) : ($game->confirmed ?? []);

        // Agar ikkala kapitan ham qabul qilgan bo'lsa, o'yin statusini 'picking' ga o'zgartiramiz
        if (isset($confirmedData['team1']['status']) && $confirmedData['team1']['status'] &&
            isset($confirmedData['team2']['status']) && $confirmedData['team2']['status'] &&
            $game->status == 'waiting') {
            $game->update(['status' => 'picking']);
        }

        $statusInfo = [
            'state' => $game->status,
            'confirmed' => $confirmedData,
        ];

        $matchData = [
            'status' => 'success',
            'game' => [
                'id' => $game->id,
                'format' => $game->format,
                'status' => $statusInfo,
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
            'vetoState' => $vetoState // Current step va turnlarni bilish uchun
        ];

        return view('map_pick', [
            'match' => $matchData,
            'id' => $id
        ]);
    }

    // O'yinni qabul qilish (Accept tugmasi bosilganda)
    public function accept(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $team = $request->input('team'); // 'team1' yoki 'team2'

        $confirmed = is_string($game->confirmed) ? json_decode($game->confirmed, true) : ($game->confirmed ?? []);

        $confirmed[$team] = [
            'status' => true,
            'confirmed_at' => now()->toDateTimeString(),
        ];

        $game->confirmed = $confirmed;
        $game->save();

        return response()->json(['status' => 'success']);
    }

    // AJAX uchun API Status
    public function statusApi($id)
    {
        $game = Game::findOrFail($id);
        $confirmed = is_string($game->confirmed) ? json_decode($game->confirmed, true) : ($game->confirmed ?? []);
        return response()->json(['status' => $game->status, 'confirmed' => $confirmed]);
    }
}
