<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedBigInteger('hemis_id')->nullable()->index();
            $table->foreignId('specialty_id')->constrained('specialties')->cascadeOnDelete();
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
