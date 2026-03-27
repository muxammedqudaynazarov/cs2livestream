<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('real_name');
            $table->unsignedInteger('hemis_id')->nullable();
            $table->text('profile_url');
            $table->text('stream_avatar');
            $table->text('user_photo');
            $table->string('country')->default('UZ');
            $table->string('pos')->default('user');
            $table->json('rol')->default(json_encode(['user']));
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
