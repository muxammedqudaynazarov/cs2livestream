<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->string('key')->unique()->index()->primary()->default('transfer');
            $table->string('section')->default('text');
            $table->string('value')->default('1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
