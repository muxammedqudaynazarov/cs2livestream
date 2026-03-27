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
            dd($steamUser);
            $user = User::firstOrCreate(
                ['steam_id' => $steamUser->getId()], // SteamID64
                [
                    'name' => $steamUser->getNickname(),   // O'yindagi niki
                    'avatar' => $steamUser->getAvatar(),   // Profil rasmi
                    'password' => bcrypt(str_random(16))   // Avtomatik parol
                ]
            );

// Tizimga kiritamiz
            Auth::login($user, true);

// Asosiy sahifaga yo'naltiramiz
            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Steam avtorizatsiyasida xatolik yuz berdi!');
        }
    }
}
