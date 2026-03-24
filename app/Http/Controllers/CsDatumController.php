<?php

namespace App\Http\Controllers;

use App\Models\CsDatum;
use Illuminate\Http\Request;

class CsDatumController extends Controller
{
    public function livestream(Request $request)
    {
        CsDatum::create([
            'data' => json_encode($request->data),
        ]);
        return response()->json([
            'status' => 'OK',
        ]);
    }
}
