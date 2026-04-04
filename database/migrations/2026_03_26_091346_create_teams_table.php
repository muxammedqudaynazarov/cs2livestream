<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('tag')->unique();
            $table->string('logo')->nullable();
            $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('captain_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('university_id')->constrained('universities')->cascadeOnDelete();
            $table->string('join_url')->unique()->nullable();
            $table->enum('status', ['active', 'inactive', 'banned'])->default('inactive');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
