<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_1_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('team_2_id')->constrained('teams')->cascadeOnDelete();
            $table->string('stage')->default('Selection 1');
            $table->enum('status', ['planned', 'waiting', 'picking', 'picked', 'live', 'finished', 'delayed'])->default('waiting');
            $table->string('format')->default('BO3');
            $table->enum('win', ['t1', 't2'])->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->json('veto')->nullable();
            $table->json('confirmed')->default(json_encode([
                'team1' => [
                    'status' => false,
                    'confirmed_at' => now(),
                ],
                'team2' => [
                    'status' => false,
                    'confirmed_at' => now(),
                ],
            ]));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
