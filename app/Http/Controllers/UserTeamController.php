<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Http\Request;

class UserTeamController extends Controller
{
    public function makeCaptain(Request $request, Team $team, User $player)
    {
        $userTeam = UserTeam::where('user_id', $player->id)->where('team_id', $team->id)->where('status', '1')->exists();
        if (!$userTeam) {
            return back()->with('error', 'Bul oyınshı siziń komandańızdan emes!');
        }
        $team->update(['captain_id' => $player->id]);
        return redirect()->back()->with('success', 'Komanda kapitanı ózgertildi!');
    }

    public function acceptPlayer(Request $request, Team $team, User $player)
    {
        $userTeams = UserTeam::where('user_id', $player->id)->get();
        $access = true;
        foreach ($userTeams as $userTeam) if ($userTeam->status == '1') $access = false;
        if (!$access) {
            UserTeam::where('user_id', $player->id)->where('team_id', $team->id)->delete();
            return redirect()->back()->with('error', 'Qosılıw arzasın qabıllaw múmkinshiligi boladı.');
        }
        UserTeam::where('user_id', $player->id)->where('team_id', '!=', $team->id)->delete();
        UserTeam::where('user_id', $player->id)->where('team_id', $team->id)->update(['status' => '1']);
        return redirect()->back()->with('success', 'Gamer komandaǵa qabıl etildi!');
    }

    /**
     * Kutilayotgan arizani rad etish
     */
    public
    function rejectPlayer(Request $request, Team $team, Player $player)
    {
        if ($player->team_id !== $team->id || $player->status !== 'pending') {
            return back()->with('error', 'Arizani rad etishda xatolik yuz berdi.');
        }

        // O'yinchini komandadan chiqarib yuborish (yoki statusini 'rejected' qilish)
        $player->update([
            'team_id' => null,
            'status' => 'free_agent' // Erkin agentga aylantiramiz
        ]);

        return back()->with('success', 'Ariza rad etildi.');
    }

    /**
     * O'yinchini narxini belgilab transferga chiqarish
     */
    public
    function transferPlayer(Request $request, Team $team, Player $player)
    {
        // Narxni validatsiya qilish
        $request->validate([
            'price' => 'required|numeric|min:0'
        ]);

        if ($player->team_id !== $team->id || $player->status !== 'active') {
            return back()->with('error', 'Bu o\'yinchini transferga qo\'yish mumkin emas.');
        }

        // O'yinchini transfer ro'yxatiga qo'shish
        $player->update([
            'is_on_transfer' => true,
            'transfer_price' => $request->price
        ]);

        return back()->with('success', $player->nickname . ' transfer bozoriga $' . $request->price . ' narxida qo\'yildi!');
    }
}
