<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    private $map_pool = [
        'de_mirage', 'de_inferno', 'de_nuke', 'de_ancient',
        'de_anubis', 'de_dust2', 'de_overpass'
    ];

    private $sequence = [
        ['team' => 'Team 1', 'action' => 'ban'],
        ['team' => 'Team 2', 'action' => 'ban'],
        ['team' => 'Team 1', 'action' => 'ban'],
        ['team' => 'Team 2', 'action' => 'ban'],
        ['team' => 'Team 1', 'action' => 'pick'],
        ['team' => 'Team 2', 'action' => 'pick'],
    ];

    public function index($id)
    {
        $sessionKey = 'veto_match_' . $id;
        if (!session()->has($sessionKey)) {
            session([
                $sessionKey => [
                    'step' => 0,
                    'available_maps' => $this->map_pool,
                    'history' => [],
                    'is_finished' => false
                ]
            ]);
        }
        $vetoState = session($sessionKey);
        $currentTurn = $vetoState['is_finished'] ? null : $this->sequence[$vetoState['step']];
        return view('map_pick', compact(['id', 'vetoState', 'currentTurn']));
    }

    public function action(Request $request, $id)
    {
        $sessionKey = 'veto_match_' . $id;
        $state = session($sessionKey);
        $map = $request->input('map');
        if ($state['is_finished'] || !in_array($map, $state['available_maps'])) {
            return response()->json(['error' => 'Invalid move'], 400);
        }
        $step = $state['step'];
        $currentTurn = $this->sequence[$step];

        $state['history'][$map] = [
            'action' => $currentTurn['action'],
            'team' => $currentTurn['team']
        ];
        $state['available_maps'] = array_values(array_diff($state['available_maps'], [$map]));
        $state['step']++;

        if ($state['step'] == 6) {
            $deciderMap = $state['available_maps'][0];
            $state['history'][$deciderMap] = [
                'action' => 'decider',
                'team' => 'Auto'
            ];
            $state['available_maps'] = [];
            $state['is_finished'] = true;
        }

        session([$sessionKey => $state]);
        $nextTurn = $state['is_finished'] ? null : $this->sequence[$state['step']];
        return response()->json([
            'status' => 'success',
            'map' => $map,
            'action' => $currentTurn['action'],
            'team' => $currentTurn['team'],
            'is_finished' => $state['is_finished'],
            'history' => $state['history'],
            'next_turn' => $nextTurn
        ]);
    }

    // MapController.php ichiga qo'shiladigan yangi metod:

    public function autoAction($id)
    {
        $sessionKey = 'veto_match_' . $id;
        $state = session($sessionKey);

        // Agar sessiya bo'lmasa yoki o'yin allaqachon tugagan bo'lsa, xato qaytaramiz
        if (!$state || $state['is_finished']) {
            return response()->json(['error' => 'Invalid state'], 400);
        }

        $step = $state['step'];
        $currentTurn = $this->sequence[$step];

        // Mavjud (hali tanlanmagan) xaritalar ichidan tasodifiy bittasini tanlaymiz
        $randomMapKey = array_rand($state['available_maps']);
        $map = $state['available_maps'][$randomMapKey];

        // 1. Tanlangan mapni history'ga qo'shamiz
        $state['history'][$map] = [
            'action' => $currentTurn['action'],
            'team' => $currentTurn['team'] . ' (Auto)' // Avtomat qilinganini bildirish uchun
        ];

        $state['available_maps'] = array_values(array_diff($state['available_maps'], [$map]));
        $state['step']++;

        // 2. Decider mantiqi (agar oxirgi qadam bo'lsa)
        if ($state['step'] == 6) {
            $deciderMap = $state['available_maps'][0];
            $state['history'][$deciderMap] = [
                'action' => 'decider',
                'team' => 'Auto'
            ];
            $state['available_maps'] = [];
            $state['is_finished'] = true;

            // SHU YERDA: Veto tugadi, bazaga yozish mumkin.
        }

        // Sessiyani yangilash
        session([$sessionKey => $state]);

        $nextTurn = $state['is_finished'] ? null : $this->sequence[$state['step']];

        return response()->json([
            'status' => 'success',
            'map' => $map,
            'action' => $currentTurn['action'],
            'team' => $currentTurn['team'],
            'is_finished' => $state['is_finished'],
            'history' => $state['history'],
            'next_turn' => $nextTurn
        ]);
    }
}
