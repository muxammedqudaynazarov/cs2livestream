<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SteamAuthController extends Controller
{
    public function redirectToSteam()
    {
        return Socialite::driver('steam')->redirect();
    }

    public function handleSteamCallback()
    {
        try {
            $steamUser = Socialite::driver('steam')->user();
            $steamId64 = $steamUser->getId();
            $faceitId = null;
            $faceitLevel = null;
            $faceitElo = null;
            $faceitResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('FACEIT_API_KEY'),
            ])->get('https://open.faceit.com/data/v4/players', [
                'game' => 'cs2',
                'game_player_id' => $steamId64,
            ]);
            if ($faceitResponse->successful()) {
                $data = $faceitResponse->json();
                $faceitId = $data['player_id'] ?? null;
                $faceitLevel = $data['games']['cs2']['skill_level'] ?? null;
                $faceitElo = $data['games']['cs2']['faceit_elo'] ?? null;
            }
            $user = User::updateOrCreate(
                ['id' => $steamId64],
                [
                    'name' => $steamUser->getNickname(),
                    'steam_avatar' => $steamUser->getAvatar(),
                    'profile_url' => $steamUser->user['profileurl'] ?? null,
                    'country' => $steamUser->user['loccountrycode'] ?? 'UZ',
                    'faceit' => json_encode([
                        'id' => $faceitId,
                        'level' => $faceitLevel,
                        'elo' => $faceitElo
                    ]),
                ]
            );
            Auth::login($user);
            request()->session()->regenerate();
            return redirect()->route('home');
        } catch (\Exception $e) {
            Log::error('Tizimga kirish xatosi: ' . $e->getMessage());
            return redirect('/')->with('error', 'Avtorizatsiyada xatolik yuz berdi!');
        }
    }
}
