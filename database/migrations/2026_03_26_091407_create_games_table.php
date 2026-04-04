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
            $table->enum('status', ['waiting', 'picked', 'live', 'finished', 'delayed'])->default('waiting');
            $table->string('format')->default('BO3');
            $table->enum('win', ['t1', 't2'])->default('t1');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
