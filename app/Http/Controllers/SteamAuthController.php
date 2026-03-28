<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
            $user = User::updateOrCreate(
                ['id' => $steamUser->getId()],
                [
                    'name' => $steamUser->getNickname(),
                    'steam_avatar' => $steamUser->getAvatar(),
                    'profile_url' => $steamUser->user['profileurl'] ?? null,
                    'country' => $steamUser->user['loccountrycode'] ?? 'UZ',
                ]
            );
            Auth::login($user, true);
            request()->session()->regenerate();
            return redirect()->route('home');
        } catch (\Exception $e) {
            \Log::error('Steam Login xatosi: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Steam avtorizatsiyasida xatolik yuz berdi!');
        }
    }
}
