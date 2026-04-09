<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('typings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->string('slug');
            $table->json('teams')->default(json_encode([16, 32]));
            // Inactive, Active, Subtype
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->foreignId('type_id')->nullable()->constrained('typings')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('typings');
    }
};
