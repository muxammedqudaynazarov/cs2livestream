<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // Zudlik bilan ishlashi uchun Now
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $matchId;

    public function __construct($matchId)
    {
        $this->matchId = $matchId;
    }

    public function broadcastOn()
    {
        // Kanal nomi
        return new Channel('match.' . $this->matchId);
    }

    public function broadcastAs()
    {
        return 'MatchUpdated';
    }
}
