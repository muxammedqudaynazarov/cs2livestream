<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->enum('type', [
                'single_elimination',
                'double_elimination',
                'swiss_system',
                'gsl_groups',
                'group_system',
            ])->default('single_elimination');
            $table->enum('status', ['upcoming', 'live', 'completed'])->default('upcoming');
            $table->integer('max_teams')->default(16);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('deadline_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
