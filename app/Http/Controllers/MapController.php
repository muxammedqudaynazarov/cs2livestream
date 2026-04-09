<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Events\MatchUpdated;
use Illuminate\Http\Request;

class MapController extends Controller
{
    private function getSequence($format)
    {
        if ($format === 'BO3') {
            return [['team' => 'team1', 'action' => 'ban'], ['team' => 'team2', 'action' => 'ban'], ['team' => 'team1', 'action' => 'pick'], ['team' => 'team2', 'action' => 'pick'], ['team' => 'team1', 'action' => 'ban'], ['team' => 'team2', 'action' => 'ban']];
        } elseif ($format === 'BO5') {
            return [['team' => 'team1', 'action' => 'ban'], ['team' => 'team2', 'action' => 'ban'], ['team' => 'team1', 'action' => 'pick'], ['team' => 'team2', 'action' => 'pick'], ['team' => 'team1', 'action' => 'pick'], ['team' => 'team2', 'action' => 'pick']];
        }
        return [['team' => 'team1', 'action' => 'ban'], ['team' => 'team2', 'action' => 'ban'], ['team' => 'team1', 'action' => 'ban'], ['team' => 'team2', 'action' => 'ban'], ['team' => 'team1', 'action' => 'ban'], ['team' => 'team2', 'action' => 'ban']];
    }

    public function action(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $state = $game->veto; // DB dan o'qiymiz

        $map = $request->input('map');
        $sequence = $this->getSequence($game->format);

        if (!$state || $state['is_finished'] || !in_array($map, $state['available_maps'])) {
            return response()->json(['error' => 'Noto\'g\'ri harakat'], 400);
        }

        $step = $state['step'];
        $currentTurn = $sequence[$step];

        $user = auth()->user();
        $isMyTurn = false;

        if ($currentTurn['team'] == 'team1' && $user->id == $game->team1->captain_id) $isMyTurn = true;
        if ($currentTurn['team'] == 'team2' && $user->id == $game->team2->captain_id) $isMyTurn = true;

        if (!$isMyTurn) return response()->json(['error' => 'Hozir sizning navbatingiz emas!'], 403);

        $state['history'][$map] = [
            'action' => $currentTurn['action'],
            'team' => $currentTurn['team'] == 'team1' ? $game->team1->name : $game->team2->name
        ];

        $state['available_maps'] = array_values(array_diff($state['available_maps'], [$map]));
        $state['step']++;

        if ($state['step'] == count($sequence)) {
            $deciderMap = $state['available_maps'][0];
            $state['history'][$deciderMap] = ['action' => 'decider', 'team' => 'Auto'];
            $state['available_maps'] = [];
            $state['is_finished'] = true;
            $game->status = 'live';
        }

        // DB ni yangilaymiz va Event yuboramiz
        $game->veto = $state;
        $game->save();
        event(new MatchUpdated($game->id));

        return response()->json(['status' => 'success']);
    }

    public function autoAction($id)
    {
        $game = Game::findOrFail($id);
        $state = $game->veto;
        $sequence = $this->getSequence($game->format);

        if (!$state || $state['is_finished']) return response()->json(['error' => 'Noto\'g\'ri holat'], 400);

        $step = $state['step'];
        $currentTurn = $sequence[$step];

        $randomMapKey = array_rand($state['available_maps']);
        $map = $state['available_maps'][$randomMapKey];

        $teamName = $currentTurn['team'] == 'team1' ? $game->team1->name : $game->team2->name;

        $state['history'][$map] = ['action' => $currentTurn['action'], 'team' => $teamName . ' (Auto)'];
        $state['available_maps'] = array_values(array_diff($state['available_maps'], [$map]));
        $state['step']++;

        if ($state['step'] == count($sequence)) {
            $deciderMap = $state['available_maps'][0];
            $state['history'][$deciderMap] = ['action' => 'decider', 'team' => 'Auto'];
            $state['available_maps'] = [];
            $state['is_finished'] = true;
            $game->status = 'live';
        }

        $game->veto = $state;
        $game->save();
        event(new MatchUpdated($game->id));

        return response()->json(['status' => 'success']);
    }
}
