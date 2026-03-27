<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('code')->nullable();
            $table->unsignedBigInteger('hemis_id')->nullable()->index();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->text('uuid')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialties');
    }
};
