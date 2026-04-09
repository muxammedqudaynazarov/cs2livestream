<?php

namespace App\Http\Controllers;

use App\Models\CsDatum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CsDatumController extends Controller
{
    public function livestream(Request $request)
    {
        CsDatum::create([
            'data' => json_encode($request->all()),
        ]);
        return response()->json([
            'status' => 'OK',
        ]);
    }

    public function gsi()
    {
        $content = '"DevCup_GSI"
{
    "uri" "https://cs2.devcup.uz/api/livestream/gsi"
    "timeout" "5.0"
    "buffer"  "0.1"
    "throttle" "1"
    "heartbeat" "30.0"
    "data"
    {
        "provider"               "1"
        "map"                    "1"
        "round"                  "1"
        "player_id"              "0"
        "player_state"           "0"
        "player_weapons"         "0"
        "player_match_stats"     "0"
        "allplayers_id"          "1"
        "allplayers_state"       "1"
        "allplayers_match_stats" "1"
        "allplayers_weapons"     "1"
        "phase_countdowns"       "1"
    }
}';
        $fileName = 'gamestate_integration_devcup.cfg';
        return Response::streamDownload(function () use ($content) {
            echo $content;
        }, $fileName, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
