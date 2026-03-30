<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->integer('round_number')->default(1);
            $table->foreignId('score_id')->constrained('scores')->cascadeOnDelete();
            $table->foreignId('winner_team_id')->constrained('teams')->cascadeOnDelete();
            $table->string('win_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
