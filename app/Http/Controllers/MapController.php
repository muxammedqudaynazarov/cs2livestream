<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MapController extends Controller
{
    // O'yin formatiga qarab ketma-ketlikni belgilaymiz
    private function getSequence($format)
    {
        if ($format === 'BO3') {
            return [
                ['team' => 'team1', 'action' => 'ban'],
                ['team' => 'team2', 'action' => 'ban'],
                ['team' => 'team1', 'action' => 'pick'],
                ['team' => 'team2', 'action' => 'pick'],
                ['team' => 'team1', 'action' => 'ban'],
                ['team' => 'team2', 'action' => 'ban'],
            ];
        } elseif ($format === 'BO5') {
            return [
                ['team' => 'team1', 'action' => 'ban'],
                ['team' => 'team2', 'action' => 'ban'],
                ['team' => 'team1', 'action' => 'pick'],
                ['team' => 'team2', 'action' => 'pick'],
                ['team' => 'team1', 'action' => 'pick'],
                ['team' => 'team2', 'action' => 'pick'],
            ];
        }

        // Default (BO1)
        return [
            ['team' => 'team1', 'action' => 'ban'],
            ['team' => 'team2', 'action' => 'ban'],
            ['team' => 'team1', 'action' => 'ban'],
            ['team' => 'team2', 'action' => 'ban'],
            ['team' => 'team1', 'action' => 'ban'],
            ['team' => 'team2', 'action' => 'ban'],
        ];
    }

    public function action(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $cacheKey = 'veto_match_' . $id;
        $state = Cache::get($cacheKey);

        $map = $request->input('map');
        $sequence = $this->getSequence($game->format);

        if (!$state || $state['is_finished'] || !in_array($map, $state['available_maps'])) {
            return response()->json(['error' => 'Noto\'g\'ri harakat'], 400);
        }

        $step = $state['step'];
        $currentTurn = $sequence[$step];

        // XAVFSIZLIK: Faqat o'z navbati kelgan jamoa sardori bosa oladi
        $user = auth()->user();
        $isMyTurn = false;

        if ($currentTurn['team'] == 'team1' && $user->id == $game->team1->captain_id) $isMyTurn = true;
        if ($currentTurn['team'] == 'team2' && $user->id == $game->team2->captain_id) $isMyTurn = true;

        if (!$isMyTurn) {
            return response()->json(['error' => 'Hozir sizning navbatingiz emas!'], 403);
        }

        // Harakatni qayd etamiz
        $state['history'][$map] = [
            'action' => $currentTurn['action'],
            'team' => $currentTurn['team'] == 'team1' ? $game->team1->name : $game->team2->name
        ];

        $state['available_maps'] = array_values(array_diff($state['available_maps'], [$map]));
        $state['step']++;

        // Avtomatik decider xaritasi (Oxirgi bosqich)
        if ($state['step'] == count($sequence)) {
            $deciderMap = $state['available_maps'][0];
            $state['history'][$deciderMap] = [
                'action' => 'decider',
                'team' => 'Auto'
            ];
            $state['available_maps'] = [];
            $state['is_finished'] = true;

            // O'yin statusini live ga o'tkazib yuboramiz
            $game->update(['status' => 'live']);
        }

        Cache::put($cacheKey, $state);

        return response()->json(['status' => 'success']);
    }

    public function autoAction($id)
    {
        $game = Game::findOrFail($id);
        $cacheKey = 'veto_match_' . $id;
        $state = Cache::get($cacheKey);
        $sequence = $this->getSequence($game->format);

        if (!$state || $state['is_finished']) {
            return response()->json(['error' => 'Noto\'g\'ri holat'], 400);
        }

        $step = $state['step'];
        $currentTurn = $sequence[$step];

        // Tasodifiy xarita
        $randomMapKey = array_rand($state['available_maps']);
        $map = $state['available_maps'][$randomMapKey];

        $teamName = $currentTurn['team'] == 'team1' ? $game->team1->name : $game->team2->name;

        $state['history'][$map] = [
            'action' => $currentTurn['action'],
            'team' => $teamName . ' (Auto)'
        ];

        $state['available_maps'] = array_values(array_diff($state['available_maps'], [$map]));
        $state['step']++;

        if ($state['step'] == count($sequence)) {
            $deciderMap = $state['available_maps'][0];
            $state['history'][$deciderMap] = [
                'action' => 'decider',
                'team' => 'Auto'
            ];
            $state['available_maps'] = [];
            $state['is_finished'] = true;

            $game->update(['status' => 'live']);
        }

        Cache::put($cacheKey, $state);

        return response()->json(['status' => 'success']);
    }
}
