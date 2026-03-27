<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('map_number')->default(1);
            $table->foreignId('game_id')->constrained('games')->cascadeOnDelete();
            $table->foreignId('map_id')->constrained('maps')->cascadeOnDelete();
            $table->foreignId('pick_id')->nullable()->constrained('teams')->cascadeOnDelete();
            $table->integer('team_1_score')->default(0);
            $table->integer('team_2_score')->default(0);
            $table->foreignId('winner_team_id')->nullable()->constrained('teams')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
