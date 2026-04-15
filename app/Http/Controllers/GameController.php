<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function matchzyConfig($id)
    {
        $game = Game::with(['team1.players.user', 'team2.players.user'])->findOrFail($id);

        if (!$game->veto || empty($game->veto['is_finished'])) {
            return response()->json(['error' => 'Veto hali yakunlanmagan'], 400);
        }

        $maplist = [];
        $mapSides = [];
        foreach ($game->veto['history'] as $mapSlug => $data) {
            if ($data['action'] === 'pick') {
                $maplist[] = $mapSlug;
                $mapSides[] = ($data['team'] === $game->team1->name) ? 'team1_t' : 'team2_t';
            } elseif ($data['action'] === 'decider') {
                $maplist[] = $mapSlug;
                $mapSides[] = 'knife';
            }
        }

        // 1-jamoa o'yinchilari (Kapitan ro'yxat boshida bo'lishi uchun)
        $team1Captain = [];
        $team1Others = [];
        foreach ($game->team1->players as $player) {
            // Agar o'yinchi ID si jamoa kapitanining ID siga teng bo'lsa
            if ($player->user->id == $game->team1->captain_id) {
                $team1Captain[$player->user->id] = $player->user->name;
            } else {
                $team1Others[$player->user->id] = $player->user->name;
            }
        }
        // Massivlarni birlashtiramiz (Kapitan birinchi bo'ladi)
        $team1Players = $team1Captain + $team1Others;


        // 2-jamoa o'yinchilari (Kapitan ro'yxat boshida bo'lishi uchun)
        $team2Captain = [];
        $team2Others = [];
        foreach ($game->team2->players as $player) {
            // Agar o'yinchi ID si jamoa kapitanining ID siga teng bo'lsa
            if ($player->user->id == $game->team2->captain_id) {
                $team2Captain[$player->user->id] = $player->user->name;
            } else {
                $team2Others[$player->user->id] = $player->user->name;
            }
        }
        // Massivlarni birlashtiramiz (Kapitan birinchi bo'ladi)
        $team2Players = $team2Captain + $team2Others;


        return response()->json([
            'matchid' => 'devcup_match_' . $game->id,
            'gameid' => $game->id,
            'num_maps' => count($maplist),
            'players_per_team' => 5,
            'skip_veto' => true,
            'maplist' => $maplist,
            'map_sides' => $mapSides,
            'team1' => [
                'name' => $game->team1->name,
                'tag' => 'T1',
                'players' => $team1Players
            ],
            'team2' => [
                'name' => $game->team2->name,
                'tag' => 'T2',
                'players' => $team2Players
            ],
            'cvars' => [
                'hostname' => 'DevCUP Match #' . $game->id . ' [' . $game->format . ']',
                'mp_friendlyfire' => '1',
                'mp_freezetime' => '20',
                'mp_overtime_enable' => '1',
                'mp_overtime_startmoney' => '10000',
                'mp_overtime_maxrounds' => '6',
                'mp_autoteambalance' => '0',
                'mp_autokick' => '0',
                'mp_halftime_duration' => '60',
                'mp_disconnect_kills_players' => '0',
                'mp_match_restart_delay' => '180',
                'mp_team_timeout_max' => '3',
                'mp_team_timeout_time' => '30',
                'matchzy_pause_after_restore' => '1',
                'matchzy_autostart_match' => '1',
                'matchzy_autopause_on_disconnect' => '1',
                'matchzy_everyone_ready_autostart' => '1',
                'matchzy_match_start_delay' => '10',
            ]
        ]);
    }
}
